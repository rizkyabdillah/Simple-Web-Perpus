<?php

namespace App\Controllers;

class Anggota extends BaseController
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

    public function add()
    {
        $data = [
            'title' => 'TAMBAH ANGGOTA',
            'crumb1' => 'Master Data',
            'crumb2' => 'Anggota',
            'back' => true,
            'valid' => $this->validation,
            'sidebar' => 2,
            'link_back' => route_to('view_anggota')
        ];
        return view('contents/add/anggota', $data);
    }

    public function save()
    {

        if (!$this->validate([
            'nama' => [
                'label' => 'Nama anggota',
                'rules' => 'required|alpha',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'alpha' => '{field} tidak boleh mengandung angka'
                ]
            ], 'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('valid', $this->validation);
        };

        $id_rand = strtoupper(random_string('alnum', 4));

        $data = [
            'id_anggota' => $id_rand,
            'nama' => ucfirst($this->request->getVar('nama')),
            'alamat' => ucfirst($this->request->getVar('alamat'))
        ];

        $this->model->insertData('anggota', $data);

        session()->setFlashData('pesan', 'Data anggota berhasil disimpan');
        return redirect()->to(route_to('view_anggota'));
    }

    public function delete($id)
    {
        $this->model->deleteData('anggota', ['id_anggota' => $id]);
        session()->setFlashData('pesan', 'Data anggota berhasil dihapus');
        return redirect()->to(route_to('view_anggota'));
    }

    public function edit($id)
    {
        $dataset = $this->model->getDataWhereArray('anggota', ['id_anggota' => $id]);

        $data = [
            'title' => 'UBAH ANGGOTA',
            'crumb1' => 'Master Data',
            'crumb2' => 'Petugas',
            'back' => true,
            'sidebar' => 2,
            'valid' => $this->validation,
            'link_back' => route_to('view_anggota'),
            'dataset' => $dataset[0]
        ];
        return view('contents/edit/anggota', $data);
    }

    public function update()
    {
        if (!$this->validate([
            'nama' => [
                'label' => 'Nama anggota',
                'rules' => 'required|alpha',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'alpha' => '{field} tidak boleh mengandung angka'
                ]
            ], 'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('valid', $this->validation);
        };


        $data = [
            'nama' => ucfirst($this->request->getVar('nama')),
            'alamat' => ucfirst($this->request->getVar('alamat')),
        ];

        $this->model->updateData('anggota', 'id_anggota', $this->request->getVar('id'), $data);

        session()->setFlashData('pesan', 'Data anggota berhasil diubah');
        return redirect()->to(route_to('view_anggota'));
    }
}
