<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class adminController extends Controller
{

    public function __construct()
    {
        $this->middleware("restrictAccessToAdmin");
    }
    //show admin dashboard
    public function dashboard()
    {
        return view("admin.dashboard");
    }

    //show admin categories
    public function adminCategories()
    {
        $categories = DB::table("category")->get();

        return view("admin.adminCategories")->with(["categories"=> $categories]);

    }

    //show category edit form
    public function adminCategoryEdit($id)
    {
        $category = DB::table("category")->where("id", "=", $id)->get();

        return view("admin.adminEditCategory")->with(["category"=>$category[0]]);

    }

    //show add Category
    public function adminAddCategory()
    {
        return view("admin.adminAddCategory");
    }

    //add category to database
    public function adminAddCategoryToDB(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "desc" => "required|string",
            "status" => "required",
            "image" => "image|max:5000|mimes:jpeg,png,jpg",
        ]);

        if ($validator->fails()) {
            return redirect()->route("adminAddCategory")->with(["message"=>"category not created Try Again"]);
        }

        if ($request->hasFile("image")) {
            $imageOriginalName = $request->file("image")->getClientOriginalName();
            $imageName = pathinfo($imageOriginalName, PATHINFO_FILENAME);
            $imageExt = $request->file("image")->getClientOriginalExtension();
            $imageNameToStore = $imageName."_".time().".".$imageExt;

            $request->file("image")->storeAs("public/category_imgs/",$imageNameToStore);            
        }else{
            $imageNameToStore = "default_category.png";
        }
        $arrayToAdd = [
            "name"=> $request->input("name"),
            "desc"=> $request->input("desc"),
            "active"=> $request->input("status"),
            "image"=>$imageNameToStore,
        ];

        DB::table("category")->insert($arrayToAdd);

        return \redirect()->route("adminCategories")->with(["message"=>"One new Category is added"]);
        

    }

    //update category image form
    public function adminUpdateCategoryImage(Request $request, $id)
    {
        $validate = $this->validate($request, [
            "image" => 'image|required|mimes:jpeg,jpg,png|max:3000',
        ]);

        $category = DB::table("category")->where("id","=", $id)->get();

        if (!$validate) {
            return redirect()->route("adminCategories")->with(['message'=>"Image is not updated"]);
        }
        if ($request->hasFile("image")) {
            $imageOriginalName = $request->file("image")->getClientOriginalName();
            $imageName = pathinfo($imageOriginalName, PATHINFO_FILENAME);
            $imageExt = $request->file("image")->getClientOriginalExtension();
            $imageNameToStore = $imageName."_".time().".".$imageExt;

            $request->file("image")->storeAs("public/category_imgs/",$imageNameToStore);

            DB::table("category")->where("id","=",$id)->update(['image'=>$imageNameToStore]);

            if ($category[0]->image != "default_category.png") {
                $image_exist = Storage::disk("local")->exists("public/category_imgs/".$category[0]->image);
                if ($image_exist) {
                    Storage::disk("local")->delete("public/category_imgs/".$category[0]->image);
                }
                
            }
            
            return redirect()->route("adminCategoryEdit", ['id'=>$category[0]->id])->with(['message'=>"Image Update Successful"]);
        }
    }

    //update category form
    public function adminUpdateCategory(Request $request, $id)
    {
        Validator::make($request->all(), [
            "name" => "required|string",
            "desc" => "text",
            "status" => "required|numeric",
        ]);
        /*
        $this->validate($request, [
            "name" => "required|text",
            "desc" => "text",
            "status" => "required|numeric",
        ]);*/

        $arrayToUpdate = [
            "name"=> $request->input("name"),
            "desc"=> $request->input("desc"),
            "active"=> $request->input("status"),
        ];
        DB::table("category")->where("id","=",$id)->update($arrayToUpdate);

        return redirect()->route("adminCategoryEdit",["id"=>$id])->with(["message"=>"Category Updated"]);
    }

    //admin delete category
    public function adminDeleteCategory($id)
    {
        $category = DB::table("category")->where("id","=",$id)->get();

        $image_exist = Storage::disk("local")->exists("public/category_imgs/".$category[0]->image);
        if ($image_exist) {
            Storage::disk("local")->delete("public/category_imgs/".$category[0]->image);
        }
        DB::table("category")->where("id","=",$id)->delete();
        return redirect()->route("adminCategories")->with(["message"=> "One category is deleted"]);
    }


    //show admin products
    public function adminProducts()
    {
        $products = DB::table("products")->orderBy("id", "desc")->paginate(5);
        
        return view("admin.adminProducts", compact("products"));
    }


    //show add product form
    public function adminAddProduct()
    {
        $categories = DB::table("category")->get();

        return view("admin.adminAddProduct")->with(["categories"=>$categories]);
    }

    //add product to DB
    public function adminAddProductToDB(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "desc" => "string",
            "category" => "required",
            "price" => "required|numeric",
            "status" => "required",
            "image" => "image|max:5000|mimes:jpeg,png,jpg",
        ]);

        if ($validator->fails()) {
            return redirect()->route("adminAddproduct")->with(["message"=>"product not created Try Again"]);
        }

        if ($request->hasFile("image")) {
            $imageOriginalName = $request->file("image")->getClientOriginalName();
            $imageName = pathinfo($imageOriginalName, PATHINFO_FILENAME);
            $imageExt = $request->file("image")->getClientOriginalExtension();
            $imageNameToStore = $imageName."_".time().".".$imageExt;

            $request->file("image")->storeAs("public/product_imgs/",$imageNameToStore);            
        }else{
            $imageNameToStore = "default_product.png";
        }
        $arrayToAdd = [
            "name"=> $request->input("name"),
            "description"=> $request->input("desc"),
            "category_id"=> $request->input("category"),
            "price"=> $request->input("price"),
            "active"=> $request->input("status"),
            "image"=>$imageNameToStore,
        ];

        DB::table("products")->insert($arrayToAdd);

        return \redirect()->route("adminProducts")->with(["message"=>"One new Product is added"]);
        
    }


    //show edit product form
    public function adminEditProduct($id)
    {
        $product = DB::table("products")->where("id", "=", $id)->get();
        $category = DB::table("category")->where("id", "=", $product[0]->category_id)->get();
        $categories = DB::table("category")->get();

        return view("admin.adminEditProduct")->with(["product"=>$product[0],"category"=>$category[0], "categories"=>$categories]);
    }

    //update product image
    public function adminUpdateProductImage(Request $request, $id)
    {
    
        $validator = Validator::make($request->all(),[
            "image" => 'image|required|mimes:jpeg,jpg,png|max:3000',
        ]);

        $product = DB::table("products")->where("id","=", $id)->get();

        if ($validator->fails()) {
            return redirect()->route("adminEditProduct", ['id'=>$product[0]->id])->with(['message'=>"Product Image is not updated"]);
        }
        if ($request->hasFile("image")) {
            $imageOriginalName = $request->file("image")->getClientOriginalName();
            $imageName = pathinfo($imageOriginalName, PATHINFO_FILENAME);
            $imageExt = $request->file("image")->getClientOriginalExtension();
            $imageNameToStore = $imageName."_".time().".".$imageExt;

            $request->file("image")->storeAs("public/product_imgs/",$imageNameToStore);

            DB::table("products")->where("id","=",$id)->update(['image'=>$imageNameToStore]);

            if ($product[0]->image != "default_product.png") {
                $image_exist = Storage::disk("local")->exists("public/product_imgs/".$product[0]->image);
                if ($image_exist) {
                    Storage::disk("local")->delete("public/product_imgs/".$product[0]->image);
                }
                
            }
            
            return redirect()->route("adminEditProduct", ['id'=>$product[0]->id])->with(['message'=>"Product Image Update Successful"]);
        }
    }

    //update product form
    public function adminUpdateProduct(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "desc" => "string|nullable",
            "price" => "numeric|numeric",
            "category" => "required|numeric",
            "status" => "required|numeric",
        ]);
        
        if ($validator->fails()) {
            # code...
            return redirect()->route("adminEditProduct",["id"=>$id])->with(["message"=>"Thier is an error. Try again later"]);
        }

        $arrayToUpdate = [
            "name"=> $request->input("name"),
            "description"=> $request->input("desc"),
            "price"=> $request->input("price"),
            "category_id"=> $request->input("category"),
            "active"=> $request->input("status"),
        ];
        DB::table("products")->where("id","=",$id)->update($arrayToUpdate);

        return redirect()->route("adminEditProduct",["id"=>$id])->with(["message"=>"Product Updated Successful"]);
    }

    //delete product
    public function adminDeleteProduct($id)
    {
        $product = DB::table("products")->where("id","=",$id)->get();

        $image_exist = Storage::disk("local")->exists("public/product_imgs/".$product[0]->image);
        if ($image_exist) {
            Storage::disk("local")->delete("public/product_imgs/".$product[0]->image);
        }
        DB::table("products")->where("id","=",$id)->delete();
        return redirect()->route("adminProducts")->with(["message"=> "One Product is deleted"]);
    }


    /*
this is admin show Users section
    */

    //admin show users
    public function showUsers()
    {
        $users = User::paginate(10);
        return view("admin.adminUsers")->with(["users"=>$users]);

    }


}
