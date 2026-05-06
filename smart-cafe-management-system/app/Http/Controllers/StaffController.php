<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function index(): View
    {
        abort_unless(auth()->user()?->is_admin, 403);

        return view('staff.index', [
            'staff' => Staff::latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        abort_unless(auth()->user()?->is_admin, 403);

        return view('staff.create');
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(auth()->user()?->is_admin, 403);

        Staff::create($this->validatedStaff($request));

        return redirect()->route('staff.index')->with('success', 'Staff member added.');
    }

    public function edit(Staff $staff): View
    {
        abort_unless(auth()->user()?->is_admin, 403);

        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff): RedirectResponse
    {
        abort_unless(auth()->user()?->is_admin, 403);

        $staff->update($this->validatedStaff($request));

        return redirect()->route('staff.index')->with('success', 'Staff member updated.');
    }

    public function destroy(Staff $staff): RedirectResponse
    {
        abort_unless(auth()->user()?->is_admin, 403);

        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff member deleted.');
    }

    private function validatedStaff(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'shift' => ['required', 'string', 'max:255'],
        ]);
    }
}
