<?php

namespace App\Controllers;

class Petugas extends BaseController
{

    public function index()
    {
        $petugas = $this->model->getAllDataArray('VIEW_PETUGAS');
        $data = [
            'title' => 'PETUGAS',
            'crumb1' => 'Master Data',
            'crumb2' => 'Petugas',
            'sidebar' => 1,
            'dataset' => $petugas,
        ];
        return view('contents/petugas', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'TAMBAH PETUGAS',
            'crumb1' => 'Master Data',
            'crumb2' => 'Petugas',
            'back' => true,
            'valid' => $this->validation,
            'sidebar' => 1,
            'link_back' => route_to('view_petugas')
        ];
        return view('contents/add/petugas', $data);
    }


    public function save()
    {

        if (!$this->validate([
            'nama_petugas' => [
                'label' => 'Nama petugas',
                'rules' => 'required|alpha',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'alpha' => '{field} tidak boleh mengandung angka'
                ]
            ], 'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[login.username]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah tersedia'
                ]
            ], 'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} harus 8 karakter'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('valid', $this->validation);
        };


        // SAVE DATA TO USER
        $id_rand = strtoupper(random_string('alnum', 4));

        $data = [
            'id_petugas' => $id_rand,
            'nama_petugas' => ucfirst($this->request->getVar('nama_petugas'))
        ];

        $this->model->insertData('petugas', $data);

        $data = [
            'id_login' => $id_rand,
            'username' => strtolower($this->request->getVar('nama_petugas')),
            'password' => password_hash(strtolower($this->request->getVar('nama_petugas')), PASSWORD_BCRYPT),
            'level' => 'PETUGAS'
        ];

        $this->model->insertData('login', $data);

        session()->setFlashData('pesan', 'Data petugas berhasil disimpan');
        return redirect()->to(route_to('view_petugas'));
    }


    public function delete($id)
    {
        $this->model->deleteData('login', ['id_login' => $id]);
        $this->model->deleteData('petugas', ['id_petugas' => $id]);
        session()->setFlashData('pesan', 'Data petugas berhasil dihapus');
        return redirect()->to(route_to('view_petugas'));
    }


    public function edit($id)
    {
        $dataset = $this->model->getDataWhereArray('VIEW_PETUGAS', ['id_petugas' => $id]);

        $data = [
            'title' => 'UBAH PETUGAS',
            'crumb1' => 'Master Data',
            'crumb2' => 'Petugas',
            'back' => true,
            'sidebar' => 1,
            'valid' => $this->validation,
            'link_back' => route_to('view_petugas'),
            'dataset' => $dataset[0]
        ];
        return view('contents/edit/petugas', $data);
    }


    public function update()
    {
        if (!$this->validate([
            'nama_petugas' => [
                'label' => 'Nama petugas',
                'rules' => 'required|alpha',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'alpha' => '{field} tidak boleh mengandung angka'
                ]
            ], 'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[login.username,id_login,' . $this->request->getVar('id') . ']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah tersedia'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('valid', $this->validation);
        };


        $data = [
            'nama_petugas' => ucfirst($this->request->getVar('nama_petugas'))
        ];

        $this->model->updateData('petugas', 'id_petugas', $this->request->getVar('id'), $data);



        $data = [
            'username' => strtolower($this->request->getVar('username'))
        ];


        if ($this->request->getVar('password') != null) {
            $data += array('password' => password_hash(strtolower($this->request->getVar('password')), PASSWORD_BCRYPT));
        }

        $this->model->updateData('login', 'id_login', $this->request->getVar('id'), $data);

        session()->setFlashData('pesan', 'Data petugas berhasil diubah');
        return redirect()->to(route_to('view_petugas'));
    }
}
