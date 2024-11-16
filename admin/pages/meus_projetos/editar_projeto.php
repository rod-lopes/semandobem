<?php
@session_start();
require_once('conexao.php');
require_once('verificar-permissao.php');

$id = intval($_GET['id']);
$id_usuario = $_SESSION['id_usuario'];

  $hoje = date('Y-m-d');
//Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Verificar se o usuário clicou no botão
if (!empty($dados['enviar'])) {
  $nome = $_POST['nome'];
  $descricao_curta = $_POST['descricao_curta'];
  $descricao = $_POST['descricao'];
  $categoria = $_POST['categoria'];
  $telefone = $_POST['telefone'];
  $cidade = $_POST['cidade'];
  $uf = $_POST['uf'];
  $data_lancamento = $hoje;
  $email_site = $_POST['email_site'];
  $id_user = $id;

  
  $erro = array();
  if(empty($nome))
    $erro[] = "Preencha o nome do seu projeto.";
  if(empty($descricao_curta))
    $erro[] = "Preencha a descrição curta do seu projeto.";  

  if(empty($descricao))
    $erro[] = "Preencha a descrição do seu projeto";

  if(empty($categoria))
    $erro[] = "Preencha uma categoria";
    
    if(empty($telefone))
    $erro[] = "Insira o telefone de seu projeto.";

    if(empty($cidade))
    $erro[] = "Insira a cidade de seu projeto.";

    if(empty($uf))
    $erro[] = "Insira o Estado de seu projeto.";

    if(empty($email_site))
    $erro[] = "Insira um email ou site de seu projeto.";


  if(count($erro) == 0) {


    $res2 = $pdo->prepare("UPDATE projetos SET nome = :nome, descricao_curta = :descricao_curta, descricao = :descricao, cod_categoria = :categoria, telefone = :telefone, cidade = :cidade, uf = :uf, email_site = :email_site WHERE id = '$id'");
    $res2->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
    $res2->bindParam(':descricao_curta', $dados['descricao_curta'], PDO::PARAM_STR);
    $res2->bindParam(':descricao', $dados['descricao'], PDO::PARAM_STR);
    $res2->bindParam(':categoria', $dados['categoria'], PDO::PARAM_STR);
    $res2->bindParam(':telefone', $dados['telefone'], PDO::PARAM_STR);
    $res2->bindParam(':cidade', $dados['cidade'], PDO::PARAM_STR);
    $res2->bindParam(':uf', $dados['uf'], PDO::PARAM_STR);
    $res2->bindParam(':email_site', $dados['email_site'], PDO::PARAM_STR);
    $res2->execute();

    if ($res2->rowCount()) {
     
     die("<script>location.href=\"index.php?m=meus_projetos\";</script>");

   } else {
    $erro[] = "Lançamento nâo cadastrado!"; 
   
  }

}

}
?>

<?php 
	$query2 = $pdo->query("SELECT * from projetos WHERE id = '$id' AND id_user =  '$id_usuario'");
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
				<!-- Edit Personal Info -->
				<div class="widget personal-info">
					<h3 class="widget-header user">Editar seu Projeto</h3>
					<form form action="" method="post" >
						<!-- First Name -->
						<div class="form-group">
						    <label for="first-name">Nome do Projeto</label>
						    <input type="text" name="nome" value="<?php echo $res2[0]['nome']; ?>" class="form-control" id="first-name">
						</div>						
				</div>

                <div class="widget personal-info">
					<h3 class="widget-header user">Imagem do Projeto</h3>					
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
				</div>
				<!-- Change Password -->
				<div class="widget change-password">
					<h3 class="widget-header user">Descrição do seu projeto</h3>
						<!-- Current Password -->
						<div class="form-group">
						    <label for="current-password">Descrição Curta</label>
						    <input type="text" name="descricao_curta" value="<?php echo $res2[0]['descricao_curta']; ?>" class="form-control" id="current-password">
						</div>
						<!-- New Password -->
						<div class="form-group">
						    <label for="new-password">Descrição de seu projeto.</label>
						    <textarea class="form-control" name="descricao" id="story" rows="4"><?php echo $res2[0]['descricao']; ?></textarea>
						</div>
				</div>

				<div class="widget personal-info">
					<h3 class="widget-header user">Selecione a Categoria de seu projeto</h3>
						<!-- First Name -->
						<div class="form-group">
						    <label for="first-name">Categoria</label>
						    <select name="categoria" class="form-control">
                            <?php 
                            $query = $pdo->query("SELECT * from categorias  order by categoria asc");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);
                            $total_reg = @count($res);
                            if($total_reg > 0){ 

                            for($i=0; $i < $total_reg; $i++){
                            foreach ($res[$i] as $key => $value){	}
                            ?>
                            <option <?php if(@$categoria == $res[$i]['id']){ ?> selected <?php } ?> value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['categoria'] ?></option>

                    <?php }

                  }else{ 
                      
                      
                    echo '<option value="0" selected="selected" disabled="disabled">Cadastre uma Categoria</option>';

                  } ?>
                            </select>
						</div>						
				</div>
                
				<!-- Change Email Address -->
				<div class="widget change-email mb-0">
					<h3 class="widget-header user">Localidade do Projeto</h3>
						<!-- Current Password -->
						<div class="form-group">
						    <label for="current-email">Cidade</label>
						    <input type="text" name="cidade" value="<?php echo $res2[0]['cidade']; ?>" class="form-control" id="current-email">
						</div>
                        <!-- Current Password -->
						<div class="form-group">
						    <!-- Versão UF e Estado para HTML -->
                        <select class="form-control" name="uf" id="estado">
                            <option value="Selecione seu estado" selected disabled>Selecione seu estado</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                            </select>
						</div>						
				</div>

                <div class="widget change-email mb-0">
					<h3 class="widget-header user">Dados Para Contato</h3>
						<!-- Current Password -->
						<div class="form-group">
						    <label for="current-email">Telefone</label>
						    <input type="text" name="telefone" value="<?php echo $res2[0]['telefone']; ?>" class="form-control" id="current-email">
						</div>
                        <!-- Current Password -->
						<div class="form-group">
						    <!-- Versão UF e Estado para HTML -->
						    <label for="current-email">Email ou Site </label>
						    <input type="text" name="email_site" value="<?php echo $res2[0]['email_site']; ?>" class="form-control" id="current-email"
						</div>
				</div>
                <?php   } ?>

                <!-- Submit Button -->
				<button type="submit" name="enviar" value="1" class="btn btn-success">Criar Projeto</button>
                </form>
			</div>