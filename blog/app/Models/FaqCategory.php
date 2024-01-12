<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use HasFactory;
    protected $primaryKey = 'Id';
    protected $fillable = [
        'title',
        'question',
        'answer'

      ];

    public function faqItems()
    {
        return $this->hasMany(FaqItems::class, 'categoryId');
    }
}
