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

                        $name_pr = $_GET['progname'];

                        $query1 = "DROP VIEW IF EXISTS program_funds";
                        $query2 = "CREATE VIEW program_funds AS
                                    SELECT p.title, p.funds FROM project p
                                    INNER JOIN program pr
                                    ON pr.program_id = p.program_id
                                    WHERE pr.name_pr = '$name_pr'";
                        $query3 = "select * from program_funds";

                        $result = mysqli_query($conn, $query1);
                        $result = mysqli_query($conn, $query2);
                        $result = mysqli_query($conn, $query3);

                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem; margin-left: 70px">No Results</h1>';
                        }
                        else{
                            echo "<p style='font-size:1.2rem; margin-left:70px; margin-top:20px;'>The projects of $name_pr are:</p>";
                            echo "<div style='margin-left:70px; margin-top:20px;' class='table-responsive'>";
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

</body>

</html>