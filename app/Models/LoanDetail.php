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
    
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    // A loan detail belongs to a loan
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    // A loan detail belongs to a book
  
    public static function export()
    {
        $loan = LoanDetail::with('loan','book','user')->get();
  

        $loan_filter = [];
        $no = 1;
        for ($i = 0; $i <  $loan->count(); $i++) {
            $loan_filter[$i]['no'] = $no++;
            $loan_filter[$i]['ID Pinjaman'] =   $loan[$i]->id;
            $loan_filter[$i]['Peminjam'] =   $loan[$i]->user->name;
            $loan_filter[$i]['Judul Buku'] =   $loan[$i]->book->title;
            $loan_filter[$i]['Tanggal Pinjam'] =    $loan[$i]->loan_at;
            $loan_filter[$i]['Tanggal Kembali'] =  $loan[$i]->return_at;
            $loan_filter[$i]['Status'] =    $loan[$i]->return_at ? 'Dipinjam' : 'Dikembalikan' ;
        }

       
   
        return    $loan_filter;
    }
}
