<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JenisAduan extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_jenis'=>1,
                'keterangan'=>'Pengamanan'

            ],
            [
                'id_jenis'=>2,
                'keterangan'=>'Penanganan ODGJ'

            ],
            [
                'id_jenis'=>3,
                'keterangan'=>'Penanganan Orang Terlantar'

            ],
            [
                'id_jenis'=>4,
                'keterangan'=>'Patroli'

            ],
        ];
        $this->db->table('jenis_aduan')->insertBatch($data);
    }
}
