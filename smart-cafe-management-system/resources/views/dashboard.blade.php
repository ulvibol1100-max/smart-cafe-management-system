<x-layouts.app title="Dashboard">
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4 rounded-lg border border-white/70 bg-white/75 p-5 shadow-sm">
        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-amber-700">Dashboard</p>
            <h1 class="mt-1 text-3xl font-bold tracking-tight">Cafe overview</h1>
        </div>
        <a href="{{ route('orders.create') }}" class="rounded-md bg-stone-950 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-stone-800">New Order</a>
    </div>

    <div class="grid gap-4 md:grid-cols-4">
        <div class="rounded-lg border border-white bg-white p-5 shadow-sm">
            <p class="text-sm text-stone-500">Sales today</p>
            <p class="mt-2 text-2xl font-bold">${{ number_format($salesToday, 2) }}</p>
        </div>
        <div class="rounded-lg border border-white bg-white p-5 shadow-sm">
            <p class="text-sm text-stone-500">Orders today</p>
            <p class="mt-2 text-2xl font-bold">{{ $ordersToday }}</p>
        </div>
        <div class="rounded-lg border border-white bg-white p-5 shadow-sm">
            <p class="text-sm text-stone-500">Pending</p>
            <p class="mt-2 text-2xl font-bold">{{ $pendingOrders }}</p>
        </div>
        <div class="rounded-lg border border-white bg-white p-5 shadow-sm">
            <p class="text-sm text-stone-500">Best seller</p>
            <p class="mt-2 text-lg font-bold">{{ $bestSeller?->name ?? 'No sales yet' }}</p>
        </div>
    </div>

    <div class="mt-8 overflow-hidden rounded-lg border border-white bg-white shadow-sm">
        <div class="border-b border-stone-100 px-5 py-4">
            <h2 class="font-bold">Recent orders</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-stone-100 text-stone-600">
                    <tr>
                        <th class="px-5 py-3">Order</th>
                        <th class="px-5 py-3">Customer</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Total</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentOrders as $order)
                        <tr class="border-t border-stone-100 hover:bg-amber-50/50">
                            <td class="px-5 py-3">#{{ $order->id }}</td>
                            <td class="px-5 py-3">{{ $order->customer->name }}</td>
                            <td class="px-5 py-3 capitalize">{{ $order->status }}</td>
                            <td class="px-5 py-3">${{ number_format($order->total_price, 2) }}</td>
                            <td class="px-5 py-3 text-right"><a class="font-semibold text-amber-700" href="{{ route('orders.show', $order) }}">Receipt</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-8 text-center text-stone-500">No orders yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
