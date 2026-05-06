<x-layouts.app title="Edit Staff">
    <div class="mb-6 rounded-lg border border-white/70 bg-white/75 p-5 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-widest text-amber-700">Team</p>
        <h1 class="mt-1 text-3xl font-bold tracking-tight">Edit staff</h1>
    </div>
    <form method="POST" action="{{ route('staff.update', $staff) }}" class="rounded-lg border border-white bg-white p-5 shadow-sm sm:p-6">@method('PUT') @include('staff.form')</form>
</x-layouts.app>
