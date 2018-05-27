<?php
     class db{
         private $host = 'localhost';
         private $usuario = 'id5798447_api_ing_soft';
         private $password = '12345678';
         private $base = 'id5798447_api_ing_soft';


         //conectar BD
         public function conectar(){
             $conexion_mysql = "mysql:host=$this->host;dbname=$this->base";
             $conexionBD = new PDO($conexion_mysql, $this->usuario, $this->password);
             $conexionBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


         // esta line arregla la codificacion de la BD por si no se cargan bien los datos
         //utf_8
         $conexionBD -> exec("set names utf8");

         return $conexionBD;




         }
     }



?>