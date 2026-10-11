<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    protected $helpers = ['form', 'url'];

    // Rules used by both create and update
    private function getRules()
    {
        return [
            'full_name' => [
                'label' => 'Full name',
                'rules' => 'required|min_length[3]',
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
            ],
        ];
    }

    // List all customers
    public function index()
    {
        $model = new CustomerModel();

        $data['pageTitle'] = 'Customers';
        $data['customers'] = $model->findAll();

        return view('customers/index', $data);
    }

    // Show an empty form
    public function new()
    {
        $data['pageTitle'] = 'New Customer';
        $data['title']     = 'New Customer';
        $data['action']    = base_url('customers/create');
        $data['customer']  = ['full_name' => '', 'email' => ''];

        return view('customers/form', $data);
    }

    // Validate, then insert
    public function create()
    {
        if (! $this->validate($this->getRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new CustomerModel();
        $model->insert([
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
        ]);

        return redirect()->to('/customers')->with('success', 'Customer added successfully.');
    }

    // Show the form filled with the existing record
    public function edit($id)
    {
        $model    = new CustomerModel();
        $customer = $model->find($id);

        if ($customer === null) {
            return redirect()->to('/customers')->with('error', 'Customer not found.');
        }

        $data['pageTitle'] = 'Edit Customer';
        $data['title']     = 'Edit Customer';
        $data['action']    = base_url('customers/update/' . $id);
        $data['customer']  = $customer;

        return view('customers/form', $data);
    }

    // Validate, then update
    public function update($id)
    {
        if (! $this->validate($this->getRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new CustomerModel();
        $model->update($id, [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
        ]);

        return redirect()->to('/customers')->with('success', 'Customer updated successfully.');
    }
}
