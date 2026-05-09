<?php

session_start();

include '../includes/db.php';

if(!isset($_SESSION['admin'])) {

    header("Location: login.php");
    exit();

}

/* ADD BLOG */

if(isset($_POST['add_blog'])) {

    $title = $_POST['title'];
    $category = $_POST['category'];
    $short_description = $_POST['short_description'];
    $content = $_POST['content'];
    $blog_link = $_POST['blog_link'];

    /* IMAGE UPLOAD */

    $imagePath = "";

    if(!empty($_FILES['image']['name'])) {

        $imageName = time() . "_" . $_FILES['image']['name'];

        $tempName = $_FILES['image']['tmp_name'];

        $uploadPath = "../uploads/" . $imageName;

        move_uploaded_file($tempName, $uploadPath);

        $imagePath = "uploads/" . $imageName;

    }

    /* INSERT QUERY */

    $query = "INSERT INTO blogs
              (title, category, image, short_description, content, blog_link)

              VALUES

              ('$title',
               '$category',
               '$imagePath',
               '$short_description',
               '$content',
               '$blog_link')";

    mysqli_query($conn, $query);

    header("Location: dashboard.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Blog</title>

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Google Font -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>

        *{
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

        }

        .main-card{

            background:rgba(255,255,255,0.08);

            border:1px solid rgba(255,255,255,0.08);

            backdrop-filter:blur(12px);

            border-radius:25px;

            padding:40px;

            box-shadow:0 20px 40px rgba(0,0,0,0.35);

        }

        h2{

            font-weight:700;

            margin-bottom:25px;

            background:linear-gradient(to right,#6366f1,#8b5cf6);

            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;

        }

        .form-control{

            background:rgba(255,255,255,0.08);

            border:none;

            color:white;

            padding:14px;

            border-radius:14px;

            margin-bottom:18px;

        }

        .form-control::placeholder{

            color:#94a3b8;

        }

        .form-control:focus{

            background:rgba(255,255,255,0.12);

            color:white;

            box-shadow:none;

        }

        input[type="file"]{

            padding:12px;

        }

        textarea{

            resize:none;

        }

        .btn-custom{

            background:linear-gradient(to right,#6366f1,#8b5cf6);

            border:none;

            padding:12px 28px;

            border-radius:12px;

            color:white;

            font-weight:500;

            transition:0.3s ease;

        }

        .btn-custom:hover{

            transform:translateY(-3px);

        }

        label{

            color:#e2e8f0;

            margin-bottom:8px;

            display:block;

        }

        .top-buttons{

            display:flex;

            justify-content:space-between;

            align-items:center;

            flex-wrap:wrap;

            gap:15px;

            margin-bottom:30px;

        }

        .nav-btn{

            border:none;

            padding:10px 20px;

            border-radius:12px;

            background:linear-gradient(to right,#6366f1,#8b5cf6);

            color:white;

            text-decoration:none;

            transition:0.3s ease;

            display:inline-block;

        }

        .nav-btn:hover{

            transform:translateY(-3px);

            color:white;

        }

        .logout-btn{

            background:linear-gradient(to right,#ef4444,#dc2626);

        }

        /* CKEDITOR FIX */

        .cke{

            margin-top:10px !important;
            margin-bottom:20px !important;
            border-radius:16px !important;
            overflow:hidden;

        }

        .cke_top{

            background:#f8fafc !important;

        }

        .cke_bottom{

            background:#f8fafc !important;

        }

        .cke_contents{

            min-height:400px !important;

        }

        .cke_chrome{

            border:none !important;

        }

    </style>

</head>

<body>

<div class="container py-5">

    <!-- TOP BUTTONS -->

    <div class="top-buttons">

        <a href="dashboard.php"
           class="nav-btn">

            ← Dashboard

        </a>

        <div class="d-flex gap-2">

            <a href="../index.php"
               class="nav-btn">

                🌐 Website

            </a>

            <a href="logout.php"
               class="nav-btn logout-btn">

                Logout

            </a>

        </div>

    </div>

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="main-card">

                <h2>
                    Add New Blog ✨
                </h2>

                <form method="POST"
                      enctype="multipart/form-data">

                    <!-- TITLE -->

                    <input type="text"
                           name="title"
                           class="form-control"
                           placeholder="Blog Title"
                           required>

                    <!-- CATEGORY -->

                    <input type="text"
                           name="category"
                           class="form-control"
                           placeholder="Category"
                           required>

                    <!-- IMAGE -->

                    <div class="mb-3">

                        <label>
                            Upload Blog Image 📸
                        </label>

                        <input type="file"
                               name="image"
                               class="form-control"
                               accept="image/*"
                               required>

                    </div>

                    <!-- EXTERNAL LINK -->

                    <div class="mb-3">

                        <label>
                            External Article Link 🌐
                        </label>

                        <input type="url"
                               name="blog_link"
                               class="form-control"
                               placeholder="https://example.com/article">

                    </div>

                    <!-- SHORT DESCRIPTION -->

                    <textarea name="short_description"
                              class="form-control"
                              placeholder="Short Description"
                              required></textarea>

                    <!-- FULL CONTENT -->

                    <div class="mb-3">

                        <label>
                            Full Blog Content 📝
                        </label>

                        <textarea name="content"
                                  id="content"></textarea>

                    </div>

                    <!-- BUTTONS -->

                    <div class="d-flex gap-3 flex-wrap mt-4">

                        <button type="submit"
                                name="add_blog"
                                class="btn btn-custom">

                            Add Blog 🚀

                        </button>

                        <a href="dashboard.php"
                           class="btn btn-secondary px-4 py-2 rounded-3">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<!-- CKEDITOR -->

<script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script>

<script>

    CKEDITOR.replace('content', {

        height: 400

    });

</script>

</body>
</html>