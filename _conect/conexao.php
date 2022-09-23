<?php
define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', 'jklmb4546FPS$');
define('DB', 'mercadinho');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die('Não foi possível conectar');
