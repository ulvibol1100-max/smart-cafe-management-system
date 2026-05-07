<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        abort_unless(auth()->user()?->is_admin, 403);

        $today = now()->toDateString();

        $bestSeller = Product::query()
            ->select('products.*', DB::raw('COALESCE(SUM(order_items.quantity), 0) as sold_count'))
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id')
            ->orderByDesc('sold_count')
            ->first();

        return view('dashboard', [
            'salesToday' => Order::whereDate('created_at', $today)->sum('total_price'),
            'ordersToday' => Order::whereDate('created_at', $today)->count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'completedOrders' => Order::where('status', 'completed')->count(),
            'bestSeller' => $bestSeller,
            'recentOrders' => Order::with('customer')->latest()->take(5)->get(),
        ]);
    }
}
