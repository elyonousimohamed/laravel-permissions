<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
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
        $permissions = [
            'create',
            'edit',
            'view',
            'delete'
        ];
        return view('roles.create', compact('permissions'));
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
            'permissions' => ["required"],
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
        // $this->routes[] = [
        //     "route" => "offers.edit",
        //     "current" => "offers.edit",
        //     "params" => $offer->id,
        //     "name" => "edit",
        // ];
        // $offer->cover = $this->getImageS3($offer->cover);
        // return Inertia::render('Offers/Edit', [
        //     'routes' => $this->routes,
        //     'offer' => $offer,
        // ]);
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
        // $validated = $request->validate([
        //     'button_url' => ['required', "string"],
        //     'cover' => ["required", "image", "mimes:jpeg,png,jpg,webp", "max:2048"],
        // ]);

        // $offer->update([
        //     'title' => [
        //         'ar' => $request->title_ar,
        //         'fr' => $request->title_fr,
        //     ],
        //     'subtitle' => [
        //         'ar' => $request->subtitle_ar,
        //         'fr' => $request->subtitle_fr,
        //     ],
        //     'button_text' => [
        //         'ar' => $request->button_text_ar,
        //         'fr' => $request->button_text_fr,
        //     ],
        //     'button_url' => $request->button_url,
        //     'cover' => str_contains($request->cover, 'https://madinashop.s3.eu-west-3.amazonaws.com') ? $offer->cover : $this->saveImageS3('offers-cover', $request, 'cover'),
        //     'type' => $request->type,
        //     'active' => $request->active,
        //     'location' => $request->location
        // ]);

        // return Redirect::route('offers.index');
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
