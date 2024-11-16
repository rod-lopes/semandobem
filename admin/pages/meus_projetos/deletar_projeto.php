<?php 

require_once('conexao.php');
require_once('verificar-permissao.php');

$id = intval($_GET['id']);

$query_con = $pdo->query("DELETE from projetos WHERE id = '$id'");

die("<script>location.href=\"index.php?m=meus_projetos\";</script>");

 ?>