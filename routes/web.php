<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    } else {
        return view('welcome');
    }
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    // Define your admin routes here
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');
});

Route::resource('books', BookController::class);
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('cart', CartController::class)->only(['index', 'update', 'destroy']);
    Route::get('cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
    Route::put('cart/update/{cartItem}/{book_id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('cart/purchase', [CartController::class, 'purchase'])->name('cart.purchase');
    Route::get('/admin/dashboard', [BookController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/books/{book}/reviews', [BookController::class, 'showReviews'])->name('books.reviews');
    Route::post('/books/{book}/reviews', [BookController::class, 'addReview'])->name('books.addReview')->middleware('auth');
});
