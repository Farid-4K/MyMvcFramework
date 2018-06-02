<?php
namespace app\models\Admin;

use app\core\Model;

/**
 * Модель Index контроллера Main
 */
class Main extends Model
{

   public function adminExit()
   {
      unset($_SESSION['private']);
      return true;
   }

}
