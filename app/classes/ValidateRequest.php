<?php

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;


class ValidateRequest
{
    private $errors = [];
    private $error_message = [
        "unique" => "This :attribute field is already in use",
        "require" => "This :attribute field must be filled",
        "minlength" => "This :attribute field must be at least :policies characters",
        "maxlength" => "This :attribute field must be more then :policies characters",
        "email" => "This email validation error",
        "string" => "This :attribute field can only filled string values",
        "number" => "This :attribute field can only filled number values",
        "mixed" => "This :attribute field can only accpted A-Za-z0-9 \.*&^%$#@!~ characters",
    ];
    public function checkValidate($data, $policies)
    {
        foreach($data as $column=>$value)
        {
            if(in_array($column, array_keys($policies)))
            {
                $this->doValidation([
                    "column"=>$column,
                    "value"=>$value,
                    "policies"=>$policies[$column]
                ]);
            }
        }
    }
    public function doValidation($data)
    {
        $column = $data["column"];
        $value = $data["value"];
        foreach($data["policies"] as $rule=>$policies)
        {
            $valid = call_user_func_array([self::class,$rule],[$column,$value,$policies]);

            if(!$valid)
            {
                $this->setError(str_replace([":attribute", ":policies"],[$column,$policies],
                    $this->error_message[$rule]),$column);
            }
        }
       
    }
    public function unique($colum, $value, $policies)
    {
        if($value != null && !empty(trim($value)))
            return !Capsule::table($policies)->where($colum, $value)->exists();
    }
    public function require($colum, $value, $policies)
    {
        return $value != null && !empty(trim($value)) ? true : false;
    }
    public function minLength($colum, $value, $policies)
    {
        if ($value != null && !empty(trim($value)))
            return strlen(trim($value)) >= $policies;
    }
    public function maxLength($colum, $value, $policies)
    {
        if ($value != null && !empty(trim($value)))
            return strlen(trim($value)) <= $policies;
    }
    public function email($colum, $value, $policies) 
    {
        if ($value != null && !empty(trim($value)))
            return filter_var($value, FILTER_VALIDATE_EMAIL);
        else
            return false;
    }
    public function string($colum, $value, $policies) 
    {
        if ($value != null && !empty(trim($value)))
            return preg_match("/^[A-Za-z _]+$/", $value);
    }
    public function number($colum, $value, $policies) 
    {
        if ($value != null && !empty(trim($value)))
            return preg_match("/^[0-9]+$/", $value);
    }
    public function mixed($colum, $value, $policies) 
    {
        if ($value != null && !empty(trim($value)))
            return preg_match("/^[A-Za-z0-9 \.*&^%$#@!~]+$/", $value);
    }
    public function setError($error, $key = null)
    {
        if($key){
            $this->errors[$key] = $error;
        }else{
            $this->error[] = $error;
        }
    }
    public function hasError()
    {
        return count($this->errors) > 0 ? true : false;
    }
    public function getError()
    {
        return $this->errors;
    }
}

?>