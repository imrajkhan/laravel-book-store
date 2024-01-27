@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Shopping Cart</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <table class="table">
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cartItems as $cartItem)
                    <tr>
                        <td>{{ $cartItem->book->title }}</td>
                        <td>
                            <form action="{{ route('cart.update', ['cartItem' => $cartItem->id, 'book_id' => $cartItem->book->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this item from the cart?')">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <!-- Cart is empty message goes here -->
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center">
            <!-- "Go back to Books" button always present -->
            <a href="{{ route('books.index') }}" class="btn btn-primary">Go back to Books</a>

            <!-- Purchase button only shown if the cart is not empty -->
            @if ($cartItems->isNotEmpty())
                <form action="{{ route('cart.purchase') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Purchase</button>
                </form>
            @endif
        </div>
    </div>
@endsection
