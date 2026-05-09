<?php

include 'includes/db.php';

if(!isset($_GET['id'])) {

    header("Location: index.php");
    exit();

}

$id = $_GET['id'];

$query = "SELECT * FROM blogs WHERE id='$id'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0){

    header("Location: index.php");
    exit();

}

$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo $row['title']; ?>
    </title>

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

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
            background:linear-gradient(
                135deg,
                #020617,
                #0f172a,
                #111827
            );
            color:white;
            min-height:100vh;
            overflow-x:hidden;
        }

        /* Navbar */

        .navbar-custom{
            background:rgba(255,255,255,0.06);
            backdrop-filter:blur(14px);
            border-bottom:1px solid rgba(255,255,255,0.08);
            padding:18px 0;
            position:sticky;
            top:0;
            z-index:999;
        }

        .navbar-brand{
            font-size:1.7rem;
            font-weight:700;
            background:linear-gradient(to right,#6366f1,#8b5cf6);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
            text-decoration:none;
        }

        /* Main Container */

        .blog-container{
            max-width:1050px;
            margin:auto;
            padding:60px 20px;
        }

        .blog-card{
            background:rgba(255,255,255,0.08);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:30px;
            overflow:hidden;
            box-shadow:0 20px 50px rgba(0,0,0,0.4);
            animation:fadeIn 0.8s ease;
        }

        @keyframes fadeIn{

            from{
                opacity:0;
                transform:translateY(40px);
            }

            to{
                opacity:1;
                transform:translateY(0);
            }

        }

        /* Blog Image */

        .blog-image{
            width:100%;
            height:520px;
            object-fit:cover;
        }

        /* Content */

        .blog-content{
            padding:50px;
        }

        .category{
            display:inline-block;
            padding:8px 18px;
            border-radius:50px;
            background:linear-gradient(to right,#6366f1,#8b5cf6);
            margin-bottom:25px;
            font-size:0.88rem;
            font-weight:500;
        }

        .blog-title{
            font-size:3rem;
            font-weight:700;
            margin-bottom:20px;
            line-height:1.2;
            color:white;
        }

        .blog-meta{
            color:#94a3b8;
            margin-bottom:35px;
            font-size:0.95rem;
            border-bottom:1px solid rgba(255,255,255,0.08);
            padding-bottom:20px;
        }

        /* CKEditor Content Styling */

        .blog-description{
            color:#d1d5db;
            line-height:1.9;
            font-size:1.08rem;
        }

        .blog-description h1,
        .blog-description h2,
        .blog-description h3,
        .blog-description h4,
        .blog-description h5,
        .blog-description h6{
            color:white;
            margin-top:35px;
            margin-bottom:18px;
            font-weight:700;
        }

        .blog-description p{
            margin-bottom:22px;
        }

        .blog-description ul,
        .blog-description ol{
            padding-left:25px;
            margin-bottom:25px;
        }

        .blog-description li{
            margin-bottom:10px;
        }

        .blog-description blockquote{
            border-left:4px solid #8b5cf6;
            padding-left:20px;
            margin:25px 0;
            color:#cbd5e1;
            font-style:italic;
        }

        .blog-description table{
            width:100%;
            margin:30px 0;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:18px;
        }

        .blog-description table th{
            background:#6366f1;
            color:white;
            padding:15px;
            border:1px solid rgba(255,255,255,0.08);
        }

        .blog-description table td{
            padding:15px;
            border:1px solid rgba(255,255,255,0.08);
            color:#d1d5db;
        }

        .blog-description img{
            width:100%;
            border-radius:20px;
            margin:30px 0;
        }

        .blog-description a{
            color:#8b5cf6;
            text-decoration:none;
        }

        .blog-description a:hover{
            text-decoration:underline;
        }

        .blog-description code{
            background:rgba(255,255,255,0.08);
            padding:4px 8px;
            border-radius:8px;
            color:#c4b5fd;
        }

        /* Buttons */

        .button-group{
            display:flex;
            gap:15px;
            flex-wrap:wrap;
            margin-top:50px;
        }

        .custom-btn{
            padding:13px 26px;
            border-radius:14px;
            text-decoration:none;
            color:white;
            font-weight:500;
            transition:0.3s ease;
            display:inline-block;
        }

        .custom-btn:hover{
            transform:translateY(-3px);
            color:white;
        }

        .home-btn{
            background:linear-gradient(to right,#6366f1,#8b5cf6);
        }

        .back-btn{
            background:linear-gradient(to right,#0ea5e9,#06b6d4);
        }

        /* Responsive */

        @media(max-width:768px){

            .blog-title{
                font-size:2rem;
            }

            .blog-image{
                height:320px;
            }

            .blog-content{
                padding:28px;
            }

        }

    </style>

</head>

<body>

<!-- Navbar -->

<nav class="navbar-custom">

    <div class="container">

        <a href="index.php"
           class="navbar-brand">

            BlogSphere ✨

        </a>

    </div>

</nav>

<!-- Blog Section -->

<div class="blog-container">

    <div class="blog-card">

        <!-- Blog Image -->

        <img src="<?php echo $row['image']; ?>"
             class="blog-image">

        <!-- Blog Content -->

        <div class="blog-content">

            <!-- Category -->

            <span class="category">

                <?php echo $row['category']; ?>

            </span>

            <!-- Title -->

            <h1 class="blog-title">

                <?php echo $row['title']; ?>

            </h1>

            <!-- Meta -->

            <div class="blog-meta">

                Published Blog Article ✨

            </div>

            <!-- Full Content -->

            <div class="blog-description">

                <?php echo html_entity_decode($row['content']); ?>

            </div>

            <!-- Buttons -->

            <div class="button-group">

                <a href="index.php"
                   class="custom-btn home-btn">

                    ← Back to Home

                </a>

                <a href="javascript:history.back()"
                   class="custom-btn back-btn">

                    Previous Page

                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>