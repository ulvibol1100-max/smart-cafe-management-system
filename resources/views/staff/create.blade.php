<x-layouts.app title="Add Staff">
    <div class="mb-6 rounded-lg border border-white/70 bg-white/75 p-5 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-widest text-amber-700">Team</p>
        <h1 class="mt-1 text-3xl font-bold tracking-tight">Add staff</h1>
    </div>
    <form method="POST" action="{{ route('staff.store') }}" class="rounded-lg border border-white bg-white p-5 shadow-sm sm:p-6">@include('staff.form')</form>
</x-layouts.app>
