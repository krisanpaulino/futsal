<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FasilitasModel;
use App\Models\FeedbackModel;
use App\Models\JadwalModel;
use App\Models\NotifikasiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Ajax extends BaseController
{
    public function form()
    {
        $model = new FasilitasModel();
        $fasilitas = $model->getStatus('Tersedia');
        $jumlah = $this->request->getPost('count');
        if ($jumlah > 0) {
            $form = view('booking_form', ['jumlah' => $jumlah, 'fasilitas' => $fasilitas]);
            $summary = view('booking_summary', ['jumlah' => $jumlah]);
            $data = [
                'form' => $form,
                'summary' => $summary,

            ];
            echo json_encode($data);
        }
    }
    public function detailTransaksi()
    {
        $id = $this->request->getPost('id');
        $model = new JadwalModel();
        $data['show'] = $model->byTransaksi($id);
        $show = view('transaksi_detail', $data);
        echo json_encode($show);
    }
    public function cekJadwal()
    {
        $tanggal = $this->request->getPost('tanggal');
        $waktu_mulai = date('H:i:s', strtotime($this->request->getPost('waktu_mulai')));
        $durasi = $this->request->getPost('durasi');
        $waktu_selesai = date('H:i:s', strtotime('+' . $durasi . ' hour', strtotime($waktu_mulai)));
        $model = new JadwalModel();
        // echo json_encode($waktu_selesai);
        echo json_encode($model->isKosong($tanggal, $waktu_mulai, $waktu_selesai));
    }
    function notifikasiPelanggan()
    {
        $model = new NotifikasiModel();
        $notifikasi = $model->getNotifikasiPelanggan(pelanggan()->pelanggan_id);
        echo json_encode($notifikasi);
    }
    function notifikasiAdmin()
    {
        $model = new NotifikasiModel();
        $notifikasi = $model->getNotifikasiAdmin();
        echo json_encode($notifikasi);
    }
    function read($id)
    {
        $model = new NotifikasiModel();
        echo $model->read($id);
    }
    public function getFeedback()
    {
        $id = $this->request->getPost('id');

        $model = new FeedbackModel();
        $feedback = $model->getFeedback($id);
        $data['feedback'] = $feedback;
        $data['transaksi_id'] = $id;

        $content = view('modal_feedback', $data);

        echo json_encode($content);
    }
}
