<?php
  // include constants.php
  include('constants.php');

  // check if list_id in url
  if (isset($_GET['list_id'])) {
    // get the list_id from URL or Get method
    $list_id = $_GET['list_id'];
    // connect to database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    // select database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

    // query to delete list from database
    $sql = "DELETE FROM tbl_lists WHERE list_id=$list_id";

    //execute The Query
    $res = mysqli_query($conn, $sql);

    // check whether the query is executed
    if($res==true) {
      // create a SESSION variable to display messege
      $_SESSION['delete'] = "List Deleted Successfully";

      // redirect to manage lists page
      header('location:'.SITEURL.'manage_list.php');
    }
    else {
      // failed to Delete List
      $_SESSION['delete_fail'] = "Failed to Delete List.";

      // redirect to manage lists page
      header('location:'.SITEURL.'manage_list.php');
    }
  }
  else {
    // redirect to manage lists page
    header('location:'.SITEURL.'manage_list.php');
  }


?>
