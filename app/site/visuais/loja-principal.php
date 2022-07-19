<?php
	/*var_dump($this->dados);
	var_dump($this->dados["prdtsPorTipo"]);*/
?>
    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-center text-sm-left">
                                <div class="toolbar-sorter-right">
                                    <span>Sort by </span>
                                    <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
									<option data-display="Select">Nothing</option>
									<option value="1">Popularity</option>
									<option value="2">High Price → High Price</option>
									<option value="3">Low Price → High Price</option>
									<option value="4">Best Selling</option>
								</select>
                                </div>
                                <p>Showing all 4 results</p>
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                                <ul class="nav nav-tabs ml-auto">
                                    <li>
                                        <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div id="TabelaProdutos" class="row">
										<?php foreach($this->dados['produtos'] as $produto){ ?>
											<div id="CelulaProduto<?= $produto['Id'] ?>" class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
												<div class="products-single fix">
													<div class="box-img-hover">
														<img src="/SitePeixe/assets/imagens/produtos/<?= $produto['Grupo'] ?>/<?= $produto['Tipo'] ?>/<?= $produto['Nome'] ?>/01.jpg" class="img-fluid" alt="Image">
													</div>
													<div class="why-text">
														<h4><a href="/SitePeixe/Loja/detalhe/<?= $produto['Id'] ?>" ><?= $produto['Nome'] ?></a></h4>
														<h5> R$<?= $produto['Preco'] ?>/<?= $produto['UnidadeVenda'] ?></h5>
													</div>
												</div>
											</div>
										<?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="list-view">
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                            <p class="new">New</p>
                                                        </div>
                                                        <img src="/SitePeixe/assets/images/img-pro-01.jpg" class="img-fluid" alt="Image">
                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4>Lorem ipsum dolor sit amet</h4>
                                                    <h5> <del>$ 60.00</del> $40.79</h5>
                                                    <p>Integer tincidunt aliquet nibh vitae dictum. In turpis sapien, imperdiet quis magna nec, iaculis ultrices ante. Integer vitae suscipit nisi. Morbi dignissim risus sit amet orci porta, eget aliquam purus
                                                        sollicitudin. Cras eu metus felis. Sed arcu arcu, sagittis in blandit eu, imperdiet sit amet eros. Donec accumsan nisi purus, quis euismod ex volutpat in. Vestibulum eleifend eros ac lobortis aliquet.
                                                        Suspendisse at ipsum vel lacus vehicula blandit et sollicitudin quam. Praesent vulputate semper libero pulvinar consequat. Etiam ut placerat lectus.</p>
                                                    <a class="btn hvr-hover" href="#">Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                            <p class="sale">Sale</p>
                                                        </div>
                                                        <img src="/SitePeixe/assets/images/img-pro-02.jpg" class="img-fluid" alt="Image">
                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4>Lorem ipsum dolor sit amet</h4>
                                                    <h5> <del>$ 60.00</del> $40.79</h5>
                                                    <p>Integer tincidunt aliquet nibh vitae dictum. In turpis sapien, imperdiet quis magna nec, iaculis ultrices ante. Integer vitae suscipit nisi. Morbi dignissim risus sit amet orci porta, eget aliquam purus
                                                        sollicitudin. Cras eu metus felis. Sed arcu arcu, sagittis in blandit eu, imperdiet sit amet eros. Donec accumsan nisi purus, quis euismod ex volutpat in. Vestibulum eleifend eros ac lobortis aliquet.
                                                        Suspendisse at ipsum vel lacus vehicula blandit et sollicitudin quam. Praesent vulputate semper libero pulvinar consequat. Etiam ut placerat lectus.</p>
                                                    <a class="btn hvr-hover" href="#">Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                            <p class="sale">Sale</p>
                                                        </div>
                                                        <img src="/SitePeixe/assets/images/img-pro-03.jpg" class="img-fluid" alt="Image">
                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4>Lorem ipsum dolor sit amet</h4>
                                                    <h5> <del>$ 60.00</del> $40.79</h5>
                                                    <p>Integer tincidunt aliquet nibh vitae dictum. In turpis sapien, imperdiet quis magna nec, iaculis ultrices ante. Integer vitae suscipit nisi. Morbi dignissim risus sit amet orci porta, eget aliquam purus
                                                        sollicitudin. Cras eu metus felis. Sed arcu arcu, sagittis in blandit eu, imperdiet sit amet eros. Donec accumsan nisi purus, quis euismod ex volutpat in. Vestibulum eleifend eros ac lobortis aliquet.
                                                        Suspendisse at ipsum vel lacus vehicula blandit et sollicitudin quam. Praesent vulputate semper libero pulvinar consequat. Etiam ut placerat lectus.</p>
                                                    <a class="btn hvr-hover" href="#">Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <div class="search-product">
                            <form action="#">
                                <input class="form-control" placeholder="Search here..." type="text">
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>
                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Categories</h3>
                            </div>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
								<script> var idsProdutoValido = {}; </script>
								<?php foreach($this->dados['prdtsPorTipo'] as $grupoPrdts => $tiposPrdtEmGrupo){ ?>
									<!--Copiar a lista de produtos organizados por tipo de php para Javascript e adicionar uma lista a cada entrada de grupo que contenha os ids de todos os produtos que pertencem a esse grupo. RAZÃO: Pelo que eu entendi, chamadas a funções de Javascript, feitas por tags de HTML, não conseguem usar variáveis de PHP como parametro. Devido a isso, este Javascript interno é usado para fazer essa transferência de informações entre linguagens e adicionar outras informações que a função usa.-->
									<script>
										idsProdutoValido['<?= $grupoPrdts ?>'] = {'idsPrdtEmGrupo': []};
										<?php $qtdPrdtsEmGrupo = 0;
										/*Para cada entrada do dicionário de tipos de produto no grupo atual da linguagem PHP, montar uma entrada no dicionário equivalente de JS, a qual terá mesmo nome em sua chave e mesmos ids em seu valor. Além disso, adicionar os ids a lista de ids de produto no grupo atual de JS.*/
										foreach($tiposPrdtEmGrupo as $tipoPrdts => $idsPhpPrdtEmTipo){ ?>
											idsProdutoValido['<?= $grupoPrdts ?>']['<?= $tipoPrdts ?>'] = [];
											var idsJsPrdtEmTipo = idsProdutoValido['<?= $grupoPrdts ?>']['<?= $tipoPrdts ?>'];
											var idsPrdtEmGrupo = idsProdutoValido['<?= $grupoPrdts ?>']["idsPrdtEmGrupo"];
											/*Copiar cada entrada da lista de ids de produto no tipo atual, a qual está na linguagem PHP, para a lista equivalente em JS e para a lista de ids de produto no grupo atual, que também está nessa linguagem. Além disso, aumentar em um a quantidade de produtos no grupo atual.*/
											<?php foreach($idsPhpPrdtEmTipo as $idProduto){ ?>
												idsJsPrdtEmTipo.push(<?= $idProduto ?>);
												idsPrdtEmGrupo.push(<?= $idProduto ?>);
												<?php $qtdPrdtsEmGrupo++; ?>
											<?php } ?>
										<?php } ?>
									</script>
									
									<div class="list-group-collapse sub-men">
										<button class="list-group-item list-group-item-action" onclick="filtrarTipoProduto(idsProdutoValido['<?= $grupoPrdts ?>']['idsPrdtEmGrupo'])" data-toggle="collapse" aria-expanded="true" aria-controls="sub-men1"> <?= $grupoPrdts ?> <small class="text-muted">(<?= $qtdPrdtsEmGrupo ?>)</small></button>
										<div class="collapse show" data-parent="#list-group-men">
											<div class="list-group">
												<?php foreach($tiposPrdtEmGrupo as $tipoPrdts => $idsPrdtEmTipo){ ?>
													<button class="list-group-item list-group-item-action" onclick="filtrarTipoProduto(idsProdutoValido['<?= $grupoPrdts ?>']['<?= $tipoPrdts ?>'])"> <?= $tipoPrdts ?> <small class="text-muted">( <?= count($idsPrdtEmTipo) ?> )</small></button>
												<?php } ?>
											
												<!--<a href="#" class="list-group-item list-group-item-action active">Fruits 1 <small class="text-muted">(50)</small></a>
												<a href="#" class="list-group-item list-group-item-action">Fruits 2 <small class="text-muted">(10)</small></a>
												<a href="#" class="list-group-item list-group-item-action">Fruits 3 <small class="text-muted">(10)</small></a>
												<a href="#" class="list-group-item list-group-item-action">Fruits 4 <small class="text-muted">(10)</small></a>
												<a href="#" class="list-group-item list-group-item-action">Fruits 5 <small class="text-muted">(20)</small></a>-->
											</div>
										</div>
									</div>
									
                                <?php } ?>
                            </div>
                        </div>
                        <div class="filter-price-left">
                            <div class="title-left">
                                <h3>Price</h3>
                            </div>
                            <div class="price-box-slider">
                                <div id="slider-range"></div>
                                <p>
                                    <input type="text" id="amount" readonly style="border:0; color:#fbb714; font-weight:bold;">
                                    <button class="btn hvr-hover" type="submit">Filter</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->
	
	<!-- Iniciar - Referências a scripts(js) -->
	<script src="/SitePeixe/assets/js/loja-principal.js"></script>
	<!-- Terminar - Referências a scripts(js) -->