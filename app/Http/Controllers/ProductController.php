<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->all();
        $prod = new Product();

        $prod->name = $params['name'];
        $prod->description = $params['description'];
        $prod->price = $params['price'];
        $prod->save();

        return $prod;
    }

    public function destroy($id)
    {
        return Product::destroy($id);
    }

    // public function index()
    // public function show($id)
    // public function update($id)
}
