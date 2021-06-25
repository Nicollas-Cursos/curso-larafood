<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryProductController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:products");
    }

    public function categories($productId)
    {
        if (!$product = Product::find($productId)) {
            return redirect()->back();
        }

        $categories = $product->categories()->paginate();

        return view("admin.pages.products.categories.index", [
            "product" => $product,
            "categories" => $categories
        ]);
    }

    public function categoriesAvailable($productId, Request $request)
    {
        if (!$product = Product::find($productId)) {
            return redirect()->back();
        }

        $filters = $request->except("_token");

        $categories = $product->categoriesAvailable($request->filter);

        return view("admin.pages.products.categories.available", [
            "product" => $product,
            "categories" => $categories,
            "filters" => $filters
        ]);
    }

    public function attachCategoriesProduct($productId, Request $request)
    {
        if (!$request->categories) {
            return redirect()->back()->with("warning", "Marque alguma categoria para vincular.");
        }

        if (!$product = Product::find($productId)) {
            return redirect()->back();
        }

        $product->categories()->attach($request->categories);

        return redirect()->route("product.categories", $product->id);
    }

    public function detachCategoryProduct($productId, $categoryId)
    {
        if (!$product = Product::find($productId)) {
            return redirect()->back();
        }

        if (!$category = Category::find($categoryId)) {
            return redirect()->back();
        }

        $product->categories()->detach($category);

        return redirect()->route("product.categories", $product->id);
    }
}
