<x-layouts.app title="Edit Order">
    <div class="mb-6 rounded-lg border border-white/70 bg-white/75 p-5 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-widest text-amber-700">Order</p>
        <h1 class="mt-1 text-3xl font-bold tracking-tight">Edit order #{{ $order->id }}</h1>
    </div>
    <form method="POST" action="{{ route('orders.update', $order) }}" class="rounded-lg border border-white bg-white p-5 shadow-sm sm:p-6">
        @method('PUT')
        @include('orders.form')
    </form>
</x-layouts.app>
