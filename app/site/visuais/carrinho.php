<?php
	var_dump($_SESSION);
?>

	<!-- Iniciar - Referências a estilos(css) -->
	<link rel="stylesheet" href="/SitePeixe/assets/css/carrinho.css">
	<!-- Terminar - Referências a estilos(css) -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th>Quantidade</th>
                                    <th>Total</th>
                                    <th>Remover</th>
                                </tr>
                            </thead>
							<?php if(count($_SESSION['carrinho']) > 0){ ?>
                            <tbody id="listaCompras">
								<?php foreach($_SESSION['carrinho'] as $idProdutoCmprd => $infoCompra){ ?>
									<tr class="compra">
										<td class="thumbnail-img">
											<a href="detalhe/<?= $idProdutoCmprd ?>"><img class="img-fluid" src="/SitePeixe/assets/imagens/produtos/<?= $infoCompra["Grupo"] ?>/<?= $infoCompra["Tipo"] ?>/<?= $infoCompra["Nome"] ?>/01.jpg" alt="" /></a>
										</td>
										<td class="name-pr">
											<a href="detalhe/<?= $idProdutoCmprd ?>"><?= $infoCompra["Nome"] ?></a>
										</td>
										<td class="price-pr">
											<p class="precoProduto">R$ <?= $infoCompra["Preco"] ?>/<?= $infoCompra["UnidadeVenda"] ?></p>
										</td>
										<td class="quantity-box">
											<input type="number" size="4" name="<?= NOME_CAMPO_QTD_CMPRD_PRDT ?><?= $idProdutoCmprd ?>" value="<?= $infoCompra["QtdCmprd"] ?>" min="0" step="1" class="c-input-text qty text quantidade">
										</td>
										<td class="total-pr">
											<p class="precoCompra"></p>
										</td>
										<td class="remove-pr">
											<i class="fas fa-times botaoRemocao" id="botaoRemocaoCompra<?= $idProdutoCmprd ?>"></i>
										</td>
									</tr>
								<?php } ?>
                            </tbody>
							<?php } ?>
                        </table>
						<?php if(count($_SESSION['carrinho']) == 0){ ?>
						<div class="title-all text-center">
							<h2>Não há produtos no carrinho.</h2>
						</div>
						<?php } ?>
                    </div>
                </div>
            </div>

			<?php if(count($_SESSION['carrinho']) > 0){ ?>
            <div id="infosPedido" class="row my-5">
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Resumo do Pedido</h3>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Total da Compra</h5>
                            <div id="precoCrnh" class="ml-auto h5">R$ <?= $_SESSION['precoCrnh'] ?></div>
                        </div>
                        <hr>
					</div>
                </div>
				<div class="col-lg-8 col-sm-12">
                    <div class="update-box">
						<form action="/SitePeixe/Loja/checkout" method="post">
							<input value="Finalizar Compra" type="submit">
						</form>
                    </div>
                </div>
            </div>
			<?php } ?>
        </div>
    </div>
    <!-- End Cart -->
	
	<!-- Iniciar - Referências a scripts(js) -->
	<script src="/SitePeixe/assets/js/carrinho.js"></script>
	<!-- Terminar - Referências a scripts(js) -->
