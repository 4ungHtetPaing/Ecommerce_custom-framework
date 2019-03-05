<?php

namespace App\Controllers;

use App\Models\Product;
use App\Classes\Request;
use App\Models\Category;
use App\Classes\Session;
use App\Classes\CSRFToken;
use App\Classes\UploadFile;
use App\Models\SubCategory;
use App\Classes\ValidateRequest;
use Illuminate\Database\Capsule\Manager as Capsule;

class ProductController extends MainController
{
    public function index()
    {
        $productions = Product::all()->count();
        list($products, $pages) = paginate(2, $productions, new Product);
        $products = json_decode(json_encode($products));
        $cats = Category::all();
        $sub_cats = SubCategory::all();
        view("admin/product/home", compact('products', 'cats', 'sub_cats', 'pages'));
    }
    public function store()
    {
        if (CSRFToken::checkToken($_POST['token'])) {

            $rules = [
                "name" => ["require" => true, "minlength" => 5, "unique" => "products"],
                "description" => ["require" => true, "minlength" => 15]
            ];
            $validator = new ValidateRequest;
            $validator->checkValidate($_POST, $rules);
            if ($validator->hasError()) {
                $cats = Category::all();
                $sub_cats = SubCategory::all();
                $productions = Product::all()->count();
                list($products, $pages) = paginate(2, $productions, new Product);
                $products = json_decode(json_encode($products));
                $errors = $validator->getError();
                view("admin/product/home", compact("products", 'cats', 'sub_cats', "pages", "errors"));
            } else {

                $cates = Capsule::table('sub_categories')->where('id', '=', $_POST['sub_category'])->get();
                $cat_id = '';
                foreach ($cates as $cat) {
                    $cat_id = $cat->cat_id;
                }
                $file = Request::get("file");
                if(!empty($file->file->name)){
                   $uploadFile = new UploadFile();
                   $moveResult = $uploadFile->move($file);
                   if($moveResult == "File Create Success")
                    { 
                            $product = new Product;
                            $product->name = $_POST['name'];
                            $product->price = $_POST['price'];
                            $product->cat_id = $cat_id;
                            $product->sub_cat_id = $_POST['sub_category'];
                            $product->description = $_POST['description'];
                            $product->image = $uploadFile->getPath();

                            if ($product->save()) {
                                $productions = Product::all()->count();
                                list($products, $pages) = paginate(2, $productions, new Product);
                                $products = json_decode(json_encode($products));
                                $success = "Product Create Successful";
                                $cats = Category::all();
                                $sub_cats = SubCategory::all();
                                view("admin/product/home", compact("products", 'cats', 'sub_cats', "pages", "success"));
                            } else {
                                $errors = [];
                                $productions = Product::all()->count();
                                list($products, $pages) = paginate(2, $productions, new Product);
                                $products = json_decode(json_encode($products));
                                $cats = Category::all();
                                $sub_cats = SubCategory::all();
                                view("admin/product/home", compact("products", 'cats', 'sub_cats', "pages", "errors"));
                            }
                      
                    }else{
                        $errors = ["Please check file size and"];
                        $productions = Product::all()->count();
                        list($products, $pages) = paginate(2, $productions, new Product);
                        $products = json_decode(json_encode($products));
                        $cats = Category::all();
                        $sub_cats = SubCategory::all();
                        view("admin/product/home", compact("products", 'cats', 'sub_cats', "pages", "errors"));
                    }

                }else{
                    $errors = ["File could not be empty!"];
                    $productions = Product::all()->count();
                    list($products, $pages) = paginate(2, $productions, new Product);
                    $products = json_decode(json_encode($products));
                    $cats = Category::all();
                    $sub_cats = SubCategory::all();
                    view("admin/product/home", compact("products", 'cats', 'sub_cats', "pages", "errors"));
                }

            }

        } else {
            $errors = ["Token Mis-Match Errors"];
            $productions = Product::all()->count();
            list($products, $pages) = paginate(2, $productions, new Product);
            $products = json_decode(json_encode($products));
            $cats = Category::all();
            $sub_cats = SubCategory::all();
            view("admin/product/home", compact("products", 'cats', 'sub_cats', "pages", "errors"));
        }

    }
     public function delete($id)
    {
       
        $pro_delete = Product::destroy($id);
        if($pro_delete)
        {
            $msg = "Product Delete Successful";
            Session::flash('product_delete', $msg);
            $productions = Product::all()->count();
            list($products, $pages) = paginate(2, $productions, new Product);
            $products = json_decode(json_encode($products));
            $cats = Category::all();
            $sub_cats = SubCategory::all();
            view("admin/product/home", compact("products", 'cats', 'sub_cats', "pages"));
        }else{
            $msg = "Product Deletion Error!";
            Session::flash('product_delete', $msg);
            $productions = Product::all()->count();
            list($products, $pages) = paginate(2, $productions, new Product);
            $products = json_decode(json_encode($products));
            $cats = Category::all();
            $sub_cats = SubCategory::all();
            view("admin/product/home", compact("products", 'cats', 'sub_cats', "pages"));
        }
    }
}
