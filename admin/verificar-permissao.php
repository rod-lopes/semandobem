<?php 

//VERIFICAR PERMISSÃO DO USUÁRIO
if(@$_SESSION['nivel_usuario'] != 'Administrador'){
	echo "<script language='javascript'>window.location='login.php'</script>";
}
 ?>