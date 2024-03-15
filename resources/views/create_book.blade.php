@extends('layouts.app')
@section('content')
    <h1>Add New Book</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('book.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="release_date">Release Date:</label>
            <input type="date" name="release_date" id="release_date" class="form-control">{{ old('release_date') }}</input>
        </div>

        <div class="form-group">
            <label for="isbn">ISBN:</label>
            <input type="text" name="isbn" id="isbn" class="form-control">{{ old('isbn') }}</input>
        </div>

        <div class="form-group">
            <label for="author">Author:</label>
            <select name="author_id" id="author" class="form-control">
                <option value="">Select Author</option>
                @foreach ($authors as $author)
                    <option value="{{ $author['id'] }}">{{ $author['first_name'] }} {{ $author['last_name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="format">Format:</label>
            <input type="text" name="format" id="format" class="form-control" value="{{ old('format') }}">
        </div>

        <div class="form-group">
            <label for="number_of_pages">Number of Pages:</label>
            <input type="number" name="number_of_pages" id="number_of_pages" class="form-control" value="{{ old('number_of_pages') }}">
        </div>

        <button type="submit" class="btn btn-primary">Create Book</button>
    </form>
@endsection
