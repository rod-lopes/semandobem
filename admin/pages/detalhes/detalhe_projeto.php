<?php
@session_start();
require_once('conexao.php');
require_once('verificar-permissao.php');

$id = intval($_GET['id']);
$id_usuario = $_SESSION['id_usuario'];

  $hoje = date('Y-m-d');

	$query2 = $pdo->query("SELECT * from projetos WHERE id = '$id'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$total_reg2 = @count($res2);
	if($total_reg2 > 0){ 
?>

                
                <div class="widget dashboard-container my-adslist">
					<h3 class="widget-header">Detalhe do Projeto</h3>

					<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>
								<th>IMAGEM</th>
								<th>Título do Projeto</th>
								<th class="text-center">Categoria</th>
								<th class="text-center">Telefone</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								
								<td class="product-thumb">
									<img width="80px" height="auto" src="images/projetos/<?php echo $res2[0]['imagem']; ?>" alt="image description"></td>
								<td class="product-details">
									<h3 class="title"><?php echo $res2[0]['nome']; ?></h3>
									<span class="add-id"><strong>ID:</strong> <?php echo $res2[0]['id']; ?></span>
									<span><strong>Data: </strong><time><?php echo date("d/m/Y", strtotime($res2[0]['data_lancamento']));?></time> </span>
									<span class="status active"><strong>Status:</strong>Ativo</span>
									<span class="location"><strong>Local:</strong><?php echo $res2[0]['cidade']; ?>, <?php echo $res2[0]['uf']; ?></span>
								</td>
								<td class="product-category">
                                <?php
                                $id_cat = $res2[0]['cod_categoria'];
                                $query_2 = $pdo->query("SELECT * from categorias where id = '$id_cat' ");
                                $res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);
                                $nome_cat = $res_2[0]['categoria'];
                                echo $nome_cat;
                                ?>

                                </td>
								<td class="action" data-title="Action">
									<div class="">
                                <span class="add-id"><strong><?php echo $res2[0]['telefone']; ?></strong>
									</div>
								</td>
							</tr>
                            
						</tbody>
					</table>
                    <p><strong>Descrição: </strong><?php echo $res2[0]['descricao_curta']; ?></p>
                    <p><strong>Descrição Completa do Projeto: </strong><?php echo $res2[0]['descricao']; ?></p>


        	 
                <?php   } ?>
                              