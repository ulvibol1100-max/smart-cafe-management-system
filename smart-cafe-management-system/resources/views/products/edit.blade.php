<x-layouts.app title="Edit Product">
    <h1 class="mb-6 text-3xl font-bold">Edit product</h1>
    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="rounded-lg border border-stone-200 bg-white p-6 shadow-sm">
        @method('PUT')
        @include('products.form')
    </form>
</x-layouts.app>
