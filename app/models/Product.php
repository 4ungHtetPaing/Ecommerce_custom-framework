<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;

class Product extends Model
{
    // protected $fillable = [
    //     'name', 'cat_id', 'sub_cat_id', 'image', 'description', 'price'
    // ];
    public function genPaginate($limit)
    {
        $table = $this->getTable();
        $products = [];
        $pros = Capsule::select("SELECT * FROM $table ORDER BY id DESC " . $limit);

        foreach ($pros as $product) {
            $date = new Carbon($product->created_at);
            array_push($products, [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'cat_id' => $product->cat_id,
                'sub_cat' => $product->sub_cat_id,
                'description' => $product->description,
                'created' => $date->toFormattedDateString(),
            ]);
        }

        return $products;

    }
}

?>