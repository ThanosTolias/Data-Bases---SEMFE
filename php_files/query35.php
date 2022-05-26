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

                        $query1 = "DROP VIEW IF EXISTS zeugh_pediwn";
                        $query2 = "CREATE VIEW zeugh_pediwn as
                                    SELECT sc1.name_scfield name1, sc2.name_scfield name2, sc1.scfield_id + sc2.scfield_id as keyy
                                    FROM scientific_field sc1
                                    INNER JOIN scientific_field sc2
                                    ON sc1.scfield_id < sc2.scfield_id";
                        $query3 = "DROP VIEW IF EXISTS erga_kleidi";
                        $query4 = "CREATE VIEW erga_kleidi as
                                    SELECT project_id, sum(scfield_id) as keyy, count(*)
                                    FROM scientific_field_project
                                    GROUP BY project_id
                                    HAVING COUNT(*) = 2";
                        $query5 = "SELECT concat(zp.name1, zp.name2) as namee, count(*)
                                    FROM zeugh_pediwn zp
                                    INNER JOIN erga_kleidi ek
                                    ON ek.keyy = zp.keyy
                                    GROUP BY namee
                                    ORDER BY count(*) desc";

                        $result = mysqli_query($conn, $query1);
                        $result = mysqli_query($conn, $query2);
                        $result = mysqli_query($conn, $query3);
                        $result = mysqli_query($conn, $query4);
                        $result = mysqli_query($conn, $query5);

                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Projects Found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                            echo '<table class="table">';
                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th>Scientifics Fields</th>';
                                        echo '<th>Count</th>';
                                    echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while($row = mysqli_fetch_row($result)){
                                    echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<th>' . $row[1] . '</th>';
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