<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use Codeigniter\RESTful\ResourceController;
use \Firebase\JWT\JWT;
class Login extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $userModel = new UserModel();
        $email  = $this->request->getVar('email');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        //buat rules
       //cek username
        $users = $userModel->where('username', $username)->orWhere('email', $email)->first();
        if(!$users){
            $res = [
                'status'=>401,
                'msg'=>'Username atau email tidak terdaftar',
            ];
        }
        //cek password
        $pass_very = password_verify('password', $users['password']);
        if(!$pass_very){
            $res = [
                'status'=>401,
                'msg'=>'Password Salah...!',
            ];
        }
        //jika benar    
        $res = [
            'status'=>200,
            'msg'=>'Anda Berhasil Login, silahkan pergi kemenu',
        ];     
              
    
        
        return $this->respond($res);
        
    }
}