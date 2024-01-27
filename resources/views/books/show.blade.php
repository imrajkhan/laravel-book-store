@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <h2>{{ $book->title }}</h2>
                <p class="mb-2">Author: {{ $book->author }}</p>
                <p class="mb-2">Genre: {{ $book->genre }}</p>
                <p class="mb-2">Price: ${{ $book->price }}</p>
                <p class="mb-4">Description: {{ $book->description }}</p>

                <!-- Link to view reviews for the book -->
                <p><a href="{{ route('books.reviews', $book) }}" class="btn btn-info">See Reviews</a></p>
            </div>

            <div class="col-md-4">
                <!-- Add the form to add the book to the cart -->
                @auth
                    <form action="{{ route('cart.add', $book) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-block">Add to Cart</button>
                    </form>
                @else
                    <p class="mt-3"><a href="{{ route('login') }}" class="btn btn-primary btn-block">Login to Add to Cart</a></p>
                @endauth
            </div>
        </div>
    </div>
@endsection
