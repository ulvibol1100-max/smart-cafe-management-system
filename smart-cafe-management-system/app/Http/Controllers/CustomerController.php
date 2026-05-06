<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless(auth()->user()?->is_admin, 403);

        return view('customers.index', [
            'customers' => Customer::query()
                ->when($request->search, fn ($query, $search) => $query->where('name', 'like', "%{$search}%")->orWhere('phone', 'like', "%{$search}%"))
                ->latest()
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function create(): View
    {
        abort_unless(auth()->user()?->is_admin, 403);

        return view('customers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(auth()->user()?->is_admin, 403);

        Customer::create($this->validatedCustomer($request));

        return redirect()->route('customers.index')->with('success', 'Customer created.');
    }

    public function edit(Customer $customer): View
    {
        abort_unless(auth()->user()?->is_admin, 403);

        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer): RedirectResponse
    {
        abort_unless(auth()->user()?->is_admin, 403);

        $customer->update($this->validatedCustomer($request));

        return redirect()->route('customers.index')->with('success', 'Customer updated.');
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        abort_unless(auth()->user()?->is_admin, 403);

        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted.');
    }

    private function validatedCustomer(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'loyalty_points' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
