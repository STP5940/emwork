<?php

namespace App\Users;

use App\Models\T_Customers;
use App\Models\T_Testbody;
use App\Models\T_Testpractical;
use App\Models\T_Testtheory;
use App\Controller;
use Illuminate\Database\Capsule\Manager as DB;

use Rakit\Validation\Validator;

use Firebase\JWT\JWT;

class CustomerController extends Controller
{
    /**
     * CustomerController
     */

    public function store($request, $response, $args)
    {
        try {

            $dataAuth = json_decode($this->JWTAuth($request));

            if ($dataAuth->status === true) {

                $firstname         =  get($request, 'firstname');
                $lastname          =  get($request, 'lastname');
        
                // validate data
                $validator = new Validator;
                $validation = $validator->validate(($request->getParsedBody() == [])? ['data_null'=>1]:$request->getParsedBody(), [
                    'firstname'        => 'required|max:200',
                    'lastname'         => 'required|max:200'
                ]);
        
                if ($validation->fails()) {
        
                    $errors = $validation->errors();     
                    foreach ($errors->firstOfAll() as $error) {
                        throw new \Exception($error, 400);
                        exit();
                    }
                }

                $Customers_id                    =   T_Customers::Genid();
                $Customers                       =   new T_Customers;
                $Customers->Customers_id         =   $Customers_id;
                $Customers->firstname            =   $firstname;
                $Customers->lastname             =   $lastname;
                $Customers->created_at           =   date("Y-m-d H:i:s");
                $Customers->save();

                T_Testbody::add($Customers_id, 0, 0, 0, 0);
                T_Testpractical::add($Customers_id, 0);
                T_Testtheory::add($Customers_id, 0, 0, 0);

                @http_response_code(200);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode([
                    'status'     => true,
                    'message'    => 'success',
                    // 'data'     => $SubInventoryallowances
                ], true);
                exit();
            } else {

                @http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode(['JWTAuth' => [
                    'status' => false,
                    'message' => $dataAuth->message,
                ]], true);
                exit();
            }

        } catch (\Exception $e) {

            // Sys_errorlog::insert_log(__FUNCTION__, $e->getCode(), $e->getMessage(), $request);

            @http_response_code($e->getCode());
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                'status' => false,
                'error'  => $e->getMessage(),
            ], true);
            exit();
        }
    }

    public function destroy($request, $response, $args)
    {
        try {

            $dataAuth = json_decode($this->JWTAuth($request));

            if ($dataAuth->status === true) {

                $Customers_id         =  get($request, 'Customers_id');
        
                // validate data
                $validator = new Validator;
                $validation = $validator->validate(($request->getParsedBody() == [])? ['data_null'=>1]:$request->getParsedBody(), [
                    'Customers_id'     => 'required|max:200',
                ]);
        
                if ($validation->fails()) {
        
                    $errors = $validation->errors();     
                    foreach ($errors->firstOfAll() as $error) {
                        throw new \Exception($error, 400);
                        exit();
                    }
                }

                $Customers = T_Customers::find($Customers_id);
                if(@count($Customers) <= 0){
                    @http_response_code(404);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode([
                        'status'     => false,
                        'message'    => 'ไม่พบรายการที่ต้องการลบ หรือรายการถูกลบไปแล้ว',
                    ], true);
                    exit();
                }

                $Customers->delete();

                @http_response_code(200);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode([
                    'status'     => true,
                    'message'    => 'success',
                ], true);
                exit();
            } else {

                @http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode(['JWTAuth' => [
                    'status' => false,
                    'message' => $dataAuth->message,
                ]], true);
                exit();
            }

        } catch (\Exception $e) {

            // Sys_errorlog::insert_log(__FUNCTION__, $e->getCode(), $e->getMessage(), $request);

            @http_response_code($e->getCode());
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                'status' => false,
                'error'  => $e->getMessage(),
            ], true);
            exit();
        }
    }

    
    public function update($request, $response, $args)
    {
        try {

            $dataAuth = json_decode($this->JWTAuth($request));

            if ($dataAuth->status === true) {

                $Customers_id         =  get($request, 'Customers_id');
                $firstname            =  get($request, 'firstname');
                $lastname             =  get($request, 'lastname');
        
                // validate data
                $validator = new Validator;
                $validation = $validator->validate(($request->getParsedBody() == [])? ['data_null'=>1]:$request->getParsedBody(), [
                    'Customers_id'     => 'required|max:200',
                    'firstname'        => 'required|max:200',
                    'lastname'         => 'required|max:200'
                ]);
        
                if ($validation->fails()) {
        
                    $errors = $validation->errors();     
                    foreach ($errors->firstOfAll() as $error) {
                        throw new \Exception($error, 400);
                        exit();
                    }
                }

                $Customers = T_Customers::find($Customers_id);
                if(@count($Customers) <= 0){
                    @http_response_code(404);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode([
                        'status'     => false,
                        'message'    => 'ไม่พบรายการที่ต้องการแก้ไข หรือรายการถูกลบไปแล้ว',
                    ], true);
                    exit();
                }
                
                $Customers->update([
                    'firstname' => $firstname,
                    'lastname'  => $lastname
                ]);

                @http_response_code(200);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode([
                    'status'     => true,
                    'message'    => 'success',
                ], true);
                exit();
            } else {

                @http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode(['JWTAuth' => [
                    'status' => false,
                    'message' => $dataAuth->message,
                ]], true);
                exit();
            }

        } catch (\Exception $e) {

            // Sys_errorlog::insert_log(__FUNCTION__, $e->getCode(), $e->getMessage(), $request);

            @http_response_code($e->getCode());
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                'status' => false,
                'error'  => $e->getMessage(),
            ], true);
            exit();
        }
    }
    
}
