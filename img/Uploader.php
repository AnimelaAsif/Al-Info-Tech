<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["Upload"])) {
    $targetDir = __DIR__ . '/';
    $fileName = basename($_FILES["Upload"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    if (move_uploaded_file($_FILES["Upload"]["tmp_name"], $targetFilePath)) {
        $output = shell_exec("bash push_image.sh " . $targetFilePath);
        echo "File uploaded successfully and script executed.";
    } else {
        echo "Error uploading file.";
    }
}
?>