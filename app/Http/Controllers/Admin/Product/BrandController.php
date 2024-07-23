<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->search;
        $brand = Brand::where("name", "like", "%$search%")->orderBy('id', 'desc')->paginate(25);

        return response()->json([
            'total' => $brand->total(),
            'brands' => $brand->map(function($brand) {
                return [
                    "id" => $brand->id,
                    "name"=> $brand->name,
                    "state" => $brand->state,
                    "created_at" => $brand->created_at->format("Y-m-d H:i:s")
                ];
            }),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $isValid = Brand::where("name", $request->name)->first(); // check if attribute exist
        if ($isValid) {
            return response()->json(["message" => 403]);
        }

        $brand = Brand::create( $request->all() ); // create brand
        return response()->json([
            "message" => 200,
            "brand" => [
                "id" => $brand->id,
                "name"=> $brand->name,
                "state" => $brand->state,
                "created_at" => $brand->created_at->format("Y-m-d H:i:s"),
            ],
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $isValid = Brand::where("id","<>", $id)->where("name", $request->name)->first(); // check if Brand exist
        if ($isValid) {
            return response()->json(["message" => 403]);
        }

        $brand = Brand::findOrFail($id);
        $brand->update($request->all()); // update brand
        return response()->json([
            "message" => 200,
            "brand" => [
                "id" => $brand->id,
                "name"=> $brand->name,
                "state" => $brand->state,
                "created_at" => $brand->created_at->format("Y-m-d H:i:s"),
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        if($brand){
            $brand->delete();
            return response()->json(["message" => 200]); // delete attribute
        }
        return response()->json(["message"=> 404]);
    }
}
