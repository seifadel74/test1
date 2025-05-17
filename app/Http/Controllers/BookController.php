<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json([
            'message' => 'تم جلب الكتب بنجاح',
            'books' => $books
        ], 200);
    }

    public function getBooksByType($type)
    {
        \Log::info('Type requested: ' . $type);

        $books = Book::whereRaw('LOWER(type) = ?', [strtolower($type)])->get();

        if ($books->isEmpty()) {
            $availableTypes = Book::select('type')->distinct()->pluck('type');
            \Log::info('Available types: ' . $availableTypes->toJson());

            return response()->json([
                'message' => 'لا توجد كتب في هذا النوع',
                'available_types' => $availableTypes
            ], 404);
        }

        return response()->json([
            'message' => 'تم جلب الكتب بنجاح',
            'books' => $books
        ], 200);
    }

    public function create(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'published_year' => 'required|integer|min:1800|max:2025',
            'image_url' => 'nullable|url',
            'pdf_url' => 'nullable|url',
            'type' => 'required|string|max:255',
        ]);

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'published_year' => $request->published_year,
            'image_url' => $request->image_url,
            'pdf_url' => $request->pdf_url,
            'type' => $request->type,
        ]);

        return response()->json([
            'message' => 'تم إضافة الكتاب بنجاح',
            'book' => $book
        ], 201);
    }

    public function edit(Request $request, $id)
    {
        // العثور على الكتاب أو إرجاع 404 إذا لم يوجد
        $book = Book::findOrFail($id);

        // التحقق من صحة البيانات
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'published_year' => 'required|integer|min:1800|max:2025',
            'image_url' => 'nullable|url',
            'pdf_url' => 'nullable|url',
            'type' => 'required|string|max:255',
        ]);

        // تحديث البيانات
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->published_year = $request->published_year;
        $book->image_url = $request->image_url;
        $book->pdf_url = $request->pdf_url;
        $book->type = $request->type;
        $book->save();

        return response()->json([
            'message' => 'تم تعديل الكتاب بنجاح',
            'book' => $book
        ], 200);
    }

    public function delete(Request $request, $id)
    {
        // العثور على الكتاب وحذفه
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json([
            'message' => 'تم حذف الكتاب بنجاح'
        ], 200);
    }
}
