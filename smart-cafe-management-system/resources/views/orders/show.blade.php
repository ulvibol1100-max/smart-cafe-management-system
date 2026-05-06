<x-layouts.app title="Receipt">
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3 print:hidden">
        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-amber-700">Receipt</p>
            <h1 class="text-3xl font-bold">Order #{{ $order->id }}</h1>
        </div>
        <div class="flex gap-2">
            <button onclick="window.print()" class="rounded-md bg-stone-900 px-4 py-2 font-semibold text-white">Print</button>
            <a href="{{ route('orders.edit', $order) }}" class="rounded-md bg-stone-200 px-4 py-2 font-semibold text-stone-700">Edit</a>
        </div>
    </div>

    <div class="mx-auto max-w-xl rounded-lg border border-stone-200 bg-white p-8 shadow-sm print:border-0 print:shadow-none">
        <div class="border-b border-stone-200 pb-4">
            <p class="text-sm font-semibold uppercase tracking-widest text-amber-700">Smart Cafe</p>
            <h2 class="text-2xl font-bold">Receipt #{{ $order->id }}</h2>
            <p class="mt-1 text-sm text-stone-500">{{ $order->created_at->format('M d, Y h:i A') }}</p>
        </div>
        <div class="mt-4 text-sm">
            <p><span class="font-semibold">Customer:</span> {{ $order->customer->name }}</p>
            <p><span class="font-semibold">Phone:</span> {{ $order->customer->phone ?: '-' }}</p>
            <p><span class="font-semibold">Status:</span> {{ ucfirst($order->status) }}</p>
        </div>
        <table class="mt-6 w-full text-left text-sm">
            <thead class="border-b border-stone-200 text-stone-500"><tr><th class="py-2">Item</th><th class="py-2 text-center">Qty</th><th class="py-2 text-right">Subtotal</th></tr></thead>
            <tbody>
                @foreach ($order->products as $product)
                    <tr class="border-b border-stone-100">
                        <td class="py-3">{{ $product->name }}<div class="text-xs text-stone-500">${{ number_format($product->pivot->unit_price, 2) }} each</div></td>
                        <td class="py-3 text-center">{{ $product->pivot->quantity }}</td>
                        <td class="py-3 text-right">${{ number_format($product->pivot->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr><td colspan="2" class="pt-4 text-right text-lg font-bold">Total</td><td class="pt-4 text-right text-lg font-bold">${{ number_format($order->total_price, 2) }}</td></tr>
            </tfoot>
        </table>
        <p class="mt-6 text-center text-sm text-stone-500">Thank you for visiting Smart Cafe.</p>
    </div>
</x-layouts.app>
