<?php

namespace App\Http\Controllers;

use App\Exports\LoansExport;
use App\Models\LoanDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class LoansDetailController extends Controller
{
    public function show()
    {
        
     
    
       
     
            $loanDetails = LoanDetail::all(); 
        
        

        return view('loans.detail', compact('loanDetails'));
    }
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

    public function print()
    {
        $data['loans'] = LoanDetail::all();
        $pdf = Pdf::loadView('loans_detail.print', $data);
        return $pdf->stream('loans_detail.pdf');
    }

    public function export()
    {
        return Excel::download(new LoansExport, 'loans_detail.xlsx');
    }
}
