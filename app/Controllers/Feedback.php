<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FeedbackModel;
use CodeIgniter\HTTP\ResponseInterface;

class Feedback extends BaseController
{
    public function index()
    {
        $model = new FeedbackModel();
        $data = [
            'title' => 'Data Feedback',
            'feedback' => $model->getFeedback()
        ];
        return view('admin/feedback_index', $data);
    }
}
