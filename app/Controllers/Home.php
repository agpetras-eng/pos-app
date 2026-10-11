<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\UserModel;

class Home extends BaseController
{
    protected $helpers = ['form', 'url'];

    // Dashboard: the home screen with the big buttons
    public function index()
    {
        $customerModel = new CustomerModel();
        $userModel     = new UserModel();

        $data['pageTitle']      = 'Home';
        $data['customer_count'] = $customerModel->countAllResults();
        $data['user_count']     = $userModel->countAllResults();

        // Newest customer (null if the table is empty)
        $data['latest_customer'] = $customerModel->orderBy('id', 'DESC')->first();

        return view('dashboard', $data);
    }
}
