<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Cache;

use App\Models\Category;
use App\Services\Tree\SWWWTreeTraversal;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait CategoryCacheTrait
{
    public function getCategoryData($id = -1)
    {
//        $all_categories = Category::with(['childrenRecursive']);
        $all_categories = Category::query();
        if ($id != -1) {
            $all_categories = $all_categories->where('id', '=', $id);
        }
        $all_categories = $all_categories->get()->map(function ($value) {
            $value->get_parents = array_reverse(Arr::flatten($value->parents));
            $childs = collect($value->get_parents)->pluck('name')->toArray();
            $value->get_parents_name = count($childs) > 0 ? " ( ". implode(" / " , $childs)." ) " : "";
            $value->get_children = $value->getAllChildren();

            unset($value->parent_);
            unset($value->children);

            return $value;
        });
        return $all_categories;
    }
    public function getCategoryAsSpecificArrange() {
        $all_categories = $this->getCategoryData();
        $new_all_categories = new Collection();
        foreach ($all_categories->where('parent_id','=',null) as $new_category) {
            $new_all_categories->push($new_category);
            $new_all_categories = $new_all_categories->merge($all_categories->whereIn('id' , $new_category->get_children->pluck('id')->toArray()));

        }
        return $new_all_categories;
    }

}