<?php
// PHP code can go here for server-side logic if needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Municipality Government</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('images/bg.jpg'); /* Replace with your municipality background image */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background-color: rgba(248, 243, 243, 0.7); /* Semi-transparent background for readability */
            padding: 20px;
            border-radius: 10px;
        }
        .box {
            background-color: green; /* Bootstrap primary color */
            color: white;
            padding: 10px;
            margin: 20px 30px; /* Increased vertical margin for separation */
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .box:hover {
            background-color: black; /* Darker shade on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <img style="width: 120px; height: 120px; padding: 10px; display: inline-flex;" src="images/sibagat.png" alt="">
        <h1>Welcome to the Municipality of SIBAGAT, AGUSAN DEL SUR</h1>
        <h3>Here's the Plantilla processes:</h3>
        <div class="box" onclick="window.location.href='JO.php'">
            <h1>Job Order</h1>
            <p>Click here for Job Order Plantilla.</p>
        </div>
        <div class="box" onclick="window.location.href='index.php'">
            <h1>Contractual of Service</h1>
            <p>Click here for Contractual of Service Plantilla.</p>
        </div>
    </div>
</body>
</html>
