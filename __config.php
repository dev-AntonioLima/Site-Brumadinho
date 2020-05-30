<?php

header("Content-type: text/html; charset=utf-8");

if($_SERVER['SERVER_NAME'] == 'localhost'):
	
$myServidor = "localhost"; 
$myUsuario = "root"; 
$mySenha = ""; 
$myBanco = "brumadinhoajuda"; 
$myServidor = ""; 
$myUsuario = "";
$mySenha = "";
$myBanco = "";
endif;

$conn = new mysqli($myServidor, $myUsuario, $mySenha, $myBanco);

if ($conn->connect_error)
 die("Falha na conexão com o DB: " . $conn->connect_error);

$conn->query("SET NAMES 'utf8'");
$conn->query('SET character_set_connection=utf8');
$conn->query('SET character_set_client=utf8');
$conn->query('SET character_set_results=utf8');
$conn->query("SET GLOBAL lc_time_names=pt_BR");
$conn->query("SET lc_time_names = 'pt_BR'");
?> 