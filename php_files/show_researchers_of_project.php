<!DOCTYPE html>
<html lang = "en">                    
                    
<body>     

    <div class="container">
        <div class="row" id="row">
            <div class="col-md-12">
                <div class="card" id="card-container">
                    <div class="card-body" id="card">

                    <?php
                        include 'db_connection.php';
                        $conn = OpenCon();

                        //$program_name = $_POST['Program Name'];
                        // // $program_ID = $_POST['Program ID'];

                        $project_id = $_GET['id'];


                        $query = "SELECT * FROM researcher r
                                    INNER JOIN works_on_project w
                                    ON w.researcher_id = r.researcher_id
                                    INNER JOIN project p
                                    ON p.project_id = w.project_id
                                    WHERE p.project_id = '$project_id'";

                        $result = mysqli_query($conn, $query);
                        
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Projects Found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Researcher_ID</th>';
                                            echo '<th>First Name</th>';
                                            echo '<th>Last Name</th>';
                                            echo '<th>Birthdate</th>';
                                            echo '<th>Gender</th>';
                                            echo '<th>Datework</th>';

                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_row($result)){
                                        echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>';
                                            echo '<td>' . $row[1] . '</td>';
                                            echo '<td>' . $row[2] . '</td>';
                                            echo '<td>' . $row[3] . '</td>';
                                            echo '<td>' . $row[4] . '</td>';
                                            echo '<td>' . $row[6] . '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                echo '</table>';
                            echo '</div>';
                        }
                    ?>
                    </div>
                <a action></a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>