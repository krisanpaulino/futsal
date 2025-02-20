<?php

use App\Models\PelangganModel;
use App\Models\SewafasilitasModel;
use App\Models\UserModel;

function pelanggan()
{
    $model = new PelangganModel();
    $user = $model->where('pelanggan.user_id', session('user')->user_id)->first();
    return $user;
}
function user()
{
    $model = new UserModel();
    $user = $model->where('user_id', session('user')->user_id)->first();
    return $user;
}
function getSewaFasilitas($jadwal_id)
{
    $model = new SewafasilitasModel();
    $model->join('fasilitas', 'fasilitas.fasilitas_id = sewafasilitas.fasilitas_id');
    $res = $model->where('jadwal_id', $jadwal_id)->find();
    return $res;
}
