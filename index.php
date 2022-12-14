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
                        $view = 15;
                        if (isset($_GET['page']))
                        {
                            $page_active = $_GET['page'];
                        }else {				
                            $page_active = 1;		
                        }		
                        $data = ($page_active-1)*$view;	
                ?>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <form action="search.php" method="get">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">      
                            <div class="input-group">
                                <input class="form-control" type="text" name="search" placeholder="Search for..." aria-label="Search for..." aria-describedby="button-search" />
                                <input class="btn btn-primary" id="button-search" type="submit" value="Go!">
                            </div>
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
                                        <?php } while($rowyear = $qyear->fetch_assoc()); ?>
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
                                        <?php } while($rowgrade = $qgrade->fetch_assoc()); ?>
                                    </select>
                                    <input class="btn btn-info" id="button-search" type="submit" value="Filter">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Sort by</div>
                        <div class="card-body">
                            <select onChange={this.inputHandler} name="sortBy" class="form-control">
                                <option value="">Default</option>
                                <option value="recent">Recent Graduates</option>
                                <option value="nameAZ">Name (Ascending)</option>
                                <option value="nameZA">Name (Descending)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Visual Gallery-->
                <div class="col-lg-8">
                    <!-- Nested row for alumni photos-->
                    <div class="row">
                        <?php
                            include "config/config.php";
                            $sql = "SELECT * FROM alumni_tbl LIMIT $data, $view ";	
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
                    <!-- Pagination-->
                    <?php 
                        $sqltotal = "SELECT * FROM alumni_tbl";
                        $qtotal = $koneksi->query($sqltotal); 
                        $total_data = $qtotal->num_rows;
            
                        $total_page = ceil($total_data/$view);
                    ?>
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <?php if ($total_page > 0) { ?>
                            <ul class="pagination justify-content-center my-4">
                                <?php if ($page_active > 1){ ?>
                                    <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $page_active-1 ?>"><</a></li>
                                <?php }; ?>

                                <?php if ($page_active > 3){ ?>
                                    <li class="page-item"><a class="page-link" href="index.php?page=1">1</a></li>
                                    <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                                <?php }; ?>

                                <?php if ($page_active -2 > 0){ ?>
                                    <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $page_active-2 ?>">
                                    <?php echo $page_active-2 ?></a></li>
                                <?php }; ?>

                                <?php if ($page_active -1 > 0){ ?>
                                    <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $page_active-1 ?>">
                                    <?php echo $page_active-1 ?></a></li>
                                <?php }; ?>

                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="index.php?page=<?php echo $page ?>">
                                    <?php echo $page_active ?></a>
                                </li>

                                <?php if ($page_active+1 < $total_page+1){ ?>
                                    <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $page_active+1 ?>">
                                    <?php echo $page_active+1 ?></a></li>
                                <?php }; ?>

                                <?php if ($page_active+2 < $total_page+1){ ?>
                                    <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $page_active+2 ?>">
                                    <?php echo $page_active+2 ?></a></li>
                                <?php }; ?>

                                <?php if ($page_active < $total_page-2){ ?>
                                    <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                                    <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $total_page ?>">
                                    <?php echo $total_page ?></a></li>
                                <?php }; ?>

                                <?php if ($page_active < $total_page){ ?>
                                    <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $page_active+1 ?>">></a></li>
                                <?php }; ?>
                            </ul>
                        <?php }; ?>
                    </nav>   
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
