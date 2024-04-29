<?php
namespace App\Helpers;

use Fireabse\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JwtAuth{
    public $key;

    public function __construct(){
        $key = 'ramdon_key_fonesv_2024_04_29';
    }
    public function singup($email, $pass, $getToken = null){
        $user = User::where('email', $email)->first();
        
        
        $singup = false;
        if(is_object($user)){
            $singup = true;
        }

        if($singup){
            $token = array(
                'sub' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'surname' => $user->surname,
                'iat' => time(),
                'exp' => time() + (7 * 24 * 60 * 60)
            );
            $jwt = JWT::encode($token, $this->key, 'HS256');

            if(is_null($getToken)){
                $data = $jwt;
            } else {
                $decoded = JWT::decoded($jwt, $this->key, ['HS256']);
                $data = $decoded;
            }
        } else {
            $data = array (
                'status'=> 'warning',
                'code' => 400,
                'message' => 'Login incorrecto'
            );
        }

        return $data;
    }
}