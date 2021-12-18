<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','image','icon'];

    // Relación 1-n
    public function products(){
        return $this->hasMany(Product::class);
    }

    // URL amigable
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
