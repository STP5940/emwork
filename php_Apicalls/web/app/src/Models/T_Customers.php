<?php
/*
 * Model only for Appbase slim
 * @Makedate 05-07-2019
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class T_Customers extends Model
{

  use SoftDeletes;

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */

  protected $table = "T_Customers";
  protected $primaryKey = "Customers_id";

  const CREATED_AT   = 'created_at';
  const UPDATED_AT   = 'updated_at';
  const DELETED_AT   = 'deleted_at';

  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at'
  ];

  protected $fillable = [
    'Customers_id', 'firstname', 'lastname'
  ];

  protected static function Genid()
  {

    $Tmpyear = date("Y") - 2000;

    $Tmpmonth = (date("n") > 9) ? date("n") : "0" . date("n");

    $Tmpday = date("d");

    $Tmpsearch = $Tmpyear . $Tmpmonth . $Tmpday;
    $Genbill  = DB::SELECT("SELECT IFNULL(MAX(CAST(Customers_id as CHAR)), 0) + 1 as Autoid FROM T_Customers WHERE LEFT(Customers_id, 6) = ? ", [$Tmpsearch]);

    if ($Genbill['0']->Autoid > 0) {
      $Sautoid = $Genbill['0']->Autoid;
    } else {
      $Sautoid = "1";
    }

    if ($Sautoid == 1) {
      $Sautoid = $Tmpsearch . "0001";
    } else {
      $Sautoid = $Sautoid;
    }

    return $Sautoid;
  }

  // protected static function addCustomers($Customers_id, $firstname, $lastname)
  // {
  //   $Customers                       =   new T_Customers;
  //   $Customers->Customers_id         =   $Customers_id;
  //   $Customers->created_at           =   date("Y-m-d H:i:s");
  //   $Customers->save();
  // }

}
