<?php

namespace App\Http\Controllers;

use App\Models\LoanDetail;
use Illuminate\Http\Request;

class LoansDetailController extends Controller
{
    public function show()
    {
        
        $loanDetails = LoanDetail::all();

        return view('loans.detail', compact('loanDetails'));
    }
//     public function destroy( string $id)
//     {
//         $loan = LoanDetail::findOrFail($id);
//         $loan->delete();

      
//         $notification = array(
//             'message' => 'Data pinjaman berhasil dihapus',
//             'alert-type' => 'success'
//         );

//         return redirect()->route('loans')->with($notification);
//     }
public function destroy($id)
    {
        $detail = LoanDetail::findOrFail($id);
        $detail->delete();

        $notification = array(
            'message' => 'Data Pinjaman berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('loans')->with($notification);
    }
}
