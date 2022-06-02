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
        <h1 style="font-size:xx-large;">Query 3.2</h1>
    </div> 

                    <?php
                        include 'db_connection.php';
                        $conn = OpenCon();

                        $res_firstName = $_GET['fname'];
                        $res_lastName = $_GET['lname'];

                        $query1 = "DROP VIEW IF EXISTS erga_ana_ereunhth";
                        $query2 = "CREATE VIEW erga_ana_ereunhth AS 
                                    SELECT p.title FROM project p
                                    INNER JOIN works_on_project w
                                    ON w.project_id = p.project_id
                                    INNER JOIN researcher r
                                    ON r.researcher_id = w.researcher_id
                                    WHERE r.first_name = '$res_firstName' AND r.last_name = '$res_lastName'";
                        $query3 = "SELECT * FROM erga_ana_ereunhth";

                        $result = mysqli_query($conn, $query1);
                        $result = mysqli_query($conn, $query2);
                        $result = mysqli_query($conn, $query3);

                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;margin-left:70px;">No Results</h1>';
                        }
                        else{
                            echo "<p style='font-size:1.2rem; margin-left:70px; margin-top:20px;'>The projects of $res_firstName $res_lastName are:</p>";
                            echo "<div style='margin-left:70px; margin-top:20px;' class='table-responsive'>";
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

</body>

</html>