<?php

namespace App\Models;

use CodeIgniter\Model;

class VerifikasiModel extends PengaduanModel
{
    protected $table            = 'pengaduan';
    protected $primaryKey       = 'id_pengaduan';
    protected $returnType       = 'object';
    protected $allowedFields    = ['temuan','tindakan','keterangan','upload_foto'];
    protected $useTimestamps    = true;
}
