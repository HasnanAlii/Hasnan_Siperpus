<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model
{
    protected $fillable = ['loan_id', 'book_id', 'is_return', 'user_id'];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A loan detail belongs to a loan
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    // A loan detail belongs to a book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
