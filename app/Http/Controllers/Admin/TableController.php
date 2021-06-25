<?php

namespace App\Http\Controllers\Admin;

use App\Models\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTable;

class TableController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:tables");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::latest()->paginate();

        return view("admin.pages.tables.index", [
            "tables" => $tables
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.tables.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateTable  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTable $request)
    {
        Table::create($request->all());

        return redirect()->route("tables.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$table = Table::find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.tables.show", [
            "table" => $table
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
        if (!$table = Table::find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.tables.edit", [
            "table" => $table
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateTable  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTable $request, $id)
    {
        if (!$table = Table::find($id)) {
            return redirect()->back();
        }

        $table->update($request->all());

        return redirect()->route("tables.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$table = Table::find($id)) {
            return redirect()->back();
        }

        $table->delete();

        return redirect()->route("tables.index");
    }

    public function search(Request $request)
    {
        $filters = $request->except("_token");
        $filteredTables = Table::search($request->filter);

        return view("admin.pages.tables.index", [
            "tables" => $filteredTables,
            "filters" => $filters
        ]);
    }
}
