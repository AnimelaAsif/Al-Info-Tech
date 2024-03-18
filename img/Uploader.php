<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["Upload"])) {
    // Directory of the current PHP script
    $targetDir = dirname(__FILE__) . '/';
    // File name
    $fileName = basename($_FILES["Upload"]["name"]);
    // File path
    $targetFilePath = $targetDir . $fileName;

    // Upload file to server
    if (move_uploaded_file($_FILES["Upload"]["tmp_name"], $targetFilePath)) {
        shell_exec("git add $fileName");
        shell_exec("git commit -m 'Uploaded $fileName'");
        shell_exec("git push https://animelaasif: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@github.com/animelaasif/Al-Info-Tech.git");
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file.";
    }
}
?>
