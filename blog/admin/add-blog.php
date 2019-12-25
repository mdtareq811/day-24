<?php

    session_start();

    if($_SESSION['id'] == null) {
        header('Location: index.php');
    }

    require_once '../vendor/autoload.php';
    $login = new App\classes\Login();
    $blogInfo = new App\classes\BlogInfo();
//    use App\classes\BlogInfo;


    $queryResult = $blogInfo->getAllPublishedCategoryInfo();

    if(isset($_GET['logout'])) {
        $login->adminLogout();
    }


    $message = '';
    if(isset($_POST['btn'])) {
        $message = $blogInfo->saveBlogInfo($_POST);
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <?php include 'includes/menu.php'; ?>

    <div class="container" style="margin-top: 10px;">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h1 style="..." ><?php echo $message; ?></h1>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Category Name</label>
                                <div class="col-sm-9">
                                    <select name="category_id" class="form-control">
                                        <option>-----Select Category Name-----</option>
                                        <?php while ( $category = mysqli_fetch_assoc($queryResult)) { ?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Blog Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="blog_title" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Short Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="short_description"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Long Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="long_description"></textarea>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Publication Status</label>
                                <div class="col-sm-9">
                                    <input type="radio"  name="status" value="1"> Published
                                    <input type="radio" name="status" value="0"> Unpublished
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Blog Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="blog_image" accept="image/*"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <button type="submit" name="btn" class="btn btn-success btn-block">Save Blog Info</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.4.1.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>