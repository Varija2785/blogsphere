<?php

include '../includes/db.php';

$category = $_POST['category'];
$search = $_POST['search'];

$query = "SELECT * FROM blogs
          WHERE title LIKE '%$search%'";

if($category != "") {

    $query .= " AND category='$category'";

}

$query .= " ORDER BY id DESC";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)) {

?>

<div class="col-lg-4 col-md-6 mb-4">

    <div class="blog-card h-100"
         style="
         background:rgba(255,255,255,0.08);
         border:1px solid rgba(255,255,255,0.08);
         border-radius:25px;
         overflow:hidden;
         transition:0.4s ease;
         position:relative;
         ">

        <!-- Image -->

        <div class="image-container">

            <img src="<?php echo $row['image']; ?>"
                 class="blog-image"
                 style="
                 width:100%;
                 height:230px;
                 object-fit:cover;
                 ">

        </div>

        <!-- Content -->

        <div class="blog-content"
             style="padding:25px;">

            <!-- Category -->

            <span class="blog-category"
                  style="
                  display:inline-block;
                  padding:6px 14px;
                  border-radius:50px;
                  background:linear-gradient(to right,#6366f1,#8b5cf6);
                  font-size:0.8rem;
                  margin-bottom:15px;
                  color:white;
                  ">

                <?php echo $row['category']; ?>

            </span>

            <!-- Title -->

            <h3 class="blog-title"
                style="
                font-size:1.3rem;
                font-weight:600;
                margin-bottom:10px;
                color:white;
                ">

                <?php echo $row['title']; ?>

            </h3>

            <!-- Description -->

            <p class="blog-description"
               style="
               color:#d1d5db;
               margin-bottom:20px;
               ">

                <?php echo $row['short_description']; ?>

            </p>

            <!-- EXTERNAL LINK -->

            <?php if(!empty($row['blog_link'])) { ?>

                <a href="<?php echo trim($row['blog_link']); ?>"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="read-btn"
                   style="
                   display:inline-block;
                   padding:12px 22px;
                   border-radius:12px;
                   background:linear-gradient(to right,#6366f1,#8b5cf6);
                   color:white;
                   text-decoration:none;
                   position:relative;
                   z-index:999;
                   ">

                    Read More →

                </a>

            <?php } else { ?>

                <!-- INTERNAL BLOG -->

                <a href="blog-details.php?id=<?php echo $row['id']; ?>"
                   class="read-btn"
                   style="
                   display:inline-block;
                   padding:12px 22px;
                   border-radius:12px;
                   background:linear-gradient(to right,#6366f1,#8b5cf6);
                   color:white;
                   text-decoration:none;
                   position:relative;
                   z-index:999;
                   ">

                    Read More →

                </a>

            <?php } ?>

        </div>

    </div>

</div>

<?php

}

} else {

?>

<div class="col-12">

    <div class="text-center py-5">

        <h3 style="color:#cbd5e1;">

            No Blogs Found 😔

        </h3>

    </div>

</div>

<?php } ?>