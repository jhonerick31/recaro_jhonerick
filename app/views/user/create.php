<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create User</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Poppins", sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: #0d0d0d;
      color: #00ff88;
    }

    .form-container {
      background: rgba(0, 0, 0, 0.85);
      border: 1px solid #00ff88;
      border-radius: 15px;
      padding: 40px;
      width: 350px;
      color: #00ff88;
      box-shadow: 0 0 25px rgba(0, 255, 136, 0.3);
      animation: fadeIn 0.8s ease;
    }

    .form-container h1 {
      text-align: center;
      margin-bottom: 25px;
      font-size: 24px;
      color: #00ff88;
      text-shadow: 0 0 8px #00ff88;
      letter-spacing: 1px;
    }

    label {
      font-weight: 500;
      display: block;
      margin-bottom: 6px;
      font-size: 14px;
      color: #00ff88;
    }

    input[type="text"], input[type="email"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #00ff88;
      border-radius: 8px;
      margin-bottom: 18px;
      font-size: 14px;
      outline: none;
      background: #1a1a1a;
      color: #00ff88;
      transition: all 0.3s ease;
    }

    input[type="text"]:focus, input[type="email"]:focus {
      box-shadow: 0 0 10px #00ff88;
    }

    input[type="submit"] {
      width: 100%;
      padding: 12px;
      background: #00ff88;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      color: #0d0d0d;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    input[type="submit"]:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 15px #00ff88;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Create User</h1>
    <form method="post" action="">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" required>

      <label for="email">Email</label>
      <input type="email" name="email" id="email" required>

      <input type="submit" value="Create User">
    </form>
  </div>
</body>
</html>
