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
                <a class="navbar-brand" href="#">SVP Alumni Gallery</a>
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
                        $view = 30;
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
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Search by name..." aria-label="Search by name..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                            </div>
                        </div>
                    </div>
                    <!-- Filter widget-->
                    <div class="card mb-4 filter">
                        <div class="card-header">Filter</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6>Filter by year</h6>
                                    <select onChange={this.inputHandler} name="filterYear" class="form-control">
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <h6>Filter by class</h6>
                                    <select onChange={this.inputHandler} name="filterClass" class="form-control">
                                        <option value="grade12">Grade 12</option>
                                        <option value="12science">12 Science</option>
                                        <option value="12social">12 Social</option>
                                        <option value="scienceUN">12 Science UN</option>
                                        <option value="scienceA2">12 Science A2</option>
                                        <option value="socialUN">12 Social UN</option>
                                        <option value="socialA2">12 Social A2</option>
                                        <option value="darwin">12 Darwin</option>
                                        <option value="dalton">12 Dalton</option>
                                        <option value="newton">12 Newton</option>
                                        <option value="plato">12 Plato</option>
                                    </select>
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
                        <ul class="pagination justify-content-center my-4">
                            <?php for ($i=1; $i<=$total_page; $i++){?>
                            <!-- Jika Start $i / = page yang aktif -->
                            <?php if($i == $page_active){?>
                            <li class="page-item active">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></a>
                            </li>
                            <!-- END Start $i / = page yang aktif -->                      
                            <!-- Page Link Untuk Kehalaman Yang Lainnya ------->     
                            <?php }else { ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>
                            <!-- END Page Link Untuk Kehalaman Yang Lainnya -->                        
                            <?php } ?>
                        </ul>
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
