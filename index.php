<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>img</title>
</head>

<body>

	<form action="?upload=1" method="post" enctype="multipart/form-data">
		Select image to upload:
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Upload Image" name="submit">
	</form>

	<?php
	if(isset($_POST["submit"])) {
		$file = $_FILES["fileToUpload"];

		$tempFile = $file['tmp_name'];
		$targetPath = "files/";
		$targetFile =  $targetPath . $file['name'];
		$url = "http".(!empty($_SERVER['HTTPS'])?"s":"").
		"://".$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME'])."/";
		if (move_uploaded_file($tempFile,$targetFile))
		{
			echo('file upload OK:
			<br />
			<img src="'.$targetFile.'"/>
			');
			echo('<script>
			window.prompt("Copy link to clipboard: Ctrl+C, Enter", "'.$url.$targetFile.'");
			</script>
			');
		}
		else
		{
			if ($file["error"] == "1") // UPLOAD_ERR_INI_SIZE
			{
				echo ('ERROR: The uploaded file exceeds the upload_max_filesize directive in php.ini.');
			}
			else
			{
				echo('ERROR: '.$file["error"]);
			}
		}
	}
	?>

</body>

</html>
