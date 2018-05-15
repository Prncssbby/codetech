<?php

	require "../session/session.php";
	require "../vendor/autoload.php";
	
	use Codetech\database;
	use Codetech\files;
	use Codetech\folders;

	$db = new database;
	$file = new files;
	$folder = new folders;

	$file->getUserFiles($_SESSION['userId'],0,'dateAdded');

	$folder->getUserFolders($_SESSION['userId'],0,'dateCreated');

	$_SESSION['currentPath'] = 'root';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>CodeTech</title>
	<meta name="description" content="CodeTech">
	<meta name="author" content="Princess">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->

	<!-- start: CSS -->
	<link id="bootstrap-style" href="../assets/css/bootstrap.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="../assets/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="../assets/css/style-responsive.css" rel="stylesheet">

	<!-- end: CSS -->

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- start: Favicon -->
	<link rel="shortcut icon" href="header.ico">
	<!-- end: Favicon -->
		
	
		<!-- start: JavaScript-->

		<script src="../assets/js/jquery-1.9.1.min.js"></script>
		<script src="../assets/js/jquery-migrate-1.0.0.min.js"></script>
		<script src="../assets/js/jquery-ui-1.10.0.custom.min.js"></script>
		<script src="../assets/js/bootstrap.js"></script>	
		<script src="../assets/js/jquery.imagesloaded.js"></script>
		<script src="../assets/jquery.min.js"></script>
	
	
	
	
	<script>
		$(document).ready(function(){
	  		$('#folderName').hide();
	  		$('#createFolderBtn').hide();
	  		$('#createFolder').click(function(){
	  			$('#folderName').show();
	  			$('#createFolderBtn').show();
	  			$('#createFolder').hide();
	  		});
			
        <?php if( $folder->getUserFolders_folders() > 0 ): ?>
          <?php foreach($folder->getUserFolders_folders() as $folderId): ?>  
				$('#editSpanFolder<?= $folderId ?>').hide();
				//$('#editFolderTextbox<?= $folderId ?>').hide();
				$('#renameFolderNow<?= $folderId ?>').hide();

				$('#renameFolderBtn<?= $folderId ?>').click(function(){
				  $('#spanFolder<?= $folderId ?>').hide();
				  $('#editSpanFolder<?= $folderId ?>').show();
				  //$('#editFolderTextbox<?= $folderId ?>').show();
					$('#editFolderTextbox<?= $folderId ?>').attr("type","text");

				  $('#renameFolderBtn<?= $folderId ?>').hide();
				  $('#renameFolderNow<?= $folderId ?>').show();
				});

			  $('#renameFolderNow<?= $folderId ?>').click(function(){
				$.post("renameFolder.php",{folderId:<?= $folderId ?>, name:$('#editFolderTextbox<?= $folderId ?>').val() },function(){
				  //$('#editSpanFolder<?= $folderId ?>').hide();
				 // $('#spanFolder<?= $folderId ?>').show();
				  location.reload();
				});
			  });
		  <?php endforeach; ?>
		<?php endif ?>

		<?php if($file->getUserFiles_files() > 0): ?>	
	        <?php foreach($file->getUserFiles_files() as $fileId): ?>
	          //$('#editSpan<?= $fileId ?>').hide();
	          $('#renameNow<?= $fileId ?>').hide();

	          $('#renameBtn<?= $fileId ?>').click(function(){
	            $('#spanFile<?= $fileId ?>').hide();
	            $('#renameBtn<?= $fileId ?>').hide();
	            $('#editSpan<?= $fileId ?>').show();
				$('#editTextbox<?= $fileId?>').attr("type","text");
	            $('#renameNow<?=$fileId ?>').show();
	          });

	          $('#renameNow<?= $fileId ?>').click(function(){
	            $.post("renameFile.php",{fileId:<?= $fileId ?>, name:$('#editTextbox<?= $fileId ?>').val() },function(){
	              $('#editSpan<?= $fileId ?>').hide();
	              $('#spanFile<?= $fileId ?>').show();
	              location.reload();
	            });
	          });
				
			  $('#deleteBtn<?= $fileId ?>').click(function(){
			  
				$.post("deleteFile.php",{fileId:<?= $fileId ?>},function(){
	              location.reload();
	            });
			  });
				
	        <?php endforeach; ?>			
		<?php endif; ?>	
			
		});			
	</script>
		<!-- end: JavaScript-->
	
	
</head>

