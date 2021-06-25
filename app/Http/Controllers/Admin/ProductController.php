<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Tenant\ManagerTenant;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate();

        return view("admin.pages.products.index", [
            "products" => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.products.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProduct $request)
    {
        $data = $request->all();

        $tenantUuid = app(ManagerTenant::class)->getTenantUuid();

        if($request->hasFile('image') && $request->image->isValid()) {
            $data["image"] = $request->image->store("tenants/{$tenantUuid}/products");
        }
        
        Product::create($data);

        return redirect()->route("products.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$product = Product::find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.products.show", [
            "product" => $product
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
        if (!$product = Product::find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.products.edit", [
            "product" => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateProduct  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProduct $request, $id)
    {
        if (!$product = Product::find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        $tenantUuid = app(ManagerTenant::class)->getTenantUuid();

        if($request->hasFile('image') && $request->image->isValid()) {

            if(Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            $data["image"] = $request->image->store("tenants/{$tenantUuid}/products");
        }

        $product->update($data);

        return redirect()->route("products.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$product = Product::find($id)) {
            return redirect()->back();
        }

        if(Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route("products.index");
    }

    public function search(Request $request)
    {
        $filters = $request->except("_token");
        $filteredCategories = Product::search($request->filter);

        return view("admin.pages.products.index", [
            "products" => $filteredCategories,
            "filters" => $filters
        ]);
    }
}
