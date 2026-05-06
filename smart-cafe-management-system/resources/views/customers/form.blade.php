@csrf
<div class="grid gap-4 md:grid-cols-3">
    <div>
        <label class="text-sm font-medium">Name</label>
        <input name="name" value="{{ old('name', $customer->name ?? '') }}" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2">
    </div>
    <div>
        <label class="text-sm font-medium">Phone number</label>
        <input name="phone" value="{{ old('phone', $customer->phone ?? '') }}" class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2">
    </div>
    <div>
        <label class="text-sm font-medium">Loyalty points</label>
        <input type="number" min="0" name="loyalty_points" value="{{ old('loyalty_points', $customer->loyalty_points ?? 0) }}" class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2">
    </div>
</div>
<div class="mt-6 flex gap-2">
    <button class="rounded-md bg-amber-700 px-4 py-2 font-semibold text-white hover:bg-amber-800">Save</button>
    <a href="{{ route('customers.index') }}" class="rounded-md bg-stone-200 px-4 py-2 font-semibold text-stone-700 hover:bg-stone-300">Cancel</a>
</div>
