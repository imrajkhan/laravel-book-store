@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">Reviews for {{ $book->title }}</h2>

        <!-- Display reviews -->
        @forelse ($reviews as $review)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="font-weight-bold mb-0">{{ $review->user->name }}</p>
                    <p class="text-muted small mb-2">
                        Rating:
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-warning"></i>
                            @endif
                        @endfor
                    </p>
                    <p>{{ $review->comment }}</p>
                </div>
            </div>
        @empty
            <p class="text-muted">No reviews yet.</p>
        @endforelse

        <div class="d-flex justify-content-center mt-4">
            {{ $reviews->links() }}
        </div>

        <!-- Form to add a new review -->
        @auth
            <form action="{{ route('books.addReview', $book) }}" method="POST" class="mt-4">
                @csrf

                <div class="form-group">
                    <label for="rating">Rating:</label>
                    <select name="rating" class="form-control" required>
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}">{{ $i }} star{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea name="comment" class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        @else
            <p class="mt-4">Please <a href="{{ route('login') }}">log in</a> to leave a review.</p>
        @endauth
    </div>
    <style>
        .star-rating {
            display: inline-block;
        }

        .star-rating i {
            font-size: 24px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .star-rating i.text-warning {
            color: #FFD700;
        }

        .star-rating i:not(.text-warning) {
            color: #ccc;
        }
    </style>
@endsection
