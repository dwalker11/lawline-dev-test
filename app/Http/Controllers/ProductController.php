<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $params = $request->only(['name', 'description', 'price']);
        $prod = Product::create($params);

        return response()->json(['created' => 'success']);
    }

    public function update(Request $request, $id)
    {
        $params = $request->only(['name', 'description', 'price']);
        $prod = Product::find($id)->update($params);

        return response()->json(['updated' => 'success']);
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(['delete' => 'sucess']);
    }

    public function showUserProducts($user)
    {
        $user = User::find($user);
        return response()->json($user->products);
    }

    public function associateUser($id, $user)
    {
        $product = Product::find($id);
        $user = User::find($user);

        $product->user()->associate($user);
        $product->save();

        return response()->json(['associate' => 'success']);
    }

    public function dissociateUser($id)
    {
        $product = Product::find($id);

        $product->user()->dissociate();
        $product->save();

        return response()->json(['dissociate' => 'success']);
    }
}
