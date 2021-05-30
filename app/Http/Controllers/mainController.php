<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table("category")->paginate(2);
        $products = DB::table("products")->paginate(6);

        return view("main")->with(['categories' => $categories, 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function categories()
     {
        $categories = DB::table("category")->get();

        return view("categories")->with(["categories" => $categories]);
     }


     public function singleCategory($id)
     {
         $category = DB::table("category")->where("id", "=", $id)->get();

         $products = DB::table("products")->where("category_id", "=", $id)->get();

         return view("singleCategory")->with(["category"=>$category, "products"=>$products]); 
     }


    public function singleProduct($id)
    {
        $product = DB::table("products")->where("id", "=", $id)->get();

        return view("singleProduct")->with(["product"=>$product[0]]);
    }

    public function products()
    {
        $categories = DB::table("category")->get();
        $products = DB::table("products")->get();

        return view("products")->with(["products"=>$products, "categories"=>$categories]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
