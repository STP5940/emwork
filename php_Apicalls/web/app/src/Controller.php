<?php

namespace App;

/**
 * Basic controller
 */
use App\Models\T_Users;
use Firebase\JWT\JWT;
use Psr\Container\ContainerInterface;
use Illuminate\Database\Capsule\Manager as DB;

class Controller
{

    public $csrf;
    public $container;
    public $csrf_nameKey;
    public $csrf_valueKey;
    public $csrf_name;
    public $csrf_value;
    public static $secret;
    public static $publickey;
    public static $linenotifyDepositkey;
    public static $linenotifyWithdrawkey;
    public static $linenotifyBank;
    public static $nameWebsite;
    public static $urlupperWebsite;
    public static $urllowerWebsite;

    public function __construct(ContainerInterface $container)
    {
        self::$publickey = $container['settings']['google_recaptcha']['public'];
        self::$secret = $container['settings']['google_recaptcha']['secret'];

        self::$linenotifyDepositkey = $container['settings']['line_notify']['depositkey'];
        self::$linenotifyWithdrawkey = $container['settings']['line_notify']['withdrawkey'];
        self::$linenotifyBank = $container['settings']['line_notify']['bank'];
        self::$nameWebsite = $container['settings']['name_website']['title'];
        self::$urlupperWebsite = $container['settings']['name_website']['urlupper'];
        self::$urllowerWebsite = $container['settings']['name_website']['urllower'];

        $this->csrf = $container['csrf'];
        $this->csrf->validateStorage();
        $this->container = $container;

        $this->csrf_nameKey = $this->csrf->getTokenNameKey();
        $this->csrf_valueKey = $this->csrf->getTokenValueKey();
        $this->csrf_name = $this->csrf->getTokenName();
        $this->csrf_value = $this->csrf->getTokenvalue();

        define('csrf_name', $this->csrf_name);
        define('csrf_value', $this->csrf_value);
        define('csrf', "<input type='hidden' name='$this->csrf_nameKey' id='$this->csrf_nameKey' value='$this->csrf_name'>
         <input type='hidden' name='$this->csrf_valueKey' id='$this->csrf_valueKey' value='$this->csrf_value'>");

        define('NAME_WEBSITE', self::$nameWebsite);
        define('URLUPPER_WEBSITE', self::$urlupperWebsite);
        define('URLLOWER_WEBSITE', self::$urllowerWebsite);

        DB::disconnect($this->container['settings']['db']['database']);
    }

    function __destruct()
    {
        DB::disconnect(DB_DATABASE);
    }

    public function render($response, $PageName, $ArrayValue = [])
    {
        return $this->container->get('renderer')->render($response, $PageName, $ArrayValue);
    }

    protected function json($json = array(), $return = true, $exit = 1)
    {
        if (!$return && !headers_sent()) {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode($json);
            $exit && exit(); //enhance Slim performance
        } else {
            return json_encode($json);
        }
    }

    protected function JWTAuth($request)
    {
        try {
            $settings = $this->container['settings']; // get settings array.
            $authorization_header  = $request->getHeader("authorization");
            $header_token          = str_replace("Bearer ", "", @$authorization_header['0']);
            $JWTdecoded            = JWT::decode($header_token, $settings['jwt']['secret'], array('HS256'));
            $statusUid              = T_Users::where('Users_id', $JWTdecoded->uid)->get()->count();

            if ($statusUid == 0) {
                header('Content-Type: application/json');
                return json_encode([
                    'status' => false,
                    'message' => 'ตรวจสอบตัวตนไม่สำเร็จ token นี้ถูกทำลายแล้ว',
                ], true);
                exit();
            }

            header('Content-Type: application/json');
            return json_encode([
                'status' => true,
                'token' => @$authorization_header['0'],
                'message' => 'เข้าสู่ระบบสำเร็จ',
                'datause' => $JWTdecoded,
            ], true);
            exit();
        } catch (\Exception $e) {

            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
                'message' => 'ตรวจสอบตัวตนไม่สำเร็จ โปรดเข้าสู่ระบบใหม่อีกครั้ง',
            ], true);
            exit();
        }
    }


    protected function HTMLRecaptcha()
    {
        return "<div class='g-recaptcha' data-theme='light' data-sitekey='" . self::$publickey . "'></div>
      <script src='https://www.google.com/recaptcha/api.js?hl=th' async defer></script>";
    }

    protected function Recaptcha($Recaptcha)
    {
        $recaptcha = new \ReCaptcha\ReCaptcha(self::$secret);
        $resp = $recaptcha->verify($Recaptcha, $_SERVER['REMOTE_ADDR']);
        if ($resp->isSuccess()) {

            return true; //ถ้า captcha ถูกต้องทำต่อตรงนี้
        } else if (!is_null($Recaptcha)) {

            return false; //ถ้า captcha ถูกไม่ต้องทำต่อตรงนี้

        }
    }
}
