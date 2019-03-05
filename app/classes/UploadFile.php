<?php

namespace App\Classes;

class UploadFile
{
    protected $fileName;
    protected $maxSize = 2097152;
    protected $path;

    public function getName($file, $name = '')
    {
        if($name == '')
        {
            $name = pathinfo($file->file->tmp_name, PATHINFO_FILENAME);
        }
        $name = strtolower(str_replace(["_"," "], "-", $name));
        $hash = md5(microtime());
        $ext = pathinfo($file->file->name, PATHINFO_EXTENSION);
        $this->fileName = "{$name}-{$hash}.{$ext}";
        return $this->fileName;
    }
    public function checkSize($file)
    {
        return $file->file->size > $this->maxSize ? true : false;
    }
    public function isImage($file)
    {
        $ext = pathinfo($file->file->name, PATHINFO_EXTENSION);
        $vaildExt = ["jpg","jpeg","png","bmp","gif"];
        return in_array($ext, $vaildExt);
    }
    public function getPath(){
        return $this->path;
    }
    public function move($file, $file_name = "")
    {
        $name = $this->getName($file);
        if($this->isImage($file))
        {
            if(!$this->checkSize($file))
            {
                $path = APP_ROOT ."/public/assets/uploads/";
                if(!is_dir($path))
                {
                    mkdir($path);
                }
                $this->path = URL_ROOT . "/assets/uploads/" . $name;
                $filePath = $path . $name;
                move_uploaded_file($file->file->tmp_name, $filePath);
                $msg = "File Create Success";
                return $msg;
            }else{
                $msg = "File Size exceeded!";
                return $msg;
            }

        }else{
            $msg = "Only Image File are Accepted!";
            return $msg;
        }
    }
}
