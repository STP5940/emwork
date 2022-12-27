<?php
/*
 * Model only for Appbase slim
 * @Makedate 05-07-2019
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class T_Testpractical extends Model
{

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */

  protected $table = "T_Testpractical";
  protected $primaryKey = "Testpractical_id";
  public $timestamps = false;

  protected $fillable = [
    'Testpractical_id', 'Customers_id', 'status'
  ];

  protected static function add($Customers_id, $status)
  {
    $Customerstest                         = T_Testpractical::where('Customers_id', $Customers_id)->get()->first();
    if(@count($Customerstest) <= 0){
      $Testpractical                       =   new T_Testpractical;
      $Testpractical->Customers_id         =   $Customers_id;
      $Testpractical->status               =   $status;
      $Testpractical->save();
    }
  }

}
