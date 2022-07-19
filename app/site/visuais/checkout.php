<?php
	//var_dump($_SESSION);
?>

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Informações do Comprador</h3>
                        </div>
                        <form method="post" class="needs-validation" id="infoPedido" target="_self">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="prmrNome">Primeiro Nome*</label>
                                    <input type="text" class="form-control" id="prmrNome" name="prmrNome" placeholder="" value="" required>
                                    <div class="invalid-feedback"> Um primeiro nome é necessário para prosseguir. </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="sobrenome">Sobrenome*</label>
                                    <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="" value="" required>
                                    <div class="invalid-feedback"> Um último nome é necessário para prosseguir. </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email*</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                                <div class="invalid-feedback"> Por favor insira um email válido para que possa receber atualizações sobre seu pedido. </div>
                            </div>
                            <div class="mb-3">
                                <label for="celular">Número de Celular (incluindo o DDD)*</label>
                                <input type="text" class="form-control" id="celular" name="celular" placeholder="" required>
                                <div class="invalid-feedback"> Por favor insira um número de celular válido para que possamos entrar em contato em caso de problemas com seu pedido. </div>
                            </div>
                            <div class="mb-3">
                                <label for="endereco">Endereço*</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="" required>
                                <div class="invalid-feedback"> Por favor insira o endereço de entrega. </div>
                            </div>
							<div class="row">
								<div class="col-md-6 mb-3">
                                    <label for="numeroEndrc">Número do Endereço*</label>
                                    <input type="text" class="form-control" id="numeroEndrc" name="numeroEndrc" placeholder="" required="">
                                    <div class="invalid-feedback"> O número do endereço do local de entrega é necessário. </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cep">CEP (Somente os Números)*</label>
                                    <input type="text" class="form-control" id="cep" name="cep" placeholder="" required>
                                    <div class="invalid-feedback"> O CEP é necessário para prosseguir. </div>
                                </div>
							</div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="slcndrEstado">Estado*</label>
                                    <select class="wide w-100" id="slcndrEstado" name="estado">
										<?php foreach($this->dados["nomesEstados"] as $nomeEstado){ ?>
											<option value="<?= $nomeEstado ?>"><?= $nomeEstado ?></option>
										<?php } ?>
									</select>
                                    <div class="invalid-feedback"> Por favor selecione um estado válido. </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="slcndrCidade">Cidade*</label>
                                    <select class="wide w-100" id="slcndrCidade" name="cidade">
										<?php foreach($this->dados['nomesCddsPrmrEstd'] as $nomeCidade){ ?>
											<option value="<?= $nomeCidade ?>"><?= $nomeCidade ?></option>
										<?php } ?>
									</select>
                                    <div class="invalid-feedback"> Por favor selecione uma cidade válida. </div>
                                </div>
                            </div>
							<hr class="mb-4">
							<div class="title-left">
								<h3>Formato de Pagamento</h3>
							</div>
							<div class="d-block my-3">
								<div class="custom-control custom-radio">
									<input id="credito" name="metodoPgmnt" type="radio" value="cartaoEltrnc" class="pgmntCartao custom-control-input" checked required>
									<label class="custom-control-label" for="credito">Crédito</label>
								</div>
								<div class="custom-control custom-radio">
									<input id="debito" name="metodoPgmnt" type="radio" value="cartaoEltrnc" class="pgmntCartao custom-control-input" required>
									<label class="custom-control-label" for="debito">Débito</label>
								</div>
								<div class="custom-control custom-radio">
									<input id="pgmntNaEntrega" name="metodoPgmnt" type="radio" value="pgmntEntrg" class="custom-control-input" required>
									<label class="custom-control-label" for="pgmntNaEntrega">Pagamento na Entrega</label>
								</div>
							</div>
						</form>
						<form method="post" id="infosPgmnt">
							<div id="zonaDtlhsPgmnt">
								<div id="cartaoEltrnc" class="dtlhsPgmnt">
								</div>
							</div>
						</form>
						<hr class="mb-1">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Carrinho de Compras</h3>
                                </div>
                                <div class="rounded p-2 bg-light">
									<?php $ePrmrCompra = true;
									foreach($_SESSION['carrinho'] as $compra){ ?>
										<div class="media mb-2 <?php if(!$ePrmrCompra){ ?> border-top <?php } ?>">
											<div class="media-body"> <a href="detail.html"> <?= $compra['Nome'] ?></a>
												<div class="small text-muted">Preço do Produto: <?= $compra['Preco'] ?> <span class="mx-2">|</span> Qtd: <?= $compra['QtdCmprd'] ?> <span class="mx-2">|</span> Subtotal: <?= $compra['Preco']*$compra['QtdCmprd'] ?></div>
											</div>
										</div>
									<?php if($ePrmrCompra) {$ePrmrCompra = false;}
									} ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                <hr>
									<div class="d-flex gr-total">
										<h5>Preço Total do Carrinho</h5>
										<div class="ml-auto h5"><?= $_SESSION['precoCrnh'] ?></div>
									</div>
                                </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"><input type="submit" value="Terminar Pedido" form="infosPgmnt" class="ml-auto btn hvr-hover"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

	<!-- Iniciar - Referências a scripts(js) -->
	<script src="/SitePeixe/assets/js/checkout.js"></script>
	<script src="/SitePeixe/assets/js/ferramentas/cleave.min.js"></script>
	<script src="/SitePeixe/assets/js/ferramentas/cleave-phone.br.js"></script>
	<script src="https://js.stripe.com/v3/"></script>
	<!-- Terminar - Referências a scripts(js) -->
