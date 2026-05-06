<x-layouts.app title="Staff">
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <div><p class="text-sm font-semibold uppercase tracking-widest text-amber-700">Team</p><h1 class="text-3xl font-bold">Staff</h1></div>
        <a href="{{ route('staff.create') }}" class="rounded-md bg-amber-700 px-4 py-2 font-semibold text-white hover:bg-amber-800">Add Staff</a>
    </div>
    <div class="overflow-hidden rounded-lg border border-stone-200 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-stone-100 text-stone-600"><tr><th class="px-5 py-3">Name</th><th class="px-5 py-3">Role</th><th class="px-5 py-3">Shift</th><th class="px-5 py-3"></th></tr></thead>
            <tbody>
                @forelse ($staff as $member)
                    <tr class="border-t border-stone-100">
                        <td class="px-5 py-3 font-medium">{{ $member->name }}</td><td class="px-5 py-3">{{ $member->role }}</td><td class="px-5 py-3">{{ $member->shift }}</td>
                        <td class="px-5 py-3"><div class="flex justify-end gap-2"><a href="{{ route('staff.edit', $member) }}" class="rounded-md bg-stone-100 px-3 py-2 font-semibold">Edit</a>@if (auth()->user()->is_admin)<form method="POST" action="{{ route('staff.destroy', $member) }}" onsubmit="return confirm('Delete this staff member?')">@csrf @method('DELETE')<button class="rounded-md bg-red-100 px-3 py-2 font-semibold text-red-700">Delete</button></form>@endif</div></td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-5 py-8 text-center text-stone-500">No staff records yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{ $staff->links() }}</div>
</x-layouts.app>
