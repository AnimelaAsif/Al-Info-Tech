<?php include 'authentication.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Uploader</title>
    <link rel="icon" href="logo.png" type="image/jpg">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('logo.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .uploader {
            background-color: rgba(182, 195, 242, 0.656);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 90%;
        }
        .uploader h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        .uploader form {
            text-align: center;
        }
        .uploader input[type="file"] {
            display: none;
        }
        .uploader label {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin-bottom: 20px;
        }
        .uploader label:hover {
            background-color: #0056b3;
        }
        .uploader input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .uploader input[type="submit"]:hover {
            background-color: #218838;
        }
        #logout-btn {
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            background-color: #d9534f; /* Red color */
            color: #fff; /* White text */
            margin-top: 20px;
        }
        #logout-btn:hover {
            background-color: #c9302c; /* Darker red color on hover */
        }
        #remaining-time {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="uploader">
        <h2>Upload Your Files</h2>
        <form action="Uploader.php" method="post" enctype="multipart/form-data">
            <label for="Upload">Select Files</label>
            <input type="file" name="Upload" id="Upload" multiple onchange="displayFileNames()">
            <br>
            <input type="submit" value="Upload Files">
        </form>
        <p id="file-names"></p>
    </div>

    <!-- Logout button -->
    <button id="logout-btn" onclick="logout()">Logout</button>

    <!-- Display remaining time -->
    <div id="remaining-time"></div>

    <script>
        // JavaScript code for automatic logout after 5 minutes of inactivity
        let logoutTimer;

        function setLogoutTimer() {
            logoutTimer = setTimeout(function() {
                window.location.href = 'logout.php'; // Redirect to logout page
            }, 300000); // 5 minutes (300000 milliseconds)
        }

        document.addEventListener('mousemove', resetLogoutTimer);
        document.addEventListener('keypress', resetLogoutTimer);

        function resetLogoutTimer() {
            clearTimeout(logoutTimer);
            setLogoutTimer();
        }

        setLogoutTimer(); // Start the logout timer on page load

        // JavaScript function to display file names
        function displayFileNames() {
            var input = document.getElementById('Upload');
            var fileNames = '';
            for (var i = 0; i < input.files.length; i++) {
                fileNames += input.files[i].name + '<br>';
            }
            document.getElementById('file-names').innerHTML = 'Selected files: <br>' + fileNames;
        }

        // JavaScript function to handle logout
        function logout() {
            window.location.href = 'logout.php'; // Redirect to logout page
        }

        // JavaScript function to display remaining time
        function updateTimeRemaining() {
            let timeElement = document.getElementById('remaining-time');
            let secondRemaining = 300 - Math.floor((Date.now() - startTime) / 1000);

            if (secondRemaining <= 0) {
                timeElement.textContent = 'Session expired. Please log in again.';
            } else {
                let minutes = Math.floor(secondRemaining / 60);
                let seconds = secondRemaining % 60;
                timeElement.textContent = `Time remaining: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            }
        }

        let startTime = Date.now();
        setInterval(updateTimeRemaining, 1000);
    </script>
</body>
</html>
