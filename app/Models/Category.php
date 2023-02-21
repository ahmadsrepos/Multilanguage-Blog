<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes;

    public $translatedAttributes = ['title'];
    protected $fillable = ['image', 'parent'];

    ######## RELATIONSHIPS ########

    public function getParent()
    {
        return $this->belongsTo(Category::class, 'parent');
    }

    public function getChildren()
    {
        return $this->hasMany(Category::class, 'parent');
    }

    public function getAllChildren()
    {
        return $this->hasMany(Category::class, 'parent')->withTrashed();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
