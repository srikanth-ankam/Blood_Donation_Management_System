<!DOCTYPE html>
<html>
<head>
  <title>Donor Login - LifeSaver</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f2f2f2;
      padding: 30px;
      margin: 0;
    }

    .login-box {
      width: 400px;
      margin: 50px auto 20px auto;
      background: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #c82333;
    }

    input[type="email"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="submit"] {
      width: 100%;
      background-color: #c82333;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #a71d2a;
    }

    .home-link {
      text-align: center;
      margin-top: 20px;
    }

    .home-link a {
      text-decoration: none;
      color: #c82333;
      font-weight: bold;
      padding: 8px 16px;
      border: 2px solid #c82333;
      border-radius: 5px;
      transition: background 0.3s;
    }

    .home-link a:hover {
      background: #c82333;
      color: #fff;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h2>Donor Login</h2>
    <form action="php/donor_auth.php" method="POST">
      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <input type="submit" value="Login">
    </form>
    <div class="home-link">
      <a href="index.php">🏠 Go Home</a>
    </div>
  </div>

  

</body>
</html>
