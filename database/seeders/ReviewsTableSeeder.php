<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Book;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        $reviewsPerBook = 3;

        $books = Book::all();

        foreach ($books as $book) {
            $this->createReviewsForBook($book, $reviewsPerBook);
        }
    }

    /**
     * Create multiple reviews for singlle book.
     */
    private function createReviewsForBook(Book $book, $count)
    {
        Review::factory($count)->create([
            'book_id' => $book->id,
        ]);
    }
}
