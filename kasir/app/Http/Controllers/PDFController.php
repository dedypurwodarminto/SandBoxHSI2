<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf as domPdf;
use Mpdf\Mpdf;

class PDFController extends Controller
{
    //Generate PDF dengan DOMPDF
    public function faktur($no_transaksi)
    {
        $data = array(
            'title' => "Faktur $no_transaksi",
            'data_detail' => Transaksi::findorfail($no_transaksi),
            'data_barang' => Barang::join('tb_detail_transaksi', 'tb_barang.id', '=', 'tb_detail_transaksi.id_barang')
            ->select('tb_barang.*', 'tb_detail_transaksi.*')
            ->where('tb_detail_transaksi.no_transaksi', '=', $no_transaksi)
                ->get()
        );

        // return view('kasir.transaksi.nota', $data);
        $pdf = domPdf::loadView('kasir.transaksi.nota', $data);
        $pdf -> setPaper([0, 0, 311.85, 822.15]);
        return $pdf->stream();
    }

    //Generate PDF dengan spatie
    public function invoice($no_transaksi)
    {
        $data = array(
            'title' => "Invoice $no_transaksi",
            'data_detail' => Transaksi::findorfail($no_transaksi),
            'data_barang' => Barang::join('tb_detail_transaksi', 'tb_barang.id', '=', 'tb_detail_transaksi.id_barang')
            ->select('tb_barang.*', 'tb_detail_transaksi.*')
            ->where('tb_detail_transaksi.no_transaksi', '=', $no_transaksi)
                ->get()
        );
        $mPDF = new Mpdf([
            'mode' => 'utf-8',
            'format' => [100, 236],
            'orientation' => 'L'
        ]);
        $mPDF->WriteHTML(view('kasir.transaksi.invoice', $data));
        $mPDF->SetWatermarkText(new \Mpdf\WatermarkText('L U N A S'));
        $mPDF->watermarkTextAlpha = 0.1;
        $mPDF->showWatermarkText = true;
        // $mPDF->SetWatermarkImage('../images/background.jpg');
        // $mPDF->watermarkImageAlpha = 0.5;
        // $mPDF->showWatermarkImage = true;
        $mPDF->SetProtection(['copy', 'print'], '', 'pass');
        return $mPDF->Output();
    }

}
