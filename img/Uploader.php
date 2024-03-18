<?php
    $FileName=$_FILES['furesume']['name'];
    $TmpName=$_FILES['furesume']['tmp_name'];

    move_uploaded_file($TmpName, $FileName);
    echo("File uploaded successfully");
?> 