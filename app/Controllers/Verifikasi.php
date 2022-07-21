<?php

namespace App\Controllers;

use App\Models\Kecamatan;
use App\Models\PengaduanModel;
use App\Controllers\BaseController;
use App\Models\VerifikasiModel;

class Verifikasi extends BaseController
{
    function __construct()
    {
        $this->pengaduan = new PengaduanModel();
        $this->verifikasi = new VerifikasiModel();
        $this->kecamatan = new Kecamatan();
        $this->db      = \Config\Database::connect();
    }

    public function index()
    {
        return view('petugas/home');
    }

    public function tampil()
    {
        $data['pengaduan'] = $this->pengaduan->getAll();
        return view('petugas/verifikasi/getverif', $data);
    }

    public function tambah($id = null)
    {
        $pengaduan = $this->pengaduan->find($id);
        if (is_object($pengaduan)) {
            $data['pengaduan'] = $pengaduan;
            $data['kecamatan'] = $this->kecamatan->findAll();
            return view('petugas/verifikasi/addverif', $data);
        } else {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function terverif($id = null)
    {
        $pengaduan = $this->pengaduan->find($id);
        $data['pengaduan'] = $this->pengaduan->getDetail();
        if ($data == null) {
            // $data = $this->request->getPost();
            // $this->pengaduan->insert($data);
            // $id = $this->request->getPost('id_pengaduan');
            $temuan = $this->request->getPost('temuan');
            $tindakan = $this->request->getPost('tindakan');
            $keterangan = $this->request->getPost('keterangan');
            $upload_foto = $this->request->getPost('upload_foto');
            $this->pengaduan->save_verif($id, $temuan, $tindakan, $keterangan, $upload_foto);
        } else {
            echo "gagal verifikasi";
        }
        // $data['status']==1;

        return redirect()->to(site_url('petugas/verifikasi'));
    }
}
