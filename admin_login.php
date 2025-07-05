<!DOCTYPE html>
<html>
<head>
  <title>Admin Login - LifeSaver</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f1f1f1;
      padding: 50px;
    }
    .box {
      width: 400px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      color: #c82333;
      text-align: center;
    }
    input {
      width: 100%;
      padding: 12px;
      margin-top: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    input[type="submit"] {
      background-color: #c82333;
      color: white;
      cursor: pointer;
    }
    .home-btn {
      display: block;
      text-align: center;
      margin-top: 15px;
    }
    .home-btn a {
      color: #c82333;
      text-decoration: none;
      font-weight: bold;
    }
    .home-btn a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="box">
    <h2>Admin Login</h2>
    <form method="post" action="php/admin_auth.php">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
    </form>
    <div class="home-btn">
      <a href="index.php">🏠 Go Home</a>
    </div>
  </div>
</body>
</html>
