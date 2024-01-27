<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        Book::create([
            'title' => 'Sample Book 1',
            'author' => 'Author 1',
            'genre' => 'Fiction',
            'price' => 19.99,
            'quantity_available' => 50,
        ]);

        Book::create([
            'title' => 'Sample Book 2',
            'author' => 'Author 2',
            'genre' => 'Non-Fiction',
            'price' => 29.99,
            'quantity_available' => 30,
        ]);

        Book::create([
            'title' => 'Sample Book 3',
            'author' => 'Author 3',
            'genre' => 'Mystery',
            'price' => 24.99,
            'quantity_available' => 40,
        ]);

        Book::create([
            'title' => 'Sample Book 4',
            'author' => 'Author 4',
            'genre' => 'Science Fiction',
            'price' => 39.99,
            'quantity_available' => 20,
        ]);

        Book::create([
            'title' => 'Sample Book 5',
            'author' => 'Author 5',
            'genre' => 'Biography',
            'price' => 34.99,
            'quantity_available' => 25,
        ]);

    }
}
