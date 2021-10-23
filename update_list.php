<?php
  include('constants.php');

  // check list_id in url
  if(isset($_GET['list_id'])){
    // get the list_id value
    $list_id = $_GET['list_id'];

    // connnect to database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    // select database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

    // query to get list data from database
    $sql = "SELECT * FROM tbl_lists WHERE list_id=$list_id";

    //execute The Query
    $res = mysqli_query($conn, $sql);

    //check whether the query is executed
    if($res==true)
    {
      // get the list data
      $row = mysqli_fetch_assoc($res); // value is an array

      //Create Individual Variable to save the data
      $list_name = $row['list_name'];
      $list_description = $row['list_description'];
    }
    else {
      // redirect to manage lists page
      header('location:'.SITEURL.'manage_list.php');
    }
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update List</title>
    <link rel="stylesheet" href="CSS\styles.css">
  </head>
  <body>
    <div class="wrapper">
    <h1>TASK MANAGER</h1>
    <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
    <a class="btn-secondary" href="<?php echo SITEURL; ?>manage_list.php">Manage Lists</a>
    <h2>Update List</h2>

      <p><?php
      // check whether the session is created for update_fail
      if (isset($_SESSION['update_fail'])) {
        // display messege
        echo $_SESSION['update_fail'];
        // remove messege after displaying once
        unset($_SESSION['update_fail']);
      }
         ?>
      </p>


    <!-- form to add list -->
    <form class="" action="" method="POST">
      <table>
        <tr>
          <td class="form-text">List Name:</td>
          <td><input type="text" name="list_name" value="<?php echo $list_name; ?>" required="required"></td>
        </tr>
        <tr>
          <td class="form-text">List Description:</td>
          <td><textarea name="list_description" rows="8" cols="80"><?php echo $list_description; ?></textarea></td>
        </tr>
        <tr>
          <td><input class="btn-primary btn-lg" type="submit" name="submit" value="Update"></td>
        </tr>
      </table>
    </form>
    </div>
  </body>
</html>

<?php
  // check whether the update button is clicked
  if(isset($_POST['submit'])){
    // get the updated values from the form
    $list_name  = $_POST['list_name'];
    $list_description  = $_POST['list_description'];

    // connect the database
    $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    // select database
    $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

    // query to update list
    $sql2 = "UPDATE tbl_lists SET
            list_name = '$list_name',
            list_description = '$list_description'
            WHERE list_id = $list_id
            ";

    // execute query
    $res2 = mysqli_query($conn2, $sql2);

    if ($res2==true) {
      // create a SESSION variable to display messege
      $_SESSION['update'] = "List Updated Successfully";

      // redirect to manage lists page
      header('location:'.SITEURL.'manage_list.php');
    }
    else {
      // create a SESSION variables to display messege
      $_SESSION['update_fail'] = "Faied to update List";

      // rediret to update lists page
      header('location:'.SITEURL.'update_list.php?list_id='.$list_id);
    }
  }
?>
