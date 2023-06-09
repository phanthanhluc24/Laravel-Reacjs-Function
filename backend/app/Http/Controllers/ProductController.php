<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();

        return response()->json(
            $product
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "amount" => "required|numeric",
            "price" => "required|numeric",
            "image" => "nullable",
        ]);
        $imageName=Str::random(15).".".$request->image->getClientOriginalExtension();
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->amount = $request->amount;
        $product->price = $request->price;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            Storage::disk("public")->put($imageName,file_get_contents($request->image));
            $product->image=$imageName;
        }
        $product->save();

        return response()->json([
            "message" => "Product successfully created",
            "product" => $product
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return response()->json(
            $product
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $imageName=Str::random(15).".".$request->image->getClientOriginalExtension();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->amount = $request->amount;
        $product->price = $request->price;
        if ($request->hasFile("image")) {
            $image=$request->file("image");
            $fileName=$image->getClientOriginalName();
            // $imagePath=$image->store("public");
            Storage::disk("public")->put($imageName,file_get_contents($request->image));
            $product->image=$imageName;
        }
        $product->save();

        return response()->json(
            $product
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::destroy($id);
        return response()->json([
            "message" => "Xóa thành công"
        ]);
    }
}
