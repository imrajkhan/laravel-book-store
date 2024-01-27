@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Admin Dashboard</h2>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Purchased Books</h3>
            </div>
            <div class="card-body">
                @if($groupedPurchasedBooks->isEmpty())
                    <p class="text-muted">No books have been purchased yet.</p>
                @else
                    @foreach($groupedPurchasedBooks as $user => $books)
                        <div class="mb-3">
                            <h4>{{ $user }}</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $book)
                                        <tr>
                                            <td>{{ $book->first()->book->title }}</td>
                                            <td>{{ $book->sum('quantity') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="mb-0">Books In Demand</h3>
            </div>
            <div class="card-body">
                @if($booksInDemand->isEmpty())
                    <p class="text-muted">No books are in demand.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Total Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booksInDemand as $bookInDemand)
                                <tr>
                                    <td>{{ $bookInDemand->book->title }}</td>
                                    <td>{{ $bookInDemand->total_quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
