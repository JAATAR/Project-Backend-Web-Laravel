<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $primaryKey = 'postId';
    protected $fillable = [

        'user_id',
        'title',
        'cover_image',
        'content',
        'publishing_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
