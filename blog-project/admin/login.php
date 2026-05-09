<?php
session_start();
include '../includes/db.php';

/* LOGIN */

if(isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM admins
              WHERE username='$username'
              AND password='$password'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {

        $_SESSION['admin'] = $username;

        header("Location: dashboard.php");
        exit();

    } else {

        $error = "Invalid Username or Password!";

    }
}

/* SIGN UP */

if(isset($_POST['signup'])) {

    $username = trim($_POST['signup_username']);
    $password = trim($_POST['signup_password']);
    $confirm_password = trim($_POST['confirm_password']);

    if($password != $confirm_password){

        $signup_error = "Passwords do not match!";

    } else {

        $check = mysqli_query($conn,
        "SELECT * FROM admins WHERE username='$username'");

        if(mysqli_num_rows($check) > 0){

            $signup_error = "Username already exists!";

        } else {

            mysqli_query($conn,
            "INSERT INTO admins(username,password)
             VALUES('$username','$password')");

            $signup_success = "Admin account created successfully!";

        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Authentication</title>

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            overflow:hidden;

            background:
            radial-gradient(circle at top left,#312e81 0%,transparent 30%),
            radial-gradient(circle at bottom right,#581c87 0%,transparent 30%),
            linear-gradient(135deg,#020617,#0f172a,#111827);

            position:relative;
        }

        /* Glow */

        .glow-1,
        .glow-2{

            position:absolute;
            border-radius:50%;
            filter:blur(70px);
            opacity:0.35;
            animation:floatGlow 7s ease-in-out infinite;

        }

        .glow-1{

            width:350px;
            height:350px;
            background:#6366f1;
            top:-80px;
            left:-80px;

        }

        .glow-2{

            width:300px;
            height:300px;
            background:#a855f7;
            bottom:-80px;
            right:-80px;
            animation-delay:2s;

        }

        @keyframes floatGlow{

            0%{
                transform:translateY(0px);
            }

            50%{
                transform:translateY(20px);
            }

            100%{
                transform:translateY(0px);
            }

        }

        /* Card */

        .auth-card{

            width:100%;
            max-width:480px;

            padding:45px;

            border-radius:30px;

            background:rgba(255,255,255,0.08);

            border:1px solid rgba(255,255,255,0.08);

            backdrop-filter:blur(18px);

            box-shadow:
            0 20px 50px rgba(0,0,0,0.45),
            0 0 30px rgba(99,102,241,0.12);

            position:relative;
            z-index:2;

            animation:cardFade 0.8s ease;

        }

        @keyframes cardFade{

            from{
                opacity:0;
                transform:translateY(30px);
            }

            to{
                opacity:1;
                transform:translateY(0);
            }

        }

        /* Logo */

        .logo-circle{

            width:85px;
            height:85px;

            border-radius:50%;

            margin:auto;
            margin-bottom:25px;

            display:flex;
            align-items:center;
            justify-content:center;

            background:
            linear-gradient(to right,#6366f1,#8b5cf6);

            color:white;
            font-size:2rem;

            box-shadow:
            0 10px 25px rgba(99,102,241,0.35);

        }

        /* Title */

        .title-box{

            text-align:center;
            margin-bottom:30px;

        }

        .title-box h2{

            font-size:2.3rem;
            font-weight:700;

            background:
            linear-gradient(to right,#818cf8,#c084fc);

            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;

            margin-bottom:10px;

        }

        .title-box p{

            color:#cbd5e1;
            font-size:0.95rem;

        }

        /* Tabs */

        .tab-buttons{

            display:flex;
            gap:10px;
            margin-bottom:25px;

        }

        .tab-btn{

            flex:1;
            border:none;
            padding:12px;

            border-radius:14px;

            background:rgba(255,255,255,0.06);

            color:white;

            transition:0.3s ease;

            cursor:pointer;

        }

        .tab-btn.active{

            background:
            linear-gradient(to right,#6366f1,#8b5cf6);

        }

        /* Forms */

        .form-box{
            display:none;
        }

        .form-box.active{
            display:block;
        }

        .input-group-custom{

            position:relative;
            margin-bottom:20px;

        }

        .input-group-custom i{

            position:absolute;
            left:18px;
            top:50%;
            transform:translateY(-50%);
            color:#94a3b8;
            z-index:2;

        }

        .form-control{

            background:rgba(255,255,255,0.07);

            border:1px solid rgba(255,255,255,0.06);

            border-radius:16px;

            padding:15px 15px 15px 50px;

            color:white;

        }

        .form-control::placeholder{

            color:#94a3b8;

        }

        .form-control:focus{

            background:rgba(255,255,255,0.1);

            border-color:#818cf8;

            box-shadow:
            0 0 0 4px rgba(99,102,241,0.15);

            color:white;

        }

        /* Buttons */

        .btn-auth{

            width:100%;

            border:none;

            padding:15px;

            border-radius:16px;

            background:
            linear-gradient(to right,#6366f1,#8b5cf6);

            color:white;

            font-weight:600;

            transition:0.35s ease;

            box-shadow:
            0 12px 24px rgba(99,102,241,0.25);

        }

        .btn-auth:hover{

            transform:translateY(-4px);

        }

        /* Alerts */

        .alert{

            border:none;
            border-radius:14px;
            margin-bottom:20px;

        }

        .alert-danger{

            background:rgba(239,68,68,0.12);
            color:#fecaca;

        }

        .alert-success{

            background:rgba(34,197,94,0.12);
            color:#bbf7d0;

        }

        /* Footer */

        .bottom-text{

            text-align:center;
            margin-top:25px;

            color:#94a3b8;
            font-size:0.9rem;

        }

        .bottom-text span{

            color:#c4b5fd;

        }

        /* Mobile */

        @media(max-width:576px){

            .auth-card{

                margin:20px;
                padding:35px 25px;

            }

            .title-box h2{

                font-size:1.9rem;

            }

        }

    </style>

</head>

<body>

<!-- Glow -->

<div class="glow-1"></div>
<div class="glow-2"></div>

<!-- Card -->

<div class="auth-card">

    <!-- Logo -->

    <div class="logo-circle">

        <i class="bi bi-shield-lock-fill"></i>

    </div>

    <!-- Title -->

    <div class="title-box">

        <h2>
            BlogSphere Admin
        </h2>

        <p>
            Login or create a new admin account
        </p>

    </div>

    <!-- Tabs -->

    <div class="tab-buttons">

        <button class="tab-btn active"
                onclick="showTab('login')">

            Login

        </button>

        <button class="tab-btn"
                onclick="showTab('signup')">

            Sign Up

        </button>

    </div>

    <!-- LOGIN FORM -->

    <div id="login"
         class="form-box active">

        <?php
        if(isset($error)) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
        ?>

        <form method="POST">

            <div class="input-group-custom">

                <i class="bi bi-person-fill"></i>

                <input type="text"
                       name="username"
                       class="form-control"
                       placeholder="Enter Username"
                       required>

            </div>

            <div class="input-group-custom">

                <i class="bi bi-lock-fill"></i>

                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Enter Password"
                       required>

            </div>

            <button type="submit"
                    name="login"
                    class="btn-auth">

                Login to Dashboard 🚀

            </button>

        </form>

    </div>

    <!-- SIGNUP FORM -->

    <div id="signup"
         class="form-box">

        <?php
        if(isset($signup_error)) {
            echo "<div class='alert alert-danger'>$signup_error</div>";
        }

        if(isset($signup_success)) {
            echo "<div class='alert alert-success'>$signup_success</div>";
        }
        ?>

        <form method="POST">

            <div class="input-group-custom">

                <i class="bi bi-person-plus-fill"></i>

                <input type="text"
                       name="signup_username"
                       class="form-control"
                       placeholder="Create Username"
                       required>

            </div>

            <div class="input-group-custom">

                <i class="bi bi-lock-fill"></i>

                <input type="password"
                       name="signup_password"
                       class="form-control"
                       placeholder="Create Password"
                       required>

            </div>

            <div class="input-group-custom">

                <i class="bi bi-shield-lock-fill"></i>

                <input type="password"
                       name="confirm_password"
                       class="form-control"
                       placeholder="Confirm Password"
                       required>

            </div>

            <button type="submit"
                    name="signup"
                    class="btn-auth">

                Create Admin Account ✨

            </button>

        </form>

    </div>

    <!-- Footer -->

    <div class="bottom-text">

        Powered by <span>BlogSphere CMS</span>

    </div>

</div>

<!-- Script -->

<script>

function showTab(tabId){

    let forms =
    document.querySelectorAll('.form-box');

    let buttons =
    document.querySelectorAll('.tab-btn');

    forms.forEach(form => {

        form.classList.remove('active');

    });

    buttons.forEach(btn => {

        btn.classList.remove('active');

    });

    document
    .getElementById(tabId)
    .classList.add('active');

    event.target.classList.add('active');

}

</script>

</body>
</html>