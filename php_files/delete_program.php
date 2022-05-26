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
                    
                    $program_id = $_GET['id'];
                    $query = "SELECT program_id, name_pr FROM program WHERE program_id = $program_id";
                    $res1 = mysqli_query($conn, $query);
                    $row = mysqli_fetch_row($res1);

                    echo '<div class="form-group col-sm-3 mb-3">';
                        echo '<label class = "form-label" style="width: 300px;">Are you sure you want to DELETE program: <br><b>' . $row[0] . '  ' . $row[1] . '?</b></label>';
                    echo '</div>';

                    if(isset($_POST['submit_del'])){
                    
                        $query = "DELETE FROM program
                                WHERE program_id = '$program_id'";
                        if (mysqli_query($conn, $query)) {
                            header("Location: ./read_programs.php");
                            exit();
                        }
                        else{
                            echo "Error while deleting record: <br>" . mysqli_error($conn) . "<br>";
                        }
                    }

                ?>
                </div>
                
                <button class = "btn btn-primary btn-submit-custom" type = "submit" name="submit_del">Delete</button>
                <button class = "btn btn-primary btn-submit-custom" formaction="read_programs.php">Back</button>

            </form>
    </div>
    </div>
</div>

    
</body>

</html>