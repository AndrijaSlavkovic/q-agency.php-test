<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index(Request $request, ApiService $apiService)
    {
        $authors = $apiService->getAllAuthors();
        return view('create_book', compact('authors'));
    }

    public function store(Request $request, ApiService $apiService)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'release_date' => $request->release_date,
            'isbn' => $request->isbn,
            'author_id' => $request->author_id,
            'format' => $request->format,
            'number_of_pages' => $request->number_of_pages,
        ];

        $response = $apiService->createBook($data);

        if ($response) {
            return redirect()->route('book.show')->with('success', 'Book created successfully!');
        } else {
            return back()->withErrors(['error' => 'Failed to create book!']);
        }
    }

    public function destroy(int $bookId, ApiService $apiService)
    {
        $response = $apiService->deleteBook($bookId);

        if ($response) {
            return redirect()->back()->with('success', 'Book deleted successfully!');
        } else {
            return back()->withErrors(['error' => 'Failed to delete book!']);
        }
    }

}
