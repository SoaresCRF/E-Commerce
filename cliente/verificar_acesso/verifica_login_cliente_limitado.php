<?php
// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

// Se a sessão cargo atual não for do cliente volta para página anterior 
if ($_SESSION['cargo'] != "cliente") {
	session_destroy();
	header("Location: ../cliente/todos_produtos.php");
	exit;
}
