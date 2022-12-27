<?php
namespace App;

use Phpfastcache\CacheManager;
use Phpfastcache\Config\ConfigurationOption;
/**
 *
 */
class Caching
{

  function Set($keyword, $data = array(), $time){

            $path = '/var/www/cache';

            // $time = minutes
            // Setup File Path on your config files
            // Please note that as of the V6.1 the "path" config
            // can also be used for Unix sockets (Redis, Memcache, etc)
            if(!is_dir($path) && !file_exists($path)){
              $oldmask = umask(0);
              mkdir($path, 0777, true);
              umask($oldmask);
            }

            CacheManager::setDefaultConfig(new ConfigurationOption([
                'path' => $path, // or in windows "C:/tmp/"
            ]));


            // In your class, function, you can call the Cache
            @$InstanceCache = CacheManager::getInstance('files');

            /**
             * Try to get $products from Caching First
             * product_page is "identity keyword";
             */
            $key = $keyword;
            $CachedString = $InstanceCache->getItem($key);
            // echo "<pre>";
            // var_dump($data[0]);
            // echo "<pre>";
            $your_product_data = $data;

            if (!$CachedString->isHit()) {
                $CachedString->set($your_product_data)->expiresAfter($time);//in seconds, also accepts Datetime
            	$InstanceCache->save($CachedString); // Save the cache item just like you do with doctrine and entities

                /**
                  * FIRST LOAD // WROTE OBJECT TO CACHE // RELOAD THE PAGE AND SEE //
                  */

                return $CachedString->get();
                exit();

            } else {

                /**
                  * READ FROM CACHE //
                  */

                // echo "Data Cache";

                return $CachedString->get();
                exit();
            }

            /**
             * use your products here or return them;
             */
            // echo "<br>";
            // echo implode('<br>', $CachedString->get());// Will echo your product list

  }

  function Get($keyword){

          $path = '/var/www/cache';

          if(!is_dir($path) && !file_exists($path)){
            $oldmask = umask(0);
            mkdir($path, 0777, true);
            umask($oldmask);
          }

          CacheManager::setDefaultConfig(new ConfigurationOption([
              'path' => $path,
          ]));

          @$InstanceCache = CacheManager::getInstance('files');

          $key = $keyword;
          $CachedString = $InstanceCache->getItem($key);

          if (!$CachedString->isHit()) {
            return [];
            exit();
          } else {
            return $CachedString->get();
            exit();
          }
  }
}
