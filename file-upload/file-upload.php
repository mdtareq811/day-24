<?php
      $link = mysqli_connect('localhost','root','','image_upload');
    echo '<pre>';
    print_r($_POST);

      if(isset($_POST['btn'])) {


          $fileName = $_FILES['image_file']['name'];
          $directory = 'images/';
          $imageUrl = $directory.$fileName;
          $fileType = pathinfo($fileName,PATHINFO_EXTENSION);
          $check =  getimagesize($_FILES['image_file']['tmp_name']);

          if($check) {
              if(file_exists($imageUrl)) {
                  die('This image already exist. Please select another one. Thanks');
              } else {

                  if($_FILES['image_file']['size'] > 500000) {
                      die('Your image size is to large.Please select with in 10kb');
                  } else {
                      if($fileType != 'JPG' && $fileType != 'png' && $fileType != 'jpg') {
                          die('Image file is not supported.Please use jpg or png');

                      } else {
                          move_uploaded_file($_FILES['image_file']['tmp_name'], $imageUrl);
                          $sql = "INSERT INTO images (image_file) VALUES ('$imageUrl')";
                          mysqli_query($link,$sql);
                          echo 'Image upload & save successfully';
                      }
                  }

              }

          } else {
              die('Please chose a image file thanks !.');
          }
      }


?>

<form action="" method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <th>Select File</th>
            <td><input type="file" name="image_file"/> </td>
        </tr>
        <tr>
            <th></th>
            <td><input type="submit" name="btn" value="SubmiT"/> </td>
        </tr>
    </table>

</form>

<hr/>

<?php
    $sql = "SELECT * FROM images";
    $queryResult = mysqli_query($link, $sql);

?>

<table>
    <?php while ($image = mysqli_fetch_assoc($queryResult)) { ?>
    <tr>
        <td><img src="<?php echo $image['image_file']; ?>" alt="" height="100" width="100"/></td>
    </tr>
    <?php } ?>
</table>