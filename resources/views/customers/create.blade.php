<x-layouts.app title="Add Customer">
    <h1 class="mb-6 text-3xl font-bold">Add customer</h1>
    <form method="POST" action="{{ route('customers.store') }}" class="rounded-lg border border-stone-200 bg-white p-6 shadow-sm">
        @include('customers.form')
    </form>
</x-layouts.app>
