<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductGallery;

class ProductService{

    public function index(){
        $products = Product::join('product_galleries', 'products.id', '=', 'product_galleries.product_id')->paginate(15);

        return response()->json($products);
    }

    public function create($request){
        $product = new Product;

        $store = $product->create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price
        ])->id;
        
        if($request->hasFile('file')){
            $file = $request->file;
            $rename = md5(time().''.rand(0,9999)).'.'.$file->getClientOriginalExtension();
            $stor = $file->storeAs('public/products/images', $rename);

            $gallery = new ProductGallery;
            $create = $gallery->create([
                'product_id' => $store,
                'url' => 'products/images/'.$rename
            ]);
        } 

        return response()->json($store);
    }
    public function update($id, $request){
        $product = Product::find($id);

        $update = $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price
        ]);

        if($request->hasFile('file')){
            $file = $request->file;
            $rename = md5(time().''.rand(0,9999)).'.'.$file->getClientOriginalExtension();
            $stor = $file->storeAs('public/products/images', $rename);

            $gallery = ProductGallery::where('product_id', $id)->first();
            $create = $gallery->update([
                'url' => 'products/images/'.$rename
            ]);
        }
        
        return response()->json($update);
    }
    public function show($id){
        $product = Product::find($id)->join('product_galleries', 'products.id', '=', 'product_galleries.product_id')->first();

        return response()->json($product);
    }
    public function destroy($id){
        $product = Product::find($id)->delete();

        return response()->json([
            'status' => 200
        ]);
    }
}