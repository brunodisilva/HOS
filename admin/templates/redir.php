

  include_once ("../../admin/authconfig.php");

  $SUBMIT_FORM_VARS = array_merge($HTTP_POST_VARS,$HTTP_GET_VARS);
 
  if (isset($SUBMIT_FORM_VARS["filename"])){
    $filename = $SUBMIT_FORM_VARS["filename"];
  }
  else{
	  echo "<meta http-equiv=\"refresh\" content=\"0; URL=$url_root/forbidden.php\">";
	  exit;	
  }

	$group_num = $_COOKIE['access_num'];
	$flag=0;
	for ($i=0;$i<$group_num;$i++) {
	$gname="access_".$i;
	$group = $_COOKIE[$gname];
	if ($group==$curgroup) {$flag=1;}
	}
	if ($flag==0) { //no access to this folder
	  echo "<meta http-equiv=\"refresh\" content=\"0; URL=$url_root/forbidden.php\">";
	  exit;	
	}  
  
  $supportedExtensionsArray = array(array(".asf","video/x-ms-asf",1),
array(".asp","text/asp",0),
array(".asx","video/x-ms-asf",1),
array(".au","audio/basic",1),
array(".avi","video/avi",1),
array(".bm","image/bmp",0),
array(".bmp","image/bmp",0),
array(".css","text/css",0),
array(".doc","application/msword",1),
array(".eps","application/postscript",1),
array(".exe","application/octet-stream",1),
array(".gif","image/gif",0),
array(".gz","application/x-gzip",1),
array(".gzip","application/x-gzip",1),
array(".htm","text/html",0),
array(".html","text/html",0),
array(".htmls","text/html",0),
array(".ico","image/x-icon",0),
array(".jpe","image/jpeg",0),
array(".jpeg","image/jpeg",0),
array(".jpg","image/jpeg",0),
array(".js","application/x-javascript",1),
array(".lsp","application/x-lisp",1),
array(".mid","audio/midi",1),
array(".midi","audio/midi",1),
array(".mod","audio/mod",1),
array(".mov","video/quicktime",1),
array(".mp3","audio/mpeg3",1),
array(".mp3","video/mpeg",1),
array(".mpeg","video/mpeg",1),
array(".mpg","audio/mpeg",1),
array(".mpg","video/mpeg",1),
array(".pdf","application/pdf",0),
array(".pic","image/pict",0),
array(".pict","image/pict",0),
array(".pl","text/plain",0),
array(".png","image/png",0),
array(".ppt","application/mspowerpoint",1),
array(".ppt","application/powerpoint",1),
array(".ps","application/postscript",1),
array(".psd","application/octet-stream",1),
array(".qt","video/quicktime",1),
array(".ra","audio/x-realaudio",1),
array(".ram","audio/x-pn-realaudio",1),
array(".rm","audio/x-pn-realaudio",1),
array(".rmi","audio/mid",1),
array(".rtf","text/richtext",1),
array(".shtml","text/html",0),
array(".shtml","text/x-server-parsed-html",0),
array(".swf","application/x-shockwave-flash",1),
array(".text","text/plain",0),
array(".tgz","application/x-compressed",1),
array(".tif","image/tiff",0),
array(".tiff","image/tiff",0),
array(".txt","text/plain",0),
array(".vsd","application/x-visio",1),
array(".wav","audio/wav",1),
array(".word","application/msword",1),
array(".wp","application/wordperfect",1),
array(".wri","application/mswrite",1),
array(".xls","application/excel",1),
array(".xml","text/xml",0),
array(".zip","application/zip",1));

  for ($i=0; $i<count($supportedExtensionsArray); $i++){
    
    $extension = $supportedExtensionsArray[$i][0];
    $contentType = $supportedExtensionsArray[$i][1];
    $download = $supportedExtensionsArray[$i][2];

    $extensionLength = strlen($extension);
    $fileExtension = substr($filename,
                            (strlen($filename) - $extensionLength), 
                            strlen($extension));
    
    if (strtolower($fileExtension) == $extension &&
        file_exists($filename)){

      header("Content-type: " . $contentType);
      	
	if ($download){
	header("Content-Disposition: attachment; filename=" . $filename); 
	}
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

readfile($filename);
      //echo file_get_contents($filename);
      exit();
  	  }    
 	 }
	  echo "<meta http-equiv=\"refresh\" content=\"0; URL=$url_root/forbidden.php\">";
	  exit;	
?>