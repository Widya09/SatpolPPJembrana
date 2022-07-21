<?php

namespace App\Controllers;

use App\Models\Kecamatan;
use App\Models\PengaduanModel;
use App\Controllers\BaseController;

class Pengaduan extends BaseController
{
    function __construct()
    {
        $this->pengaduan = new PengaduanModel();
        $this->kecamatan = new Kecamatan();
        $this->db      = \Config\Database::connect();
    }
    public function index()
    {
        // cara 1 query builder
        // $builder = $this->db->table('pengaduan');
        // $builder->select('*');
        // $builder->join('kecamatan', 'kecamatan.id_kecamatan = pengaduan.id_pengaduan', 'left');
        // $data['pengaduan']   = $builder->get()->getResult();

        //cara 2 query manual
        // $query = $this->db->query("SELECT * FROM pengaduan");
        // $data['pengaduan'] = $query->getResult();
        $data['pengaduan'] = $this->pengaduan->getAll();

        return view('admin/pengaduan/get', $data);
    }

    public function getDetail($id = null)
    { {
            // $builder = $this->db->table('pengaduan as a ');
            // $builder->select('*');
            // $builder->join('kecamatan as b', 'a.id_kecamatan=b.id_kecamatan');
            // $builder->where('a.id_pengaduan', $id);
            // if( $builder->select('status')==0){
            //     $builder->select('status')=='pending';
            // }else{
            //     $builder->select('status')=='terverifikasi';
            // };                               

            //cara mengambil data dari stdClass : $variable->nama_kolom _pada_table_database
            $data['pengaduan'] = $this->pengaduan->getDetail($id);
            // $data['status'] = $status;
            // if ($row->status == 0) {
            //     $status == 'pending';
            // } else {
            //     $status == 'terverifikasi';
            // }
            return $this->response->setJSON($data);
        }
    }

    public function create()
    {
        $data['kecamatan'] = $this->kecamatan->findAll();
        return view('admin/pengaduan/add', $data);
    }

    public function store()
    {
        // cara 1 kalau namenya sama
        $data = $this->request->getPost();
        $this->pengaduan->insert($data);
        return redirect()->to(site_url('admin/pengaduan'));
    }

    public function edit($id = null)
    {
        $pengaduan = $this->pengaduan->find($id);
        if (is_object($pengaduan)) {
            $data['pengaduan'] = $pengaduan;
            $data['kecamatan'] = $this->kecamatan->findAll();
            return view('admin/pengaduan/edit', $data);
        } else {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();
        $this->pengaduan->update($id, $data);
        // return redirect()->to(site_url('pengaduan'));
    }

    public function delete($id = null)
    {
        $this->pengaduan->delete($id);
        // return $this->response->setJSON;
        return redirect()->to(site_url('admin/pengaduan'));
    }
}
