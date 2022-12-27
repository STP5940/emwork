<?php
/*
 * Model only for Appbase slim
 * @Makedate 05-07-2019
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class T_Users extends Model
{

  // use SoftDeletes;

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */

  protected $table = "T_Users";
  protected $primaryKey = "Users_id";

  // const CREATED_AT   = 'created_at';
  // const UPDATED_AT   = 'updated_at';
  // const DELETED_AT   = 'deleted_at';

  // protected $dates = [
  //   'created_at',
  //   'updated_at',
  //   'deleted_at'
  // ];

  protected $fillable = [
    'Users_id', 'fullname', 'username', 'password'
  ];

  protected static function Genid()
  {

    $Tmpyear = date("Y") - 2000;

    $Tmpmonth = (date("n") > 9) ? date("n") : "0" . date("n");

    $Tmpday = date("d");

    $Tmpsearch = $Tmpyear . $Tmpmonth . $Tmpday;
    $Genbill  = DB::SELECT("SELECT IFNULL(MAX(CAST(Users_id as CHAR)), 0) + 1 as Autoid FROM T_Users WHERE LEFT(Users_id, 6) = ? ", [$Tmpsearch]);

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

  protected static function checklogin($username)
  {
    return T_Users::where('username', $username)
      ->get(['T_Users.Users_id', 'T_Users.fullname', 'T_Users.username', 'T_Users.password'])
      ->first();
  }

}
