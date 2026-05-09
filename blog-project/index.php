<?php
include 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>BlogSphere</title>

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Google Font -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- AOS -->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css"
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

            min-height:100vh;
            color:white;
            overflow-x:hidden;
        }

        /* Navbar */

        .navbar{
            background:rgba(15,23,42,0.75)!important;
            backdrop-filter:blur(18px);
            border-bottom:1px solid rgba(255,255,255,0.08);
            padding:15px 0;
        }

        .navbar-brand{
            font-size:1.8rem;
            font-weight:700;
            background:linear-gradient(to right,#6366f1,#8b5cf6);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        .nav-btn{
            border:none;
            padding:10px 22px;
            border-radius:12px;
            background:linear-gradient(to right,#6366f1,#8b5cf6);
            color:white;
            text-decoration:none;
            transition:0.3s ease;
            font-size:0.92rem;
            font-weight:500;
        }

        .nav-btn:hover{
            transform:translateY(-3px);
            color:white;
            box-shadow:0 10px 25px rgba(99,102,241,0.35);
        }

        /* Hero */

        .hero{
            text-align:center;
            padding:90px 20px 50px;
        }

        .hero h1{
            font-size:4rem;
            font-weight:700;
            line-height:1.2;

            background:linear-gradient(to right,#6366f1,#8b5cf6);

            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;

            margin-bottom:18px;
        }

        .hero p{
            color:#cbd5e1;
            font-size:1.12rem;
        }

        /* Featured Blog */

        .featured-blog{
            position:relative;
            border-radius:30px;
            overflow:hidden;
            height:450px;
            margin-top:30px;
            margin-bottom:70px;
            border:1px solid rgba(255,255,255,0.08);

            box-shadow:
            0 20px 40px rgba(0,0,0,0.35);

        }

        .featured-blog img{
            width:100%;
            height:100%;
            object-fit:cover;
            transition:0.5s ease;
        }

        .featured-blog:hover img{
            transform:scale(1.05);
        }

        .featured-overlay{
            position:absolute;
            inset:0;

            background:linear-gradient(
                to top,
                rgba(0,0,0,0.92),
                rgba(0,0,0,0.2),
                transparent
            );

            display:flex;
            flex-direction:column;
            justify-content:flex-end;
            padding:45px;
        }

        .featured-badge{
            width:max-content;
            padding:8px 18px;
            border-radius:50px;
            background:linear-gradient(to right,#6366f1,#8b5cf6);
            margin-bottom:18px;
            font-size:0.85rem;
        }

        .featured-overlay h2{
            font-size:3rem;
            font-weight:700;
            margin-bottom:15px;
        }

        .featured-overlay p{
            color:#d1d5db;
            margin-bottom:25px;
            max-width:700px;
            line-height:1.7;
        }

        /* Search */

        .search-box{
            background:rgba(255,255,255,0.08);
            border:none;
            color:white;
            padding:16px;
            border-radius:15px;
            margin-bottom:25px;
        }

        .search-box::placeholder{
            color:#94a3b8;
        }

        .search-box:focus{
            background:rgba(255,255,255,0.1);
            color:white;
            box-shadow:none;
        }

        /* Filters */

        .filter-container{
            display:flex;
            flex-wrap:wrap;
            gap:12px;
            margin-bottom:40px;
        }

        .filter-btn{
            border:none;
            padding:10px 22px;
            border-radius:50px;
            background:rgba(255,255,255,0.08);
            color:white;
            transition:0.3s ease;
            cursor:pointer;
        }

        .filter-btn:hover,
        .filter-btn.active{
            background:linear-gradient(to right,#6366f1,#8b5cf6);
            transform:translateY(-2px);
        }

        /* Cards */

        .blog-card{
            background:rgba(255,255,255,0.08);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:25px;
            overflow:hidden;
            transition:0.4s ease;
            height:100%;
        }

        .blog-card:hover{
            transform:translateY(-10px);

            box-shadow:
            0 20px 40px rgba(0,0,0,0.35),
            0 0 18px rgba(99,102,241,0.25);

        }

        .blog-card img{
            width:100%;
            height:230px;
            object-fit:cover;
            transition:0.4s ease;
        }

        .blog-card:hover img{
            transform:scale(1.04);
        }

        .card-body-custom{
            padding:25px;
        }

        .category-badge{
            display:inline-block;
            padding:6px 14px;
            border-radius:50px;
            background:linear-gradient(to right,#6366f1,#8b5cf6);
            font-size:0.8rem;
        }

        .blog-title{
            font-size:1.3rem;
            font-weight:600;
            margin-bottom:12px;
            line-height:1.5;
        }

        .blog-text{
            color:#d1d5db;
            margin-bottom:22px;
            line-height:1.7;
        }

        /* Buttons */

        .read-btn{
            display:inline-block;
            padding:12px 22px;
            border-radius:12px;
            background:linear-gradient(to right,#6366f1,#8b5cf6);
            color:white !important;
            text-decoration:none !important;
            cursor:pointer;
            border:none;
            transition:0.3s ease;
        }

        .read-btn:hover{
            transform:translateY(-3px);
            color:white !important;
        }

        /* Footer */

        footer{
            text-align:center;
            padding:70px 20px;
            color:#94a3b8;
        }

        footer h4{
            color:white;
            margin-bottom:12px;
        }

        @media(max-width:768px){

            .hero h1{
                font-size:2.4rem;
            }

            .featured-overlay h2{
                font-size:2rem;
            }

            .featured-blog{
                height:360px;
            }

            .featured-overlay{
                padding:25px;
            }

        }

    </style>

</head>

<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg sticky-top">

    <div class="container">

        <a class="navbar-brand" href="#">
            BlogSphere ✨
        </a>

        <div class="d-flex gap-2">

            <a href="index.php" class="nav-btn">
                Home
            </a>

            <a href="admin/add_blog.php" class="nav-btn">
                Add Blog
            </a>

            <a href="admin/login.php" class="nav-btn">
                Admin
            </a>

        </div>

    </div>

</nav>

<!-- Hero -->

<div class="hero" data-aos="fade-up">

    <h1>
        Explore Trending Stories
    </h1>

    <p>
        Modern blogs with premium reading experience.
    </p>

</div>

<!-- Featured Blog -->

<?php
$featured = mysqli_query($conn,"SELECT * FROM blogs ORDER BY id DESC LIMIT 1");
$featuredBlog = mysqli_fetch_assoc($featured);
?>

<div class="container">

    <div class="featured-blog" data-aos="zoom-in">

        <img src="<?php echo $featuredBlog['image']; ?>">

        <div class="featured-overlay">

            <span class="featured-badge">
                Featured Story
            </span>

            <h2>
                <?php echo $featuredBlog['title']; ?>
            </h2>

            <p>
                <?php echo $featuredBlog['short_description']; ?>
            </p>

            <div style="color:#cbd5e1; margin-bottom:18px;">

                🕒 <?php echo date("d M Y • h:i A", strtotime($featuredBlog['created_at'])); ?>

            </div>

            <?php if(!empty($featuredBlog['blog_link'])) { ?>

                <a href="<?php echo trim($featuredBlog['blog_link']); ?>"
                   target="_blank"
                   class="read-btn">

                    Explore Story →

                </a>

            <?php } else { ?>

                <a href="blog-details.php?id=<?php echo $featuredBlog['id']; ?>"
                   class="read-btn">

                    Explore Story →

                </a>

            <?php } ?>

        </div>

    </div>

</div>

<!-- Main Content -->

<div class="container pb-5">

    <!-- Search -->

    <input type="text"
           id="search"
           class="form-control search-box"
           placeholder="Search blogs...">

    <!-- Filters -->

    <div class="filter-container">

        <button class="filter-btn active" data-category="">
            All
        </button>

        <button class="filter-btn" data-category="Result">
            Result
        </button>

        <button class="filter-btn" data-category="Admit Card">
            Admit Card
        </button>

        <button class="filter-btn" data-category="Exam">
            Exam
        </button>

        <button class="filter-btn" data-category="addiction">
            Addiction
        </button>

    </div>

    <!-- Blog Cards -->

    <div class="row" id="blogData">

    <?php

    $query = "SELECT * FROM blogs ORDER BY id DESC";

    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)) {

    ?>

    <div class="col-lg-4 col-md-6 mb-4"
         data-aos="fade-up">

        <div class="blog-card">

            <img src="<?php echo $row['image']; ?>">

            <div class="card-body-custom">

                <div style="display:flex;
                            justify-content:space-between;
                            align-items:center;
                            margin-bottom:15px;">

                    <span class="category-badge">

                        <?php echo $row['category']; ?>

                    </span>

                    <span style="font-size:13px; color:#94a3b8;">

                        🕒 <?php echo date("d M Y", strtotime($row['created_at'])); ?>

                    </span>

                </div>

                <h3 class="blog-title">

                    <?php echo $row['title']; ?>

                </h3>

                <p class="blog-text">

                    <?php echo $row['short_description']; ?>

                </p>

                <?php if(!empty($row['blog_link'])) { ?>

                    <a href="<?php echo trim($row['blog_link']); ?>"
                       target="_blank"
                       class="read-btn">

                        Read More →

                    </a>

                <?php } else { ?>

                    <a href="blog-details.php?id=<?php echo $row['id']; ?>"
                       class="read-btn">

                        Read More →

                    </a>

                <?php } ?>

            </div>

        </div>

    </div>

    <?php } ?>

    </div>

</div>

<!-- Footer -->

<footer>

    <h4>
        BlogSphere ✨
    </h4>

    <p>
        Crafted with PHP, MySQL, AJAX & CKEditor
    </p>

</footer>

<!-- jQuery -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- AOS -->

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>

AOS.init();

</script>

<!-- AJAX -->

<script>

$(document).ready(function(){

    let selectedCategory = "";

    function fetchBlogs(){

        var search = $("#search").val();

        $.ajax({

            url:"ajax/filter.php",

            type:"POST",

            data:{
                category:selectedCategory,
                search:search
            },

            success:function(response){

                $("#blogData").html(response);

            }

        });

    }

    $(".filter-btn").click(function(){

        $(".filter-btn").removeClass("active");

        $(this).addClass("active");

        selectedCategory = $(this).data("category");

        fetchBlogs();

    });

    $("#search").keyup(function(){

        fetchBlogs();

    });

});

</script>

</body>
</html>