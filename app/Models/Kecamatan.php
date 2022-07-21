<?php

namespace App\Models;

use CodeIgniter\Model;

class Kecamatan extends Model
{
    protected $table            = 'kecamatan';
    protected $primaryKey       = 'id_kecamatan';
    protected $returnType       = 'object';
    protected $allowedFields    = ['keterangan'];
    protected $useTimestamps    = true;
}
