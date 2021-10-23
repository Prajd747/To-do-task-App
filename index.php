<?php
include('constants.php');
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ToDo App</title>
    <link rel="stylesheet" href="CSS\styles.css">
  </head>
  <body>
    <div class="wrapper">

    <h1>TASK MANAGER</h1>

  <!-- menu starts -->

  <div class="menu">
    <a href="<?php echo SITEURL;?>">Home</a>

    <?php
      // display lists from database in menu

      // connect to database
      $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

      //select Database
      $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

      // sql query to insert
      $sql2 = "SELECT * FROM tbl_lists";

      //execute Query
      $res2 = mysqli_query($conn2, $sql2);

      if ($res2==true) {
            // display lists from database
            while ($row2=mysqli_fetch_assoc($res2)) {
              $list_id = $row2['list_id'];
              $list_name = $row2['list_name'];
              ?>
                <a href="<?php echo SITEURL; ?>list_task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
              <?php
            }
      }

    ?>

    <a href="<?php echo SITEURL;?>manage_list.php">Manage Lists</a>
  </div>

    <!-- sessions -->

    <p><?php
    if (isset($_SESSION['add'])) {
      // display messege
      echo $_SESSION['add'];
      // remove messege after displaying once
      unset($_SESSION['add']);
    }
    if (isset($_SESSION['delete'])) {
      // display messege
      echo $_SESSION['delete'];
      // remove messege after displaying once
      unset($_SESSION['delete']);
    }
    if (isset($_SESSION['delete_fail'])) {
      // display messege
      echo $_SESSION['delete_fail'];
      // remove messege after displaying once
      unset($_SESSION['delete_fail']);
    }
    if (isset($_SESSION['update'])) {
      // display messege
      echo $_SESSION['update'];
      // remove messege after displaying once
      unset($_SESSION['update']);
    }
    ?></p>

    <!-- tasks start here -->

    <div class="tasks">
      <a class="btn-primary" href="<?php echo SITEURL;?>add_task.php"">Add Tasks</a>
      <table class="table-full">
        <tr>
          <th>Order</th>
          <th>Task Name</th>
          <th>Priority</th>
          <th>Deadline</th>
          <th>Actions</th>
        </tr>
        <?php
          // connect to database
          $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

          //select Database
          $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

          // sql query to display
          $sql = "SELECT * FROM tbl_tasks";

          //execute Query
          $res = mysqli_query($conn, $sql);

          if ($res==true) {
            // display tasks from database
            //count rows in database
            $count_rows = mysqli_num_rows($res);

            //create integer variable
            $sn=1;

            // check if there is data in tasks table
            if ($count_rows>0) {
              // data is in database
              while ($row=mysqli_fetch_assoc($res)) {
                $task_id = $row['task_id'];
                $task_name = $row['task_name'];
                $priority = $row['priority'];
                $deadline = $row['deadline']
                ?>
                <tr>
                  <td><?php echo $sn++; ?></td>
                  <td><?php echo $task_name; ?></td>
                  <td><?php echo $priority; ?></td>
                  <td><?php echo $deadline; ?></td>
                  <td><a class="btn3" href="<?php echo SITEURL; ?>update_task.php?task_id=<?php echo $task_id; ?>">Update</a>
                      <a class="btn4" href="<?php echo SITEURL; ?>delete_task.php?task_id=<?php echo $task_id; ?>">Delete</a></td>
                </tr>
                <?php
              }
            }
            else {
              // no data in database
              ?><tr>
                <td colspan="5">No Tasks Yet</td>
              </tr><?php
            }
          }

        ?>

      </table>
      </div>
    </div>
  </body>
</html>
