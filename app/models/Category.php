<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;

class Category extends Model
{
    protected $fillable = ['category_name', 'slug'];

    public function genPaginate($limit){
        $table = $this->getTable();
        $categories = [];
        $cats = Capsule::select("SELECT * FROM $table ORDER BY id DESC " . $limit);

        foreach ($cats as $cat) {
            $date = new Carbon($cat->created_at);
            array_push($categories, [
                'id' => $cat->id,
                'category_name' => $cat->category_name,
                'slug' => $cat->slug,
                'created' => $date->toFormattedDateString(),
            ]);
        }

        return $categories;

    }
}

?>