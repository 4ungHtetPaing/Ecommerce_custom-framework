<?php

namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\ValidateRequest;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends MainController
{
    public function index($data = [])
    {
        $sub_cates = SubCategory::all()->count();
        list($sub_cats, $pages) = paginate(2, $sub_cates, new SubCategory);
        $sub_cats = json_decode(json_encode($sub_cats));
        view("admin/sub_category/sub_category", compact("sub_cats", 'pages'));
    }

    public function store(){

        $post = Request::get("post");
        $data = [
            "name" => $post->name,
            "token" => $post->token,
            "id" => $post->id
        ];
        // echo json_encode($data);
        if (CSRFToken::checkToken($post->token)) {

            $rules = [
                "name" => ["require" => true, "minlength" => 5, "string" => true, "unique" => "sub_categories"],
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if ($validator->hasError()) {
                header('HTTP/1.1 422 Validation Error!', true, 422);
                echo json_encode($validator->getError());
                exit;
                // $cats = Category::all();
                // view("admin/category/create", compact("cats", "errors"));
            } else {

                $sub_cat = SubCategory::create([
                    "name" => $post->name,
                    "cat_id" => $post->id
                ]);

                if ($sub_cat) {
                    // $cats = Category::all();
                    // $success = "Category Create Successful";
                    // view("admin/category/category", compact("cats", "success"));
                } else {
                    header('HTTP/1.1 422 Validation Error!', true, 422);
                    echo json_encode($validator->getError());
                    exit;
                    // view("admin/category/create", compact("cats", "errors"));
                }

            }

        } else {
            Session::flash("subcate_create_error", "SubCategory Creation Error!");
            header('HTTP/1.1 422 Validation Error!', true, 422);
            echo json_encode($validator->getError());
            exit;
            // Redirect::back();
        }
    }

    public function update()
    {
        $post = Request::get('post');

        if (CSRFToken::checkToken($post->token)) {
            $rules = [
                "name" => ["require" => true, "minlength" => 5, "unique" => "sub_categories"],
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if ($validator->hasError()) {
                header('HTTP/1.1 422 Validation Error!', true, 422);
                echo json_encode($validator->getError());
                exit;
            } else {
                SubCategory::where('id', $post->id)->update(['name' => $post->name]);
                echo "SubCategory Update Successfully";
                exit;
            }

        } else {
            header('HTTP/1.1 422 Validation Error!', true, 422);
            echo "Token Mis-Match Error!";
            exit;
        }

    }

    public function delete($id)
    {
        
            $sub_cat_dele = SubCategory::destroy($id);
        if ($sub_cat_dele) {
            $sub_cates = SubCategory::all()->count();
            list($sub_cats, $pages) = paginate(2, $sub_cates, new SubCategory);
            $sub_cats = json_decode(json_encode($sub_cats));
            $msg = "SubCategory Delete Successful";
            Session::flash('sub_category_delete', $msg);
            view("admin/sub_category/sub_category", compact("sub_cats", "pages"));
        } else {
            $sub_cates = SubCategory::all()->count();
            list($sub_cats, $pages) = paginate(2, $sub_cates, new SubCategory);
            $sub_cats = json_decode(json_encode($sub_cats));
            $msg = "SubCategory Deletion Error!";
            Session::flash('sub_category_delete', $msg);
            view("admin/sub_category/sub_category", compact("sub_cats", "pages"));
        }
    }
    
}
