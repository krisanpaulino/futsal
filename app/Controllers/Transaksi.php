<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FasilitasModel;
use App\Models\JadwalModel;
use App\Models\NotifikasiModel;
use App\Models\PelangganModel;
use App\Models\SewafasilitasModel;
use App\Models\TransaksiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Transaksi extends BaseController
{

    private function sendEmail($to, $title, $message)
    {
        $email = \Config\Services::email();
        // $this->load->library('email');

        $email->setFrom('krisanpaulino@gmail.com', 'KrisanPaulino');
        $email->setTo($to);

        $email->setSubject($title);
        $email->setMessage($message);

        return $email->send();
    }
    public function index()
    {
        $model = new TransaksiModel();
        $data = [
            'title' => 'Data Transaksi',
            'transaksi' => $model->getAll('Booking Lapangan')
        ];
        return view('admin/transaksi_index', $data);
    }
    function jadwal($transaksi_id)
    {
        $model = new TransaksiModel();
        $mJadwal = new JadwalModel();
        $data = [
            'title' => 'DetailTransaksi',
            'transaksi' => $model->getSingle($transaksi_id),
            'jadwal' => $mJadwal->byTransaksi($transaksi_id),
        ];
        return view('admin/transaksi_detail', $data);
    }
    function verifikasi()
    {
        $transaksi_id = $this->request->getPost('transaksi_id');
        $model = new TransaksiModel();
        $transaksi = $model->getSingle($transaksi_id);
        //Updating data in sekolah
        $data['status'] = 'Sudah Bayar';
        $model->update($transaksi_id, $data);

        $message = "<h1>Update Transaksi Booking Lapangan</h1>Kepada " . $transaksi->pelanggan_nama . " Booking Lapangan anda pada " . $transaksi->tanggal_pesan . " dengan pembayaran pada " . $transaksi->tanggal_bayar . " telah diverifikasi. Silahkan datang pada jadwal sesuai pesanan anda!";
        //Notifikasi
        $notifikasi = [
            'transaksi_id' => $transaksi_id,
            'notifikasi_tanggal' => date('Y-m-d H:i:s'),
            'notifikasi_isi' => 'Bukti Bayar sudah diverifikasi!',
            'status' => 'terkirim'
        ];
        $mNotif = new NotifikasiModel();
        $mNotif->insert($notifikasi);
        //Email
        $error = $this->sendEmail($transaksi->pelanggan_email, 'Pesanan Diverifikasi', $message);
        // dd($error);
        return redirect()->back()
            ->with('message', "Toastify({'text':'Berhasil diverifikasi!'}).showToast()");
    }

    function tolak()
    {
        $transaksi_id = $this->request->getPost('transaksi_id');
        $model = new TransaksiModel();
        //Updating data in sekolah
        $transaksi = $model->getSingle($transaksi_id);
        $data['status'] = 'Ditolak';
        $model->update($transaksi_id, $data);
        //Notifikasi
        $notifikasi = [
            'transaksi_id' => $transaksi_id,
            'notifikasi_tanggal' => date('Y-m-d H:i:s'),
            'notifikasi_isi' => 'Bukti Bayar sudah ditolak! Periksa kembali dan upload ulang!',
            'status' => 'terkirim'
        ];
        $mNotif = new NotifikasiModel();
        $mNotif->insert($notifikasi);
        $message = "<h1>Update Transaksi Booking Lapangan</h1>Kepada " . $transaksi->pelanggan_nama . " Booking Lapangan anda pada " . $transaksi->tanggal_pesan . " dengan pembayaran pada " . $transaksi->tanggal_bayar . " telah ditolak. periksa kembali bukti pembayaran anda!";
        //Email
        $this->sendEmail($transaksi->pelanggan_email, 'Pesanan Diverifikasi', $message);
        return redirect()->back()
            ->with('message', "Toastify({'text':'transaksi ditolak!'}).showToast()");
    }
    function byPelanggan($pelanggan_id)
    {
        $model = new TransaksiModel();
        $mPelanggan = new PelangganModel();
        $data = [
            'title' => 'Data Transaksi',
            'transaksi' => $model->byPelanggan($pelanggan_id),
            'pelanggan' => $mPelanggan->find($pelanggan_id)
        ];
        return view('admin/transaksi_pelanggan', $data);
    }

    function fasilitas()
    {
        $model = new TransaksiModel();
        $transaksi = $model->getAll('Sewa Fasilitas');
        $data = [
            'title' => 'Data Transaksi',
            'transaksi' => $transaksi,
        ];
        return view('admin/transaksi_fasilitas', $data);
    }
    function detailSewa($transaksi_id)
    {
        $model = new TransaksiModel();
        $msewa = new SewafasilitasModel();
        $data = [
            'title' => 'DetailTransaksi',
            'transaksi' => $model->getSingle($transaksi_id),
            'sewafasilitas' => $msewa->getDetail($transaksi_id),
        ];
        return view('admin/transaksi_detailfasilitas', $data);
    }
    function sewaFasilitas()
    {
        $model = new FasilitasModel();
        $fasilitas = $model->getStatus('Tersedia');
        $data = [
            'title' => 'Sewa Fasilitas',
            'fasilitas' => $fasilitas,
        ];
        return view('admin/transaksi_sewafasilitas', $data);
    }
    function prosesSewa()
    {
        $fasilitas = $this->request->getPost('fasilitas');
        $durasi = $this->request->getPost('durasi');
        $jumlah = $this->request->getPost('jumlah');
        $harga = $this->request->getPost('harga');
        if ($fasilitas == null) {
            return redirect()->back()
                ->with('message', "dangerToast('Gagal order. Tidak ada fasilitas dipilih')");
        }

        $transaksi = [
            'tanggal_pesan' => date("Y-m-d H:i:s"),
            'tanggal_bayar' => date("Y-m-d H:i:s"),
            'status' => 'Sudah Bayar',
            'nama_penyewa' => 'Sudah Bayar',
            'jenis' => 'Sewa Fasilitas',
            'total_bayar' => array_sum($durasi) * array_sum($jumlah) * array_sum($harga),
        ];
        $tmodel = new TransaksiModel();
        if ($transaksi_id = $tmodel->insert($transaksi)) {
            foreach ($fasilitas as $key => $fasilitas_id) {
                $data = [
                    'transaksi_id' => $transaksi_id,
                    'fasilitas_id' => $fasilitas_id,
                    'jumlah_sewa' => $jumlah[$key],
                    'jumlah_jam' => $durasi[$key],
                    'sub_total' => $jumlah[$key] * $durasi[$key],
                    'status' => 'Selesai'
                ];
                $model = new SewafasilitasModel();
                $model->insert($data);
                // dd($model->errors());
            }
            return redirect()->to('admin/transaksi-fasilitas')
                ->with('message', "successToast('Berhasil')");
        }
        dd($tmodel->errors());
    }
}
