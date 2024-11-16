<?php
@session_start();
require_once("conexao.php");

//Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Verificar se o usuário clicou no botão
if (!empty($dados['enviar'])) {
  $nome = $_POST['nome'];
  $cpf = $_POST['cpf'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $senha = $_POST['senha'];
  $nivel = "Administrador";
  $imagem = "indisponivel.jpg";
  
  $erro = array();
  if(empty($nome))
    $erro[] = "Preencha o seu Nome.";
  if(empty($cpf))
    $erro[] = "Preencha o número do CPF.";  

  if(empty($email))
    $erro[] = "Preencha o seu email";

  if(empty($senha))
    $erro[] = "Preencha sua senha";

      if(empty($telefone))
    $erro[] = "Preencha o seu telefone";


  if(count($erro) == 0) {

    
    $query2 = "INSERT INTO usuarios (nome, cpf, email, telefone, senha, nivel, imagem) VALUES (:nome, :cpf, :email, :telefone, :senha, '$nivel', '$imagem' ) ";
    $res2 = $pdo->prepare($query2);
    $res2->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
    $res2->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
    $res2->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $res2->bindParam(':telefone', $dados['telefone'], PDO::PARAM_STR);
    $res2->bindParam(':senha', $dados['senha'], PDO::PARAM_STR);

    $res2->execute();
    if ($res2->rowCount()) {
     
     die("<script language='javascript'>window.location='sucesso.php'</script>");

   } else {
    $erro[] = "Lançamento nâo cadastrado!"; 
   
  }

}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Semando Bem Vindo - Cadastrar</title>
  
  <!-- PLUGINS CSS STYLE -->
  <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Owl Carousel -->
  <link href="plugins/slick-carousel/slick/slick.css" rel="stylesheet">
  <link href="plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet">
  <!-- Fancy Box -->
  <link href="plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet">
  <link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
  <link href="plugins/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css" rel="stylesheet">
  <!-- CUSTOM CSS -->
  <link href="css/style.css" rel="stylesheet">

  <!-- FAVICON -->
  <link href="img/favicon.png" rel="shortcut icon">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body class="body-wrapper">


<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg  navigation">
					<a class="navbar-brand" href="../index.html">
						<img src="images/logo.png" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">
							
						</ul>
						<ul class="navbar-nav ml-auto mt-10">

						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>

<!--===============================
=            Hero Area            =
================================-->

<section class="hero-area bg-1 text-center overly">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Header Contetnt -->
				<div class="content-block">
					<h1>Cadastro</h1>				
					
				</div>

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
				<!-- Advance Search -->
				<div class="advance-search">
					<form  action="" method="post" >
						<div class="row">
							<!-- Store Search -->
                    
							<div class="col-lg-6 col-md-12">
								<div class="block d-flex">
									<input type="text" name="nome" class="form-control mb-2 mr-sm-2 mb-sm-0"  placeholder="Nome Completo">
								</div>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="block d-flex">
									<input type="email" name="email" class="form-control mb-2 mr-sm-2 mb-sm-0"  placeholder="Email">
								</div>
							</div>
						</div>
					
				</div>
                	<div class="advance-search">

						<div class="row">                    
							<div class="col-lg-6 col-md-12">
								<div class="block d-flex">
									<input type="text" name="cpf" class="form-control mb-2 mr-sm-2 mb-sm-0"  placeholder="CPF">
								</div>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="block d-flex">
									<input type="text" name="telefone" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Telefone">

								</div>
							</div>
						</div>
                    
					
				</div>
				                	<div class="advance-search">

						<div class="row">
							<!-- Store Search -->
                    
							<div class="col-lg-6 col-md-12">
								<div class="block d-flex">
									<input type="password" name="senha" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Senha">
								</div>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="block d-flex">
									<input type="password" name="rsenha" class="form-control mb-2 mr-sm-2 mb-sm-0"  placeholder="Repita Senha">
									<!-- Search Button -->
									<button type="submit" name="enviar" value="1" class="btn btn-success">Cadastrar</button>
                                    </form>
								</div>
							</div>
						</div>


                
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<!--===================================
=            Client Slider            =
====================================-->


<!--===========================================
=            Popular deals section            =
============================================-->




<!--==========================================
=            All Category Section            =
===========================================-->

<section class=" section">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Section title -->

				<div class="row">
		
					
					
					
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>




<!--============================
=            Footer            =
=============================-->

<footer class="footer section section-sm">
  <!-- Container Start -->
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-7 offset-md-1 offset-lg-0">
        <!-- About -->
        <div class="block about">
        <!-- footer logo -->
          <img src="images/logo-footer.png" alt="">
          <!-- description -->
          <p class="alt-color">Somos um projeto que conectamos pessoas em prol do voluntariado. Nosso intúito é conectar pessoas e projetos sociais afim de promover o bem-estar de nossas comunidades. Temos o compromisso em colaborar de forma transparente e inclusiva. Todos são bem vindos :)</p>
        </div>
      </div>
      <!-- Link list -->
      <div class="col-lg-2 offset-lg-1 col-md-3">
        <div class="block">
          <h4>Nossas Páginas</h4>
          <ul>
            <li><a href="http://semeandobem.great-site.net/">Home</a></li>
            <li><a href="http://semeandobem.great-site.net/contact.html">Contato</a></li>

          </ul>
        </div>
      </div>
      <!-- Link list -->

      <!-- Promotion -->
      <div class="col-lg-4 col-md-7">
        <!-- App promotion -->
        <div class="block-2 app-promotion">
          <a href="">
            <!-- Icon -->
            <img src="images/footer/phone-icon.png" alt="mobile-icon">
          </a>
          <p>Web Site totalmente responsivo</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Container End -->
</footer>
<!-- Footer Bottom -->
<footer class="footer-bottom">
    <!-- Container Start -->
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-12">
          <!-- Copyright -->
          <div class="copyright">
            <p>Copyright © 2024. Todos os Direitos Reservados</p>
          </div>
        </div>
        <div class="col-sm-6 col-12">
          <!-- Social Icons -->
          <ul class="social-media-icons text-right">
              <li><a class="fa fa-facebook" href=""></a></li>
              <li><a class="fa fa-twitter" href=""></a></li>
              <li><a class="fa fa-pinterest-p" href=""></a></li>
              <li><a class="fa fa-vimeo" href=""></a></li>
            </ul>
        </div>
      </div>
    </div>
    <!-- Container End -->
    <!-- To Top -->
    <div class="top-to">
      <a id="top" class="" href=""><i class="fa fa-angle-up"></i></a>
    </div>
</footer>

  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="plugins/tether/js/tether.min.js"></script>
  <script src="plugins/raty/jquery.raty-fa.js"></script>
  <script src="plugins/bootstrap/dist/js/popper.min.js"></script>
  <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="plugins/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>
  <script src="plugins/slick-carousel/slick/slick.min.js"></script>
  <script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
  <script src="plugins/fancybox/jquery.fancybox.pack.js"></script>
  <script src="plugins/smoothscroll/SmoothScroll.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
  <script src="js/scripts.js"></script>

</body>

</html>



