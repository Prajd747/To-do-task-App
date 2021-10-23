<?php
  include('constants.php');
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add List</title>
    <link rel="stylesheet" href="CSS\styles.css">
  </head>
  <body>
    <div class="wrapper">

    <h1>TASK MANAGER</h1>
    <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
    <a class="btn-secondary" href="<?php echo SITEURL; ?>manage_list.php">Manage Lists</a>
    <h2>Add List</h2>

    <p><?php
          // check whether the session is created
          if (isset($_SESSION['add_fail'])) {
            // display messege
            echo $_SESSION['add_fail'];
            // remove messege after displaying once
            unset($_SESSION['add_fail']);
          }
        ?>
    </p>

    <!-- form to add list -->
    <form class="" action="" method="post">
      <table>
        <tr>
          <td class="form-text">List Name:</td>
          <td><input type="text" name="list_name" placeholder="Type list name here" value="" required="required"></td>
        </tr>
        <tr>
          <td class="form-text">List Description:</td>
          <td><textarea name="list_description" rows="8" cols="80" placeholder="Type list description here"></textarea></td>
        </tr>
        <tr>
          <td><input type="submit" name="submit" value="Save"></td>
        </tr>
      </table>
    </form>
    </div>
  </body>
</html>

<?php
  // check form pcntl_wexitstatus
  if (isset($_POST["submit"]))
  {
    // set input from form to variables
    $list_name = $_POST{"list_name"};
    $list_description = $_POST{"list_description"};

    // connect SQLiteDatabase

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    // select database

    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

    // query to insert
    $sql = "INSERT INTO tbl_lists SET
            list_name = '$list_name',
            list_description = '$list_description'
            ";

    // execute query
    $res = mysqli_query($conn, $sql);

    if ($res==true) {
      // create a SESSION variable to display messege
      $_SESSION['add'] = "List Added Successfully";

      // redirect to manage lists page
      header('location:'.SITEURL.'manage_list.php');
    }
    else {
      // create a SESSION variables to display messege
      $_SESSION['add_fail'] = "Faied to add List";

      // rediret to add list page
      header('location:'.SITEURL.'add_list.php');
    }

  }
?>
