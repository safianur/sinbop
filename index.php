<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();

    if($_SESSION['level_user'] == "Admin"){
        header("Location: dashboard.php");
    } elseif($_SESSION['level_user'] == "User"){
        header("Location: dashboard.php");
    }else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Keuangan Perwakilan Banyuwangi</title>
	<link rel="shortcut icon" type="image/x-icon" href="./assets/images/logo/Tram-Baterai.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: url(assets/images/backgrounds/keyeta-nih-3.png) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            /* background:rgba(0, 0, 0, 0.5); */
            /* background-color: #C2DED1; */
            height: 410px;
            margin: auto;
            width: 329px;
            min-height: 100vh;
            background-position: center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            opacity: 0.9;
            width: 400px;
            min-height: 300px;
            background: #FFF;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0,0,0,.3);
            padding: 40px 30px;
        }

        .avatar {
            width: 100px;
            height: 35px;
            /* border-radius: 50%; */
            position: absolute;
            top: 160px;
            left: calc(50% - 50px);
        }

        .container .login-text {
            color: #111;
            font-weight: 500;
            font-size: 1.1rem;
            text-align: center;
            margin-top: 40px;
            margin-bottom: 20px;
            display: block;
            text-transform: capitalize;
        }
        
        .container .login-username .input-group {
            width: 100%;
            height: 50px;
            margin-bottom: 25px;
        }
        
        .container .login-username .input-group input {
            width: 100%;
            height: 100%;
            border: 2px solid #e7e7e7;
            padding: 15px 20px;
            font-size: 1rem;
            border-radius: 30px;
            background: transparent;
            outline: none;
            transition: .3s;
        }
        
        .container .login-username .input-group input:focus, .container .login-username .input-group input:valid {
            border-color: #47B5FF;
        }
        
        .container .login-username .input-group .btn {
            display: block;
            width: 35%;
            padding: 10px 15px;
            text-align: center;
            border: none;
            background: #4e73df;
            outline: none;
            margin: 0 auto;
            border-radius: 30px;
            font-size: 1.2rem;
            color: #FFF;
            cursor: pointer;
            transition: .3s;
        }
        
        .container .login-username .input-group .btn:hover {
            transform: translateY(-5px);
            background: #47B5FF;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST" class="login-username">
            <img src="assets/images/logo/Logo-INKA.png" class="avatar">
            <p class="login-text" style="font-size: 150%; font-weight: 790;">Silahkan LogIn</p>
            <div class="input-group">
                <input type="text" placeholder="username" name="username" autocomplete="off" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="password" name="password" autocomplete="off" required>
            </div>
            <div class="input-group">
                <button type="submit" name="submit" class="btn">LogIn</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php } ?>