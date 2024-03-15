
@extends('layouts.app')
@section('content')    
    <h1>Author Details</h1>

    @if ($author)
        <h2>{{ $author['first_name'] }} {{ $author['last_name'] }}</h2>
        <p><strong>Birthday:</strong> {{ App\Helpers\DateHelper::formatDate($author['birthday']) }}</p>
        <p><strong>Biography:</strong> {{ array_key_exists('biography', $author) ? $author['biography'] : 'No biography'}}</p>
        <p><strong>Gender:</strong> {{ $author['gender'] }}</p>
        <p><strong>Place of birth:</strong> {{ $author['place_of_birth'] }}</p>

        @if (count($author['books']) > 0)
            <h3>Books by {{ $author['first_name'] }} {{ $author['last_name'] }}</h3>
            <ul>
                @foreach ($author['books'] as $book)
                    <li>
                        <strong>Title:</strong> {{ $book['title'] }}<br>
                        <strong>Release Date:</strong> {{ App\Helpers\DateHelper::formatDate($book['release_date']) }}<br>
                        <strong>Description:</strong> {{ $book['description'] }}<br>
                        @if (isset($book['isbn']))
                            <strong>ISBN:</strong> {{ $book['isbn'] }}<br>
                        @endif
                        <strong>Format:</strong> {{ $book['format'] }}<br>
                        <strong>Number of Pages:</strong> {{ $book['number_of_pages'] }}
                        <form action="{{ route('book.destroy', $book['id']) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Book</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p>This author has no books listed.</p>
        @endif
    @else
        <p>Author not found.</p>
    @endif
@endsection
