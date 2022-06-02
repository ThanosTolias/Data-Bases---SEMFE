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
        <h1 style="font-size:xx-large;">Query 3.7</h1>
    </div>  

    <ul class="lista">
        <li><p style="font-size: 1.5rem; margin-left: 70px ; margin-top: 20px;">Tracking the top five executives:</p></li>
        <li><a href="3.7a.php" class="but_but">Execute Query</a></li>
    </ul>

    <div style="margin: 100px 0 0 90px;">
        <table style="column-gap: 100px;">
            <colgroup>
                <col>
                <col>
                <col>
                <col>
            </colgroup>
            
            <thead>
                <caption style="font-size: 2rem;float:left;background-color:rgb(31,106,177);"> Top Executives</caption>
            </thead>

            <?php
                        include 'db_connection.php';
                        $conn = OpenCon();

                        $query = "with budget_pr(executive_id, organization_id, value)as
                                (select executive_id, organization_id, -1*sum(funds) from project group by executive_id, organization_id) ,
                                top5ing(executive_id, organization_id, value) as
                                (select executive_id, organization_id, -1*value from budget_pr group by value limit 5 )
                                select name_ex, name_org, value from executive, organization, top5ing where (executive.executive_id, organization.organization_id) = (top5ing.executive_id,top5ing.organization_id)";
                        

                        $result = mysqli_query($conn, $query);


                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Results</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                            echo '<table class="table">';
                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th>Executive Name</th>';
                                        echo '<th>Organization Name</th>';
                                        echo '<th>Total Funds (Euro)</th>';
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
                        }
            ?>
            
        </table>
    </div>

</body>

</html>