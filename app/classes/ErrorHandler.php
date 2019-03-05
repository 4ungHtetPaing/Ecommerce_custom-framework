<?php

namespace App\Classes;

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;


class ErrorHandler
{
    public function __construct()
    {
        $whoops = new Run();
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();

    }
    public function handleError($error_number,$error_message,$error_file,$error_line){
        // echo "Error Number is {$error_number} <br>";
        // echo "Error Number is {$error_message} <br>";
        // echo "Error Number is {$error_file} <br>";
        // echo "Error Number is {$error_line} <br>";
    }
}
