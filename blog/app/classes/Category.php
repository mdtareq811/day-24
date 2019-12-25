<?php


namespace App\classes;

use App\classes\Database;
class Category
{
      public function saveCategoryInfo($data) {
          $sql = "INSERT INTO category (category_name,category_description,status) VALUES ('$data[category_name]','$data[category_description]','$data[status]')";

          if(mysqli_query(Database::dbConnection(), $sql)) {
              $message = "Category Save Successfully";
              return $message;
          } else {
              die('Query Problem'.mysqli_error(Database::dbConnection()));
          }
      }

      public function getAllCategoryInfo() {
          $sql = "SELECT * FROM category";
          if(mysqli_query(Database::dbConnection(), $sql)) {
               $queryResult = mysqli_query(Database::dbConnection(), $sql);
               return $queryResult;
          } else {
              die('Query Problem'.mysqli_error(Database::dbConnection()));
          }
      }

      public  function getAllCategoryInfoById($id) {
          $sql = "SELECT * FROM category WHERE id = '$id'";
          if(mysqli_query(Database::dbConnection(),$sql)) {
              $queryResult = mysqli_query(Database::dbConnection(), $sql);
              return $queryResult;

          } else {
              die('Query Problem'.mysqli_error(Database::dbConnection()));
          }
      }

      public function updateCategoryInfo($data) {
          $sql = "Update category SET category_name = '$data[category_name]', category_description = '$data[category_description]',status = '$data[status]' WHERE id = '$data[id]'";
          if(mysqli_query(Database::dbConnection(), $sql)) {
              header('Location:manage-category.php');
          } else {
              die('Query Problem'.mysqli_error(Database::dbConnection()));
          }
      }

      public function deleteCategoryInfo($id) {
          $sql = "DELETE FROM category WHERE id = '$id'";
          if(mysqli_query(Database::dbConnection(), $sql)) {
              $message = "Category Info DELETE successfully";
              return $message;
          } else {
              die('Query Problem'.mysqli_error(Database::dbConnection()));
          }
      }
}