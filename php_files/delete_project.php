<!DOCTYPE html>
<html lang = "en">

<body>

    <div class="container">
    <div class="row" id="row">
        <div class="col-md-12">
            <form class="form-horizontal" name="project_form" method="POST">
                <div class="form-group col-sm-3 mb-3">
                <?php

                    include 'db_connection.php';
                    $conn = OpenCon();
                    
                    $project_id = $_GET['id'];
                    $query = "SELECT project_id, title FROM project WHERE project_id = $project_id";
                    $res1 = mysqli_query($conn, $query);
                    $row = mysqli_fetch_row($res1);

                    echo '<div class="form-group col-sm-3 mb-3">';
                        echo '<label class = "form-label" style="width: 300px;">Are you sure you want to DELETE project: <br><b>' . $row[0] . '  ' . $row[1] . '?</b></label>';
                    echo '</div>';

                    if(isset($_POST['submit_del'])){
                    
                        $query = "DELETE FROM project
                                WHERE project_id = $project_id";
                        if (mysqli_query($conn, $query)) {
                            header("Location: ./read_projects_criteria.php");
                            exit();
                        }
                        else{
                            echo "Error while deleting record: <br>" . mysqli_error($conn) . "<br>";
                        }
                    }

                ?>
                </div>
                
                <button class = "btn btn-primary btn-submit-custom" type = "submit" name="submit_del">Delete</button>
                <button class = "btn btn-primary btn-submit-custom" formaction="read_projects_criteria.php">Back</button>

            </form>
    </div>
    </div>
</div>

    
</body>

</html>