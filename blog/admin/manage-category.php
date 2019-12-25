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
    use App\classes\Category;

    $message = '';
    if(isset($_GET['delete'])) {
        $id = $_GET['id'];
        $message = Category::deleteCategoryInfo($id);
    }

    $queryResult = Category::getAllCategoryInfo();


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
                            <th scope="col">Category Description</th>
                            <th scope="col">Publication Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while($category = mysqli_fetch_assoc($queryResult)){ ?>
                        <tr>
                            <th scope="row"><?php echo $category['id']; ?></th>
                            <td><?php echo $category['category_name']; ?></td>
                            <td><?php echo $category['category_description']; ?></td>
                            <td><?php echo $category['status']; ?></td>
                            <td>
                                <a href="edit-category.php?id=<?php echo $category['id']; ?> ">Edit</a>
                                <a href="?delete=true&id=<?php echo $category['id']; ?>" onclick="return confirm('Are you sure to delete this !!');">Delete</a>
                            </td>
                        </tr>
<!--                        <tr>-->
<!--                            <th scope="row">2</th>-->
<!--                            <td>Jacob</td>-->
<!--                            <td>Thornton</td>-->
<!--                            <td>@fat</td>-->
<!--                            <td>-->
<!--                                <a href="">Edit</a>-->
<!--                                <a href="">Delete</a>-->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <th scope="row">3</th>-->
<!--                            <td>Larry</td>-->
<!--                            <td>the Bird</td>-->
<!--                            <td>@twitter</td>-->
<!--                            <td>-->
<!--                                <a href="">Edit</a>-->
<!--                                <a href="">Delete</a>-->
<!--                            </td>-->
<!--                        </tr>-->
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