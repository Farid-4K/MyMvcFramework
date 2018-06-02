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

      'documentation' => [
         'controller' => 'Main',
         'action'     => 'doc',
      ],

      'admin' => [
         'controller' => 'Admin',
         'action'     => 'home',
      ],

      'admin/main' => [
         'controller' => 'Admin',
         'action'     => 'main',
      ],

      'admin/main/pages' => [
         'controller' => 'Admin',
         'action'     => 'pages',
      ],
      //do_not_erase

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
