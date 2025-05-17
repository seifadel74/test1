<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\users;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // public function index()
    // {
    //     $comment = Comment::all();
    //     return $comment;
    // }

    // public function create(Request $request, $id){
    //     $comment = new Comment($id);
    //     $comment = comment::create([
    //         'comment' => $request->comment,
    //     ]);

    //     return response()->json(['message' => 'comment Add successfully', 'comment' => $comment]);
    // }

    // public function edit(Request $request, $id){
    //     $comment = comment::findorFail($id);
    //     $comment->comment = $request->comment;
    //     return response()->json(['message' => 'Comment Edited successfully', 'book' => $comment]);
    // }
    public function index()
    {
        $comments = Comment::all();
        return response()->json([
            'message' => 'تم جلب التعليقات بنجاح',
            'comments' => $comments
        ], 200);
    }

    public function create(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        // التحقق من وجود الكتاب
        $book = Book::findOrFail($id);

        // إنشاء التعليق
        $comment = Comment::create([
            'book_id' => $id,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'تم إضافة التعليق بنجاح',
            'comment' => $comment
        ], 201);
    }

    public function edit(Request $request, $id)
    {
        // العثور على التعليق أو إرجاع 404 إذا لم يوجد
        $comment = Comment::findOrFail($id);

        // التحقق من صحة البيانات
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        // تحديث التعليق
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json([
            'message' => 'تم تعديل التعليق بنجاح',
            'comment' => $comment
        ], 200);
    }
}
