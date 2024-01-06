<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqItems extends Model
{
    use HasFactory;

    protected $primaryKey = 'itemId';
    protected $fillable = [
        'categoryId',
        'question',
        'answer'
    ];

    public function faqCategory()
    {
        return $this->belongsTo(FaqCategory::class, 'categoryId');
    }
}
