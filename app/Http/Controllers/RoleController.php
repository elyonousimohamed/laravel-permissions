<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles.index')->only(['index']);
        $this->middleware('can:roles.show')->only(['show']);
        $this->middleware('can:roles.create')->only(['create']);
        $this->middleware('can:roles.store')->only(['store']);
        $this->middleware('can:roles.edit')->only(['edit']);
        $this->middleware('can:roles.update')->only(['update']);
        $this->middleware('can:roles.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', "string"],
            'permissions' => ["required", "array", "min:1"],
        ]);

        $input['name'] = $request->name;
        $permissions = [];
        foreach ($request->permissions as $value) {
            $permissions[] = $value;
        }

        $input['permissions'] = $permissions;

        Role::create($input);

        return Redirect::route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return response()->json($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact(['role']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', "string"],
            'permissions' => ["required", "array", "min:1"],
        ]);

        $permissions = [];
        foreach ($request->permissions as $value) {
            $permissions[] = $value;
        }

        $role->update([
            'name' => $request->name,
            'permissions' => $permissions
        ]);

        return Redirect::route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return Redirect::route('roles.index');
    }
}
