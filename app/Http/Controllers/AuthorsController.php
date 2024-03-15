<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class AuthorsController extends Controller
{
    /**
     * Summary of index
     * @param \Illuminate\Http\Request $request
     * @param \App\Services\ApiService $apiService
     * @return mixed|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request, ApiService $apiService)
    {
        if (!session()->has('logged_in') || session()->get('logged_in') != true ) {
            return redirect()->route('login');
        }

        $currentPage = $request->input('page') ?: 1;
        $perPage = 10;

        $authors = $apiService->getAuthors($currentPage, $perPage);

        $totalResults = $authors['total_results'];
        $totalPages = $authors['total_pages'];
        $authors = $authors['items'];

        return view('authors', compact('authors', 'totalResults', 'totalPages', 'currentPage', 'perPage'));
    }
}
