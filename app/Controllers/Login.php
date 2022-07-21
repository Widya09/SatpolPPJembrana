<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class Login extends BaseController
{
    function __construct()
    {
        $this->users = new ModelUser();
        $this->db      = \Config\Database::connect();
    }
    public function index()
    {
        return view('login');
    }
    public function ceklogin()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('users')->getWhere(['username' => $post['username']]);
        $user = $query->getRow();
        if ($user) {
            if (password_verify($post['password'], $user->password)) {
                $params = ['id_users' => $user->id_users];
                session()->set($params);
                return view('admin/home');
                // echo "login";
            }
        } else {
            return $this->response->setJSON->setStatusCode(400);
           
        }
    }
}
