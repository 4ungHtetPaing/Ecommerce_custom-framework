<?php 
use App\Classes\Mail;
use App\Classes\ErrorHandler;
use App\Classes\Session;
use App\Classes\ValidateRequest;

// use Illuminate\Database\Capsule\Manager as Capsule;

require_once "../bootstrap/init.php";

new ErrorHandler();

set_error_handler([new ErrorHandler(), "handleError"]);

// echo getenv("APP_ENV");
// $user = Capsule::table("user")->where("user_id",3)->get();
// echo "<pre>".print_r($user,true)."</pre>";
// $mailer = new Mail;
// $mail_content = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati consequuntur dicta incidunt quod. Qui dolorum voluptas saepe dolorem, enim itaque beatae expedita est debitis reiciendis. Quia ab architecto quos debitis!";
// $data = [
//     "to" => "thurainmay87@gmail.com",
//     "to_name" => "Ko Zin Wine",
//     "subject" => "New Mail Form E-Commerce Project",
//     "content" => $mail_content,
//     "file_name" => "welcome",
//     "image_link" =>
//         "https://image.tmdb.org/t/p/w300/rOi9B6dsQOhXVvzolL2UVRhTFu3.jpg"
// ];
// Session::set("name","koko");
// Session::replace("name","mgmg");
// Session::flash("category_success","successfully");
// echo Session::flash("category_success");
// echo $hey;
// if($mailer->send($data))
//     echo "Mail Sent Successfully";
// else
//     echo "Mail Sent Fail!";
// $result = ValidateRequest::mixed("name", "abc123@#$%^&*!", 5);
// echo $result == true ? "true" : "false";

// $validate = new ValidateRequest;
// $validate->checkValidate($post,$policy);
// if($validate->hasError())
// {
//     beautify($validate->getError());
// }else{
//     echo "goooooooooooooooooooood";
// }
// $origin = "Local@#$%^&** Electroinc";
// echo slug($origin);


?>
