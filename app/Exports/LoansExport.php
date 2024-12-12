<?php

namespace App\Exports;

use App\Models\Book;
use App\Models\LoanDetail;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LoansExport implements WithHeadings, ShouldAutoSize, FromArray
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Book::all();
    // }
    public function array(): array
    {
        return LoanDetail::export();
    }
    public function headings(): array
    {
        return [
            'No',
            'Id Pinjaman',
            'Peminjam',
            'Judul Buku',
            'Tanggal Pinjam',
            'Tanggal Pengembalian',
            'Status',
        ];
    }
}
