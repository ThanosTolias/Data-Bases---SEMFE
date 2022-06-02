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
        <h1 style="font-size:xx-large;">Query 3.4</h1>
    </div> 

    
    <ul class="lista">
        <li><p style="font-size: 1.5rem; margin-left: 70px ; margin-top: 20px;">Tracking all organizations which took over the same ammount of projects in two concecutive years with a higher number of ten projects per year:</p></li>
        <li><a href="3.4a.php" class="but_but">Execute Query</a></li>
    </ul>
    <div style="margin: 100px 0 0 90px;">
        <table style="column-gap: 100px;">
            <colgroup>
                <col>
                <col>
            </colgroup>
            
            <thead>
                <caption style="font-size: 2rem;float:left;"> Organizations</caption>
                <tr style="background-color:rgb(31, 106, 177); color: rgb(255, 255, 255); font-size: 1.5rem;"> <!-- prwth grammh-->
                    <th>Name</th>
                </tr>
            </thead>

            <?php
                        include 'db_connection.php';
                        $conn = OpenCon();

                        $query = "with table1(organization_id, year1, num1) as(
                                    select pr.organization_id, year(pr.start_date) YYYY, count(*) from project pr group by pr.organization_id, 
                                    year(pr.start_date) having count(*) >= 10 order by pr.organization_id, year(pr.start_date)),
                                    findtheorg(organization_id) as 
                                    (select t1.organization_id from table1 t1 -- , t1.year1, t1.num1, t2.year1, t2.num1 
                                    inner join table1 t2 on t1.organization_id = t2.organization_id and t1.year1 = t2.year1 + 1
                                    where t1.num1 = t2.num1)
                                    select name_org from organization 
                                    where organization.organization_id in
                                    (Select organization_id from findtheorg);";

                        $result = mysqli_query($conn, $query);

                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Results</h1>';
                        }
                        else{
                            echo '<tbody>';
                            while($row = mysqli_fetch_row($result)){
                                echo '<tr> <!-- deuterh grammh-->';
                                echo '<td>' . $row[0] . '</td>';
                                echo'</tr>';
                            }
                            echo'</tbody>';
                        }
            ?>
            
        </table>
    </div>
</body>

</html>