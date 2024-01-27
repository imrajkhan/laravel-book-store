@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Book Listing</h2>
        <div class="row">
            @forelse ($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- Link to the book's detail page -->
                            <h5 class="card-title"><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></h5>
                            <p class="card-text">Author: {{ $book->author }}</p>
                            <p class="card-text">Genre: {{ $book->genre }}</p>
                            <p class="card-text">Price: ${{ $book->price }}</p>
                            <a href="{{ route('cart.add', $book->id) }}" class="btn btn-success">Add to Cart</a>
                            <a href="{{ route('books.reviews', $book->id) }}" class="btn btn-info">Reviews</a>

                            @auth
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>No books available.</p>
                </div>
            @endforelse
        </div>
        
        @auth
            @if(auth()->user()->isAdmin())
                <div class="text-right mt-4">
                    <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
                </div>
            @endif
        @endauth
    </div>
@endsection
