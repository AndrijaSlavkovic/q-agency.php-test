<?php

namespace App\Services;

use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Http;

class ApiService
{
    protected $baseUrl;
    protected $credentials;

    public function __construct()
    {
        $this->baseUrl = config('q-api.base_url');
        $this->credentials = config('q-api.credentials');
    }

    /**
     * Summary of login
     * @param mixed $email
     * @param mixed $password
     * @return boolean || string {}
     */
    public function login($email, $password)
    {
        $response = Http::post($this->baseUrl . '/token', [
            'email' => $email,
            'password' => $password
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }

    /**
     * Summary of getAuthors
     * @param mixed $token
     * @param mixed $page
     * @param mixed $perPage
     * @return string {}
     */
    public function getAuthors($page = 1, $perPage = 10)
    {
        $user = session()->get('user');
        $response = Http::withToken($user['token_key'])->get($this->baseUrl . '/authors', [
                'orderBy' => 'id',
                'direction' => 'ASC',
                'limit' => $perPage,
                'page' => $page,
            ]);

        return $response->json();
    }

    public function getAllAuthors()
    {
        $allAuthors = [];
        $currentPage = 1;
        $limit = 12;
        $user = session()->get('user');

        do {
            $response =  Http::withToken($user['token_key'])->get($this->baseUrl . '/authors', [
                'orderBy' => 'id',
                'direction' => 'ASC',
                'limit' => $limit,
                'page' => $currentPage,
            ]);;

            if ($response->successful()) {
                $data = json_decode($response->getBody(), true);
                $allAuthors = array_merge($allAuthors, $data['items']);
                $currentPage++;
            } else {
                // Handle API errors
                return null;
            }
        } while ($currentPage <= $data['total_pages']);

        return $allAuthors;
    }


    /**
     * Summary of getAuthor
     * @param int $authorId
     * @return boolean || string {}
     */
    public function getAuthor(int $authorId)
    {
        $user = session()->get('user');
        $response = Http::withToken($user['token_key'])->get($this->baseUrl . '/authors/' . $authorId);

        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }

    public function createAthor( $token, $first_name,  $last_name,  $birthday, $biography, $gender, $place_of_birth)
    {
        $response = Http::withToken($token)->post($this->baseUrl . '/authors', [
            "first_name" => $first_name,
            "last_name" => $last_name,
            "birthday" => $birthday,
            "biography" => $biography,
            "gender" => $gender,
            "place_of_birth" => $place_of_birth
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }

    public function deleteAuthor( $authorId ) 
    {
        $user = session()->get('user');
        $response = Http::withToken($user['token_key'])->delete($this->baseUrl . '/authors/' . $authorId);

        if ($response->successful()) {
            return true;
        }

        return false;
    }

    public function deleteBook($bookId)
    {
        $user = session()->get('user');
        $response = Http::withToken($user['token_key'])->delete($this->baseUrl . '/books/' . $bookId);

        if ($response->successful()) {
            return true;
        }

        return false;
    }

    public function createBook($data) {
        $user = session()->get('user');
        $response = Http::withToken($user['token_key'])->post($this->baseUrl . '/books', [
            'title' => $data['title'],
            'description' => $data['description'],
            'release_date' => $data['release_date'],
            'isbn' => $data['isbn'],
            "author" => [
                "id" => intval($data['author_id'])
            ],
            'format' => $data['format'],
            'number_of_pages' => intval($data['number_of_pages']),
        ]);

        if ($response->successful()) {
            return true;
        }

        return false;
    }
}
