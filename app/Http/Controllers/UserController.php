<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\JwtAuth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function createdUser(Request $request){
        $request_json = $request->input('json',null);
        $params = json_decode($request_json);
        if(!empty($params)){
            $params_array = json_decode($request_json, true);

            $validate = \Validator::make($params_array, [
                'id' => 'required',
                'name' => 'required|alpha',
                'surname' => 'required|alpha',
                'email' => 'required|email|unique:users',
                'password' => 'required|alpha'
            ]);

            if($validate->fails()){
                $data = array(
                    'status' => 'warning',
                    'code' => 400,
                    'message' => 'Los datos enviados son incorrectos. Verifique la información.',
                    'errors' => $validate->errors()
                );

                return response()->json($data, $data['code']);
            }

            $pass = hash('sha256', $params->password);

            $user = new User();
            $user->id   = $params_array['id'];
            $user->name = $params_array['name'];
            $user->surname = $params_array['surname'];
            $user->password = $pass;
            $user->email = $params_array['email'];

            $user-> save();

            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Usuario creado correctamente.',
                'user' => $user
            );
            return response()->json($data, $data['code']);
        }

        $data = array(
            'status' => 'warning',
            'code' => 400,
            'message' => 'No se enviaron datos en la petición.'
        );
        return response()->json($data, $data['code']);
    }

    public function login(Request $request){
        $jwtAuth = new JwtAuth();
        
        $email = 'test@fonesva.com';
        $password = 'test';
        $pass = hash('sha256', $password);

        return $jwtAuth->singup($email, $pass);
    }
}
