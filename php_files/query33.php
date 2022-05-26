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

                        $query1 = "with given(project_id) as
                                    (select project_id 
                                    from scientific_field_project
                                    where scfield_id = 36649
                                    )
                                    select title 
                                    from project 
                                    where project.project_id in
                                    (select project_id from given)";
                        $query2 = "with given(project_id) as
                                    (select project_id 
                                    from scientific_field_project
                                    where scfield_id = 36649
                                    ),
                                    resIDs(researcher_id) as
                                    (select researcher_id 
                                    from works_on_project 
                                    where works_on_project.project_id in
                                    (select project_id from given))
                                    select first_name, last_name from researcher 
                                    where researcher.researcher_id in 
                                    (select researcher_id from resIDs)";

                        $result = mysqli_query($conn, $query1);
                        $result = mysqli_query($conn, $query2);

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