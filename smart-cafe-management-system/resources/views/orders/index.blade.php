<x-layouts.app title="Orders">
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4 rounded-lg border border-white/70 bg-white/75 p-5 shadow-sm">
        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-amber-700">Sales</p>
            <h1 class="mt-1 text-3xl font-bold tracking-tight">Orders</h1>
        </div>
        <a href="{{ route('orders.create') }}" class="rounded-md bg-stone-950 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-stone-800">New Order</a>
    </div>

    <form class="mb-5 flex flex-wrap gap-3 rounded-lg border border-white bg-white p-4 shadow-sm">
        <input type="date" name="date" value="{{ request('date') }}" class="rounded-md border border-stone-300 bg-stone-50 px-3 py-2 outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-100">
        <select name="status" class="rounded-md border border-stone-300 bg-stone-50 px-3 py-2 outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-100">
            <option value="">All statuses</option>
            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
            <option value="completed" @selected(request('status') === 'completed')>Completed</option>
        </select>
        <button class="rounded-md bg-stone-900 px-4 py-2 font-semibold text-white shadow-sm">Filter</button>
    </form>

    <div class="overflow-hidden rounded-lg border border-white bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-stone-950 text-white">
                <tr><th class="px-5 py-3">Order ID</th><th class="px-5 py-3">Customer</th><th class="px-5 py-3">Date</th><th class="px-5 py-3">Status</th><th class="px-5 py-3">Total</th><th class="px-5 py-3"></th></tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="border-t border-stone-100 hover:bg-amber-50/50">
                        <td class="px-5 py-3 font-medium">#{{ $order->id }}</td>
                        <td class="px-5 py-3">{{ $order->customer->name }}</td>
                        <td class="px-5 py-3">{{ $order->created_at->format('M d, Y') }}</td>
                        <td class="px-5 py-3">
                            <span class="rounded-full px-3 py-1 text-xs font-bold capitalize {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-800' }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-5 py-3">${{ number_format($order->total_price, 2) }}</td>
                        <td class="px-5 py-3">
                            <div class="flex flex-wrap justify-end gap-2">
                                @if ($order->status === 'pending')
                                    <form method="POST" action="{{ route('orders.complete', $order) }}" class="complete-order-form">
                                        @csrf
                                        @method('PATCH')
                                        <button class="rounded-md bg-emerald-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-emerald-700">Complete</button>
                                    </form>
                                @endif
                                <a href="{{ route('orders.show', $order) }}" class="rounded-md bg-amber-100 px-3 py-2 font-semibold text-amber-800 hover:bg-amber-200">Receipt</a>
                                <a href="{{ route('orders.edit', $order) }}" class="rounded-md bg-stone-100 px-3 py-2 font-semibold hover:bg-stone-200">Edit</a>
                                @if (auth()->user()->is_admin)
                                    <form method="POST" action="{{ route('orders.destroy', $order) }}" onsubmit="return confirm('Delete this order?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-md bg-red-100 px-3 py-2 font-semibold text-red-700">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-8 text-center text-stone-500">No orders found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{ $orders->links() }}</div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.complete-order-form').forEach((form) => {
            form.addEventListener('submit', (event) => {
                event.preventDefault();

                Swal.fire({
                    title: 'Complete this order?',
                    text: 'Use this when the drink or food is ready.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#059669',
                    cancelButtonColor: '#78716c',
                    confirmButtonText: 'Yes, complete it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        @if (session('success'))
            Swal.fire({
                title: 'Done',
                text: @json(session('success')),
                icon: 'success',
                confirmButtonColor: '#b45309'
            });
        @endif
    </script>
</x-layouts.app>
