<?php
namespace app\config;

/**
 * Файл конфигурации
 * Не стирайте комментарии "do_not_erase".
 */
class Config
{
   const ROUTES = [

      '' => [
         'controller' => 'Main',
         'action'     => 'index',
      ],

   ];

   const DB = [
      'HOST'     => 'localhost',
      'NAME'     => 'test',
      'USER'     => 'root',
      'PASSWORD' => '123',
   ];

   const ADMIN = [
      'LOGIN'    => 'admin',
      'PASSWORD' => 'admin',
   ];
}
