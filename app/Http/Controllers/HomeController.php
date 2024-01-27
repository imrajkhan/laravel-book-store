<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $userPurchases = auth()->user()->purchases;

        $commonlyPurchasedBooks = Purchase::select('book_id', \DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('book_id')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        $commonlyPurchasedBookIds = $commonlyPurchasedBooks->pluck('book_id')->toArray();

        $similarBooks = Book::whereIn('id', $commonlyPurchasedBookIds)
            ->orderByRaw('FIELD(id, ' . implode(',', $commonlyPurchasedBookIds) . ')')
            ->get();

        return view('home', compact('similarBooks'));
    }



}
