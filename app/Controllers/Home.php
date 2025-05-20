<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\FasilitasModel;
use App\Models\FeedbackModel;
use App\Models\JadwalModel;
use App\Models\KepsekModel;
use App\Models\LapanganModel;
use App\Models\NotifikasiModel;
use App\Models\PelangganModel;
use App\Models\PendaftaranModel;
use App\Models\RiwayatModel;
use App\Models\SekolahModel;
use App\Models\SewafasilitasModel;
use App\Models\TaModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class Home extends BaseController
{
    private $email_address = 'luciodasilva391@gmail.com';
    private function sendEmail($to, $title, $message)
    {
        $email = \Config\Services::email();
        // $this->load->library('email');

        $email->setFrom('luciodasilva391@gmail.com', 'Indah Futsal');
        $email->setTo($to);

        $email->setSubject($title);
        $email->setMessage($message);

        return $email->send();
    }
    public function index(): string
    {
        $mFeedback = new FeedbackModel();
        $data = [
            'title' => 'Indah Futsal Kupang',
            'feedback' => $mFeedback->getFeedback(null, 3)
        ];
        return view('landing_page', $data);
    }
    public function bookingPage(): string
    {
        $model = new LapanganModel();
        $mJadwal = new JadwalModel();
        $data = [
            'title' => 'Halaman Booking Lapangan',
            'lapangan' => $model->first(),
            'jadwal' => $mJadwal->tampilDepan()
        ];
        return view('booking_page', $data);
    }
    public function booking()
    {
        $mLapangan = new LapanganModel();
        $lapangan = $mLapangan->first();
        $post = $this->request->getPost();
        // dd($post);
        $trx = [
            'pelanggan_id' => pelanggan()->pelanggan_id,
            'status' => 'Belum Bayar',
            'total_bayar' => array_sum($post['durasi']) * $lapangan->harga_sewa
        ];
        //hitung total trx fasilitas
        $mFasilitas = new FasilitasModel();
        $totalfasilitas = 0;

        if (isset($post['fasilitas0'])) {

            $trx['jenis'] = 'Booking Lapangan dan Fasilitas';
        }
        foreach ($post['durasi'] as $key => $dur) {
            if (isset($post['fasilitas' . $key])) {

                $fasilitas_ids = $post['fasilitas' . $key];
                $mFasilitas->selectSum('harga_sewa', 'total');
                $mFasilitas->whereIn('fasilitas_id', $fasilitas_ids);
                $total = $mFasilitas->first();
                $totalfasilitas += $total->total * $dur;
            }
        }
        $trx['total_bayar'] += $totalfasilitas; // LANJUT DI MASUKAN TRANSAKSI FASILITAS KE DB
        $mTransaksi = new TransaksiModel();
        $mJadwal = new JadwalModel();
        $mSewa = new SewafasilitasModel();
        if ($transaksi_id = $mTransaksi->insert($trx, true)) {
            foreach ($post['durasi'] as $key => $row) {
                //Jadwal
                $waktu_mulai = $post['waktu_mulai'][$key];
                $waktu_selesai = date('H:i', strtotime('+' . $row . ' hour', strtotime($waktu_mulai)));
                $data = [
                    'transaksi_id' => $transaksi_id,
                    'tanggal' => $post['tanggal'][$key],
                    'waktu_mulai' => $waktu_mulai,
                    'waktu_selesai' => $waktu_selesai,
                    'status' => 'Pending',
                    'harga' => $row * $lapangan->harga_sewa
                ];
                $jadwal_id = $mJadwal->insert($data, true);

                //Fasilitas
                if (isset($post['fasilitas' . $key])) {

                    foreach ($post['fasilitas' . $key] as $i => $fasilitas_id) {
                        $fasilitas = $mFasilitas->find($fasilitas_id);
                        $sewafasilitas = [
                            'fasilitas_id' => $fasilitas_id,
                            'jadwal_id' => $jadwal_id,
                            'sub_total' => $row * $fasilitas->harga_sewa
                        ];
                        $mSewa->insert($sewafasilitas);
                    }
                }
            }
        }
        $transaksi = $mTransaksi->find($transaksi_id);
        $notifikasi = [
            'transaksi_id' => $transaksi_id,
            'notifikasi_tanggal' => date('Y-m-d H:i:s'),
            'notifikasi_isi' => 'Booking lapangan masuk!',
            'status' => 'terkirim'
        ];
        $mNotif = new NotifikasiModel();
        $mNotif->insert($notifikasi);
        $message = "<h1>Booking Lapangan Masuk</h1> Booking lapangan oleh pelanggan : <b>" . pelanggan()->pelanggan_nama . "</b> pada " . $transaksi->tanggal_pesan . "telah masuk. </br> Silahkan login sebagai admin untuk melihat rincian booking.";
        $error = $this->sendEmail($this->email_address, 'Pesanan Masuk', $message);

        return redirect()->to('pesanan-saya');
    }
    function pesananSaya()
    {
        $model = new TransaksiModel();
        $pelanggan = pelanggan();
        $data = [
            'title' => 'Daftar Pesanan Saya',
            'transaksi' => $model->byPelanggan($pelanggan->pelanggan_id)
        ];
        return view('transaksi_index', $data);
    }
    function jadwal()
    {
        $mJadwal = new JadwalModel();
        $data = [
            'title' => 'Halaman Booking Lapangan',
            'jadwal' => $mJadwal->tampilDepan()
        ];
        return view('jadwal_page', $data);
    }
    function jadwalSaya()
    {
        $mJadwal = new JadwalModel();
        $pelanggan_id = pelanggan()->pelanggan_id;
        $data = [
            'title' => 'Halaman Jadwal Saya',
            'jadwal' => $mJadwal->tampilDepan($pelanggan_id),
            'riwayat' => $mJadwal->tampilRiwayat($pelanggan_id)
        ];
        return view('jadwal_saya', $data);
    }
    function uploadBayar()
    {
        $transaksi_id = $this->request->getPost('transaksi_id');

        $file = $this->request->getFile('file');
        $validationRule = [
            'file' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[file]',
                    // 'is_image[file]',
                    'mime_in[file,application/pdf,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    // 'max_size[file,2048]',
                    // 'max_dims[file,1920,1080]',
                ],
            ],
        ];
        if (!$this->validateData([], $validationRule)) {
            $errors = ['errors' => $this->validator->getErrors()];
            dd($errors);
            return redirect()->back()->with('errors', $errors)
                ->with('message', "Toastify({'text':'File tidak valid.', style: {
            background: '#fd2e64',
          }}).showToast()")->withInput();
        }
        if (!$file->isValid()) {
            return redirect()->back()->with('errors', ['image' => 'File tidak valid'])
                ->with('message', "Toastify({'text':'File tidak valid!', style: {
                background: '#fd2e64',
              }}).showToast()")->withInput();
        }

        $model = new TransaksiModel();
        $transaksi = $model->find($transaksi_id);
        //File Upload 
        $filename = 'bayar' . $transaksi_id . '.' . $file->getClientExtension();
        $file->move('assets/img/bayar/', $filename, true);

        //Updating data in sekolah
        $data['bukti_bayar'] = $filename;
        $data['status'] = 'Butuh Verifikasi';
        $data['tanggal_bayar'] = date('Y-m-d H:i:s');
        $model->update($transaksi_id, $data);

        $message = "<h1>Booking Lapangan dibayar</h1> Booking lapangan oleh pelanggan : <b>" . pelanggan()->pelanggan_nama . "</b> pada " . $transaksi->tanggal_pesan . "telah dibayar. </br> Silahkan login sebagai admin untuk melakukan proses validasi butkti pembayaran.";
        $error = $this->sendEmail($this->email_address, 'Pesanan Masuk', $message);
        //done
        return redirect()->back()
            ->with('message', "Toastify({'text':'Berhasil diupload!'}).showToast()");
    }

    function batal()
    {
        $transaksi_id = $this->request->getPost('transaksi_id');
        $model = new TransaksiModel();
        $data['status'] = 'Batal';
        $model->update($transaksi_id, $data);
    }
    function feedback()
    {
        $transaksi_id = $this->request->getPost('transaksi_id');
        $model = new FeedbackModel();
        $data['transaksi_id'] = $transaksi_id;
        $data['komentar'] = $this->request->getPost('komentar');
        $data['rating'] = $this->request->getPost('rating');
        $model->insert($data);
        return redirect()->back()->with('message', 'successToast("Berhasil memberikan feedback!")');
    }
    function profil()
    {
        $pelanggan = pelanggan();
        $data = [
            'title' => 'Profil',
            'pelanggan' => $pelanggan
        ];
        return view('profil', $data);
    }
    function updateProfil()
    {
        $pelanggan = pelanggan();
        $model = new PelangganModel();
        $data['pelanggan_nama'] = $this->request->getPost('pelanggan_nama');
        $data['pelanggan_telepon'] = $this->request->getPost('pelanggan_telepon');
        $data['pelanggan_email'] = $this->request->getPost('pelanggan_email');
        $model->update($pelanggan->pelanggan_id, $data);
        $model = new UserModel();
        $user['username'] = $this->request->getPost('username');
        $model->update($pelanggan->user_id, $user);
        return redirect()->back()->with('message', 'successToast("Berhasil")');
    }
    function updatePassword()
    {
        // $user_id = user()->user_id;
        $current_password = $this->request->getPost('current_password');
        $model = new UserModel();
        $user = user();
        //cek validasi password 
        if (!password_verify($current_password, $user->user_password)) {
            return redirect()->back()->with('errors', $model->errors())
                ->with('message', "Toastify({'text':'Gagal! Pasword salah!', style: {
    background: '#fd2e64',
  }}).showToast()");
        }
        $data = [
            'user_password' => $this->request->getPost('user_password'),
            'password_confirmation' => $this->request->getPost('password_confirmation')
        ];
        // dd($user);
        $model->where('user_id', session('user')->user_id);
        $model->set($data);
        if (!$model->update())
            // dd($model->errors());
            return redirect()->back()->with('errors', $model->errors())
                ->with('message', "Toastify({'text':'Gagal! Konfirmasi password tidak sama', style: {
    background: '#fd2e64',
  }}).showToast()");

        return redirect()->back()
            ->with('message', "Toastify({'text':'Password berhasil diubah!'}).showToast()")
            ->with('errors', $model->errors());
    }

    function tambahFasilitas()
    {
        $jadwal_id = $this->request->getPost('jadwal_id');
        $mJadwal = new JadwalModel();
        $jadwal = $mJadwal->find($jadwal_id);

        $model = new TransaksiModel();
        $transaksi = $model->find($jadwal->transaksi_id);

        $mFasilitas = new FasilitasModel();
        $fasilitas = $this->request->getPost('fasilitas');
        $mSewaF = new SewafasilitasModel();
        $total = 0; //total tambah fasilitas
        // dd($fasilitas);
        foreach ($fasilitas as $fasilitas_id) {
            $fas = $mFasilitas->find($fasilitas_id);
            $total += $fas->harga_sewa;

            $starttimestamp = strtotime($jadwal->waktu_mulai);
            $endtimestamp = strtotime($jadwal->waktu_selesai);
            $difference = abs($endtimestamp - $starttimestamp) / 3600;

            $sewa = [
                'fasilitas_id' => $fasilitas,
                'sub_total' => $fas->harga_sewa * $difference,
                'jadwal_id' => $jadwal_id
            ];
            $mSewaF->insert($sewa);
        }

        $datatrx = [
            'total_bayar' => $transaksi->total_bayar + $total
        ];

        $model->where('transaksi_id', $jadwal->transaksi_id);
        $model->set($datatrx);
        $model->update();

        return redirect()->back()->with('message', "Toastify({'text':'Pesanan berhasil diupdate!'}).showToast()");
    }
}
