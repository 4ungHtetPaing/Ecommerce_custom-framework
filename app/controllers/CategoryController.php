<?php

namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\ValidateRequest;
use App\Models\Category;

class CategoryController extends MainController
{
    public function index($data = [])
    {
        $cates = Category::all()->count();
        list($cats, $pages) = paginate(2, $cates, new Category);
        $cats = json_decode(json_encode($cats));
        view("admin/category/category", compact("cats",'pages'));
    }
    public function create()
    {
        view("admin/category/create");
    }
    public function store()
    {
        
        $post = Request::get("post");
        if (CSRFToken::checkToken($post->token)) {
            $rules = [
                "category_name" => ["require" => true, "minlength" => 5, "string"=>true, "unique" => "categories"],
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if ($validator->hasError()) {
                $cates = Category::all()->count();
                list($cats, $pages) = paginate(2, $cates, new Category);
                $cats = json_decode(json_encode($cats));
                $errors = $validator->getError();
                view("admin/category/create", compact("cats", "pages", "errors"));
            } else {
                $slug = slug($post->category_name);
                $category = Category::create([
                    "category_name" => $post->category_name,
                    "slug" => $slug
                ]);

                if ($category) {
                    $cates = Category::all()->count();
                    list($cats, $pages) = paginate(2, $cates, new Category);
                    $cats = json_decode(json_encode($cats));
                    $success = "Category Create Successful";
                    view("admin/category/category", compact("cats", "pages", "success"));
                }else{
                    $cates = Category::all()->count();
                    list($cats, $pages) = paginate(2, $cates, new Category);
                    $cats = json_decode(json_encode($cats));
                    view("admin/category/create", compact("cats", "pages", "errors"));
                }
                
            }
            // if (strpos($msg, 'uccess')) {
            //     Session::flash("cate_create_success", $msg);
            //     Redirect::back();
            // } else {
            //     Session::flash("cate_create_error", $msg);
            //     Redirect::back();
            // }
        } else {
            Session::flash("cate_create_error", "Category Creation Error!");
            Redirect::back();
        }
    }
    public function delete($id)
    {
       
        $cat_dele = Category::destroy($id);
        if($cat_dele)
        {
            $msg = "Category Delete Successful";
            Session::flash('category_delete', $msg);
            $cates = Category::all()->count();
            list($cats, $pages) = paginate(2, $cates, new Category);
            $cats = json_decode(json_encode($cats));
            view("admin/category/category", compact("cats", "pages"));
        }else{
            $msg = "Category Deletion Error!";
            Session::flash('category_delete', $msg);
            $cates = Category::all()->count();
            list($cats, $pages) = paginate(2, $cates, new Category);
            $cats = json_decode(json_encode($cats));
            view("admin/category/category", compact("cats", "pages"));
        }
    }
    public function update ()
    {
        $post = Request::get('post');

        if(CSRFToken::checkToken($post->token))
        {
            $rules = [
                "category_name" => ["require" => true, "minlength" => 5, "unique" => "categories"],
            ];
            $validator = new ValidateRequest();            
            $validator->checkValidate($post, $rules);
            if ($validator->hasError()) {
                header('HTTP/1.1 422 Validation Error!', true, 422);
                echo json_encode($validator->getError());
                exit;
            } else {
                Category::where('id', $post->id)->update(['category_name' => $post->category_name]);
                echo "Category Update Successfully";
                exit;
            }
           
        }else{
            header('HTTP/1.1 422 Validation Error!', true, 422);
            echo "Token Mis-Match Error!";
            exit;
        }

        

    }
}
