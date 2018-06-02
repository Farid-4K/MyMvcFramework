<?php
namespace app\models\Admin;

use app\config\Config as Config;
use app\core\Model;

/**
 * Работа с конфигом и структурой фремворка из панели администратора.
 */
class Pages extends Model
{

   /**
    * Выборка данных из конфига
    */
   public function getPages()
   {
      $urls = Config::ROUTES;

      foreach ($urls as $key => $val) {
         $key = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $key);
         $routes[$key] = $val;
      }

      foreach ($routes as $key => $val) {
         $min_key = preg_replace('/\//', '-', $key);
         $original[$key] = $val;
      }

      return $original;
   }

   /**
    * Создание файла контроллера для новой записи в конфиге
    */
   public function createFiles($data)
   {
      if (!empty($data)) {
         $folder = ucfirst($data['controller']);
         $file = ucfirst($data['action'] . 'Controller.php');
         $finalName = ROOT . "/app/controllers/{$folder}/{$file}";
         if (!file_exists($finalName)) {
            if (!mkdir(ROOT . "/app/controllers/{$folder}")) {
               throw new FileSystemException('Ошибка при создании директории, проверьте наличие прав');
            }
            $path_to_template = ROOT . '/app/storage/extensions/default/controller.php';
            $default = file_get_contents($path_to_template);
            $controller = ucfirst($data['action']);
            $action = lcfirst($data['action']);
            $pattern = '/([\W\w]+)(%)([\W\w]+)(%)([\W\w]+)/';
            $finalData = preg_replace($pattern, '$1' . $controller . '$3' . $action . '$5', $default);
            file_put_contents($finalName, $finalData, FILE_APPEND);
            if ($this->newRoute($data)) {
               return true;
            }
         } else {
            $this->error = "Контроллер уже существует, измените имя action.";
         }
      } else {
         throw new LossArgumentException('Нет данных');
      }
   }

   /**
    * Добавление нового Route в конфиг
    */
   public function newRoute($POST)
   {
      $replace = "$1$2
      \"{$POST['url']}\" => [
      \t\"controller\" => \"{$POST['controller']}\",
      \t\"action\" => \"{$POST['action']}\",
      ],
      //do_not_erase";
      $file = ROOT . '/app/config/config.php';
      $pattern = '/(const ROUTES = \[)([\W\w]+)(\/\/do_not_erase)/';
      file_put_contents($file, preg_replace($pattern, $replace, file_get_contents($file)));
      return true;
   }

}

class LossArgumentException extends \Exception
{}
class FileSystemException extends \Exception
{}
