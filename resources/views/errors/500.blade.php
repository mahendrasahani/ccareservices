<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Internal Server Error</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Arial", sans-serif;
        }

        body {
            background-color: #121212;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            max-width: 600px;
        }

        h1 {
            font-size: 5rem;
            font-weight: bold;
            animation: glitch 1s infinite alternate;
        }

        @keyframes glitch {
            0% { text-shadow: 2px 2px red; }
            50% { text-shadow: -2px -2px cyan; }
            100% { text-shadow: 2px -2px lime; }
        }

        p {
            font-size: 1.5rem;
            margin: 10px 0 20px;
        }

        .btn {
            display: inline-block;
            background: #ff4757;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 1.2rem;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn:hover {
            background: #ff6b81;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>500</h1>
        <p>Oops! Something went wrong. Please try again Later.</p>
        <a href="/" class="btn">Go Home</a>
    </div>
</body>
</html>
