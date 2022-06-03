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
        <h1 style="font-size:xx-large;">Query 3.6</h1>
    </div>

    <div>
        <ul>
            <li><p style="font-size: 1.5rem; margin-left: 70px ; margin-top: 20px;">Tracking the youngest researchers with the most active projects:</p></li>
            <li><a href="3.6a.php" class="but_but">Execute Query</a></li>
        </ul>
    </div>

    <div style="margin: 100px 0 0 90px;">
        <table style="column-gap: 100px;">
            <colgroup>
                <col>
                <col>
                <col>
            </colgroup>
            
            <thead>
                <caption style="font-size: 2rem;float:left; background-color:rgb(31,106,177)"> Top Young Researchers</caption>
            </thead>

            <?php
                        include 'db_connection.php';
                        $conn = OpenCon();

                        $query = "with 
                        youngs(fname,lname,resea,age) as (select re.first_name,re.last_name,re.researcher_id, year(current_date())-year(re.birthdate) 
                        from researcher re where year(current_date())-year(re.birthdate)<40),
                        act1ve(proj) as (select pr.project_id from project pr where current_date()-end_date<0 and 
                        current_date()>start_date)
                        select youngs.fname,youngs.lname,count(*) from works_on_project wop 
                        inner join youngs on wop.researcher_id = youngs.resea 
                        inner join act1ve on wop.project_id = act1ve.proj group by wop.researcher_id order by count(*) desc";
                        

                        $result = mysqli_query($conn, $query);


                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Results</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                            echo '<table class="table">';
                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th>First Name</th>';
                                        echo '<th>Last Name</th>';
                                        echo '<th># of projects</th>';
                                    echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while($row = mysqli_fetch_row($result)){
                                    echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>' . '<td>' . $row[1] . '</td>' . '<td>' . $row[2] . '</td>';
                                    echo '</tr>';
                                }
                                echo '</tbody>';
                        }
                ?>
            
        </table>
    </div>

    
    
</body>

</html>