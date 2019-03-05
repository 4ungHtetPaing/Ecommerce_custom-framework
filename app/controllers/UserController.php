<?php 

namespace App\Controllers;

// use App\Models\SubCategory;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Redirect;
use App\Classes\ValidateRequest;
use App\Models\User;
use App\Classes\Auth;


class UserController extends MainController{
    public function loginForm(){
        if(Auth::check("user_name")){
            Redirect::to("../cart");
        }else{
            view("user/login");
        }
    }
    public function login(){
        $post = Request::get("post");
        if(\App\Classes\CSRFToken::checkToken($post->token)){
            $rules = [
                "user_email" => ["unique" => "users"],
                "password" => ["minlength" => '5']
            ];

            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if ($validator->hasError()) {
                beautify($validator->getError());
            } else {
                
                $user_password = password_hash($post->password, PASSWORD_BCRYPT);
                $user = User::where("user_email", $post->email)->first();
                if($user){
                    if(password_verify($post->password, $user->user_password)){
                        Session::set("user_id", $user->user_id);
                        Session::set("user_name", $user->user_name);
                        Redirect::to("../cart");
                    }else {
                        Session::flash("error_message", "Password Error! ");
                        Redirect::back();
                    }
                }else{
                    Session::flash("error_message", "Email Error! ");
                    Redirect::back();
                }
               
            }

        }else{
            Session::flash("error_message", "Token Mis Match Error!");
            Redirect::back();
        }
    }
    public function registerForm(){
        if (Auth::check("user_name")) {
            Redirect::to("../cart");
        } else {
            view("user/register");
        }

    }
    public function register(){
        $post = Request::get("post");
          if(\App\Classes\CSRFToken::checkToken($post->token)){
              if($post->password === $post->con_pass){
                    $rules = [
                        "name" => ["minlength"=>"5"],
                        "user_email" => ["unique"=>"users"],
                        "password" => ["minlength"=>'5']
                    ];

                        $validator = new ValidateRequest();
                        $validator->checkValidate($post, $rules);
                        if($validator->hasError()){
                            beautify($validator->getError());
                        }else{
                               $user = new User();
                               $user->user_name = $post->name;
                               $user->user_email = $post->email;
                               $user->user_password = password_hash($post->password, PASSWORD_BCRYPT);
                                if($user->save()){
                                    Session::flash("success_message", "Registion Success! Please Login!");
                                    Redirect::to("login");
                                }else{
                                    Session::flash("error_message", "Something Wrong! Please Check Something");
                                    Redirect::back();
                                }
                        }
              }else{
                    Session::flash("error_message", "Password Do Not Match!");
                    Redirect::back();
              }
           

        }else{
            Session::flash("error_message", "Token Mis Match Error!");
            Redirect::back();
        }
    }
    public function logout(){
        Session::remove("user_id");
        Session::remove("user_name");
        Redirect::to("login");
    }
}

?>