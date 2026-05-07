@csrf
<div class="grid gap-4 md:grid-cols-3">
    <div>
        <label class="text-sm font-semibold text-stone-700">Name</label>
        <input name="name" value="{{ old('name', $staff->name ?? '') }}" required class="mt-2 w-full rounded-md border border-stone-300 bg-stone-50 px-4 py-3 outline-none transition focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-100">
    </div>
    <div>
        <label class="text-sm font-semibold text-stone-700">Role</label>
        <select name="role" class="mt-2 w-full rounded-md border border-stone-300 bg-stone-50 px-4 py-3 outline-none transition focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-100">
            @foreach (['Barista', 'Cashier', 'Manager'] as $role)
                <option @selected(old('role', $staff->role ?? '') === $role)>{{ $role }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm font-semibold text-stone-700">Shift</label>
        <input name="shift" value="{{ old('shift', $staff->shift ?? '') }}" placeholder="Morning, Evening" required class="mt-2 w-full rounded-md border border-stone-300 bg-stone-50 px-4 py-3 outline-none transition focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-100">
    </div>
</div>
<div class="mt-6 flex gap-2 border-t border-stone-100 pt-5">
    <button class="rounded-md bg-stone-950 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-stone-800">Save</button>
    <a href="{{ route('staff.index') }}" class="rounded-md border border-stone-300 bg-white px-5 py-3 font-semibold text-stone-700 shadow-sm transition hover:bg-stone-100">Cancel</a>
</div>
