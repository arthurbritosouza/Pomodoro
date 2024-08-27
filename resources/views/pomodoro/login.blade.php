<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
  body {
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #ececec;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .login-container {
    width: 350px;
    padding: 40px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
  }

  .login-container h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
    font-size: 24px;
    font-weight: bold;
  }

  .login-container form {
    display: flex;
    flex-direction: column;
  }

  .login-container form input {
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s;
  }

  .login-container form input:focus {
    outline: none;
    border-color: #007bff;
  }

  .login-container form button {
    padding: 12px;
    border: none;
    border-radius: 8px;
    background-color: #007bff;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-weight: bold;
  }

  .login-container form button:hover {
    background-color: #0056b3;
  }

  .login-container .actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 15px;
  }

  .criar-conta {
    text-decoration: none;
    color: #007bff;
    font-weight: 500;
    transition: color 0.3s ease;
  }

  .criar-conta:hover {
    color: #0056b3;
  }
</style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form action="login_user" method="POST">
      @csrf
      <input type="email" name="email" placeholder="Email" required>
      <div class="actions">
        <a class="criar-conta" href="/cadastro">Cadastrar conta</a>
        <button type="submit">Entrar</button>
      </div>
    </form>
  </div>
</body>
</html>
