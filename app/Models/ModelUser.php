<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id_users';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nama', 'username', 'password', 'role'];


    function ceklogin($username, $password)
    {
        $builder = $this->db->table('users');
        $builder->select("*");
        $builder->where("username", $username);
        $builder->get();
        $query = $builder->get()->getRow();
        /**
         * Check password
         */
        if (!empty($user)) {
            if (password_verify($password, $query->password)) {
                return $query->get()->getResult();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}
