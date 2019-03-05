<?php 

namespace App\Controllers;

use App\Models\SubCategory;


class AdminController extends MainController{
    public function index(){

        view("admin/dashboard/dashboard");
        
    }
}

?>




