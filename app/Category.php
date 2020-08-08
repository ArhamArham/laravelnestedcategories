<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded=[];
    //one level child
    public function child()
    {
        return $this->hasMany(Category::class,'parent_category_id',);
    }
    //Recursive children
    public function children()
    {
        return $this->hasMany(Category::class,'parent_category_id',)->with('children');
    }
    //one level paren
    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_category_id',);
    }
    //Recursive parent
    public function parents()
    {
        return $this->belongsTo(Category::class,'parent_category_id',)->with('parent');
    }
}
