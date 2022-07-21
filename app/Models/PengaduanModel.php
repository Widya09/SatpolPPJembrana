<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{

    protected $table            = 'pengaduan';
    protected $primaryKey       = 'id_pengaduan';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama', 'nik', 'nomor_hp', 'jenis_aduan', 'sasaran', 'waktu', 'tgl_pengaduan', 'lokasi', 'id_kecamatan', 'temuan', 'tindakan', 'keterangan', 'upload_foto'];
    protected $useTimestamps    = true;

    function getAll()
    {
        $builder = $this->db->table('pengaduan');
        $builder->join('kecamatan', 'kecamatan.id_kecamatan = pengaduan.id_kecamatan', 'left');
        $query = $builder->get();
        return $query->getResult();
    }

    function getDetail($id = null)
    {
        $builder = $this->db->table('pengaduan as a ');
        $builder->select('*');

        $builder->join('kecamatan as b', 'a.id_kecamatan=b.id_kecamatan');
        $builder->where('a.id_pengaduan', $id);
        // $builder-> where('status');
        //  if( $builder->select('status')->where('status')==0){
        //     $builder->select('*')->where('status')=='pending';
        // }else{
        //     $builder->select('*')->where('status')=='terverifikasi';
        // };
        $query = $builder->get();
        return $query->getRow(); //kalau data yang diambil itu cuman 1 row
        // return $query->getResult(); //kalau data yang diambil itu multiple row contoh ambil semua data atau beberapa data ( data > 1)
    }
    function save_verif($id,$temuan, $tindakan, $keterangan, $upload_foto)
    {
        $builder = $this->db->table('pengaduan');
        $builder->select('id_pengaduan');
        $data = [
            // 'id_pengaduan'=>$id,
            'temuan' => $temuan,
            'tindakan' => $tindakan,
            'keterangan' => $keterangan,
            'upload_foto' => $upload_foto

        ];
        $builder->insert($data);
        $query = $builder->getWhere(['id_pengaduan'=>$id],$temuan,$tindakan,$keterangan,$upload_foto);
        return $query->getRow();
    }
}
