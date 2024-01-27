<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'user_id', 'book_id', 'quantity', 'total_price', 'purchase_date',
    ];

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the Book model (assuming you have a Book model)
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
