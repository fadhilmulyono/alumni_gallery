<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SVP Alumni Visual Gallery</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">SVP Alumni Gallery</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php">Alumni</a></li>
                        <li class="nav-item"><a class="nav-link" href="grade9.php">Grade 9</a></li>
                        <li class="nav-item"><a class="nav-link active" href="homecoming.php">Homecoming</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">SVP Alumni Association</h1>
                    <p class="lead mb-0">The Global Network of Sekolah Victory Plus Alumni</p>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="row">
                <!-- Visual Gallery-->
                <div class="col-lg-12">
                    <!-- Nested row for alumni photos-->
                    <div class="row">
                        <?php
                            include "config/config.php";
                            $sql = "SELECT * FROM homecoming";	
                            $query = $koneksi->query($sql);			
                            $row = $query->fetch_assoc();		
                            do{
                        ?>
                        <div class="col-lg-3">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!">
                                    <img style="height:350px;" class="card-img-top" src="./images/photos/<?php echo $row['photo_name'] ?>.jpg" alt="<?php echo $row['photo_name'] ?>" />
                                </a>
                                <div class="card-body">
                                    <div class="small text-muted">Class of <?php echo $row['class_of'] ?></div>
                                    <h2 class="card-title h4"><?php echo $row['name'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <?php }while($row = $query->fetch_assoc()); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; SVP Alumni Association 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
