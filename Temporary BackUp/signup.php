<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Login</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background: linear-gradient(135deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9)), url('background.jpg');
      background-size: cover;
      color: white;
    }

    .login-container {
      background-color: rgba(255, 255, 255, 0.15);
      padding: 40px 30px;
      border-radius: 15px;
      text-align: center;
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.5);
      width: 320px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-container:hover {
      transform: scale(1.05);
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.8);
    }

    h2 {
      margin-bottom: 20px;
      font-size: 24px;
      color: #00ccff;
      letter-spacing: 1px;
    }

    input {
      width: 85%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 30px;
      border: none;
      background-color: rgba(255, 255, 255, 0.2);
      color: white;
      font-size: 16px;
      outline: none;
      transition: background-color 0.3s ease;
    }

    input::placeholder {
      color: #d3d3d3;
    }

    input:focus {
      background-color: rgba(255, 255, 255, 0.4);
    }

    button {
      padding: 12px 25px;
      background-color: #00ccff;
      color: white;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button:hover {
      background-color: #008cba;
      transform: translateY(-2px);
    }

    button:active {
      background-color: #007a99;
      transform: translateY(1px);
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Doctor Registration</h2>
    <form action="process_registration.php" method="POST">
      <input type="text" id="username" name="username" placeholder="Username" required>
      <input type="password" id="password" name="password" placeholder="Password" required>
      <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter Password" required>
      <button type="submit" name="register">Register</button>
    </form>
  </div>
  
</body>
</html>
