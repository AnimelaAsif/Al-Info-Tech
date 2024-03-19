<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["Upload"])) {
    $targetDir = dirname(__FILE__) . '/';
    $fileName = basename($_FILES["Upload"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["Upload"]["tmp_name"], $targetFilePath)) {
        $output1 = shell_exec("sh image-list.sh 2>&1");
        $output2 = shell_exec("sh modify-images-file.sh 2>&1");
        shell_exec("git add .");
        shell_exec("git commit -m 'Uploaded $fileName'");
        shell_exec("git push https://animelaasif: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@github.com/animelaasif/Al-Info-Tech.git");
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file.";
    }
}
?>
