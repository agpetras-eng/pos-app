<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    protected $helpers = ['form', 'url'];

    // List all users (with avatar thumbnails)
    public function index()
    {
        $model = new UserModel();

        $data['pageTitle'] = 'User Accounts';
        $data['users']     = $model->findAll();

        return view('users/index', $data);
    }

    // Show an empty form (no avatar input when creating)
    public function new()
    {
        $data['pageTitle'] = 'New User';
        $data['title']     = 'New User';
        $data['action']    = base_url('users/create');
        $data['isEdit']    = false;
        $data['user']      = ['username' => '', 'full_name' => '', 'avatar' => ''];

        return view('users/form', $data);
    }

    // Validate, then insert
    public function create()
    {
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|is_unique[users.username]',
            ],
            'full_name' => [
                'label' => 'Full name',
                'rules' => 'required|min_length[3]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $model->insert([
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ]);

        return redirect()->to('/users')->with('success', 'User added successfully.');
    }

    // Show the form filled with the existing record
    public function edit($id)
    {
        $model = new UserModel();
        $user  = $model->find($id);

        if ($user === null) {
            return redirect()->to('/users')->with('error', 'User not found.');
        }

        $data['pageTitle'] = 'Edit User';
        $data['title']     = 'Edit User';
        $data['action']    = base_url('users/update/' . $id);
        $data['isEdit']    = true;
        $data['user']      = $user;

        return view('users/form', $data);
    }

    // Validate, upload the avatar (if one was chosen), then update
    public function update($id)
    {
        $model = new UserModel();
        $user  = $model->find($id);

        if ($user === null) {
            return redirect()->to('/users')->with('error', 'User not found.');
        }

        // Username must be unique, but ignore this user's own row
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|is_unique[users.username,id,' . $id . ']',
            ],
            'full_name' => [
                'label' => 'Full name',
                'rules' => 'required|min_length[3]',
            ],
        ];

        // Only validate the avatar if a file was actually chosen
        $file    = $this->request->getFile('avatar');
        $hasFile = ($file !== null && $file->getError() !== UPLOAD_ERR_NO_FILE);

        if ($hasFile) {
            $rules['avatar'] = [
                'label'  => 'Profile picture',
                'rules'  => 'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]',
                'errors' => [
                    'uploaded' => 'The profile picture could not be uploaded. Try a smaller file.',
                    'is_image' => 'The profile picture must be an image file.',
                    'mime_in'  => 'The profile picture must be a JPG or PNG.',
                    'max_size' => 'The profile picture must not be larger than 2MB.',
                ],
            ];
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ];

        if ($hasFile) {
            $avatarFolder = FCPATH . 'uploads/avatars/';
            $thumbFolder  = FCPATH . 'uploads/thumbs/';

            // Make sure both folders exist
            if (! is_dir($avatarFolder)) {
                mkdir($avatarFolder, 0777, true);
            }
            if (! is_dir($thumbFolder)) {
                mkdir($thumbFolder, 0777, true);
            }

            // 1. Save the original with a random (safe) file name
            $newName = $file->getRandomName();
            $file->move($avatarFolder, $newName);

            // 2. Make a 150x150 display-ready thumbnail with the same file name
            service('image')
                ->withFile($avatarFolder . $newName)
                ->fit(150, 150, 'center')
                ->save($thumbFolder . $newName);

            // 3. Delete the old avatar files, if there were any
            if (! empty($user['avatar'])) {
                if (file_exists($avatarFolder . $user['avatar'])) {
                    unlink($avatarFolder . $user['avatar']);
                }
                if (file_exists($thumbFolder . $user['avatar'])) {
                    unlink($thumbFolder . $user['avatar']);
                }
            }

            // 4. Only the file NAME goes into the database
            $data['avatar'] = $newName;
        }

        $model->update($id, $data);

        return redirect()->to('/users')->with('success', 'User updated successfully.');
    }
}
