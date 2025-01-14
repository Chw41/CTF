<?php
require_once 'config.php';
session_start();

if ($_SESSION['user_id']) {
  header('Location: dashboard.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Website</title>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    section {
      position: relative;
      min-height: 100vh;
      background-color: #f8dd30;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    section .container {
      position: relative;
      width: 800px;
      height: 500px;
      background: #fff;
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    section .container .user {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
    }

    section .container .user .imgBx {
      position: relative;
      width: 50%;
      height: 100%;
      background: #ff0;
      transition: 0.5s;
    }

    section .container .user .imgBx img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    section .container .user .formBx {
      position: relative;
      width: 50%;
      height: 100%;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px;
      transition: 0.5s;
    }

    section .container .user .formBx form h2 {
      font-size: 18px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 2px;
      text-align: center;
      width: 100%;
      margin-bottom: 10px;
      color: #555;
    }

    section .container .user .formBx form input {
      position: relative;
      width: 100%;
      padding: 10px;
      background: #f5f5f5;
      color: #333;
      border: none;
      outline: none;
      box-shadow: none;
      margin: 8px 0;
      font-size: 14px;
      letter-spacing: 1px;
      font-weight: 300;
    }

    section .container .user .formBx form input[type='submit'] {
      max-width: 100px;
      background: #677eff;
      color: #fff;
      cursor: pointer;
      font-size: 14px;
      font-weight: 500;
      letter-spacing: 1px;
      transition: 0.5s;
    }

    section .container .user .formBx form .signup {
      position: relative;
      margin-top: 20px;
      font-size: 12px;
      letter-spacing: 1px;
      color: #555;
      text-transform: uppercase;
      font-weight: 300;
    }

    section .container .user .formBx form .signup a {
      font-weight: 600;
      text-decoration: none;
      color: #677eff;
    }

    section .container .signupBx {
      pointer-events: none;
    }

    section .container.active .signupBx {
      pointer-events: initial;
    }

    section .container .signupBx .formBx {
      left: 100%;
    }

    section .container.active .signupBx .formBx {
      left: 0;
    }

    section .container .signupBx .imgBx {
      left: -100%;
    }

    section .container.active .signupBx .imgBx {
      left: 0%;
    }

    section .container .signinBx .formBx {
      left: 0%;
    }

    section .container.active .signinBx .formBx {
      left: 100%;
    }

    section .container .signinBx .imgBx {
      left: 0%;
    }

    section .container.active .signinBx .imgBx {
      left: -100%;
    }

    @media (max-width: 991px) {
      section .container {
        max-width: 400px;
      }

      section .container .imgBx {
        display: none;
      }

      section .container .user .formBx {
        width: 100%;
      }
    }
  </style>
  <script>
    const toggleForm = () => {
      const container = document.querySelector('.container');
      container.classList.toggle('active');
    };
  </script>
</head>

<body>
  <section>
    <div class="container">
      <div class="user signinBx">
        <div class="imgBx"><img
            src="https://raw.githubusercontent.com/WoojinFive/CSS_Playground/master/Responsive%20Login%20and%20Registration%20Form/img1.jpg"
            alt="" /></div>
        <div class="formBx">
          <form id="loginForm" onsubmit="actionHandler(event, 'login')">
            <h2>Sign in</h2>
            <input type="text" id="loginUsername" name="username" placeholder="Username" />
            <input type="password" id="loginPassword" name="password" placeholder="Password" />
            <input type="submit" value="Sign In" />
            <p class="signup">
              Don't have an account?
              <a href="#" onclick="toggleForm();">Sign up.</a>
            </p>
          </form>
        </div>
      </div>
      <div class="user signupBx">
        <div class="formBx">
          <form id="registerForm" onsubmit="actionHandler(event, 'register')">
            <h2>Create an account</h2>
            <input type="text" id="username" name="username" placeholder="Username" />
            <input type="password" id="password" name="password" placeholder="Create Password" />
            <input type="submit" value="Sign Up" />
            <p class="signup">
              Already have an account ?
              <a href="#" onclick="toggleForm();">Sign in.</a>
            </p>
          </form>
        </div>
        <div class="imgBx"><img
            src="https://raw.githubusercontent.com/WoojinFive/CSS_Playground/master/Responsive%20Login%20and%20Registration%20Form/img2.jpg"
            alt="" /></div>
      </div>
    </div>
  </section>
</body>
<script>
  function actionHandler(event, action) {
    event.preventDefault(); // 阻止表單提交的默認行為

    // 根據 action 來取得相應的輸入值
    const username = action === 'register' ? document.getElementById('username').value : document.getElementById('loginUsername').value;
    const password = action === 'register' ? document.getElementById('password').value : document.getElementById('loginPassword').value;

    // 組裝資料
    const params = new URLSearchParams();
    params.append('action', action);
    params.append('username', username);
    params.append('password', password);

    // 發送POST請求
    fetch('/user.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: params.toString()
    })
      .then(response => response.text())
      .then(data => {
        // 處理伺服器回應
        alert(data);
        location.reload();
        // 根據回應做出相應的操作，例如顯示訊息或重定向
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  }
</script>

</html>