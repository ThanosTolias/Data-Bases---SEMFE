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
        <h1 style="font-size:xx-large;">Query 3.5</h1>
    </div>
    
    

    <ul class="lista">
        <li><p style="font-size: 1.5rem; margin-left: 70px ; margin-top: 20px;">Tracking the top three pairs of scientific fields that came up in projects:</p></li>
        <li><a href="3.5a.php" class="but_but">Execute Query</a></li>
    </ul>

    <div style="margin: 100px 0 0 90px;">
        <table style="column-gap: 100px;">
            <colgroup>
                <col>
            </colgroup>
            
            <thead>
                <caption style="font-size: 2rem;font-size: 2rem;float:left; background-color:rgb(31,106,177)"> Most Observed Pairs Of Research Fields</caption>
                <tr style="background-color:rgb(31, 106, 177); color: rgb(255, 255, 255); font-size: 1.5rem;"> <!-- prwth grammh-->
                </tr>
            </thead>

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
                                    ORDER BY count(*) desc
                                    LIMIT 3";

                        $result = mysqli_query($conn, $query1);
                        $result = mysqli_query($conn, $query2);
                        $result = mysqli_query($conn, $query3);
                        $result = mysqli_query($conn, $query4);
                        $result = mysqli_query($conn, $query5);

                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Results</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                            echo '<table class="table">';
                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th>Pairs</th>';
                                    echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while($row = mysqli_fetch_row($result)){
                                    echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                   echo '</tr>';
                                }
                                echo '</tbody>';
                        }
            ?>
            
        </table>
    </div>
    
</body>

</html>