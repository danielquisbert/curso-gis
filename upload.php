<?php

define("UPLOAD_DIR", "/var/www/curso-gis/uploads/");

if (!empty($_FILES["myFile"])) {

    $myFile = $_FILES["myFile"];
    $fileCount = count($myFile["name"]);

for ($i = 0; $i < $fileCount; $i++) {

    if ($myFile["error"][$i] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }
    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"][$i]);
    // don't overwrite an existing file
    $j = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $j++;
        $name = $parts["filename"] . "-" . $j . "." . $parts["extension"];
    }
    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"][$i],
        UPLOAD_DIR . $name);
    if (!$success) {
        echo "<p>Unable to save file.</p>";
        exit;
    }
    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $name, 0644);
    header("Location: http://192.168.43.69/curso-gis/visor.html");
}
}
else
echo "archivo vacío!";
?>