<body>
		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index-new.php"><img src="codetech.jpg"><span>CodeTech</span></a>
								
				<!-- start: Header Menu -->
				<div class="btn-group pull-right" >
					<!-- start: User Dropdown -->
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone hidden-tablet"> admin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
					
						<li><a href="../session/logout.php">Logout</a></li>
					</ul>
					<!-- end: User Dropdown -->
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	
	
	<div id="under-header"></div>
	<!-- start: Header -->
	
		<div class="container-fluid">
		<div class="row-fluid">
	
			<!-- start: Main Menu -->
			<div class="span2 main-menu-span">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Navigation</li>
						<li><a href="index-new.php"><i class="icon-folder-open"></i><span class="hidden-tablet"> File Storage</span></a></li>
						<li><a href="calendar.html"><i class="icon-calendar"></i><span class="hidden-tablet"> Calendar</span></a></li>
						<li><a href="grid.html"><i class="icon-user"></i><span class="hidden-tablet"> About Us</span></a></li>
						<li><a href="help.html"><i class="icon-question-sign"></i><span class="hidden-tablet"> Help</span></a></li>
						<!--<li><a href="deleteFile.php"><i class="icon-trash"></i><span class="hidden-tablet"> Trash Items</span></a></li> -->
					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- start: Content -->

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
						<a href="#">File Storage</a>
						</a>
						   
					</li>
				</ul>
			</div>
		

			<script>
				function myFunction() {
    				var x = document.getElementById("Demo");
    				if (x.className.indexOf("w3-show") == -1) {  
        				x.className += " w3-show";
    				} else { 
        				x.className = x.className.replace(" w3-show", "");
   							}
						}
			</script>
		
	<button id="createFolder" class="btn btn-default">+ New Folder</button>
	<form method="POST" action="createFolder.php">
		<input type="hidden" name="returnPage" value="index-new.php">
		<input type="text" id="folderName" name="folderName" placeholder="Enter Folder Name">
		<input type="submit" id="createFolderBtn" value="Create Folder">
	</form>

	<form enctype="multipart/form-data" action="upload.php" method="POST">
		<p>Upload your file</p>
		<input type="hidden" name="returnPage" value="index-new.php">
		<input type="hidden" name="location" value="uploads/">
		<input type="file" name="uploaded_file"></input><br />
		<input class="btn btn-primary" type="submit" value="Upload"></input>
	</form>
			
				<table class="table table-hover">
					<thead>
						<tr>
							<th>File</th>
							<th>Date</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

					<?php if( $folder->getUserFolders_folders() > 0 ): ?>

					  <?php foreach($folder->getUserFolders_folders() as $folderId): ?>
								<tr>
									<td>
										<span id="spanFolder<?= $folderId ?>">
							  			<a href="subfolder.php?folderId=<?= $folderId ?>" style="text-decoration: none;">
								  		<img src="../assets/folder-deepin.png" height="30" width="30">
								 		 <?= $db->selectNow('folders','name','id',$folderId) ?>
							 			</a>
										</span>
										<span id="editSpanFolder<?= $folderId ?>">
							 				 <input type="hidden" id="editFolderTextbox<?= $folderId ?>" value="<?= $db->selectNow('folders','name','id',$folderId) ?>">
										</span>                
									</td>
									<td>
										<?php
											$date = preg_split('/\s+/', $db->selectNow('folders','dateCreated','id',$folderId));
											echo $db->formatDate($date[0]);
										 ?>
									</td>  	
						  <td>
							<button id="renameFolderBtn<?= $folderId ?>" class="btn btn-default" >
								<i class="icon-pencil"></i>
							 </button>     
							<button id="renameFolderNow<?= $folderId ?>" class="btn btn-default">OK >> </button>
							  
						  </td>				
								</tr>
							<?php endforeach; ?>

					<?php endif; ?>

					<?php if($file->getUserFiles_files() != ""): ?>
						<?php foreach($file->getUserFiles_files() as $fileId): ?>
							<tr>
								<td>
						  <span id="spanFile<?= $fileId ?>">
									  <?= $db->selectNow('files','name','id',$fileId) ?>
						  </span>
						  <span id="editSpan<?= $fileId ?>">
							<?php
							  $onlyName = preg_split("/[.]/" , $db->selectNow('files','name','id',$fileId));
							?>
							<input type="hidden" id="editTextbox<?= $fileId ?>" value="<?= $onlyName[0] ?>">
						  </span>
								</td>
								<td>
									<?php
										$date = preg_split('/\s+/', $db->selectNow('files','dateAdded','id',$fileId));
										echo $db->formatDate($date[0]);
									 ?>
								</td>
						<td>
							<button id="renameBtn<?= $fileId ?>" class="btn btn-default"><i class="icon-pencil"></i></button>
						  <button id="renameNow<?= $fileId ?>" class="btn btn-default">OK >> </button>
						  <button class="btn btn-default"><a href="<?= $db->selectNow('files','location','id',$fileId) ?>" download><i class="icon-download"></i></a></button>
						  <button id="deleteBtn<?= $fileId ?>" class="btn btn-default">
							<i class="icon-trash"></i>
							</button>
						</td>
							</tr>
						<?php endforeach; ?>

					<?php endif; ?>

					</tbody>					
				</table>		
				
				
		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>
		
		<div class="clearfix"></div>
		<hr>
		
		<footer>
			<p class="pull-right">0MB of 100GB used</p>
			<p class="pull-left">Powered by: <a href="" target="_blank">CodeTech</a></p>

		</footer>
				
	</div><!--/.fluid-container-->

	
</body>
</html>
