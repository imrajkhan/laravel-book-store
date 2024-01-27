<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Purchase;

class PurchaseSeeder extends Seeder
{
    public function run()
    {
        $userIds = [1, 2, 3, 4];

        $bookIds = \App\Models\Book::pluck('id')->toArray();

        foreach ($userIds as $userId) {
            /**
             * Random no`s.
             */
            $numberOfPurchases = rand(1, 5);

            for ($i = 0; $i < $numberOfPurchases; $i++) {
                Purchase::create([
                    'user_id' => $userId,
                    'book_id' => $bookIds[array_rand($bookIds)],
                    'quantity' => rand(1, 5),
                    'total_price' => 0,
                    'purchase_date' => now(),
                ]);
            }
        }
    }
}
