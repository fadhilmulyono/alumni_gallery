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
        <link href="css/photo_card.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">SVP Alumni Gallery</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Alumni</a></li>
                        <li class="nav-item"><a class="nav-link" href="grade9.php">Grade 9</a></li>
                        <li class="nav-item"><a class="nav-link" href="homecoming.php">Homecoming</a></li>
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
                <?php 
                        include "config/config.php";
                ?>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <form action="search.php">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">      
                            <div class="input-group">
                                <input class="form-control" type="text" name="search" placeholder="Search for..." aria-label="Search for..." aria-describedby="button-search" />
                                <input class="btn btn-primary" id="button-search" type="submit" value="Go!">
                            </div>
                        </div>
                        <div class="card-footer">
                            <?php $filter_year = $_GET['filter_year']; ?>
                            Displaying filter results by class: <br> <?php echo $filter_year; ?>
                        </div>
                    </div>
                    </form>
                    <!-- Filter widget-->
                    <div class="card mb-4 filter">
                        <div class="card-header">Filter</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <form action="filter_year.php" method="get">
                                    <h6>Filter by year</h6>
                                    <select id="filter_year" name="filter_year" class="form-control" required>
                                        <option value="">Default</option>
                                        <?php
                                            $sqlyear = "SELECT * FROM year_tbl" ;
                                            $qyear = $koneksi->query($sqlyear);
                                            $rowyear = $qyear->fetch_assoc(); 
                                        do { ?>
                                        <option value="<?php echo $rowyear['year']; ?>"><?php echo $rowyear['year']; ?></option>
                                        <?php }while($rowyear = $qyear->fetch_assoc()); ?>
                                    </select>
                                    <input class="btn btn-info" id="button-search" type="submit" value="Filter">
                                    </form>
                                </div>
                                <div class="col-sm-6">
                                    <form action="filter_class.php" method="get">
                                    <h6>Filter by class</h6>
                                    <select id="filter_class" name="filter_class" class="form-control" required>
                                        <option value="">Default</option>
                                        <?php
                                            $sqlgrade = "SELECT * FROM grade_tbl" ;
                                            $qgrade = $koneksi->query($sqlgrade);
                                            $rowgrade = $qgrade->fetch_assoc(); 
                                        do { ?>
                                        <option value="<?php echo $rowgrade['grade']; ?>"><?php echo $rowgrade['grade']; ?></option>
                                        <?php }while($rowgrade = $qgrade->fetch_assoc()); ?>
                                    </select>
                                    <input class="btn btn-info" id="button-search" type="submit" value="Filter">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visual Gallery-->
                <div class="col-lg-8">
                    <!-- Nested row for alumni photos-->
                    <div class="row">
                        <?php
                            include "config/config.php";
                            $filter_year = $_GET['filter_year'];
                
                            $sql = "SELECT * FROM alumni_tbl WHERE class_of = $filter_year";	
                            $query = $koneksi->query($sql);			
                            $row = $query->fetch_assoc();	
                            
                            do{
                        ?>
                        <div class="col-lg-4">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!">
                                    <img style="height:275px;" class="card-img-top" src="./photos/<?php echo $row['photo_name'] ?>.jpg" alt="<?php echo $row['photo_name'] ?>" />
                                </a>
                                <div class="card-body">
                                    <div class="small text-muted"><?php echo $row['grade'] ?> Class of <?php echo $row['class_of'] ?></div>
                                    <h2 class="card-title h4"><?php echo $row['name'] ?></h2>
                                    <p class="card-text"><?php if($row['status'] == "In Memoriam"){
                                        echo "(In Memoriam)";
                                    } ?></p>
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
