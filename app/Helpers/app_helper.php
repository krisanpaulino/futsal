<?php

use App\Models\PelangganModel;
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
