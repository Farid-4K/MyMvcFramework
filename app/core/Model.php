<?php
namespace app\core;

use app\config\Config;
use \RedBeanPHP\R as Db;

/**
 * Модель
 */
abstract class Model extends Db
{
   public $db;
   public function connect()
   {
      $this->db = new Db;
      $db = Config::DB;
      $this->db->setup('mysql:host=' . $db['HOST'] . ';dbname=' . $db['NAME'], $db['USER'], $db['PASSWORD']);
      if (!$this->db->testConnection()) {
         exit('Нет соединения с базой данных');
      }
   }
}
