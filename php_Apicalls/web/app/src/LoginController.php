<?php

namespace App;

use App\Controller;
use App\Models\T_Users;
use Illuminate\Database\Capsule\Manager as DB;

use Rakit\Validation\Validator;

use Firebase\JWT\JWT;

class LoginController extends Controller
{
    /**
     * Homepage
     */

    public function checklogin($request, $response, $args)
    {

        try {

            $username         =  get($request, 'username');
            $password         =  get($request, 'password');
    
    
            // validate data
            $validator = new Validator;
            $validation = $validator->validate(($request->getParsedBody() == [])? ['data_null'=>1]:$request->getParsedBody(), [
                'username'        => 'required|max:200',
                'password'        => 'required|max:200'
            ]);
    
            if ($validation->fails()) {
    
                $errors = $validation->errors();     
                foreach ($errors->firstOfAll() as $error) {
                    throw new \Exception($error, 400);
                    exit();
                }
            }
    
            // echo hashstring($password);
            // die();
    
            $datasupportuse   =  T_Users::checklogin($username);
    
            if(! empty($datasupportuse) && validatehash($password, $datasupportuse->password)){
    
                $settings    = $this->container['settings'];
                $now_seconds = time();
    
                $datauseJwt = [
                    'uid'      => @$datasupportuse->Users_id,
                    'fullname' => @$datasupportuse->fullname,
                    'username' => @$datasupportuse->username,
                    'iat'      => $now_seconds
                ];
    
                $token = JWT::encode($datauseJwt, $settings['jwt']['secret'], "HS256");
    
                header('Content-Type: application/json');
                echo json_encode(['JWTAuth' => [
                    'status'  => false,
                    'message' => 'เข้าสู่ระบบสำเร็จ',
                    'token'   => $token,
                    'datause' => $datauseJwt,
                ]], true);
                exit();
            }
    
            header('Content-Type: application/json');
            echo json_encode(['JWTAuth' => [
                'status'  => false,
                'message' => 'ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง'
            ]], true);
            exit();
        } catch (\Exception $e) {

            // Sys_errorlog::insert_log(__FUNCTION__, $e->getCode(), $e->getMessage(), $request);

            @http_response_code(400);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                'status' => false,
                'error'  => $e->getMessage(),
            ], true);
            exit();
        }
    }
    
}
