<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title><?=$this->dados['titulo']?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="/SitePeixe/assets/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/SitePeixe/assets/images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/SitePeixe/assets/css/base/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="/SitePeixe/assets/css/base/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="/SitePeixe/assets/css/base/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/SitePeixe/assets/css/base/custom.css">

</head>

<body>
    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="/SitePeixe/Inicio/index"><img src="/SitePeixe/assets/images/logo.png" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item"><a class="nav-link" href="/SitePeixe/Inicio/index">Inicio</a></li>
						<li class="nav-item"><a class="nav-link" href="/SitePeixe/Loja/principal">Loja</a></li>
                        <li class="nav-item"><a class="nav-link" href="/SitePeixe/Loja/carrinho">Carrinho</a></li>
                        <li class="nav-item"><a class="nav-link" href="/SitePeixe/Informacao/contato">Contato</a></li>
                        <li class="nav-item"><a class="nav-link" href="/SitePeixe/Usuario/perfil">Meu Perfil</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navigation -->
    </header>
	
	<?php if(!isset($this->dados['mdfcssVisuais']['exclude']['top-banner'])){ ?>
		<!-- Start All Title Box -->
		<div class="all-title-box">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<h2><?= $this->dados['titulo'] ?></h2>
					</div>
				</div>
			</div>
		</div>
		<!-- End All Title Box -->
	<?php } ?>