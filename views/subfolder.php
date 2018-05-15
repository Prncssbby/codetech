<?php
	require "../session/session.php";
	require "../vendor/autoload.php";

	$folderId = $_GET['folderId'];

	use Codetech\database;
	use Codetech\folders;
	use Codetech\files;

	$db = new database;
	$folder = new folders;
	$file = new files;


	$folder->getUserFolders($_SESSION['userId'],$folderId,'dateCreated');
	$file->getUserFiles($_SESSION['userId'],$folderId,'dateAdded');

	$folderName = $db->selectNow('folders','name','id',$folderId);


	$_SESSION['currentPath'] = $folderName;
	$location = $db->selectNow('folders','location','id',$folderId);

?>

<!DOCTYPE html>
<html>
	<head>
	  <meta charset="UTF-8">
	  <title>CodeTech</title>
		<meta name="description" content="CodeTech">
		<meta name="author" content="Princess">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<link id="bootstrap-style" href="../assets/css/bootstrap.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="../assets/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="../assets/css/style-responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
		
		<link rel="shortcut icon" href="header.ico">
	 
	<script src="http://localhost/codetech/assets/jquery.min.js"></script>
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
				$('#editFolderTextbox<?= $folderId ?>').hide();
				$('#renameFolderNow<?= $folderId ?>').hide();

				$('#renameFolderBtn<?= $folderId ?>').click(function(){
				  $('#spanFolder<?= $folderId ?>').hide();
				  $('#editSpanFolder<?= $folderId ?>').show();
				  $('#editFolderTextbox<?= $folderId ?>').show();

				  $('#renameFolderBtn<?= $folderId ?>').hide();
				  $('#renameFolderNow<?= $folderId ?>').show();
				});

			  $('#renameFolderNow<?= $folderId ?>').click(function(){
				$.post("renameFolder.php",{folderId:<?= $folderId ?>, name:$('#editFolderTextbox<?= $folderId ?>').val() },function(){
				  $('#editSpanFolder<?= $folderId ?>').hide();
				  $('#spanFolder<?= $folderId ?>').show();
				  location.reload();
				});
			  });
		  <?php endforeach; ?>
		<?php endif ?>

		<?php if($file->getUserFiles_files() > 0): ?>
	        <?php foreach($file->getUserFiles_files() as $fileId): ?>
	          $('#editSpan<?= $fileId ?>').hide();
	          $('#renameNow<?= $fileId ?>').hide();

	          $('#renameBtn<?= $fileId ?>').click(function(){
	            $('#spanFile<?= $fileId ?>').hide();
	            $('#renameBtn<?= $fileId ?>').hide();
	            $('#editSpan<?= $fileId ?>').show();
	            $('#renameNow<?=$fileId ?>').show();
	          });

	          $('#renameNow<?= $fileId ?>').click(function(){
	            $.post("renameFile.php",{fileId:<?= $fileId ?>, name:$('#editTextbox<?= $fileId ?>').val() },function(){
	              $('#editSpan<?= $fileId ?>').hide();
	              $('#spanFile<?= $fileId ?>').show();
	              location.reload();
	            });
	          });
	        <?php endforeach; ?>
	    <?php endif; ?>

	  	});
	  </script>

	</head>
	<body>
		<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index-new.php"><span>CodeTech</span></a>
								
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

					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- end: Main Menu -->
			
			
			<div id="content" class="span10">
			<!-- start: Content -->

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
						<a href="#">File Storage</a> <span class="divider">/</span>
						<?php
								$folderLocation = $db->selectNow('folders','location','id',$_GET['folderId']);
								$locationSplitted = preg_split ("/\//", $folderLocation);
							


							for($x = 1; $x < count($locationSplitted); $x++ ){
								echo "<a>".$locationSplitted[$x]."</a> <span class='divider'>/</span> ";
							}
								
							?>
					</li>
						
				</ul>
			</div>
	
	<button id="createFolder" class="btn btn-default">+ New Folder</button>
	<form method="POST" action="createFolder.php">
		<input type="hidden" name="returnPage" value="subfolder.php?folderId=<?= $_GET['folderId'] ?>">
		<!-- <input type="hidden" name="location" value="uploads/<?= $folderName ?>/"> -->
		<input type="hidden" name="location" value="<?= $db->selectNow('folders','location','id',$_GET['folderId']) ?>/">
		<input type="hidden" name="parentId" value="<?= $_GET['folderId'] ?>">
		<input type="text" id="folderName" name="folderName" placeholder="Enter Folder Name" autocomplete="off">
		<input type="submit" id="createFolderBtn" value="Create Folder">
	</form>

  <form enctype="multipart/form-data" action="upload.php" method="POST">
    <p>Upload your file</p>
	<input type="hidden" name="returnPage" value="subfolder.php?folderId=<?= $_GET['folderId'] ?>">
    <input type="hidden" name="folderId" value="<?php echo $_GET['folderId'] ?>/">
   <!--  <input type="hidden" name="location" value="<?php echo $location ?>/"> -->
   <input type="hidden" name="location" value="<?= $db->selectNow('folders','location','id',$_GET['folderId']) ?>/">
    <input type="file" name="uploaded_file"></input><br />
    <input class="btn btn-primary" type="submit" value="Upload"></input>
  </form>

  	<?php
  	/*	if(isset($_SESSION['uploadMessage'])) {
  			echo $_SESSION['uploadMessage'];
  		}*/

  	?>

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
							 				 <input type="text" id="editFolderTextbox<?= $folderId ?>" value="<?= $db->selectNow('folders','name','id',$folderId) ?>">
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
							<input type="text" id="editTextbox<?= $fileId ?>" value="<?= $onlyName[0] ?>">
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
			<p class="pull-right">34MB of 100GB used</p>
			<p class="pull-left">Powered by: <a href="" target="_blank">CodeTech</a></p>

		</footer>
				
	</div><!--/.fluid-container-->


	</body>
</html>