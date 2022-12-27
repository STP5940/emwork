<?php

use eftec\bladeone\BladeOne;

$container = $app->getContainer();
$settings = $container->get('settings')['renderer'];

define('views', $settings['template_path']);
define('cache', $settings['cache']);
define('currenturl', $_SERVER['REQUEST_URI']);


/*
|--------------------------------------------------------------------------
| Link to CSS or Javascript or image
|--------------------------------------------------------------------------
*/
if (!function_exists('asset')) {
    function asset($File)
    {
        return '/'.$File.'?v='.date("YmdHis");
    }
}

/*
|--------------------------------------------------------------------------
| Link to Base URL
|--------------------------------------------------------------------------
*/
if (!function_exists('base_url')) {
  function base_url()
  {
    // server protocol
    $protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';

    // domain name
    $domain = $_SERVER['SERVER_NAME'];

    // server port
    $port = $_SERVER['SERVER_PORT'];
    $disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";

    // put em all together to get the complete base URL
    $url = "${protocol}://${domain}${disp_port}";
    return $url;
  }
}


/*
|--------------------------------------------------------------------------
| repage to view
|--------------------------------------------------------------------------
*/
if (!function_exists('view')){
    function view($Bladefile, $ArrayValue = array())
    {
      $blade = new BladeOne(views,cache,BladeOne::MODE_AUTO);
      echo @$blade->run($Bladefile,$ArrayValue); // /views/hello.blade.php must exist
    }
}

/*
|--------------------------------------------------------------------------
| repage function get();
|--------------------------------------------------------------------------
*/
if (!function_exists('get')) {
    function get($request, $parameter)
    {
      $data = (isset($request->getParsedBody()[$parameter])? $request->getParsedBody()[$parameter] : "");

      return $data;
    }
}

/*
|--------------------------------------------------------------------------
| hash string
|--------------------------------------------------------------------------
*/
if (!function_exists('hashstring')) {
    function hashstring($String)
    {
      $Secukey = 'A++$#%fsad$6546V&^%&^dfg*&(*gffdg646)*(*&^Ddfgfd%$^#^4654%fdgDfdHfdgg$&%^^&&*sdfSKsd*())';
      $options = [
          'cost' => 13,
          'Salt' => $Secukey,
      ];

      return password_hash($String, PASSWORD_BCRYPT, $options);
    }
}

/*
|--------------------------------------------------------------------------
| validatehash hash
|--------------------------------------------------------------------------
*/
if (!function_exists('validatehash')) {
    function validatehash($string, $hash)
    {
      return password_verify($string."", $hash);
    }
}

/*
|--------------------------------------------------------------------------
| set list route to array
|--------------------------------------------------------------------------
*/
if (!function_exists('setroute')) {
    function setroute($routes, $nameget)
    {
      foreach ($routes as $route) {
        $getroute[$route->getName()] = $route->getPattern();
      }
      define($nameget, $getroute);
    }
}

/*
|--------------------------------------------------------------------------
| Authen failed 403 page
|--------------------------------------------------------------------------
*/
if (!function_exists('abort403')) {
  function abort403($dataauthen)
  {
      
      if (count($dataauthen) == 0) {
        echo '<!DOCTYPE html>
          <html lang="id" dir="ltr">
          
          <head>
               <meta charset="utf-8" />
               <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
               <meta name="description" content="" />
               <meta name="author" content="" />
          
               <!-- Title -->
               <title>ขออภัย ไม่สามารถเข้าถึงหน้านี้ได้</title>
               <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
               <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous" />
          </head>
          
          <body class="bg-dark text-white py-5">
               <div class="container py-5">
                    <div class="row">
                         <div class="col-md-2 text-center">
                              <p><i class="fa fa-exclamation-triangle fa-5x"></i><br/>Status Code: 403</p>
                         </div>
                         <div class="col-md-10">
                              <h3>อุ๊ย ! เกิดข้อผิดพลาด...</h3>
                              <p>ขออภัย การเข้าถึงของคุณถูกปฏิเสธเนื่องจากเหตุผลด้านความปลอดภัย และเป็นข้อมูลที่ละเอียดอ่อนของเรา <br/> โปรดย้อนกลับไป เพื่อเรียกดูต่อไป</p>
                              <a class="btn btn-danger" href="javascript:history.back()">ย้อนกลับ</a>
                         </div>
                    </div>
               </div>
          </body>
          
          </html>';
          die();
      }

    }
  }