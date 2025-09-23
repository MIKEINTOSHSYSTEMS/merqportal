<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Evaluation Closed | MERQ Consultancy</title>
    <link rel="icon" type="image/x-icon" href="/assets/images/merq-logo.png">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3c72, #000717);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
            overflow: hidden;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            animation: fadeIn 2s ease-in-out;
            max-width: 600px;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 15px;
            animation: pulse 2s infinite;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .highlight {
            color: #ffd369;
            font-weight: bold;
            animation: glow 2s ease-in-out infinite alternate;
        }

        .emoji {
            font-size: 4em;
            display: block;
            animation: bounce 2s infinite;
        }

        .clock {
            font-size: 3em;
            margin-top: 15px;
            animation: rotate 4s linear infinite;
            display: inline-block;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                color: #ffdddd;
            }

            50% {
                color: #ff6b6b;
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 5px #ffd369, 0 0 10px #ffd369;
            }

            to {
                text-shadow: 0 0 15px #ffeb99, 0 0 25px #ffd369;
            }
        }

        footer {
            margin-top: 20px;
            font-size: 0.9em;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="container">
        <span class="clock"><img src="/assets/images/merq-logo.png" width="47px"></img></span>
        <p><strong>Thank You for Stopping By</strong><br>
            <span class="emoji">😢</span>
        <h1>Sorry!</h1>
        <b>WE ARE NOT</b> Accepting Any Evaluations currently!</p>
        <p>Please Try again within the Evaluation Periods!</p>
        <p class="highlight">💡 You will still be getting evaluation feedback and comments from your Supervisors and SMT.</p>
        <span class="clock">⏰</span>
        <footer>Thank You!</footer>
    </div>
</body>

</html>