<x-layouts.app title="Products">
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-amber-700">Menu</p>
            <h1 class="text-3xl font-bold">Products</h1>
        </div>
        <a href="{{ route('products.create') }}" class="rounded-md bg-amber-700 px-4 py-2 font-semibold text-white hover:bg-amber-800">Add Product</a>
    </div>

    <form class="mb-5 flex flex-wrap gap-3">
        <input name="search" value="{{ request('search') }}" placeholder="Search products..." class="rounded-md border border-stone-300 px-3 py-2">
        <select name="category" class="rounded-md border border-stone-300 px-3 py-2">
            <option value="">All categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
            @endforeach
        </select>
        <button class="rounded-md bg-stone-900 px-4 py-2 font-semibold text-white">Filter</button>
    </form>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @forelse ($products as $product)
            <div class="overflow-hidden rounded-lg border border-stone-200 bg-white shadow-sm">
                <div class="aspect-video bg-stone-100">
                    @if ($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                    @else
                        <div class="flex h-full items-center justify-center text-sm text-stone-400">No image</div>
                    @endif
                </div>
                <div class="p-4">
                    <p class="text-xs font-semibold uppercase tracking-wider text-amber-700">{{ $product->category }}</p>
                    <h2 class="mt-1 font-bold">{{ $product->name }}</h2>
                    <p class="mt-2 text-lg font-bold">${{ number_format($product->price, 2) }}</p>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('products.edit', $product) }}" class="rounded-md bg-stone-100 px-3 py-2 text-sm font-semibold">Edit</a>
                        @if (auth()->user()->is_admin)
                            <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-md bg-red-100 px-3 py-2 text-sm font-semibold text-red-700">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-lg border border-stone-200 bg-white p-8 text-stone-500">No products found.</div>
        @endforelse
    </div>
    <div class="mt-5">{{ $products->links() }}</div>
</x-layouts.app>
