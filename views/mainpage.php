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
<html>
	<head>
	  <meta charset="UTF-8">
	  <title>CodeTech</title>
	   <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
	  	<script src="../assets/jquery.min.js"></script>
		<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
 
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
        <?php endif; ?>

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
			
		  $('#deleteBtn<?= $fileId ?>').click(function(){
		  
			$.post("deleteFile.php",{fileId:<?= $fileId ?>},function(){
              location.reload();
            });
		  });
			
        <?php endforeach; ?>

	  	});
	  </script>

    <style>
      tr:hover {
        background-color:yellow;
      }
    </style>

	</head>
	<body>
		<h1>Welcome <?= $db->selectNow('users','username','id',$_SESSION['userId']) ?></h1>
		<a href="../session/logout.php">Logout</a>

	<br>
	<br>
	<a href="#" id="createFolder">+ New Folder</a>
	<form method="POST" action="createFolder.php">
    <input type="hidden" name="returnPage" value="mainpage.php">
		<input type="text" id="folderName" name="folderName" placeholder="Enter Folder Name">
		<input type="submit" id="createFolderBtn" value="Create Folder">
	</form>

  <form enctype="multipart/form-data" method="POST" action="upload.php">
    <p>Upload your file</p>
	<input type="hidden" name="returnPage" value="mainpage.php">
    <input type="hidden" name="location" value="uploads/">
    <input type="file" name="uploaded_file"></input><br />
    <input class="btn btn-primary" type="submit" value="Upload"></input>
  </form>

  	<?php
  		/*if(isset($_SESSION['uploadMessage'])) {
  			echo $_SESSION['uploadMessage'];
  		}*/
  	?>

  	<table width="40%">
  		<thead>
  			<tr>
  				<th>Name</th>
  				<th>Added</th>
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
        						<Font color=red>
                      <?= $db->selectNow('folders','name','id',$folderId) ?>
                    </Font>
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
                <button id="renameFolderBtn<?= $folderId ?>">Rename</button>     
                <button id="renameFolderNow<?= $folderId ?>">OK >> </button>           
              </td>				
    				</tr>
    			<?php endforeach; ?>

        <?php endif; ?>
			
			
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
              <button id="renameBtn<?= $fileId ?>">Rename</button>
              <button id="renameNow<?= $fileId ?>">OK >> </button>
              <a href="<?= $db->selectNow('files','location','id',$fileId) ?>" download>Download</a>
				<button id="deleteBtn<?= $fileId ?>">Delete</button>
			</td>
  				</tr>
  			<?php endforeach; ?>
  		</tbody>
  	</table>

	</body>
</html>