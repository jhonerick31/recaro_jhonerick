<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User/update</title>
    <style>
        body {
            font-family: 'Consolas', monospace;
            background: #000;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #00ff66;
            overflow: hidden;
        }

        .form-container {
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid #00ff66;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px #00ff66;
            width: 350px;
            animation: fadeIn 0.8s ease-in-out;
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 22px;
            color: #00ff66;
            text-shadow: 0px 0px 12px #00ff66;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            color: #00ff66;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #00ff66;
            border-radius: 6px;
            outline: none;
            background: #000;
            color: #00ff66;
            font-size: 15px;
            box-shadow: inset 0px 0px 6px #00ff66;
            transition: 0.3s;
        }

        input[type="text"]:focus, input[type="email"]:focus {
            box-shadow: 0px 0px 12px #00ff66;
            border-color: #00ffcc;
        }

        input[type="submit"] {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background: #000;
            color: #00ff66;
            font-size: 16px;
            font-weight: bold;
            border: 2px solid #00ff66;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0px 0px 10px #00ff66;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: #00ff66;
            color: #000;
            box-shadow: 0px 0px 20px #00ff66;
            transform: translateY(-2px);
        }

        /* Background Matrix effect */
        .matrix {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            overflow: hidden;
            z-index: -1;
        }

        canvas {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <!-- Matrix background -->
    <div class="matrix">
        <canvas id="matrixCanvas"></canvas>
    </div>

    <div class="form-container">
        <h1>Update User</h1>
        <form method="post" action="<?= site_url('user/update/'.$user['id']) ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?= html_escape($user['username']) ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= html_escape($user['email']) ?>" required>

            <input type="submit" value="Update User">
        </form>
    </div>

    <script>
        // Matrix effect
        const canvas = document.getElementById("matrixCanvas");
        const ctx = canvas.getContext("2d");

        canvas.height = window.innerHeight;
        canvas.width = window.innerWidth;

        const letters = "01";
        const fontSize = 14;
        const columns = canvas.width / fontSize;

        const drops = Array(Math.floor(columns)).fill(1);

        function draw() {
            ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.fillStyle = "#00ff66";
            ctx.font = fontSize + "px monospace";

            for (let i = 0; i < drops.length; i++) {
                const text = letters.charAt(Math.floor(Math.random() * letters.length));
                ctx.fillText(text, i * fontSize, drops[i] * fontSize);

                if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                    drops[i] = 0;
                }

                drops[i]++;
            }
        }

        setInterval(draw, 33);
    </script>
</body>
</html>
