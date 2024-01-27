<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $book = Book::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'comment' => $this->faker->paragraph,
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
