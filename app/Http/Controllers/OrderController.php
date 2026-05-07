<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::with('customer')
            ->when($request->date, fn ($query, $date) => $query->whereDate('created_at', $date))
            ->when($request->status, fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('orders.index', compact('orders'));
    }

    public function create(): View
    {
        return view('orders.create', [
            'products' => Product::orderBy('category')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedOrder($request);

        $order = DB::transaction(function () use ($data) {
            $customer = Customer::firstOrCreate(
                ['name' => $data['customer_name']],
                ['phone' => null, 'loyalty_points' => 0]
            );

            $order = Order::create([
                'customer_id' => $customer->id,
                'status' => $data['status'],
                'total_price' => 0,
            ]);

            $total = $this->syncItems($order, $data['items']);
            $order->update(['total_price' => $total]);

            if ($order->status === 'completed') {
                $order->customer->increment('loyalty_points', (int) floor($total / 10));
            }

            return $order;
        });

        return redirect()->route('orders.show', $order)->with('success', 'Order created.');
    }

    public function show(Order $order): View
    {
        return view('orders.show', [
            'order' => $order->load(['customer', 'products']),
        ]);
    }

    public function edit(Order $order): View
    {
        return view('orders.edit', [
            'order' => $order->load('products'),
            'products' => Product::orderBy('category')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $data = $this->validatedOrder($request);
        $wasCompleted = $order->status === 'completed';

        DB::transaction(function () use ($data, $order, $wasCompleted) {
            $customer = Customer::firstOrCreate(
                ['name' => $data['customer_name']],
                ['phone' => null, 'loyalty_points' => 0]
            );

            $order->update([
                'customer_id' => $customer->id,
                'status' => $data['status'],
            ]);

            $total = $this->syncItems($order, $data['items']);
            $order->update(['total_price' => $total]);

            if (! $wasCompleted && $order->status === 'completed') {
                $order->customer->increment('loyalty_points', (int) floor($total / 10));
            }
        });

        return redirect()->route('orders.show', $order)->with('success', 'Order updated.');
    }

    public function complete(Order $order): RedirectResponse
    {
        if ($order->status !== 'completed') {
            $order->update(['status' => 'completed']);
            $order->customer->increment('loyalty_points', (int) floor((float) $order->total_price / 10));
        }

        return redirect()->route('orders.index')->with('success', "Order #{$order->id} completed.");
    }

    public function destroy(Order $order): RedirectResponse
    {
        abort_unless(auth()->user()?->is_admin, 403);

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted.');
    }

    private function validatedOrder(Request $request): array
    {
        return $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(['pending', 'completed'])],
            'items' => ['required', 'array'],
            'items.*' => ['nullable', 'integer', 'min:0'],
        ]);
    }

    private function syncItems(Order $order, array $items): float
    {
        $sync = [];
        $total = 0;

        foreach ($items as $productId => $quantity) {
            $quantity = (int) $quantity;

            if ($quantity < 1) {
                continue;
            }

            $product = Product::findOrFail($productId);
            $subtotal = $quantity * (float) $product->price;
            $total += $subtotal;

            $sync[$product->id] = [
                'quantity' => $quantity,
                'unit_price' => $product->price,
                'subtotal' => $subtotal,
            ];
        }

        abort_if($sync === [], 422, 'Please select at least one product.');

        $order->products()->sync($sync);

        return $total;
    }
}
