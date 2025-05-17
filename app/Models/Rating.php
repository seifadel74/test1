<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'book_id', // ربط التقييم بالكتاب
        'user_id', // ربط التقييم بالمستخدم
        'rating',  // التقييم (مثل 1-5)
    ];

    // العلاقة مع Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // العلاقة مع User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
