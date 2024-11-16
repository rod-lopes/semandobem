	
                
                <div class="widget dashboard-container my-adslist">
					<h3 class="widget-header">Meus Projetos</h3>
<?php 
          //RECEBER O NUMERO DA PAGINA
          $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
          $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
          
          //SETAR A QUANTIDADE DE REGISTROS POR PÁGINA
          $limite_resultado = 20;
          $início_contagem = 19;
          
        // CALCULAR O INICIO DA VISUALIZAÇÃO
            $inicio = ($limite_resultado * $pagina) - $limite_resultado;
          
	$query = $pdo->query("SELECT * from projetos WHERE id_user = '$_SESSION[id_usuario]'  LIMIT $inicio, $limite_resultado");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){ 
?>

					<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>
								<th>IMAGEM</th>
								<th>Título do Projeto</th>
								<th class="text-center">Categoria</th>
								<th class="text-center">Ações</th>
							</tr>
						</thead>
						<tbody>
                        <?php 
                    //Seleciona os lançamentos do mês corrente na tabela
				  	for($i=0; $i < $total_reg; $i++){
						foreach ($res[$i] as $key => $value){	}
                        
						?>
							<tr>
								
								<td class="product-thumb">
									<img width="80px" height="auto" src="images/projetos/<?php echo $res[$i]['imagem']; ?>" alt="image description"></td>
								<td class="product-details">
									<h3 class="title"><?php echo $res[$i]['nome']; ?></h3>
									<span class="add-id"><strong>ID:</strong> <?php echo $res[$i]['id']; ?></span>
									<span><strong>Data: </strong><time><?php echo date("d/m/Y", strtotime($res[$i]['data_lancamento']));?></time> </span>
									<span class="status active"><strong>Status:</strong>Ativo</span>
									<span class="location"><strong>Local:</strong><?php echo $res[$i]['cidade']; ?>, <?php echo $res[$i]['uf']; ?></span>
								</td>
								<td class="product-category">
                                <span class="categories">
                                 <?php
                                $id_cat = $res[$i]['cod_categoria'];
                                $query_2 = $pdo->query("SELECT * from categorias where id = '$id_cat' ");
                                $res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);
                                $nome_cat = $res_2[0]['categoria'];
                                echo $nome_cat;
                                ?>
                               </span></td>
								<td class="action" data-title="Action">
									<div class="">
										<ul class="list-inline justify-content-center">
											                                            
											<li class="list-inline-item">
												<a class="edit" href="index.php?m=editar_projeto&id=<?php echo $res[$i]['id']; ?>">
													<i class="fa fa-pencil"></i>
												</a>		
											</li>
											<li class="list-inline-item">
												<a class="delete" href="index.php?m=deletar_projeto&id=<?php echo $res[$i]['id']; ?>">
													<i class="fa fa-trash"></i>
												</a>
											</li>
                                            
										</ul>
									</div>
								</td>
							</tr>
                            <?php } ?>
						</tbody>
					</table>
                    <?php }else{ ?>
                    <div class="alert alert-danger" role="alert">
                    <?php echo 'Não existem lançamentos para serem exibidos'; ?>
                    </div>                                         
        		
        	    <?php } ?>
                <?php
        	    
        	    //CONTAR A QUANITDADE DE REGISTROS NO BD
            $query_qnt_registros = "SELECT COUNT(id) AS num_result FROM projetos";
            $result_qnt_registros = $pdo->prepare($query_qnt_registros);
            $result_qnt_registros->execute();
            $row_qnt_registros = $result_qnt_registros->fetch(PDO::FETCH_ASSOC);
            
            //Quantidade de página
            $qnt_pagina = ceil($row_qnt_registros['num_result'] / $limite_resultado);
            
            // Maximo de link
            $maximo_link = 1;
            
            $registros_pagina = $limite_resultado * $pagina;
            if ($registros_pagina>$row_qnt_registros['num_result']){
            $registros_pagina = $row_qnt_registros['num_result'];
            }else {
                $registros_pagina = $limite_resultado * $pagina;
            }
            $registros_pagina_final = $registros_pagina - $início_contagem;
            if ($registros_pagina_final<0){
                $registros_pagina_final=1;
            }

            
            ?>		

            <div class="d-flex align-items-center">


<a class="page-link" href="index.php?page=1" >
                          <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>
                          
                        </a>
 <?php
                      
                      for ($pagina_anterior = $pagina - $maximo_link; $pagina_anterior <= $pagina - 1; $pagina_anterior++) {
                if ($pagina_anterior >= 1) { ?>

<a class="page-link" href="index.php?page=<?php echo $pagina_anterior; ?>"><?php echo $pagina_anterior; ?></a>
<?php
                }
                
                      }
                      ?>

<a class="page-link active" href="#"><?php echo $pagina; ?></a>

<?php
                      
                      for ($proxima_pagina = $pagina + 1; $proxima_pagina <= $pagina + $maximo_link; $proxima_pagina++) {
                if ($proxima_pagina <= $qnt_pagina) {
                      ?>
<a class="page-link" href="index.php?page=<?php echo $proxima_pagina; ?>"><?php echo $proxima_pagina; ?></a>

<?php
                }
                
                      }
                      ?>

                      <a class="page-link" href="index.php?page=<?php echo $qnt_pagina; ?>">
                           <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>
                        </a>

                  </div>

				</div>

                              