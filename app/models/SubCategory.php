<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;

class SubCategory extends Model
{
    protected $fillable = ['name', 'cat_id'];

    public function genPaginate($limit)
    {
        $table = $this->getTable();
        $sub_categories = [];
        $sub_cats = Capsule::select("SELECT * FROM $table ORDER BY id DESC " . $limit);

        foreach ($sub_cats as $cat) {
            $date = new Carbon($cat->created_at);
            array_push($sub_categories, [
                'id' => $cat->id,
                'name' => $cat->name,
                'cat_id' => $cat->cat_id,
                'created' => $date->toFormattedDateString(),
            ]);
        }

        return $sub_categories;

    }
}

?>