<?php

namespace App\Http\Controllers;

use App\Models\umkm;
use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;

class printController extends Controller
{
    public function surat_keterangan(Request $r){
        
        // Get all the UMKM data that matches the search query and has status 'Disetujui'
        $dataUmkm = umkm::where(function($query) use ($r) {
                $query->where('nama_usaha', 'like', "%{$r->search}%")
                    ->orWhere('name', 'like', "%{$r->search}%")
                    ->orWhere('nik', 'like', "%{$r->search}%");
            })
            ->where('status', 'Disetujui')
            ->with('getRT', 'getKategori', 'getUser')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Check if there are no approved UMKM data
        if ($dataUmkm->isEmpty()) {
            $noDataMessage = 'Maaf, Tidak Ada Data UMKM Tersetujui!!!';
            return view('screens.SuratKeterangan.suratKeterangan', compact('dataUmkm', 'noDataMessage'));
        } else {
            return view('screens.SuratKeterangan.suratKeterangan', compact('dataUmkm'));
        }
    }

    public function domisili_umkm_print($id){

        $getData = umkm::with('getRT', 'getKategori', 'getUser')->find($id);

        $data = [
            'getData' => $getData,
        ];
        
        // Load the view, render PDF content, and prepare headers
        $pdf = FacadePdf::loadView('screens.SuratKeterangan.cetakDomisili', $data);
        $content = $pdf->output();

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Surat_Keterangan_Domisili.pdf"',
        ];

        // Return response with appropriate headers for new tab download
        return response($content, 200, $headers)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Surat_Keterangan_Domisili.pdf"');
    }

    public function pinjaman_umkm_print($id){
        $getData = umkm::with('getRT', 'getKategori', 'getUser')->find($id);

        $data = [
            'getData' => $getData,
        ];
        
        // Load the view, render PDF content, and prepare headers
        $pdf = FacadePdf::loadView('screens.SuratKeterangan.cetakPinjaman', $data);
        $content = $pdf->output();

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Surat_Keterangan_Pinjaman.pdf"',
        ];

        // Return response with appropriate headers for new tab download
        return response($content, 200, $headers)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Surat_Keterangan_Pinjaman.pdf"');
    }
}
