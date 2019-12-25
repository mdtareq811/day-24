<?php


namespace App\classes;

use App\classes\Database;
class BlogInfo
{
     public function saveBlogInfo($data) {

         $fileName = $_FILES['blog_image']['name'];
         $directory = '../assets/images/';
         $imageUrl = $directory.$fileName;
         $fileType = pathinfo($fileName,PATHINFO_EXTENSION);
         $check =  getimagesize($_FILES['blog_image']['tmp_name']);

         if($check) {
             if(file_exists($imageUrl)) {
                 die('This image already exist. Please select another one. Thanks');
             } else {

                 if($_FILES['blog_image']['size'] > 500000) {
                     die('Your image size is to large.Please select with in 10kb');
                 } else {
                     if($fileType != 'JPG' && $fileType != 'png' && $fileType != 'jpg') {
                         die('Image file is not supported.Please use jpg or png');

                     } else {
                         move_uploaded_file($_FILES['blog_image']['tmp_name'], $imageUrl);

                         $sql = "INSERT INTO bloginfo (category_id,blog_title,short_description,long_description,blog_image,status) VALUES ('$data[category_id]','$data[blog_title]','$data[short_description]','$data[long_description]','$imageUrl','$data[status]')";

                         if(mysqli_query(Database::dbConnection(), $sql)) {

                             $message = "Save Blog Successfully";
                             return $message;
                         } else {
                             die('Query Problem'.mysqli_error(Database::dbConnection()));
                         }

                     }
                 }

             }

         } else {
             die('Please chose a image file thanks !.');
         }



     }

     public function getAllBlogInfo() {
         $sql = "SELECT * FROM bloginfo";

         if(mysqli_query(Database::dbConnection(), $sql)) {

             $queryResult = mysqli_query(Database::dbConnection(), $sql);
             return $queryResult;
         } else {
             die('Query Problem'.mysqli_error(Database::dbConnection()));
         }
     }

    public  function getAllBlogInfoById($id) {
        $sql = "SELECT * FROM bloginfo WHERE id = '$id'";
        if(mysqli_query(Database::dbConnection(),$sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;

        } else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }

     public function updateBlogInfo($data) {
         $sql = "Update bloginfo SET category_name= '$data[category_name]',blog_title = '$data[blog_title]',short_description = '$data[short_description]',long_description = '$data[long_description]',blog_image = '$data[blog_image]',status = '$data[status]' WHERE id='$data[id]'";
         if(mysqli_query(Database::dbConnection(), $sql)) {
             header('Location:manage-blog.php');
         } else {
             die('Query Problem'.mysqli_error(Database::dbConnection()));
         }
     }
     public function deleteBlogInfo($id) {
        $sql = "DELETE FROM bloginfo WHERE id = '$id'";
        if(mysqli_query(Database::dbConnection(), $sql)) {
             $message = "Blog Info DELETE successfully";
             return $message;
        } else {
        die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
     }

    public function getAllPublishedCategoryInfo() {
         $sql = "SELECT * FROM category WHERE status = 1 ";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);

            return $queryResult;
        } else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
     }



}