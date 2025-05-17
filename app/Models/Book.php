<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = [
        'title',
        'author',
        'pdf_url',
        'type',
        'description',
        'published_year',
        'image_url'
    ];
    // العلاقة مع Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    use HasFactory;
}
