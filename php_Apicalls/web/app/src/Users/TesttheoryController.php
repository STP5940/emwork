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

class TesttheoryController extends Controller
{
    /**
     * TesttheoryController
     */

    
    public function update($request, $response, $args)
    {
        try {

            $dataAuth = json_decode($this->JWTAuth($request));

            if ($dataAuth->status === true) {

                $Customers_id         =  get($request, 'Customers_id');
                $trafficsign          =  get($request, 'trafficsign');
                $trafficline          =  get($request, 'trafficline');
                $givingway            =  get($request, 'givingway');
        
                // validate data
                $validator = new Validator;
                $validation = $validator->validate(($request->getParsedBody() == [])? ['data_null'=>1]:$request->getParsedBody(), [
                    'Customers_id'     => 'required|max:200',
                    'trafficsign'      => 'numeric|min:0|max:50',
                    'trafficline'      => 'numeric|min:0|max:50',
                    'givingway'        => 'numeric|min:0|max:50',
                ]);
        
                if ($validation->fails()) {
        
                    $errors = $validation->errors();     
                    foreach ($errors->firstOfAll() as $error) {
                        throw new \Exception($error, 400);
                        exit();
                    }
                }

                $Testtheory = T_Testtheory::where('Customers_id', $Customers_id)->get()->first();
                if(@count($Testtheory) <= 0){
                    @http_response_code(200);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode([
                        'status'     => false,
                        'message'    => 'ไม่พบรายการที่ต้องการแก้ไข หรือรายการถูกลบไปแล้ว',
                    ], true);
                    exit();
                }

                $Testtheory->update([
                    'trafficsign'    => (empty($trafficsign) && $trafficsign <> '0' ? @$Testtheory->trafficsign:$trafficsign),
                    'trafficline'    => (empty($trafficline) && $trafficline <> '0' ? @$Testtheory->trafficline:$trafficline),
                    'givingway'       => (empty($givingway) && $givingway <> '0' ? @$Testtheory->givingway:$givingway),
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
