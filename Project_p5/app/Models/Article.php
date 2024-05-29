<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'content',
        'image',
        'category_id',
        'user_id',
    ];

    // Relasi dengan Category
    public function category()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}