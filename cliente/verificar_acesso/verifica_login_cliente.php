<?php
// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

// Se não existir a sessão cargo, cria uma com o valor visitante
if (!isset(($_SESSION['cargo']))) {
	$_SESSION['cargo'] = "visitante";
}
// Se a sessão cargo atual for do gerente destrói a sessão 
if ($_SESSION['cargo'] == "gerente" or $_SESSION['cargo'] == "dono") {
	session_destroy();
	header("Refresh:0");
	exit;
}
