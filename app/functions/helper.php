<?php

use Philo\Blade\Blade;

use voku\helper\Paginator;
use Illuminate\Database\Capsule\Manager as Capsule;

function view($path, $data = [])
{
    $views = APP_ROOT . "/resources/views/";
    $cache = APP_ROOT . "/bootstrap/cache/";

    $blade = new Blade($views, $cache);

    echo $blade->view()->make($path, $data)->render();
}
function makeMail($file_name, $data)
{
    extract($data);
    ob_start();
    require_once APP_ROOT . "/resources/views/mails/" . $file_name . ".php";
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
function beautify($data)
{
    echo "<pre>" . print_r($data, true) . "</pre>";
}
function asset($link)
{
    echo URL_ROOT . "/assets/" . $link;
}
function url($link)
{
    echo URL_ROOT . $link;
}
function slug($value)
{
    $fir_value = preg_replace( '/[^'.preg_quote('_').'\pL\pN\s]+/u', "", mb_strtolower($value));
    $sec_value = preg_replace('/[ _]+/u', "-", $fir_value);
    return $sec_value;
}
function paginate($num_record, $total_record, $object)
{

    $pages = new Paginator($num_record, 'pages');
    $values = $object->genPaginate($pages->get_limit());
    $pages->set_total($total_record);
   
    return [$values, $pages->page_links()];
}
// function findCatId($table, $id)
// {
//     $cates = Capsule::table($table)->where('id', '=', $id)->get();
//     $cat_id = '';
//     foreach ($cates as $cat) {
//         $cat_id = $cat->cat_id;
//     }
//     return $cat_id;
// }
