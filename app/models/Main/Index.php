<?php
namespace app\models\main;

use app\core\Model;

/**
 * Модель Index контроллера Main
 */
class Index extends Model
{
   public function __construct()
   {
      $this->connect();
   }
}
