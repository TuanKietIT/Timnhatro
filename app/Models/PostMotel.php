<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMotel extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'price',
        'purpose',
        'status',
        'deposit',
        'structure',
        'description',
        'area',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'image6',
        'address_address',
        'address_latitude',
        'address_longitude',
        'category_id',
        'location_id',
        'user_id',
        'choose',
        'see'
    ];
    public function category(){
       return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }
}
