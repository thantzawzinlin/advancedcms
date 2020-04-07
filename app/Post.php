<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable=['title','content','image','published_at','category_id'];

    public function DeleteImage(){
   return Storage::delete($this->image);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }





}
 
