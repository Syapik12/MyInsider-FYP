<?php

include('dbconn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_GET['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $stmt1 = $conn->prepare('SELECT * FROM password_reset WHERE token = ?');
    $stmt1->bind_param('s', $token);
    $stmt1->execute();
    $result = $stmt1->get_result();
    $reset = $result->fetch_assoc();
    $stmt1->close();

    if($reset && $new_password === $confirm_password) {
        $stmt2 = $conn->prepare('UPDATE user SET Password = ? WHERE Email = ?');
        $stmt2->bind_param('ss', $new_password, $reset['email']);
        $stmt2->execute();
        $stmt2->close();

        $stmt3 = $conn->prepare('DELETE FROM password_reset WHERE token = ?');
        $stmt3->bind_param('s', $token);
        $stmt3->execute();
        $stmt3->close();

        header('Location: successreset.html');
    } else {
        echo 'Invalid token or password';
    }
}
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <script src="https://kit.fontawesome.com/3a97e832b5.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .wrapper{
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px;
        }

        .wrapper h1{
            font-size: 36px;
            text-align: center;
        }

        .wrapper .input-box{
            position: relative;
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }

        .input-box input{
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
        }

        .input-box input::placeholder{
            color: #fff;
        }

        .input-box i{
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
        }

        .wrapper .remember-forgot{
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: -15px 0 15px;
        }

        .remember-forgot label input{
            accent-color: #fff;
            margin-right: 3px;
        }

        .remember-forgot a{
            color: #fff;
            text-decoration: none;
        }

        .remember-forgot a:hover{
            text-decoration: underline;
        }

        .wrapper .btn{
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

        .wrapper .register-link{
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0 15px;
        }

        .register-link p a{
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link p a:hover{
            text-decoration: underline;
        }

        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1000;
        }

        .video-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(214, 204, 194, 0.2);
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensure the video covers the entire container */
        }
    </style>
    <body>
        <!-- Navigation Bar -->
    <header>
        <!-- Logo on the left -->
        <a class="brand" href="index.php"><img src="./lib/logo.png" alt="Logo"></a>
        <div class="menu-btn"></div>
        <!-- Items on the right -->
        <div class="navigation">
            <div class="navigation-items">
                <a href="SearchMap.php">Explore</a>
                <a href="signin.html">Sign In</a>
            </div>
        </div>
    </header>
        <div class="video-container">
            <video autoplay muted loop>
                <source src="https://firebasestorage.googleapis.com/v0/b/charismatic-fx-399402.appspot.com/o/bg3.mp4?alt=media&token=d3f91802-993a-4f84-814f-79d12d1fa57a" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="wrapper">
            <form action="resetpassword.php?token=<?php echo $_GET['token'] ?>" method="post">
                <div class="input-box">
                    <input type="password" name="new_password" placeholder="New password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="confirm_password" placeholder="Confirm password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <button type="submit" class="btn">Reset password</button>
            </form>
        </div>
    </body>
</html>
    