<?php
  include('constants.php');
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Lists</title>
    <link rel="stylesheet" href="CSS\styles.css">
  </head>
  <body>
    <div class="wrapper">
    <h1>TASK MANAGER</h1>
    <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
    <h2>Manage Lists</h2>

    <p><?php
          // check whether the session is created for add
          if (isset($_SESSION['add'])) {
            // display messege
            echo $_SESSION['add'];
            // remove messege after displaying once
            unset($_SESSION['add']);
          }
          // check wheteher seiison is created for delete
          if (isset($_SESSION['delete'])) {
            // display messege
            echo $_SESSION['delete'];
            // remove messege after displaying once
            unset($_SESSION['delete']);
          }
          // check wheteher seiison is created for delete_fail
          if (isset($_SESSION['delete_fail'])) {
            // display messege
            echo $_SESSION['delete_fail'];
            // remove messege after displaying once
            unset($_SESSION['delete_fail']);
          }
          // check wheteher seiison is created for updated
          if (isset($_SESSION['update'])) {
            // display messege
            echo $_SESSION['update'];
            // remove messege after displaying once
            unset($_SESSION['update']);
          }
        ?>
    </p>
    <!-- display lists -->

    <div class="">
      <a class="btn-primary" href="<?php echo SITEURL; ?>add_list.php">Add Lists</a>
      <table class="table-full">
        <tr>
          <th>Order</th>
          <th>List Name</th>
          <th>Actions</th>
        </tr>

        <?php
          // connect to database
          $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

          // select database
          $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

          // query to display database
          $sql = "SELECT * FROM tbl_lists";

          // execute query
          $res = mysqli_query($conn, $sql);

          if ($res==true) {
            // count the rows in database
            $count_rows = mysqli_num_rows($res);

            // create a serial integer variable
            $en = 1;

            // check if there is data in database
            if ($count_rows>0) {
              // display data
              while ($row = mysqli_fetch_assoc($res)) {
                // get data from database
                $list_id = $row['list_id'];
                $list_name = $row['list_name'];
                ?>
                <tr>
                  <td><?php echo $en++; ?></td>
                  <td><?php echo $list_name; ?></td>
                  <td>
                      <a class="btn3" href="<?php echo SITEURL; ?>update_list.php?list_id=<?php echo $list_id; ?>">Update</a>
                      <a class="btn4" href="<?php echo SITEURL; ?>delete_list.php?list_id=<?php echo $list_id; ?>">Delete</a>
                  </td>
                </tr>

                <?php
              }
            }
            else {
              ?>
                <tr>
                  <td colspan="3">No Data</td>
                </tr>
              <?php
            }
          }
         ?>
      </table>
    </div>
    </div>
  </body>
</html>
