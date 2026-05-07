<x-layouts.app title="New Order">
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4 rounded-lg border border-white/70 bg-white/75 p-5 shadow-sm">
        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-amber-700">Counter</p>
            <h1 class="mt-1 text-3xl font-bold tracking-tight">New order</h1>
            <p class="mt-1 text-sm text-stone-500">Type the customer name, enter quantities, then save the order.</p>
        </div>
        <a href="{{ route('orders.index') }}" class="rounded-md border border-stone-300 bg-white px-4 py-2 text-sm font-semibold text-stone-700 shadow-sm hover:bg-stone-100">View Orders</a>
    </div>
    <form method="POST" action="{{ route('orders.store') }}" class="rounded-lg border border-white bg-white p-5 shadow-sm sm:p-6">
        @include('orders.form')
    </form>
</x-layouts.app>
