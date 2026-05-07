@csrf
<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm font-medium">Name</label>
        <input name="name" value="{{ old('name', $product->name ?? '') }}" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2">
    </div>
    <div>
        <label class="text-sm font-medium">Category</label>
        <input name="category" value="{{ old('category', $product->category ?? '') }}" placeholder="Coffee, Drink, Food" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2">
    </div>
    <div>
        <label class="text-sm font-medium">Price</label>
        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $product->price ?? '') }}" required class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2">
    </div>
    <div>
        <label class="text-sm font-medium">Image</label>
        <input type="file" name="image" accept="image/*" class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2">
    </div>
</div>
<div class="mt-6 flex gap-2">
    <button class="rounded-md bg-amber-700 px-4 py-2 font-semibold text-white hover:bg-amber-800">Save</button>
    <a href="{{ route('products.index') }}" class="rounded-md bg-stone-200 px-4 py-2 font-semibold text-stone-700 hover:bg-stone-300">Cancel</a>
</div>
