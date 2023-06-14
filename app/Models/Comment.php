<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'post_id'
    ];
    public function post_motel(){
        return $this->belongsTo(Post::class,'post_id');
    }
}
