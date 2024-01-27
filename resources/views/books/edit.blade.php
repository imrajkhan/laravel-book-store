@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Book</h2>
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" name="genre" class="form-control" value="{{ $book->genre }}" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ $book->price }}" required>
            </div>
            <div class="form-group">
                <label for="quantity_available">Quantity Available:</label>
                <input type="number" name="quantity_available" class="form-control" value="{{ $book->quantity_available }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Book</button>
        </form>
    </div>
@endsection
