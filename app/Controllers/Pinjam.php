<?php

namespace App\Controllers;

class Pinjam extends BaseController
{

    public function index()
    {
        $pinjam = $this->model->getAllDataArray('VIEW_PEMINJAMAN');
        $data = [
            'title' => 'PEMINJAMAN',
            'crumb1' => 'Transaksi',
            'crumb2' => 'Peminjaman',
            'sidebar' => 4,
            'dataset' => $pinjam,
        ];
        return view('contents/pinjam', $data);
    }

    public function add()
    {
        $dataanggota = $this->model->getAllDataArray('anggota');
        $databuku = $this->model->getAllDataArray('buku');

        $data = [
            'title' => 'TAMBAH PEMINJAMAN',
            'crumb1' => 'Transaksi',
            'crumb2' => 'Peminjaman',
            'back' => true,
            'sidebar' => 4,
            'dataanggota' => $dataanggota,
            'databuku' => $databuku,
            'link_back' => route_to('view_pinjam')
        ];

        return view('contents/add/pinjam', $data);
    }

    public function save()
    {
        $id_rand = strtoupper(random_string('alnum', 8));

        $buku = $this->model->getRowDataArray('buku', ['id_buku' => $this->request->getVar('buku')]);

        if ($buku['stok_buku'] < 1) {
            session()->setFlashData('pesan1', 'stok buku yang anda pilih kosong!');
        } else {
            $data = [
                'id_pinjam' => $id_rand,
                'id_anggota' => $this->request->getVar('anggota'),
                'id_buku' => $this->request->getVar('buku'),
                'id_petugas' => session()->get('data_login')['id_login'],
                'tanggal' => $this->request->getVar('tanggal'),
            ];

            $this->model->insertData('peminjaman', $data);
            $stok = $this->model->getRowDataArray('buku', ['id_buku' => $this->request->getVar('buku')])['stok_buku'];
            $this->model->updateData('buku', 'id_buku', $this->request->getVar('buku'), ['stok_buku' => $stok - 1]);

            session()->setFlashData('pesan', 'Data peminjaman berhasil disimpan');
        }

        return redirect()->to(route_to('view_pinjam'));
    }

    public function delete($id)
    {
        $this->model->deleteData('peminjaman', ['id_pinjam' => $id]);
        session()->setFlashData('pesan', 'Data pinjam berhasil dihapus');
        return redirect()->to(route_to('view_pinjam'));
    }


    public function edit($id)
    {
        $dataanggota = $this->model->getAllDataArray('anggota');
        $databuku = $this->model->getAllDataArray('buku');
        $dataset = $this->model->getDataWhereArray('peminjaman', ['id_pinjam' => $id]);

        $data = [
            'title' => 'UBAH PEMINJAMAN',
            'crumb1' => 'Master Data',
            'crumb2' => 'Peminjaman',
            'back' => true,
            'sidebar' => 4,
            'valid' => $this->validation,
            'link_back' => route_to('view_pinjam'),
            'dataanggota' => $dataanggota,
            'databuku' => $databuku,
            'dataset' => $dataset[0]
        ];
        return view('contents/edit/pinjam', $data);
    }

    public function update()
    {
        $data = [
            'id_anggota' => $this->request->getVar('anggota'),
            'id_buku' => $this->request->getVar('buku'),
            'tanggal' => $this->request->getVar('tanggal'),
        ];

        $this->model->updateData('peminjaman', 'id_pinjam', $this->request->getVar('id'), $data);

        session()->setFlashData('pesan', 'Data peminjaman berhasil diubah');
        return redirect()->to(route_to('view_pinjam'));
    }
}
