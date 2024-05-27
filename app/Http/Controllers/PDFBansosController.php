<?php

namespace App\Http\Controllers;

use App\Models\BansosModel;
use App\Models\Kriteria;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PDFBansosController extends Controller
{
    public function generatePDF()
    {
        $bansos = BansosModel::all();
        $bansos = BansosModel::orderBy('wsm', 'desc')->get();
        $kriteria = Kriteria::all();

        $date = Carbon::now()->isoFormat('D MMMM YYYY', 'id');

        $data = [
            'title' => 'Data Penerimaan Bantuan Sosial RW 06 Kelurahan Kalirejo, Kecamatan Lawang',
            'date' => $date,
            'bansos' => $bansos,
            'kriteria' => $kriteria,
        ];

        $pdf = PDF::loadView('dashboard.bansos_generate_pdf', $data)->setPaper('A4', 'landscape');
        return $pdf->download('data-penerimaan-bansos.pdf');
    }
}