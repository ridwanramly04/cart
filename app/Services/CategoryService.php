<?php

namespace App\Services;

use App\Models\Category;

class CategoryService {

    public function create($request){
        $category = new Category;

        $store = $category->create([
            'name' => $request->name
        ]);
        
        return response()->json($store);
    }

    public function update($id, $request){
        $category = Category::find($id)->update([
            'name' => $request->name
        ]);

        return response()->json($category);
    }

    public function show($id){
        $category = Category::find($id)->product()->join('product_galleries', 'products.id', '=', 'product_galleries.product_id')->get();

        return response()->json($category);
    }

    public function index(){
        $category =  Category::all();

        return response()->json($category);
    }

    public function destroy($id){
        $category = Category::find($id)->delete();

        return response()->json([
            'status' => 200,
        ]);
    }
}