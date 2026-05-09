<?php
session_start();

if(!isset($_SESSION['admin'])) {

    header("Location: login.php");
    exit();

}

include '../includes/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Google Font -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{

            background:
            radial-gradient(circle at top left,#312e81 0%,transparent 30%),
            radial-gradient(circle at bottom right,#581c87 0%,transparent 30%),
            linear-gradient(135deg,#020617,#0f172a,#111827);

            min-height:100vh;
            color:white;
            overflow-x:hidden;

        }

        .dashboard-navbar{

            padding:25px 0;

        }

        .logo{

            font-size:2rem;
            font-weight:700;

            background:linear-gradient(
                to right,
                #818cf8,
                #c084fc
            );

            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;

        }

        .top-buttons{

            display:flex;
            gap:12px;
            flex-wrap:wrap;

        }

        .nav-btn{

            border:none;
            padding:12px 22px;
            border-radius:14px;

            color:white;
            text-decoration:none;
            font-weight:500;

            transition:0.35s ease;

            display:inline-flex;
            align-items:center;
            gap:8px;

        }

        .nav-btn:hover{

            transform:translateY(-4px);
            color:white;

        }

        .btn-add{

            background:linear-gradient(
                to right,
                #6366f1,
                #8b5cf6
            );

            box-shadow:
            0 10px 20px rgba(99,102,241,0.25);

        }

        .btn-view{

            background:linear-gradient(
                to right,
                #0ea5e9,
                #06b6d4
            );

        }

        .btn-logout{

            background:linear-gradient(
                to right,
                #ef4444,
                #dc2626
            );

        }

        .welcome-box{

            margin-top:20px;
            margin-bottom:35px;

            padding:35px;

            border-radius:30px;

            background:rgba(255,255,255,0.08);

            border:1px solid rgba(255,255,255,0.08);

            backdrop-filter:blur(18px);

            box-shadow:
            0 20px 50px rgba(0,0,0,0.35);

        }

        .welcome-box h1{

            font-size:2.5rem;
            font-weight:700;
            margin-bottom:12px;

            background:linear-gradient(
                to right,
                #818cf8,
                #c084fc
            );

            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;

        }

        .welcome-box p{

            color:#cbd5e1;
            margin:0;

        }

        .stats-grid{

            display:grid;

            grid-template-columns:
            repeat(auto-fit,minmax(250px,1fr));

            gap:22px;

            margin-bottom:35px;

        }

        .stat-card{

            padding:28px;

            border-radius:26px;

            background:rgba(255,255,255,0.08);

            border:1px solid rgba(255,255,255,0.08);

            backdrop-filter:blur(18px);

            transition:0.35s ease;

            position:relative;
            overflow:hidden;

        }

        .stat-card:hover{

            transform:translateY(-8px);

            box-shadow:
            0 20px 35px rgba(0,0,0,0.35);

        }

        .stat-card::before{

            content:"";

            position:absolute;

            width:180px;
            height:180px;

            background:rgba(99,102,241,0.12);

            border-radius:50%;

            top:-70px;
            right:-70px;

        }

        .stat-icon{

            width:65px;
            height:65px;

            border-radius:18px;

            display:flex;
            align-items:center;
            justify-content:center;

            font-size:1.6rem;

            margin-bottom:20px;

            background:linear-gradient(
                to right,
                #6366f1,
                #8b5cf6
            );

        }

        .stat-card h2{

            font-size:2.3rem;
            font-weight:700;
            margin-bottom:10px;

        }

        .stat-card p{

            color:#cbd5e1;
            margin:0;

        }

        .table-card{

            background:rgba(255,255,255,0.08);

            border:1px solid rgba(255,255,255,0.08);

            border-radius:30px;

            padding:30px;

            backdrop-filter:blur(18px);

            box-shadow:
            0 20px 50px rgba(0,0,0,0.35);

        }

        .table-title{

            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
            gap:15px;

            margin-bottom:25px;

        }

        .table-title h3{

            font-weight:700;
            margin:0;

        }

        .table{

            color:white;
            margin:0;

        }

        .table thead{

            background:rgba(255,255,255,0.08);

        }

        .table th{

            border:none;
            padding:18px;
            font-weight:600;

        }

        .table td{

            border-color:rgba(255,255,255,0.08);

            padding:18px;
            vertical-align:middle;

        }

        tbody tr{

            transition:0.3s ease;

        }

        tbody tr:hover{

            background:rgba(255,255,255,0.05);

        }

        .blog-title{

            font-weight:600;

        }

        .badge-category{

            background:linear-gradient(
                to right,
                #6366f1,
                #8b5cf6
            );

            padding:8px 16px;

            border-radius:50px;

            font-size:0.82rem;

        }

        .date-text{

            color:#cbd5e1;
            font-size:0.9rem;
            line-height:1.6;

        }

        .action-buttons{

            display:flex;
            gap:10px;
            flex-wrap:wrap;

        }

        .action-btn{

            border:none;

            padding:10px 16px;

            border-radius:12px;

            color:white;
            text-decoration:none;

            font-size:0.9rem;
            font-weight:500;

            transition:0.3s ease;

            display:inline-flex;
            align-items:center;
            gap:6px;

        }

        .action-btn:hover{

            transform:translateY(-3px);
            color:white;

        }

        .edit-btn{

            background:linear-gradient(
                to right,
                #3b82f6,
                #2563eb
            );

        }

        .delete-btn{

            background:linear-gradient(
                to right,
                #ef4444,
                #dc2626
            );

        }

        .empty-text{

            text-align:center;
            padding:40px;
            color:#cbd5e1;

        }

        @media(max-width:768px){

            .welcome-box h1{

                font-size:2rem;

            }

            .table-card{

                padding:18px;

            }

            .table th,
            .table td{

                padding:14px;

            }

        }

    </style>

</head>

<body>

<div class="container py-4">

    <!-- Navbar -->

    <div class="dashboard-navbar d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div class="logo">
            BlogSphere ✨
        </div>

        <div class="top-buttons">

            <a href="add_blog.php"
               class="nav-btn btn-add">

                <i class="bi bi-plus-circle-fill"></i>

                Add Blog

            </a>

            <a href="../index.php"
               class="nav-btn btn-view">

                <i class="bi bi-globe"></i>

                View Website

            </a>

            <a href="logout.php"
               class="nav-btn btn-logout">

                <i class="bi bi-box-arrow-right"></i>

                Logout

            </a>

        </div>

    </div>

    <!-- Welcome -->

    <div class="welcome-box">

        <h1>
            Welcome Back Admin 👋
        </h1>

        <p>
            Manage blogs, edit content, upload stories and monitor your platform.
        </p>

    </div>

    <!-- Stats -->

    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-icon">

                <i class="bi bi-journal-richtext"></i>

            </div>

            <h2>

                <?php

                $countQuery = mysqli_query($conn,"SELECT * FROM blogs");

                echo mysqli_num_rows($countQuery);

                ?>

            </h2>

            <p>
                Total Blogs Published
            </p>

        </div>

        <div class="stat-card">

            <div class="stat-icon">

                <i class="bi bi-shield-lock-fill"></i>

            </div>

            <h2>
                Active
            </h2>

            <p>
                Secure Admin Access
            </p>

        </div>

    </div>

    <!-- Blog Table -->

    <div class="table-card">

        <div class="table-title">

            <h3>
                All Blogs
            </h3>

        </div>

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Published</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php

                $query = "SELECT * FROM blogs ORDER BY id DESC";

                $result = mysqli_query($conn, $query);

                if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_assoc($result)) {

                ?>

                    <tr>

                        <td>

                            #<?php echo $row['id']; ?>

                        </td>

                        <td class="blog-title">

                            <?php echo $row['title']; ?>

                        </td>

                        <td>

                            <span class="badge-category">

                                <?php echo $row['category']; ?>

                            </span>

                        </td>

                        <!-- DATE & TIME -->

                        <td class="date-text">

                            <?php echo date("d M Y", strtotime($row['created_at'])); ?>

                            <br>

                            <small>

                                <?php echo date("h:i A", strtotime($row['created_at'])); ?>

                            </small>

                        </td>

                        <td>

                            <div class="action-buttons">

                                <a href="edit_blog.php?id=<?php echo $row['id']; ?>"
                                   class="action-btn edit-btn">

                                    <i class="bi bi-pencil-square"></i>

                                    Edit

                                </a>

                                <a href="delete_blog.php?id=<?php echo $row['id']; ?>"
                                   class="action-btn delete-btn"
                                   onclick="return confirm('Are you sure you want to delete this blog?')">

                                    <i class="bi bi-trash-fill"></i>

                                    Delete

                                </a>

                            </div>

                        </td>

                    </tr>

                <?php

                }

                } else {

                ?>

                    <tr>

                        <td colspan="5">

                            <div class="empty-text">

                                No Blogs Found 😔

                            </div>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>