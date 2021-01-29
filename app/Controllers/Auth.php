<?php

namespace App\Controllers;

class Auth extends BaseController
{

    public function index()
    {
        $anggota = $this->model->getAllDataArray('anggota');
        $data = [
            'title' => 'ANGGOTA',
            'crumb1' => 'Master Data',
            'crumb2' => 'Anggota',
            'sidebar' => 2,
            'dataset' => $anggota,
        ];
        return view('contents/anggota', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(route_to('view_login'));
    }

    public function login()
    {
        $data = [
            'valid' => $this->validation
        ];
        return view('contents/login', $data);
    }

    public function auth()
    {

        if (!$this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ], 'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ]
        ])) {
            // dd($this->validation);
            return redirect()->back()->withInput()->with('valid', $this->validation);
        } else {
            $cek_user = $this->model->getRowDataArray('login', ['username' => $this->request->getVar('username')]);
            if ($cek_user) {
                if (password_verify($this->request->getVar('password'), $cek_user['password'])) {
                    session()->set([
                        'is_login' => true,
                        'data_login' => $this->model->getRowDataArray('login', ['id_login' => $cek_user['id_login']])
                    ]);
                    return redirect()->to(route_to('view_anggota'));
                }
            }
            session()->setFlashData('pesan', 'Username atau password anda salah!');
            return redirect()->back();
        };
    }
}
