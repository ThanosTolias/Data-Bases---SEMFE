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

                        //$name_pr = _POST['ProgramName'];

                        $query1 = "DROP VIEW IF EXISTS program_funds";
                        $query2 = "CREATE VIEW program_funds AS
                                    SELECT p.title, p.funds FROM project p
                                    INNER JOIN program pr
                                    ON pr.program_id = p.program_id
                                    WHERE pr.name_pr = 'program727'";
                                    // WHERE pr.name_pr = '$name_pr'";
                        $query3 = "select * from program_funds";

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
                                        echo '<th>Project Funds (Euro)</th>';
                                    echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while($row = mysqli_fetch_row($result)){
                                    echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<td>' . $row[1] . '</td>';
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