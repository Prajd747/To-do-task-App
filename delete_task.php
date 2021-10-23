<?php
    // include constants.php
    include('constants.php');

    // check if task_id is in url
    if (isset($_GET['task_id'])){
        // get the task_id from URL or Get method
        $task_id = $_GET['task_id'];

        // connect to database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        // select Database
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        // query to delete task
        $sql = "DELETE FROM tbl_tasks WHERE task_id=$task_id";

        // execute query
        $res = mysqli_query($conn, $sql);

        // check if the query is executed
        if ($res==true){
            $_SESSION['delete'] = "Task Deleted Successfully.";

            //redirect to home page
            header('location:'.SITEURL);
        }
        else{
            $_SESSION['delete_fail'] = "Failed to Delete Task";

            //Redirect to home page
            header('location:'.SITEURL);
        }

    }
    else{
        // redirect to home page
        header('location:'.SITEURL);
    }

?>
