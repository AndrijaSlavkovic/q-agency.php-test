<?php

namespace App\Http\Controllers;

use App\Services\ApiService;

class AuthorController extends Controller
{
    public function show(int $authorId, ApiService $apiService)
    {
        $author = $apiService->getAuthor($authorId);

        if ($author) {
            return view('author', compact('author'));
        } else {
            return abort(404);
        }
    }

    public function destroy(int $authorId, ApiService $apiService)
    {
        $books = [];
        $author = $apiService->getAuthor($authorId);
        if ($author) {
            $books = $author['books'];
        }
        if (count($books) === 0) {
            $response = $apiService->deleteAuthor($authorId);

            if ($response) {
                return redirect()->route('authors')->with('success', 'Author deleted successfully!');
            } else {
                return back()->with('error', 'Failed to delete author!');
            }
        } else {
            return back()->with('error', 'Author has books and cannot be deleted!');
        }
    }
}
