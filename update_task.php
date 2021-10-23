<?php
  include('constants.php');

  // check task_id in url
  if(isset($_GET['task_id'])){

    $task_id = $_GET['task_id'];

    // connnect to database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    // select database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

    // query to get task data from database
    $sql = "SELECT * FROM tbl_tasks WHERE task_id=$task_id";

    // execute The Query
    $res = mysqli_query($conn, $sql);

    // check whether the query is executed
    if($res==true)
    {
      // get the task data
      $row = mysqli_fetch_assoc($res); // value is an array

      // create individual variable to save the data
      $task_name = $row['task_name'];
      $task_description = $row['task_description'];
      $list_id = $row['list_id'];
      $priority = $row['priority'];
      $deadline = $row['deadline'];
    }
  }
  else {
    // redirect to home page
    header('location:'.SITEURL);
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update Task</title>
    <link rel="stylesheet" href="CSS\styles.css">
  </head>
  <body>
    <div class="wrapper">
    <h1>TASK MANAGER</h1>
    <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
    <h2>Update Task</h2>

    <p><?php
    if (isset($_SESSION['update_fail'])) {
      // display messege
      echo $_SESSION['update_fail'];
      // remove messege after displaying once
      unset($_SESSION['update_fail']);
    }
    ?></p>

    <!-- form to update task -->
    <form class="" action="" method="post">
      <table>
        <tr>
          <td class="form-text">Task Name: </td>
          <td><input type="text" name="task_name" value="<?php echo $task_name; ?>" required="required"></td>
        </tr>
        <tr>
          <td class="form-text">Task Description: </td>
          <td><textarea name="task_description" rows="8" cols="80"><?php echo $task_description; ?></textarea></td>
        </tr>
        <tr>
          <td class="form-text">Select List: </td>
          <td><select class="" name="list_id">
            <?php
              // connect to database
              $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

              // select database
              $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

              // query to get lists
              $sql2 = "SELECT * FROM tbl_lists";

              // execute query
              $res2 = mysqli_query($conn2, $sql2);

              if($res2==true)
              {
                  // display the Lists

                  $count_rows2 = mysqli_num_rows($res2);

                  // check if list is added
                  if($count_rows2>0)
                  {
                      while($row2=mysqli_fetch_assoc($res2))
                      {
                          // get individual value
                          $list_id_db = $row2['list_id'];
                          $list_name = $row2['list_name'];
                          ?>
                           <option <?php if($list_id_db==$list_id){echo "selected='selected'";} ?> value="<?php echo $list_id_db; ?>"><?php echo $list_name; ?></option>
                          <?php
                      }
                  }
                  else
                  {
                      // display none as option
                      ?>
                       <option <?php if($list_id=0){echo "selected='selected'";} ?> value="0">None</option>
                      <?php
                  }
              }
            ?>
          </select></td>
        </tr>
        <tr>
          <td class="form-text">Priority</td>
          <td>
            <select class="" name="priority">
              <option <?php if($priority=="high"){echo "selected='selected'";} ?> value="high">High</option>
              <option <?php if($priority=="medium"){echo "selected='selected'";} ?> value="medium">Medium</option>
              <option <?php if($priority=="low"){echo "selected='selected'";} ?> value="low">Low</option>
            </select>
        </td>
        </tr>
        <tr>
          <td class="form-text">Deadline</td>
          <td><input type="date" name="deadline" value="<?php echo $deadline; ?>"></td>
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
  // check if the button is clicked
  if (isset($_POST['submit'])) {

    // get the updated values from the form

    $task_name  = $_POST['task_name'];
    $task_description  = $_POST['task_description'];
    $list_id  = $_POST['list_id'];
    $priority  = $_POST['priority'];
    $deadline = $_POST['deadline'];

    // connect the database
    $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    // select database
    $db_select3 = mysqli_select_db($conn3, DB_NAME) or die(mysqli_error());

    // query to update task
    $sql3 = "UPDATE tbl_tasks SET
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = '$list_id',
            priority = '$priority',
            deadline = '$deadline'
            WHERE task_id = $task_id
            ";

    // execute query
      $res3 = mysqli_query($conn3, $sql3);

      if ($res3==true) {
        // create a SESSION variable to display messege
        $_SESSION['update'] = "Task Updated Successfully";

        // redirect to home page
        header('location:'.SITEURL);
      }
      else {
        // create a SESSION variables to display messege
        $_SESSION['update_fail'] = "Faied to update Task";

        // rediret to update lists page
        header('location:'.SITEURL.'update_task.php?list_id='.$list_id);
      }
  }
?>
