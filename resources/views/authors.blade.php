@extends('layouts.app')
@section('content')
    <h1>Authors</h1>
    @if ($authors)
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full name</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>Place of birth</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach($authors as $author)
                <tr>
                    <td>{{ $author['id'] }}</td>
                    <td>
                            <a href="{{ route('author.show', $author['id']) }}">{{ $author['first_name'] }} {{ $author['last_name'] }}</a>
                    </td>
                    <td>{{ App\Helpers\DateHelper::formatDate($author['birthday']) }}</td>
                    <td>{{ $author['gender'] }}</td>
                    <td>{{ $author['place_of_birth'] }}</td>
                    <td>
                    <form action="{{ route('authors.destroy', $author['id']) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Author</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Pagination Links --}}
    <ul class="pagination">
        @if ($currentPage > 1)
            <li class="page-item"><a class="page-link" href="{{ route('authors', ['page' => $currentPage - 1]) }}">Previous</a></li>
        @endif

        @for ($page = 1; $page <= $totalPages; $page++)
            <li class="page-item {{ $page === $currentPage ? 'active' : '' }}">
                <a class="page-link" href="{{ route('authors', ['page' => $page]) }}">{{ $page }}</a>
            </li>
        @endfor

        @if ($currentPage < $totalPages)
            <li class="page-item"><a class="page-link" href="{{ route('authors', ['page' => $currentPage + 1]) }}">Next</a></li>
        @endif
    </ul>
    @else
        <p>No authors found.</p>
    @endif
@endsection

