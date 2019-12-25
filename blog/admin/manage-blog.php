<?php
    session_start();

    if($_SESSION['id'] == null) {
        header('Location: index.php');
    }

    require_once '../vendor/autoload.php';
    $login = new App\classes\Login();

    if(isset($_GET['logout'])) {
        $login->adminLogout();
    }
    use App\classes\BlogInfo;

    $message = '';
    if(isset($_GET['delete'])) {
        $id = $_GET['id'];
        $message = BlogInfo::deleteBlogInfo($id);
    }

    $queryResult = BlogInfo::getAllBlogInfo();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <h1 style=".."><?php echo $message; ?></h1>
    <?php include 'includes/menu.php'; ?>

    <div class="container" style="margin-top: 10px;">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">SL NO</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Blog Title</th>
                                <th scope="col">Short Description</th>
                                <th scope="col">Long Description</th>
                                <th scope="col">Blog Image</th>
                                <th scope="col">Publication Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while($bloginfo = mysqli_fetch_assoc($queryResult)){ ?>
                                <tr>
                                    <th scope="row"><?php echo $bloginfo['id']; ?></th>
                                    <td><?php echo $bloginfo['category_name']; ?></td>
                                    <td><?php echo $bloginfo['blog_title']; ?></td>
                                    <td><?php echo $bloginfo['short_description']; ?></td>
                                    <td><?php echo $bloginfo['long_description']; ?></td>
                                    <td><?php echo $bloginfo['blog_image']; ?></td>
                                    <td><?php echo $bloginfo['status']; ?></td>
                                    <td>
                                        <a href="edit-blog.php?id=<?php echo $bloginfo['id']; ?> ">Edit</a>
                                        <a href="?delete=true&id=<?php echo $bloginfo['id']; ?>" onclick="return confirm('Are you sure to delete this !!');">Delete</a>
                                    </td>
                                </tr>

                            <?php } ?>
                            </tbody>
                        </table>
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