<?php
/*
 * Model only for Appbase slim
 * @Makedate 05-07-2019
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class T_Testbody extends Model
{

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */

  protected $table = "T_Testbody";
  protected $primaryKey = "Testbody_id";
  public $timestamps = false;

  protected $fillable = [
    'Testbody_id', 'Customers_id', 'colorblindness', 'farsightedness', 'astigmatism', 'bodyresponse'
  ];

  protected static function add($Customers_id, $colorblindness, $farsightedness, $astigmatism, $bodyresponse)
  {

    $Customerstest                    = T_Testbody::where('Customers_id', $Customers_id)->get()->first();
    if(@count($Customerstest) <= 0){
      $Testbody                       =   new T_Testbody;
      $Testbody->Customers_id         =   $Customers_id;
      $Testbody->colorblindness       =   $colorblindness;
      $Testbody->farsightedness       =   $farsightedness;
      $Testbody->astigmatism          =   $astigmatism;
      $Testbody->bodyresponse         =   $bodyresponse;
      $Testbody->save();
    }
  }

}
