<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalModel;
use App\Models\TransaksiModel;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class Laporan extends BaseController
{
    public function keuangan()
    {
        $dari = $this->request->getGet('dari');
        $sampai = $this->request->getGet('sampai');
        $model = new TransaksiModel();
        $data = [
            'title' => 'Laporan Keuangan',
            'transaksi' => $model->getLaporan($dari, $sampai),
            'dari' => $dari,
            'sampai' => $sampai,
        ];
        return view('admin/laporan_index', $data);
    }
    function cetak()
    {
        $dari = $this->request->getGet('dari');
        $sampai = $this->request->getGet('sampai');
        $model = new TransaksiModel();

        $tanggal = date('Y-m-d');
        $data = [
            'title' => 'Laporan Keuangan',
            'transaksi' => $model->getLaporan($dari, $sampai),
            'dari' => $dari,
            'sampai' => $sampai,
            'tanggal' => $tanggal
        ];
        $filename = $tanggal . '-laproran-keuangan';


        // instantiate and use the dompdf class
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf();
        $dompdf->setOptions($options);

        // load HTML content
        $dompdf->loadHtml(view('admin/laporan_cetak', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        return $dompdf->stream($filename);
    }
}
