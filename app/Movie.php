<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['user_id','name','year','category_id','description'];

    public function Category(){
      return $this->belongsTo(Category::class);
    }
}
