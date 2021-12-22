<?php
    $currentDir = getcwd();
    $uploadDirectory = "/../uploads/";
    $msg = [];
    $fileExtensions = ['jpeg','jpg','png','pdf','zip','odt','ods']; // Get all the file extensions

    $fileName = $_FILES['documento']['name'];
    $fileSize = $_FILES['documento']['size'];
    $fileTmpName  = $_FILES['documento']['tmp_name'];
    $fileType = $_FILES['documento']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));
    $hoy=date("Y-m-d");
    $uploadPath = $currentDir.$uploadDirectory.$hoy."_".basename($fileName);
    if (! in_array($fileExtension,$fileExtensions)) {
        $msg[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 20000000) {
        $msg[] = "This file is more than 20MB. Sorry, it has to be less than or equal to 20MB";
    }

    if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        $msg[] = "Estamos ok!";
    }
    //move_uploaded_file($fileTmpName, $uploadPath);

    echo json_encode(array("msg"=>$msg,));

?>
