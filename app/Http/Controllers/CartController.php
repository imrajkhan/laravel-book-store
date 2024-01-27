<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Purchase;


class CartController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    public function index()
    {
        $cartItems = auth()->user()->cart;

        return view('cart.index', compact('cartItems'));
    }

    public function add(Book $book)
    {
        $user = auth()->user();

        // Check if the book is already in the user's cart
        $existingCartItem = $user->cart()->where('book_id', $book->id)->first();

        if ($existingCartItem) {
            
            $existingCartItem->increment('quantity');
        } else {
            $user->cart()->create([
                'book_id' => $book->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Book added to cart successfully.');
    }

    public function update(Request $request, Cart $cartItem, $book_id)
    {
        $cartItem->user_id = auth()->id();
        $cartItem->quantity = $request->quantity;
        $cartItem->book_id = $book_id;
    
        $cartItem->save();
    
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }
    

    public function destroy($id)
{
    $cartItem = Cart::findOrFail($id);
    $cartItem->delete();

    return redirect()->route('cart.index')->with('success', 'Item removed from the cart successfully.');
}

public function purchase()
{
    
    // if the user is logged in
    if (auth()->check()) {
        // Get user's cart items
        $cartItems = auth()->user()->cartItems;
        // dd($cartItems);
        if ($cartItems && $cartItems->isNotEmpty()) {
            
            foreach ($cartItems as $cartItem) {
                Purchase::create([
                    'user_id' => auth()->user()->id,
                    'book_id' => $cartItem->book_id,
                    'quantity' => $cartItem->quantity,
                    'total_price' => $cartItem->book->price * $cartItem->quantity,
                    'purchase_date' => now(),
                ]);

            }

            auth()->user()->cartItems()->delete();

            return redirect()->route('cart.index')->with('success', 'Purchase successful.');
        } else {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Add items to your cart before making a purchase.');
        }
    } else {
        return redirect()->route('cart.index')->with('error', 'You must be logged in to make a purchase.');
    }
}


}
