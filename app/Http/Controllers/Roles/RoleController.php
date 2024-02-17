<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('viewAny', Role::class);
        $roles = Role::query()->paginate(10);

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('create', Role::class);
        $permissions = Permission::query()->get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);
        $request->validate([
           'name' => 'required|string|unique:roles,name',
           'permissions' => '',
           'permissions.*' => 'required|integer|exists:permissions,id'
        ]);

        $role = Role::query()->create([
            'name' => $request->name
        ]);

        if (! empty($request->permissions)) {
            $permissions = Permission::query()->whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index')->with('success', 'permission created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('view', $role);

        return view('roles.show', [
            'role' => $role->load('permissions')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('update', $role);
        $permissions = Permission::query()->get();

        return view('roles.edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $this->authorize('update', $role);
        $request->validate([
            'name' => 'required|string',
            'permissions' => '',
            'permissions.*' => 'required|integer|exists:permissions,id'
        ]);

        $role->update([
            'name' => $request->name
        ]);

        if (! empty($request->permissions)) {
            $permissions = Permission::query()->whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        }

        return redirect()->back()->with('success', 'permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        $this->authorize('delete', $role);
        $role->delete();
        return redirect()->back()->with('success', 'permission deleted successfully');
    }

}
