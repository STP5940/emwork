<?php
/*
 * Model only for Appbase slim
 * @Makedate 05-07-2019
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class T_Testtheory extends Model
{

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */

  protected $table = "T_Testtheory";
  protected $primaryKey = "Testtheory_id";
  public $timestamps = false;

  protected $fillable = [
    'Testtheory_id', 'Customers_id', 'trafficsign', 'trafficline', 'givingway'
  ];

  protected static function add($Customers_id, $trafficsign, $trafficline, $givingway)
  {
    $Customerstest                    = T_Testtheory::where('Customers_id', $Customers_id)->get()->first();
    if(@count($Customerstest) <= 0){
      $Testbody                       =   new T_Testtheory;
      $Testbody->Customers_id         =   $Customers_id;
      $Testbody->trafficsign          =   $trafficsign;
      $Testbody->trafficline          =   $trafficline;
      $Testbody->givingway            =   $givingway;
      $Testbody->save();
    }
  }

}
