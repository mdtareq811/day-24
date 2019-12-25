<?php
    session_start();

    if($_SESSION['id'] == null) {
        header('Location: index.php');
    }

    require_once '../vendor/autoload.php';
    $login = new App\classes\Login();
    use App\classes\BlogInfo;

    if(isset($_GET['logout'])) {
        $login->adminLogout();
    }

    $id = $_GET['id'];
    $queryResult = BlogInfo::getAllBlogInfoById($id);
    $bloginfo = mysqli_fetch_assoc($queryResult);

    $message = '';
    if(isset($_POST['btn'])) {
        $message = BlogInfo::updateBlogInfo($_POST);
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
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Category Name</label>
                                <div class="col-sm-9">
                                    <select name="category_name" class="form-control">
<!--                                        <option>-----Select Category Name-----</option>-->
                                        <option value="<?php echo $bloginfo['category_name']; ?>">Category One</option>
                                        <option value="<?php echo $bloginfo['category_name']; ?>">Category Two</option>
                                    </select>
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $bloginfo['id']; ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Blog Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="blog_title" class="form-control" value="<?php echo $bloginfo['blog_title']; ?>"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Short Description</label>
                                <div class="col-sm-9">
<!--                                    <textarea class="form-control" name="short_description"></textarea>-->
                                    <input type="text" name="short-description" class="form-control" value="<?php echo $bloginfo['short_description']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Long Description</label>
                                <div class="col-sm-9">
<!--                                    <textarea class="form-control" name="long_description"></textarea>-->
                                    <input type="text" name="long-description" class="form-control" value="<?php echo $bloginfo['long_description']; ?>">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Publication Status</label>
                                <div class="col-sm-9">
                                    <input type="radio"  name="status" value="1" <?php if ($data['status'] == '1') echo "checked" ?>> Published
                                    <input type="radio" name="status" value="<?php echo $bloginfo['status']; ?>"> Unpublished
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Blog Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="blog_image" accept="image/*" value="<?php echo $bloginfo['blog-image']; ?>"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <button type="submit" name="btn" class="btn btn-success btn-block">Update Blog Info</button>
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