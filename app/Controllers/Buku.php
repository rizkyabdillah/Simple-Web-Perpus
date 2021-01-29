<?php

namespace App\Controllers;

class Buku extends BaseController
{

    public function index()
    {
        $buku = $this->model->getAllDataArray('buku');
        $data = [
            'title' => 'BUKU',
            'crumb1' => 'Master Data',
            'crumb2' => 'Buku',
            'sidebar' => 3,
            'dataset' => $buku,
        ];
        return view('contents/buku', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'TAMBAH BUKU',
            'crumb1' => 'Master Data',
            'crumb2' => 'Buku',
            'back' => true,
            'valid' => $this->validation,
            'sidebar' => 3,
            'link_back' => route_to('view_buku')
        ];
        return view('contents/add/buku', $data);
    }

    public function save()
    {

        if (!$this->validate([
            'judul' => [
                'label' => 'Judul buku',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ], 'tahun' => [
                'label' => 'Tahun terbit',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                ]
            ], 'penerbit' => [
                'label' => 'penerbit',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ], 'stok' => [
                'label' => 'Stok',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('valid', $this->validation);
        };

        $id_rand = 'BK' . strtoupper(random_string('alnum', 4));

        $data = [
            'id_buku' => $id_rand,
            'judul_buku' => ucfirst($this->request->getVar('judul')),
            'tahun_terbit' => $this->request->getVar('tahun'),
            'penerbit' => ucfirst($this->request->getVar('penerbit')),
            'stok_buku' => $this->request->getVar('stok')
        ];

        $this->model->insertData('buku', $data);

        session()->setFlashData('pesan', 'Data buku berhasil disimpan');
        return redirect()->to(route_to('view_buku'));
    }

    public function delete($id)
    {
        $this->model->deleteData('buku', ['id_buku' => $id]);
        session()->setFlashData('pesan', 'Data buku berhasil dihapus');
        return redirect()->to(route_to('view_buku'));
    }

    public function edit($id)
    {
        $dataset = $this->model->getDataWhereArray('buku', ['id_buku' => $id]);

        $data = [
            'title' => 'UBAH BUKU',
            'crumb1' => 'Master Data',
            'crumb2' => 'Buku',
            'back' => true,
            'sidebar' => 3,
            'valid' => $this->validation,
            'link_back' => route_to('view_buku'),
            'dataset' => $dataset[0]
        ];
        return view('contents/edit/buku', $data);
    }

    public function update()
    {
        if (!$this->validate([
            'judul' => [
                'label' => 'Judul buku',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ], 'tahun' => [
                'label' => 'Tahun terbit',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                ]
            ], 'penerbit' => [
                'label' => 'penerbit',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ], 'stok' => [
                'label' => 'Stok',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('valid', $this->validation);
        };


        $data = [
            'judul_buku' => ucfirst($this->request->getVar('judul')),
            'tahun_terbit' => $this->request->getVar('tahun'),
            'penerbit' => ucfirst($this->request->getVar('penerbit')),
            'stok_buku' => $this->request->getVar('stok')
        ];

        $this->model->updateData('buku', 'id_buku', $this->request->getVar('id'), $data);

        session()->setFlashData('pesan', 'Data buku berhasil diubah');
        return redirect()->to(route_to('view_buku'));
    }
}
