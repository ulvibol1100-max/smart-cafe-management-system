@csrf
<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm font-semibold text-stone-700">Customer name</label>
        <input name="customer_name" value="{{ old('customer_name', $order->customer->name ?? '') }}" placeholder="Walk-in customer name" required class="mt-2 w-full rounded-md border border-stone-300 bg-stone-50 px-4 py-3 text-lg outline-none transition focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-100">
    </div>
    <div>
        <label class="text-sm font-semibold text-stone-700">Status</label>
        <select name="status" class="mt-2 w-full rounded-md border border-stone-300 bg-stone-50 px-4 py-3 text-lg outline-none transition focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-100">
            @foreach (['pending', 'completed'] as $status)
                <option value="{{ $status }}" @selected(old('status', $order->status ?? 'pending') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="mt-6">
    <div class="mb-3 flex items-center justify-between gap-3">
        <h2 class="font-bold">Choose drinks and food</h2>
        <p class="text-xs font-medium uppercase tracking-wider text-stone-400">Quantity</p>
    </div>
    <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($products as $product)
            @php
                $existing = isset($order) ? $order->products->firstWhere('id', $product->id)?->pivot?->quantity : 0;
            @endphp
            <label class="flex min-h-28 items-center justify-between gap-4 rounded-lg border border-stone-200 bg-white p-4 shadow-sm transition hover:border-amber-300 hover:bg-amber-50">
                <span>
                    <span class="inline-flex rounded-full bg-stone-100 px-2 py-1 text-xs font-semibold text-stone-600">{{ $product->category }}</span>
                    <span class="mt-2 block font-semibold">{{ $product->name }}</span>
                    <span class="text-sm font-medium text-amber-700">${{ number_format($product->price, 2) }}</span>
                </span>
                <input type="number" min="0" name="items[{{ $product->id }}]" value="{{ old('items.' . $product->id, $existing) }}" class="h-12 w-20 rounded-md border border-stone-300 bg-stone-50 px-3 text-center text-lg font-bold outline-none transition focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-100">
            </label>
        @endforeach
    </div>
</div>

<div class="mt-6 flex flex-wrap gap-2 border-t border-stone-100 pt-5">
    <button class="rounded-md bg-stone-950 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-stone-800">Save Order</button>
    <a href="{{ route('orders.index') }}" class="rounded-md border border-stone-300 bg-white px-5 py-3 font-semibold text-stone-700 shadow-sm transition hover:bg-stone-100">Cancel</a>
</div>
