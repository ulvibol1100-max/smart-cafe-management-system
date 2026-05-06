<x-layouts.app title="Add Product">
    <h1 class="mb-6 text-3xl font-bold">Add product</h1>
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="rounded-lg border border-stone-200 bg-white p-6 shadow-sm">
        @include('products.form')
    </form>
</x-layouts.app>
