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
                <li> <a href="researchers.html">Researchers</a></li>
                <li> <a href="organizations.html">Organizations</a></li>
                <li> <a href="projects.html">Projects</a></li>
                <li> <a href="index.html">Home</a></li>
            </ul>
        </div>
    </nav>
    
    <?php
                        include 'db_connection.php';
                        $conn = OpenCon();

                        $query = "SELECT r.researcher_id, r.first_name, r.last_name, r.birthdate, r.gender, o.name_org, datework
                                    FROM researcher r
                                    INNER JOIN organization o
                                    ON o.organization_id = r.organization_id;";

                        $result = mysqli_query($conn, $query);
                        
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Results Found!</h1>';
                        }
                        else{
                            echo '<div class="table-responsive" style="margin-left:100px;">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Resarcher_ID</th>';
                                            echo '<th>First Name</th>';
                                            echo '<th>Last_Name</th>';
                                            echo '<th>Birthdate</th>';
                                            echo '<th>Gender</th>';
                                            echo '<th>Organization</th>';
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
                                            echo '<td>' . $row[5] . '</td>';
                                            echo '<td>' . $row[6] . '</td>';
                                            echo '<td>';
                                                echo '<a type="button" href="./delete_researcher.php?id=' . $row[0]. '">';
                                                echo 'delete researcher';
                                                echo '</a>';
                                            echo '</td>';                                            
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                echo '</table>';
                            echo '</div>';
                        }
                    ?>
</body>

</html>