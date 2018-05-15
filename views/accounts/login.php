<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>CodeTech</title>

	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->

	<!-- start: CSS -->
	<link id="bootstrap-style" href="../../assets/css/bootstrap.css" rel="stylesheet">
	<link href="../../assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="../../assets/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="../../assets/css/style-responsive.css" rel="stylesheet">
	<!-- end: CSS -->

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- start: Favicon -->
	<link rel="shortcut icon" href="header.ico">
	<!-- end: Favicon -->
		
</head>

<body>
		<div class="container-fluid">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="registration.php">Register</a>
						
					</div>
			<div class="col-md-6">
				<?php if( isset($_GET['error']) ): ?>
					<div class="alert alert-danger alert-dismissible">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						 	<span aria-hidden="true">&times;</span>
						 </button>
						<?= $_GET['error'] ?>
					
					<?php else: ?>
						<h2>Login to your account</h2>
					<?php endif; ?>
				</div>
					<form class="form-horizontal" action="login1.php" method="post">
						<fieldset>
							
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="icon-user"></i></span>
								<input class="input-large span10" name="username" id="username" type="text" placeholder="type username" autocomplete="off" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="icon-lock"></i></span>
								<input class="input-large span10" name="password" id="password" type="password" placeholder="type password"/>
							</div>
							<div class="clearfix"></div>
							

							<div class="button-login">	
								<button type="submit" class="btn btn-primary">Login</button>
							</div>
							<div class="clearfix"></div>
					</form>

				</div><!--/span-->
			</div><!--/row-->
			
				</div><!--/fluid-row-->
				
	</div><!--/.fluid-container-->

	<!-- start: JavaScript-->

		<script src="../../assets/js/jquery-1.9.1.min.js"></script>
		<script src="../../assets/js/jquery-migrate-1.0.0.min.js"></script>
		<script src="../../assets/js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="../../assets/js/bootstrap.js"></script>
		


		<!-- end: JavaScript-->
	
</body>
</html>
