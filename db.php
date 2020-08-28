<?php

// Author : Ender KUŞ

include "Medoo.php";
 use Medoo\Medoo;
// Sentez tarafı bağlantı bilgileri.
$database = new Medoo([
	'database_type' => 'mssql',
	'database_name' => '',
	'server' => '',
	'username' => '',
	'password' => '',
	//Opsiyonel alan açılabilir ama performansı olumsuz etkiler. Sybase bağlantısında kullanmak gereklidir.
	//'driver' => 'dblib'
  //"logging" => true,
]);

// Veritabanı bağlantısını kontrol ediyoruz. Başasız olduğunda hata verecek.
/**if ($database) {
	echo "Bağlantı başarılı";
}**/


// Eliar tarafı bağlantı bilgileri.
$database2 = new Medoo([
	'database_type' => 'mssql',
	'database_name' => '',
	'server' => '',
	'username' => '',
	'password' => '',
	//Opsiyonel alan açılabilir ama performansı olumsuz etkiler. Sybase bağlantısında kullanmak gereklidir.
	//'driver' => 'dblib'
  //"logging" => true,
]);






 ?>
