<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G.S.T DB Team 11</title>
    <link rel="stylesheet" href="style.css">
</head>

<body style="background-color:rgb(148, 193, 231);">

    <nav>
        <div class="wrapper">
            <ul>
                <li> <a href="3.1.html">Q 3.1</a></li>
                <li> <a href="3.2.html">Q 3.2</a></li>
                <li> <a href="3.3.html">Q 3.3</a></li>
                <li> <a href="3.4.html">Q 3.4</a></li>
                <li> <a href="3.5.html">Q 3.5</a></li>
                <li> <a href="3.6.html">Q 3.6</a></li>
                <li> <a href="3.7.html">Q 3.7</a></li>
                <li> <a href="3.8.html">Q 3.8</a></li>
                <li> <a href="researhcers.html">Researchers</a></li>
                <li> <a href="organizations.html">Organizations</a></li>
                <li> <a href="projects.html">Projects</a></li>
                <li> <a href="index.html">Home</a></li>
            </ul>
        </div>
    </nav>
    
    <div class="container">
    <div class="row" id="row">
        <div class="col-md-12">
            <form class="form-horizontal" name="project_form" method="POST">
                <div class="form-group col-sm-3 mb-3">
                <?php

                    include 'db_connection.php';
                    $conn = OpenCon();
                    
                    $project_id = $_GET['id'];
                    $udate = $_GET['udate'];
                    $lduration = $_GET['lduration'];
                    $mduration = $_GET['mduration'];
                    $exname = $_GET['exname'];

                    $query = "SELECT project_id, title FROM project WHERE project_id = '$project_id'";
                    $res1 = mysqli_query($conn, $query);
                    $row = mysqli_fetch_row($res1);

                    echo '<div class="form-group col-sm-3 mb-3">';
                        echo '<label class = "form-label" style="width: 300px;">Are you sure you want to DELETE project: <br><b>' . $row[0] . '  ' . $row[1] . '?</b></label>';
                    echo '</div>';

                    if(isset($_POST['submit_del'])){
                    
                        $query = "DELETE FROM project
                                    WHERE project_id = '$project_id'";
                        if (mysqli_query($conn, $query)) {
                            // header("Location: ./query31.php?user_date=' . $udate . '&less_than_duration=' . $lduration . '&more_than_duration=' . $mduration . '&executive=' . $exname .'");                                               
                            header("Location: ./query31.php?date1=" . $udate . "&duration11=" . $lduration . "&duration1=" . $mduration . "&name1=" . $exname);                                               

                            exit();
                        }
                        else{
                            echo "Error while deleting record: <br>" . mysqli_error($conn) . "<br>";
                        }
                    }

                ?>
               
               </div>
                    
                    <button class = "btn btn-primary btn-submit-custom" type = "submit" name="submit_del">Delete</button>
    
                    <form>
                    <input type="button" value="Back" onclick="history.go(-1)">
                    </form>
    
                    </form> 

                    </form>
    </div>
    </div>


</body>

</html>