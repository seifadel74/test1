<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $rating = Rating::all();
        return response()->json([
            'message' => 'تم جلب التقييمات بنجاح',
            'ratings' => $rating
        ], 200);
    }

    public function create(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5', // نطاق التقييم (1-5)
        ]);

        // إنشاء التقييم
        $rating = Rating::create([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'rating' => $request->rating,
        ]);

        return response()->json([
            'message' => 'تم إضافة التقييم بنجاح',
            'rating' => $rating
        ], 201);
    }
}
