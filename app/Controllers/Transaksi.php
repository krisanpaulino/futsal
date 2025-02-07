<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalModel;
use App\Models\NotifikasiModel;
use App\Models\PelangganModel;
use App\Models\TransaksiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Transaksi extends BaseController
{
    public function index()
    {
        $model = new TransaksiModel();
        $data = [
            'title' => 'Data Transaksi',
            'transaksi' => $model->getAll()
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
        //Updating data in sekolah
        $data['status'] = 'Sudah Bayar';
        $model->update($transaksi_id, $data);

        //Notifikasi
        $notifikasi = [
            'transaksi_id' => $transaksi_id,
            'notifikasi_tanggal' => date('Y-m-d H:i:s'),
            'notifikasi_isi' => 'Bukti Bayar sudah diverifikasi!',
            'status' => 'terkirim'
        ];
        $mNotif = new NotifikasiModel();
        $mNotif->insert($notifikasi);
        return redirect()->back()
            ->with('message', "Toastify({'text':'Berhasil diverifikasi!'}).showToast()");
    }

    function tolak()
    {
        $transaksi_id = $this->request->getPost('transaksi_id');
        $model = new TransaksiModel();
        //Updating data in sekolah
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
}
