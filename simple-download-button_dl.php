<?php
	/* Admin Settings*/
	// download files containing dir	
	$download_dir	= dirname(__FILE__). '/download/';

	/* GET param */
	$filename = $_GET['file'];
	if(!$filename){ die("ERROR: a file name to download is not set!"); }
	
	$download_filepath = $download_dir. $filename;
	
	// set a file name showed in the dialog box.
	if(!$dispname){$dispname = $filename;}
	mb_convert_encoding($dispname, "UTF-8");

	/* set the Content-type depends on the extention */
	if (!file_exists($download_filepath)) {
		die("ERROR: There is not shuch file. Please hit the back button to return.");
	}else{
		$file_info = pathinfo($download_filepath);
		$ext = strtolower($file_info["extension"]);
		switch ($ext) {
			case "pdf":
				header("Content-type: application/pdf");
				break;
			case "txt":
				header("Content-type: text/plain");
				break;
			case "csv":
				header("Content-type: text/csv");
				break;
			case "doc":
				header("Content-type: application/msword");
				break;
			case "xls":
				header("Content-type: application/vnd.ms-excel");
				break;
			case "html":
			case "htm":
				header("Content-type: text/html");
				break;
			case "css":
				header("Content-type: text/css");
				break;
			case "js":
				header("Content-type: text/javascript");
				break;
			case "jpg":
			case "jpeg":
				header("Content-type: image/jpeg");
				break;
			case "png":
				header("Content-type: image/png");
				break;
			case "gif":
				header("Content-type: image/gif");
				break;
			case "zip":
				header("Content-type: application/zip");
				break;
			case "lha":
			case "lzh":
				header("Content-type: application/x-lzh");
				break;
			default;
			header("Content-type: application/octet-stream");
		}
		header("Content-Disposition: attachment; filename=$filename");
		header('Content-Length: '.filesize($download_filepath));

		readfile($download_filepath);
		exit;
	}
?>
