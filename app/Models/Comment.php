<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'book_id', // ربط التعليق بالكتاب
        'comment', // النص التعليق
    ];

    // العلاقة مع Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    use HasFactory;
}
