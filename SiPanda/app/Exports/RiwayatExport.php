<?php

namespace App\Exports;

use App\Models\Riwayat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RiwayatExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Riwayat::select('id_user', 'nama', 'umur', 'tanggal_diagnosa', 'status')->get();
        
    }

    public function headings(): array
    {
        return ['ID User', 'Nama', 'Umur', 'Tanggal Diagnosa', 'Status'];
    }
}
