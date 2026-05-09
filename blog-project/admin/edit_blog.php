<?php

session_start();

include '../includes/db.php';

if(!isset($_SESSION['admin'])) {

    header("Location: login.php");
    exit();

}

if(!isset($_GET['id'])) {

    header("Location: dashboard.php");
    exit();

}

$id = $_GET['id'];

$query = "SELECT * FROM blogs WHERE id='$id'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0){

    header("Location: dashboard.php");
    exit();

}

$row = mysqli_fetch_assoc($result);

/* UPDATE BLOG */

if(isset($_POST['update_blog'])) {

    $title = $_POST['title'];
    $category = $_POST['category'];
    $short_description = $_POST['short_description'];
    $content = $_POST['content'];
    $blog_link = $_POST['blog_link'];

    /* KEEP OLD IMAGE */

    $imagePath = $row['image'];

    /* NEW IMAGE */

    if(!empty($_FILES['image']['name'])) {

        $imageName = time() . "_" . $_FILES['image']['name'];

        $tempName = $_FILES['image']['tmp_name'];

        $uploadPath = "../uploads/" . $imageName;

        move_uploaded_file($tempName, $uploadPath);

        $imagePath = "uploads/" . $imageName;

    }

    /* UPDATE QUERY */

    $update = "UPDATE blogs SET

               title='$title',
               category='$category',
               image='$imagePath',
               short_description='$short_description',
               content='$content',
               blog_link='$blog_link'

               WHERE id='$id'";

    mysqli_query($conn, $update);

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

    <title>Edit Blog</title>

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

        .form-control:focus{

            background:rgba(255,255,255,0.12);

            color:white;

            box-shadow:none;

        }

        .form-control::placeholder{

            color:#94a3b8;

        }

        textarea{
            resize:none;
        }

        input[type="file"]{
            padding:12px;
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

        .current-image{

            width:100%;

            max-height:320px;

            object-fit:cover;

            border-radius:20px;

            margin-bottom:20px;

            border:2px solid rgba(255,255,255,0.08);

        }

        /* CKEDITOR FIX */

        .cke{

            margin-top:10px !important;
            margin-bottom:20px !important;

        }

        .cke_contents{

            min-height:400px !important;

        }

        .cke_chrome{

            border-radius:16px !important;
            overflow:hidden;

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
                    Edit Blog ✨
                </h2>

                <form method="POST"
                      enctype="multipart/form-data">

                    <!-- TITLE -->

                    <input type="text"
                           name="title"
                           class="form-control"
                           value="<?php echo $row['title']; ?>"
                           required>

                    <!-- CATEGORY -->

                    <input type="text"
                           name="category"
                           class="form-control"
                           value="<?php echo $row['category']; ?>"
                           required>

                    <!-- CURRENT IMAGE -->

                    <label>
                        Current Blog Image 📸
                    </label>

                    <img src="../<?php echo $row['image']; ?>"
                         class="current-image">

                    <!-- NEW IMAGE -->

                    <div class="mb-3">

                        <label>
                            Replace Blog Image
                        </label>

                        <input type="file"
                               name="image"
                               class="form-control"
                               accept="image/*">

                    </div>

                    <!-- EXTERNAL LINK -->

                    <div class="mb-3">

                        <label>
                            External Article Link 🌐
                        </label>

                        <input type="url"
                               name="blog_link"
                               class="form-control"
                               value="<?php echo $row['blog_link']; ?>"
                               placeholder="https://example.com/article">

                    </div>

                    <!-- SHORT DESCRIPTION -->

                    <textarea name="short_description"
                              class="form-control"
                              required><?php echo $row['short_description']; ?></textarea>

                    <!-- FULL CONTENT -->

                    <div class="mb-3">

                        <label>
                            Full Blog Content 📝
                        </label>

                        <textarea name="content"
                                  id="content"><?php echo $row['content']; ?></textarea>

                    </div>

                    <!-- BUTTONS -->

                    <div class="d-flex gap-3 flex-wrap mt-4">

                        <button type="submit"
                                name="update_blog"
                                class="btn btn-custom">

                            Update Blog 🚀

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

<!-- CKEDITOR SAME AS YOUR SCREENSHOT -->

<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>

<script>

    CKEDITOR.replace('content', {

        height: 400

    });

</script>

</body>
</html>