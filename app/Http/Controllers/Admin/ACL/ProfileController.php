<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProfile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::latest()->paginate();

        return view('admin.pages.profiles.index', [
            'profiles' => $profiles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.profiles.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProfile  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProfile $request)
    {
        Profile::create($request->all());

        return redirect()->route("profiles.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$profile = Profile::find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.profiles.show", [
            "profile" => $profile
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$profile = Profile::find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.profiles.edit", [
            "profile" => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProfile  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, StoreUpdateProfile $request)
    {
        if(!$profile = Profile::find($id)) {
            return redirect()->back();
        }

        $profile->update($request->all());

        return redirect()->route("profiles.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$profile = Profile::find($id)) {
            return redirect()->back();
        }

        $profile->delete();

        return redirect()->route("profiles.index");
    }

    public function search(Request $request)
    {
        $filters = $request->except("_token");
        $filteredProfiles = Profile::search($request->filter);

        return view("admin.pages.profiles.index", [
            "profiles" => $filteredProfiles,
            "filters" => $filters
        ]);
    }
}
