<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Purchase;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function __construct()
{
    $this->middleware('auth');
    $this->middleware('admin')->only('adminDashboard');
}

    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required',
            'price' => 'required|numeric',
            'quantity_available' => 'required|integer',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required',
            'price' => 'required|numeric',
            'quantity_available' => 'required|integer',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
    public function adminDashboard()
    {
        $purchasedBooks = Purchase::with(['user', 'book'])
            ->orderBy('user_id')
            ->get();
    
        $groupedPurchasedBooks = $purchasedBooks->groupBy([
            'user.name',
            'book.title',
        ]);
    
        $booksInDemand = Purchase::select('book_id', \DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('book_id')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();
    
        return view('admin.dashboard', compact('groupedPurchasedBooks', 'booksInDemand'));
    }

    public function showReviews(Book $book)
    {
        $reviews = $book->reviews()->with('user')->latest()->paginate(10);

        return view('books.reviews', compact('book', 'reviews'));
    }

    public function addReview(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:255',
        ]);

        $review = $book->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('books.show', $book)->with('success', 'Review added successfully.');
    }

    public function show(Book $book)
{
    return view('books.show', compact('book'));
}
    
}
