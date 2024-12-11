<?php

namespace App\Http\Controllers;

use App\Models\Bookshelf;
use App\Models\LoanDetail;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Loan;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('book', 'user')->where('user_id', auth()->id())->get();

        return view('loans_detail.index', compact('loans'));
    }
 

   

   
public function borrow(Request $request, $bookId)
{
    // Find the book to be borrowed
    $book = Book::findOrFail($bookId);

    // Create the loan record
    $loan = Loan::create([
        'user_id' => $request->user()->id,
        'book_id' => $book->id,
         'title' => $book->title,
        'loan_at' => now(),
        'return_at' => now()->addDays(14), // Default 14 hari // Initially null, will be updated later when returned
    ]);

    // Create the loan details record for each book borrowed (you can adjust if multiple books are allowed per loan)
    LoanDetail::create([
        'loan_id' => $loan->id,
        'book_id' => $book->id,
        'is_return' => false, // Initially, the book is not returned
    ]);

    // Return a success response
    $notification = array(
        'message' => 'Data buku berhasil dipinjam',
        'alert-type' => 'success'
    );

    return redirect()->route('book')->with($notification);
}

public function returnBook(Request $request, $loanId)
{

    $loan = Loan::findOrFail($loanId);

   
    $loan->update([
        'return_at' => now(),
    ]);

    // Update the loan detail's is_return status
    LoanDetail::where('loan_id', $loan->id)->update([
        'is_return' => true,
    ]);
    $notification = array(
        'message' => 'Buku berhasil dikembalikan',
        'alert-type' => 'success'
    );

    return redirect()->route('loans')->with($notification);
}
public function destroy($id)
    {
        Loan::findOrFail($id)->delete();
        // LoanDetail::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Data Detail Pinjaman berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('loans_detail')->with($notification);
    }

}
