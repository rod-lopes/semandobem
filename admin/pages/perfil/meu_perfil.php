<?php
@session_start();
require_once('conexao.php');
require_once('verificar-permissao.php');

$id_usuario = $_SESSION['id_usuario'];

  $hoje = date('Y-m-d');
//Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Verificar se o usuário clicou no botão
if (!empty($dados['enviar'])) {
  $nome = $_POST['nome'];
  $cpf = $_POST['cpf'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $senha = $_POST['senha'];
  
  $erro = array();
  if(empty($nome))
    $erro[] = "Preencha o seu Nome.";
  if(empty($cpf))
    $erro[] = "Preencha o número do CPF.";  

  if(empty($email))
    $erro[] = "Preencha o seu email";

  if(empty($senha))
    $erro[] = "Preencha sua senha";


  if(count($erro) == 0) {


    $res2 = $pdo->prepare("UPDATE usuarios  SET nome = :nome, cpf = :cpf, email = :email, senha = :senha WHERE id = '$id'");
    $res2->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
    $res2->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
    $res2->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $res2->bindParam(':senha', $dados['senha'], PDO::PARAM_STR);
    $res2->execute();

    if ($res2->rowCount()) {
     
     die("<script>location.href=\"index.php\";</script>");

   } else {
    $erro[] = "Lançamento nâo cadastrado!"; 
   
  }

}

}
?>

<?php 
	$query2 = $pdo->query("SELECT * from usuarios WHERE id =  '$id_usuario'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$total_reg2 = @count($res2);
	if($total_reg2 > 0){ 
?>


            <div class="col-md-10 offset-md-1 col-lg-12 offset-lg-0">
            <div class="col-12">
                  <?php if(isset($erro) && count($erro) > 0) {
          ?>
          <div class="alert alert-danger text-danger" role="alert">
            <?php foreach($erro as $e) { echo "$e<br>"; } ?>
          </div>                                                    

          <?php
        }
        
        ?>
        </div>

			<div class="col-md-10 offset-md-1 col-lg-12 offset-lg-0">
				<!-- Edit Personal Info -->
				<div class="widget personal-info">
					<h3 class="widget-header user">Editar Perfil</h3>
					<form form action="" method="post" >
						<!-- First Name -->
						<div class="form-group">
						    <label for="first-name">Nome</label>
						    <input type="text" name="nome" value="<?php echo $res2[0]['nome']; ?>" class="form-control" id="first-name">
						</div>						
						<!-- File chooser -->
						<div class="form-group choose-file">
							<i class="fa fa-user text-center"></i>Indisponível
						    <input type="file" class="form-control-file d-inline" id="input-file">
						 </div>
                   
						<!-- Checkbox -->
                        <!--
						<div class="form-check">
						  <label class="form-check-label" for="hide-profile">
						    <input class="form-check-input" type="checkbox" value="" id="hide-profile">
						    Hide Profile from Public/Comunity
						  </label>
						</div>
                        -->
						<!-- Zip Code -->
						<div class="form-group">
						    <label for="zip-code">CPF</label>
						    <input type="text" name="cpf" value="<?php echo $res2[0]['cpf']; ?>" class="form-control" id="zip-code">
						</div>
				</div>
				<!-- Change Password -->
				<div class="widget change-password">
					<h3 class="widget-header user">Editar Senha</h3>
						<!-- Current Password -->
						<div class="form-group">
						    <label for="current-password">Senha</label>
						    <input type="password" name="senha" value="<?php echo $res2[0]['senha']; ?>" class="form-control" id="current-password">
						</div>
				</div>
				<!-- Change Email Address -->
				<div class="widget change-email mb-0">
					<h3 class="widget-header user">Editar Email</h3>
						<!-- Current Password -->
						<div class="form-group">
						    <label for="current-email">Email</label>
						    <input type="email" name="email" value="<?php echo $res2[0]['email']; ?>" class="form-control" id="current-email">
						</div>
                <?php   } ?>
						<!-- Submit Button -->
                        <button type="submit" name="enviar" value="1" class="btn btn-success">Atualizar Perfil</button>
					</form>
				</div>
			</div>