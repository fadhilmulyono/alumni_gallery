<?php
 	session_start();
	if(!isset($_SESSION['username']))
	{
		header("location:index.php?error2");	
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SAA Visual Gallery Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="main.php">SVP Alumni Gallery</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout_process.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">CMS</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Admin Table
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="main.php">Grade 12 Alumni</a>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Miscellaneous Admin
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#">Resigned Alumni</a>
                                            <a class="nav-link" href="#">Middle School Alumni</a>
                                            <a class="nav-link" href="#">1st Alumni Homecoming</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        SAA Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">SVP Alumni Association (SAA)</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">Admin Page</li>
                            <li class="breadcrumb-item active">Edit Alumni Data</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Edit Alumni Data
                            </div>
                            <div class="card-body">
                            <?php include "../config/config.php";
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM alumni_tbl WHERE id = $id" ;
                                $query = $koneksi->query($sql);
                                $row = $query->fetch_assoc(); ?>
                                        <form action="add_process.php" method="post" enctype="multipart/form-data">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="name" name="name" type="text" placeholder="Name of Alumni" value="<?php echo $row['name'] ?>" required>
                                                        <label for="name">Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="photo_name" name="photo_name" type="text" placeholder="Name for Photo" value="<?php echo $row['photo_name'] ?>" required>
                                                        <label for="photo_name">Photo Name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="year" name="year" type="text" value="<?php echo $row['class_of'] ?>" disabled>
                                                        <label for="year">Class Of</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3"> 
                                                    <div class="form-floating mb-3 mb-md-0">   
                                                    <input class="form-control" id="grade" name="grade" type="grade" value="<?php echo $row['grade'] ?>" disabled>
                                                        <label for="grade">Grade</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="image">Upload Photo</label>
                                                    <div class="form-floating mb-3">
                                                        <input name="image" type="file" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3 mt-4 mb-0">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <div class="d-grid"><input class="btn btn-primary btn-block" type="submit" value="Save"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <div class="d-grid"><input class="btn btn-secondary btn-block" type="reset" value="Reset"></div>
                                                    </div>
                                                </div>   
                                                <div class="col-md-2">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <a href="delete_process.php?id=<?php echo $row['id']; ?>">
                                                        <button type="button" class="btn btn-danger btn-block">
                                                            Delete</button></a>
                                                    </div>
                                                </div>    
                                                <div class="col-md-2">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <a href="death_process.php?id=<?php echo $row['id']; ?>">
                                                        <button type="button" class="btn btn-dark btn-block">
                                                            Deceased</button></a>
                                                    </div>                                          
                                                </div>
                                            </div>
                                        </form>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; SVP Alumni Association 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
