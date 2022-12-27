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

class TestbodyController extends Controller
{
    /**
     * TestbodyController
     */

    
    public function update($request, $response, $args)
    {
        try {

            $dataAuth = json_decode($this->JWTAuth($request));

            if ($dataAuth->status === true) {

                $Customers_id         =  get($request, 'Customers_id');
                $colorblindness       =  get($request, 'colorblindness');
                $farsightedness       =  get($request, 'farsightedness');
                $astigmatism          =  get($request, 'astigmatism');
                $bodyresponse         =  get($request, 'bodyresponse');
        
                // validate data
                $validator = new Validator;
                $validation = $validator->validate(($request->getParsedBody() == [])? ['data_null'=>1]:$request->getParsedBody(), [
                    'Customers_id'     => 'required|max:200',
                    'colorblindness'   => 'in:1,2',
                    'farsightedness'   => 'in:1,2',
                    'astigmatism'      => 'in:1,2',
                    'bodyresponse'     => 'in:1,2',
                ]);
        
                if ($validation->fails()) {
        
                    $errors = $validation->errors();     
                    foreach ($errors->firstOfAll() as $error) {
                        throw new \Exception($error, 400);
                        exit();
                    }
                }

                $Testbody = T_Testbody::where('Customers_id', $Customers_id)->get()->first();
                if(@count($Testbody) <= 0){
                    @http_response_code(200);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode([
                        'status'     => false,
                        'message'    => 'ไม่พบรายการที่ต้องการแก้ไข หรือรายการถูกลบไปแล้ว',
                    ], true);
                    exit();
                }

                $Testbody->update([
                    'colorblindness'    => (empty($colorblindness) ? @$Testbody->colorblindness:$colorblindness),
                    'farsightedness'    => (empty($farsightedness) ? @$Testbody->farsightedness:$farsightedness),
                    'astigmatism'       => (empty($astigmatism) ? @$Testbody->astigmatism:$astigmatism),
                    'bodyresponse'      => (empty($bodyresponse) ? @$Testbody->bodyresponse:$bodyresponse),
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
