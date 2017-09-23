<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        return Product::find($id);
    }

    public function store(Request $request)
    {
        $params = $request->only(['name', 'description', 'price']);
        $prod = Product::create($params);

        return $prod;
    }

    public function update(Request $request, $id)
    {
        $params = $request->only(['name', 'description', 'price']);
        $prod = Product::find($id)->update($params);

        return $prod;
    }

    public function destroy($id)
    {
        return Product::destroy($id);
    }
}
