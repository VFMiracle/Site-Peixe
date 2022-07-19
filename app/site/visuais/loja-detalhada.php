<?php
	//var_dump($this->dados);
	var_dump($_SESSION);
?>

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active"> <img class="d-block w-100" src="/SitePeixe/assets/imagens/produtos/<?= $this->dados['produto']['Grupo'] ?>/<?= $this->dados['produto']['Tipo'] ?>/<?= $this->dados['produto']['Nome'] ?>/01.jpg" alt="First slide"> </div>
                            <div class="carousel-item"> <img class="d-block w-100" src="/SitePeixe/assets/imagens/produtos/<?= $this->dados['produto']['Grupo'] ?>/<?= $this->dados['produto']['Tipo'] ?>/<?= $this->dados['produto']['Nome'] ?>/02.jpg" alt="Second slide"> </div>
                            <div class="carousel-item"> <img class="d-block w-100" src="/SitePeixe/assets/imagens/produtos/<?= $this->dados['produto']['Grupo'] ?>/<?= $this->dados['produto']['Tipo'] ?>/<?= $this->dados['produto']['Nome'] ?>/03.jpg" alt="Third slide"> </div>
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
						<i class="fa fa-angle-left" aria-hidden="true"></i>
						<span class="sr-only">Previous</span> 
					</a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
						<i class="fa fa-angle-right" aria-hidden="true"></i> 
						<span class="sr-only">Next</span> 
					</a>
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-1" data-slide-to="0" class="active">
                                <img class="d-block w-100 img-fluid" src="/SitePeixe/assets/imagens/produtos/<?= $this->dados['produto']['Grupo'] ?>/<?= $this->dados['produto']['Tipo'] ?>/<?= $this->dados['produto']['Nome'] ?>/01.jpg" alt="" />
                            </li>
                            <li data-target="#carousel-example-1" data-slide-to="1">
                                <img class="d-block w-100 img-fluid" src="/SitePeixe/assets/imagens/produtos/<?= $this->dados['produto']['Grupo'] ?>/<?= $this->dados['produto']['Tipo'] ?>/<?= $this->dados['produto']['Nome'] ?>/02.jpg" alt="" />
                            </li>
                            <li data-target="#carousel-example-1" data-slide-to="2">
                                <img class="d-block w-100 img-fluid" src="/SitePeixe/assets/imagens/produtos/<?= $this->dados['produto']['Grupo'] ?>/<?= $this->dados['produto']['Tipo'] ?>/<?= $this->dados['produto']['Nome'] ?>/03.jpg" alt="" />
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2><?= $this->dados['produto']['Nome'] ?></h2>
						<h3><?= $this->dados['produto']['Grupo'] ?> - <?= $this->dados['produto']['Tipo'] ?></h3>
                        <h5>R$<?= $this->dados['produto']['Preco'] ?>/<?= $this->dados['produto']['UnidadeVenda'] ?></h5>
                        <p class="available-stock"><span> <?php if($this->dados['produto']['EstoqueEEstmd']){ ?> Cerca de <?php }else{ ?> Um total de <?php } ?> <?= $this->dados['produto']['Estoque'] ?><?= $this->dados['produto']['UnidadeEstoque'] ?> estão em estoque. </span><p>
						<h4>Descrição:</h4>
						<p><?= $this->dados['produto']['Descricao'] ?></p>
						<form method="get" target="_self">
							<ul>
								<li>
									<div class="form-group quantity-box">
										<label class="control-label">Quantidade a Comprar</label>
										<input name="QtdCmprd" class="form-control" value="1" min="1" max="200" type="number">
									</div>
								</li>
							</ul>

							<div class="price-box-bar">
								<div class="row">
									<div class="col-xl-5 col-lg-5 col-md-6"><input type="submit" class="btn hvr-hover" data-fancybox-close="" value="Adicionar ao Carrinho"></div>
									<?php if(count($_GET) > 0){ ?><div class="title-all col-xl-5 col-lg-5 col-md-6"><h2>O produto foi adicionado ao carrinho.</h2></div><?php } ?>
								</div>
							</div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Detail -->
