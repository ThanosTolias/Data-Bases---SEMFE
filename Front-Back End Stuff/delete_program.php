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
                            header("Location: ./3.1a.php");
                            exit();
                        }
                        else{
                            echo "Error while deleting record: <br>" . mysqli_error($conn) . "<br>";
                        }
                    }

                ?>
                </div>
                
                <button class = "btn btn-primary btn-submit-custom" type = "submit" name="submit_del">Delete</button>
                <button class = "btn btn-primary btn-submit-custom" formaction="3.1a.php">Back</button>

            </form>
    </div>
    </div>
</div>
    
</body>

</html>