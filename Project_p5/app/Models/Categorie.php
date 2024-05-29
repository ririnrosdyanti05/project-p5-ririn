<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $table = 'categories'; // Ensure this matches your table name

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }
}