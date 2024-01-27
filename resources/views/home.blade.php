@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-4 shadow">
            <div class="card-body text-center">
                <h1 class="display-4">Welcome to our Bookstore</h1>
                <p class="lead">Discover a world of amazing books!</p>
            </div>
        </div>

        <!-- Display recommended books -->
        @if(isset($similarBooks) && count($similarBooks) > 0)
            <div class="card mt-4 shadow">
                <div class="card-header bg-info text-white">
                    <h2>Recommended Books</h2>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($similarBooks as $book)
                        <li class="list-group-item">
                            <span class="badge bg-secondary">{{ $loop->index + 1 }}</span>
                            {{ $book->title }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
