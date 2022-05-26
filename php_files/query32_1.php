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

                        //$res_firstName = _POST['FirstName'];
                        //$res_lastName = _POST['LastName'];

                        $query1 = "DROP VIEW IF EXISTS erga_ana_ereunhth";
                        $query2 = "CREATE VIEW erga_ana_ereunhth AS 
                                    SELECT p.title FROM project p
                                    INNER JOIN works_on_project w
                                    ON w.project_id = p.project_id
                                    INNER JOIN researcher r
                                    ON r.researcher_id = w.researcher_id
                                    WHERE r.first_name = 'Scott' AND r.last_name = 'Hurst'";
                                    // WHERE r.first_name = '$res_firstName' AND r.last_name = '$r_lastName'";
                        $query3 = "SELECT * FROM erga_ana_ereunhth";

                        $result = mysqli_query($conn, $query1);
                        $result = mysqli_query($conn, $query2);
                        $result = mysqli_query($conn, $query3);

                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Projects Found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                            echo '<table class="table">';
                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th>Project Title</th>';
                                    echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while($row = mysqli_fetch_row($result)){
                                    echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
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