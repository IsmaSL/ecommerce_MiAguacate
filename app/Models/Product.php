<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const BORRADOR = 1;
    const PUBLICADO = 2;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Accesores
    public function getStockAttribute(){
        return $this->quantity;
    }

    // Relación 1-n inversa
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // Relación 1-n polimorfica
    public function images(){
        return $this->morphMany(Image::class, "imageable");
    }

    // URL amigable
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
