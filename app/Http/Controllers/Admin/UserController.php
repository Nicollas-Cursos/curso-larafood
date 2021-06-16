<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUpdateUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::tenantUser()->latest()->paginate();

        return view("admin.pages.users.index", [
            "users" => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser $request)
    {
        $data = $request->all();

        $data['tenant_id'] = auth()->user()->tenant_id;
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route("users.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$user = User::tenantUser()->find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.users.show", [
            "user" => $user
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
        if(!$user = User::tenantUser()->find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.users.edit", [
            "user" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUser  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, StoreUpdateUser $request)
    {
        if(!$user = User::tenantUser()->find($id)) {
            return redirect()->back();
        }

        $data = $request->only(["name", "email"]);

        if($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route("users.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$user = User::tenantUser()->find($id)) {
            return redirect()->back();
        }

        $user->delete();

        return redirect()->route("users.index");
    }

    public function search(Request $request)
    {
        $filters = $request->except("_token");
        $filteredUsers = User::search($request->filter);

        return view("admin.pages.users.index", [
            "users" => $filteredUsers,
            "filters" => $filters
        ]);
    }
}
