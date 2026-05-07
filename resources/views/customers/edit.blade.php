<x-layouts.app title="Edit Customer">
    <h1 class="mb-6 text-3xl font-bold">Edit customer</h1>
    <form method="POST" action="{{ route('customers.update', $customer) }}" class="rounded-lg border border-stone-200 bg-white p-6 shadow-sm">
        @method('PUT')
        @include('customers.form')
    </form>
</x-layouts.app>
