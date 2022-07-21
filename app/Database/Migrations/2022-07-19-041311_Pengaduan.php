<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengaduan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengaduan'          => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'nik'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'nomor_hp' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'jenis_aduan' => [
                'type'  => 'ENUM',
                'constraint' => ['Patroli', 'Pengamanan', 'Penanganan Orang Terlantar', 'Penanganan ODGJ'],
                'null' => true,
            ],
            'sasaran' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'waktu' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'tgl_pengaduan' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'lokasi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'id_kecamatan'          => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'null' => true,
            ],
            'status' => [
                'type'  => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'temuan'       => [
                'type'       => 'TEXT',
                'null' => true,

            ],
            'tindakan'       => [
                'type'       => 'TEXT',
                'null' => true,

            ],
            'keterangan' => [
                'type' => 'TEXT',
                'constraint' => null,
                'null' => true,
            ],
            'upload_foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);
        $this->forge->addKey('id_pengaduan', true);
        $this->forge->addForeignKey('id_kecamatan', 'kecamatan', 'id_kecamatan');
        $this->forge->createTable('pengaduan');
    }

    public function down()
    {
        $this->forge->dropTable('pengaduan');
    }
}
