<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id', 'loan_at', 'return_at'];
    
    
    public function loanDetails()
    {
        return $this->hasMany(LoanDetail::class);
    }
   

    // Relasi ke LoanDetail
    public function details()
    {
        return $this->hasMany(LoanDetail::class, 'loan_id');
    }
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
