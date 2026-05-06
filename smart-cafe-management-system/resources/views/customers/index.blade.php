<x-layouts.app title="Customers">
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-amber-700">CRM</p>
            <h1 class="text-3xl font-bold">Customers</h1>
        </div>
        <a href="{{ route('customers.create') }}" class="rounded-md bg-amber-700 px-4 py-2 font-semibold text-white hover:bg-amber-800">Add Customer</a>
    </div>
    <form class="mb-5 flex gap-3">
        <input name="search" value="{{ request('search') }}" placeholder="Search name or phone..." class="rounded-md border border-stone-300 px-3 py-2">
        <button class="rounded-md bg-stone-900 px-4 py-2 font-semibold text-white">Search</button>
    </form>
    <div class="overflow-hidden rounded-lg border border-stone-200 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-stone-100 text-stone-600">
                <tr><th class="px-5 py-3">Name</th><th class="px-5 py-3">Phone</th><th class="px-5 py-3">Points</th><th class="px-5 py-3"></th></tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr class="border-t border-stone-100">
                        <td class="px-5 py-3 font-medium">{{ $customer->name }}</td>
                        <td class="px-5 py-3">{{ $customer->phone ?: '-' }}</td>
                        <td class="px-5 py-3">{{ $customer->loyalty_points }}</td>
                        <td class="px-5 py-3">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('customers.edit', $customer) }}" class="rounded-md bg-stone-100 px-3 py-2 font-semibold">Edit</a>
                                @if (auth()->user()->is_admin)
                                    <form method="POST" action="{{ route('customers.destroy', $customer) }}" onsubmit="return confirm('Delete this customer?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-md bg-red-100 px-3 py-2 font-semibold text-red-700">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-5 py-8 text-center text-stone-500">No customers found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{ $customers->links() }}</div>
</x-layouts.app>
