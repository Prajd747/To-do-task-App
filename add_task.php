<?php
  include('constants.php');
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Tasks</title>
    <link rel="stylesheet" href="CSS\styles.css">
  </head>
  <body>
    <div class="wrapper">

    <h1>TASK MANAGER</h1>
    <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
    <h2>Add Task</h2>

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

    <form class="" action="" method="post">
      <table>
        <tr>
          <td class="form-text">Task Name: </td>
          <td><input type="text" name="task_name" required="required" placeholder="Type Task Name"> </td>
        </tr>
        <tr>
          <td class="form-text">Task Description</td>
          <td><textarea name="task_description" placeholder="Type Task Description" rows="8" cols="80"></textarea></td>
        </tr>
        <tr>
          <td class="form-text">Select List: </td>
          <td><select class="" name="list_id">
              <?php

                  //connect database
                  $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

                  //select Database
                  $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

                  //query to get the list from table
                  $sql = "SELECT * FROM tbl_lists";

                  //execute Query
                  $res = mysqli_query($conn, $sql);

                  if($res==true){
                      //create variable to count Rows
                      $count_rows = mysqli_num_rows($res);

                      // if there is data in database display data in drop down else display none
                      if($count_rows>0){
                          //display all lists on dropdown from database
                          while($row=mysqli_fetch_assoc($res)){
                              $list_id = $row['list_id'];
                              $list_name = $row['list_name'];
                              ?>
                              <option value="<?php echo $list_id ?>"><?php echo $list_name; ?></option>
                              <?php
                          }
                      }
                      else{
                          //display none as option
                          ?>
                          <option value="0">None</option>p
                          <?php
                      }
                    }
              ?>
          </select></td>
        </tr>
        <tr>
          <td class="form-text">Priority: </td>
          <td><select class="" name="priority">
            <option value="high">High</option>
            <option value="medium">Medium</option>
            <option value="low">Low</option>
          </select></td>
        </tr>
        <tr>
          <td class="form-text">Deadline: </td>
          <td><input type="date" name="deadline" value=""></td>
        </tr>
        <tr>
          <td><input class="btn-primary btn-lg" type="submit" name="submit" value="Save"></td>
        </tr>
      </table>
    </form>
    </div>
  </body>
</html>

<?php
  // check whether the save button is clicked
  if(isset($_POST['submit'])){
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $list_id = $_POST['list_id'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    //connect database
    $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    //select Database
    $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

    // sql query to insert
    $sql2 = "INSERT INTO tbl_tasks SET
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = $list_id,
            priority = '$priority',
            deadline = '$deadline'
            ";

    $res2 = mysqli_query($conn2, $sql2);

    if ($res2==true) {
      // create a SESSION variable to display messege
      $_SESSION['add'] = "Task Added Successfully";

      // redirect to home page
      header('location:'.SITEURL);
    }
    else {
      // create a SESSION variables to display messege
      $_SESSION['add_fail'] = "Failed to add Task";

      // rediret to add task page
      header('location:'.SITEURL.'add_task.php');
    }
  }
?>
