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

                        $query = "SELECT r.researcher_id, r.first_name, r.last_name, count(*) projects_without_deliverable
                                    FROM researcher r
                                    INNER JOIN works_on_project w
                                    ON w.researcher_id = r.researcher_id
                                    INNER JOIN
                                    (SELECT p.project_id
                                    FROM project p
                                    WHERE p.project_id NOT IN
                                    (
                                    SELECT p.project_id
                                    FROM project p
                                    INNER JOIN deliverable d
                                    ON d.project_id = p.project_id
                                    )
                                    AND (datediff(p.start_date, current_date()) <= 0 AND datediff(current_date(), p.end_date) <= 0)
                                    ORDER BY p.project_id
                                    ) nodel_projects
                                    ON nodel_projects.project_id = w.project_id
                                    GROUP BY r.first_name, r.last_name, r.researcher_id
                                    HAVING count(*) >= 1;"; // NA ALLA3W TO 1 SE 5

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
                                    echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while($row = mysqli_fetch_row($result)){
                                    echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                        echo '<td>' . $row[1] . '</td>';
                                        echo '<td>' . $row[2] . '</td>';
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