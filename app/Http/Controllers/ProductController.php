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
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $params = $request->only(['name', 'description', 'price']);
        $prod = Product::create($params);

        if ($request->file('image')->isValid()) {
            $file = $request->file('image');

            $destinationPath = storage_path('/uploads');
            $fileName = $product->id."-".$file->getClientOriginalName();

            $file->move($destinationPath, $fileName);
            $product->image = $destinationPath . DIRECTORY_SEPARATOR . $filename;
        }

        return response()->json(['created' => 'success']);
    }

    public function update(Request $request, $id)
    {
        $params = $request->only(['name', 'description', 'price']);
        $prod = Product::findOrFail($id)->update($params);

        return response()->json(['updated' => 'success']);
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(['delete' => 'success']);
    }

    public function showUserProducts($user)
    {
        $user = User::findOrFail($user);
        return response()->json($user->products);
    }

    public function associateUser($id, $user)
    {
        $product = Product::findOrFail($id);
        $user = User::findOrFail($user);

        $product->user()->associate($user);
        $product->save();

        return response()->json(['associate' => 'success']);
    }

    public function dissociateUser($id)
    {
        $product = Product::findOrFail($id);

        $product->user()->dissociate();
        $product->save();

        return response()->json(['dissociate' => 'success']);
    }

    public function uploadProductImage(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->file('image')->isValid()) {
            $file = $request->file('image');

            $destinationPath = storage_path('/uploads');
            $fileName = $product->id."-".$file->getClientOriginalName();

            $file->move($destinationPath, $fileName);
            $product->image = $destinationPath.DIRECTORY_SEPARATOR.$filename;

            return response()->json(['upload' => 'success']);
        }

        return response()->json(['upload' => 'failed']);
    }
}
