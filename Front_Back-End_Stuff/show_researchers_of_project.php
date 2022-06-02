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
    <div class="wrapper">   
        <h1 style="font-size:xx-large;">Query 3.1</h1>
    </div>

                    <?php
                        include 'db_connection.php';
                        $conn = OpenCon();

                        $project_id = $_GET['id'];

                        $query = "SELECT title FROM project where project_id = '$project_id';";
                        $result = mysqli_query($conn, $query);
                        $title = mysqli_fetch_row($result)[0];

                        $query = "SELECT * FROM researcher r
                                    INNER JOIN works_on_project w
                                    ON w.researcher_id = r.researcher_id
                                    INNER JOIN project p
                                    ON p.project_id = w.project_id
                                    WHERE p.project_id = '$project_id'";

                        $result = mysqli_query($conn, $query);
                        
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Results</h1>';
                        }
                        else{
                            echo '<div>';
                            echo '<ul class="lista" style="margin-left: 36px;">';
                                echo "<li><p style='font-size: 1.5rem; margin-left: 70px ; margin-top: 20px;'>The researchers of project $title are:</p></li>";
                            echo '</ul>';
                            echo '</div>';
                            echo '<div class="table-responsive" style="margin-top:100px;margin-left:70px;">';
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
                   
</body>

</html>