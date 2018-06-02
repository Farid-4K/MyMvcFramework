<?php
namespace app\models\Admin;

use app\config\Config;
use app\core\Model;

/**
 * Класс Home, вход в панель администратора
 */
class Home extends Model
{

   public function signIn($post)
   {
      if (($post['login'] == Config::ADMIN['LOGIN']) and ($post['password'] == Config::ADMIN['PASSWORD'])) {
         $_SESSION['private'] = true;
         return true;
      }
   }

}
