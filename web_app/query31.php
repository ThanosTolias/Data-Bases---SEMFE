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

    <div>
        <ul class="lista" style="margin-left: 36px;">
            <li><p style="font-size: 1.5rem; margin-left: 70px ; margin-top: 20px;">Press to view all active <b>programs</b>:</p></li>
            <li><a href="3.1a.php" class="but_but">Execute Query</a></li>
        </ul>
    </div>

    <div>
        <ul class="lista" style="margin-left: 36px;">
            <li><p style="font-size: 1.5rem; margin-left: 70px ; margin-top: 20px;">Click this button to <b>insert a new program</b>:</p></li>
            <li><a href="insert_program.html" class="but_but">Click Here!</a></li>
        </ul>
    </div>

    <div style="margin:110px 0 0 100px ;"><p style="font-size: 1.5rem;">In order to view your desired <b>projects</b>, submit your filters below:</p></div>

    <form action="query31.php" method="get">
        <ul class="forma" style="margin-top: 10px;">
            <li><p style="font-size: 24px; text-align: center;">Insert date:</p> <input type="date" name="date1" style="font-size: 1.5rem;"></li>
            <li><p style="font-size: 24px; text-align: center;">Insert duration (months):</p> <input name="duration1" type="value" placeholder="More Than" style="font-size: 1.5rem;">
                <input name="duration11" type="value" placeholder="Less Than" style="font-size: 1.5rem;"> </li>
            <li><p style="font-size: 24px; text-align: center;">Insert Executive Name:</p><input type="text" name="name1" placeholder="Executive Name"  style="font-size: 1.5rem;"></li>
            <li style="margin-top: 99px;"><input class="q31b" type="submit" value="Submit Filters" style="font-size: 1.5rem;"></li>
        </ul>
    </form>

                    <?php
                        include 'db_connection.php';
                        $conn = OpenCon();

                        $user_date = $_GET['date1'];
                        $less_than_duration = $_GET['duration11'];
                        $more_than_duration = $_GET['duration1'];
                        $executive = $_GET['name1'];

                        if (empty($user_date) and empty($more_than_duration) and empty($executive)){
                            if(empty($less_than_duration)){
                                $query = "SELECT project_id, title, start_date, end_date, abstract, funds FROM project";
                            }
                            else{
                                $query = "SELECT project_id, title, start_date, end_date, abstract, funds FROM project WHERE datediff(end_date, start_date) <= '$less_than_duration' * 30";
                            }
                        }
                        elseif (!empty($user_date) and empty($more_than_duration) and empty($executive)){
                            if(empty($less_than_duration)){
                                $query = "SELECT project_id, title, start_date, end_date, abstract, funds FROM project
                                            WHERE datediff(project.start_date, '$user_date') <=0 AND datediff(project.end_date, '$user_date') >= 0";
                            }
                            else{
                                $query = "SELECT project_id, title, start_date, end_date, abstract, funds FROM project
                                            WHERE datediff(project.start_date, '$user_date') <=0 AND datediff(project.end_date, '$user_date') >= 0
                                            AND datediff(end_date, start_date) <= '$less_than_duration' * 30";
                            }
                        }
                        elseif (empty($user_date) and !empty($more_than_duration) and empty($executive)){
                            if(empty($less_than_duration)){
                                $query = "SELECT project_id, title, start_date, end_date, abstract, funds FROM project
                                            WHERE datediff(project.end_date, project.start_date) >= 30*'$more_than_duration'";
                            }
                            else{
                                $query = "SELECT project_id, title, start_date, end_date, abstract, funds FROM project
                                            WHERE datediff(project.end_date, project.start_date) >= 30*'$more_than_duration'
                                            AND datediff(end_date, start_date) <= '$less_than_duration' * 30";
                            }
                        }
                        elseif (empty($user_date) and empty($more_than_duration) and !empty($executive)){
                            if(empty($less_than_duration)){
                            $query = "SELECT p.project_id, p.title, p.start_date, p.end_date, p.abstract, p.funds 
                                        FROM project p
                                        INNER JOIN executive e
                                        ON e.executive_id = p.executive_id
                                        WHERE e.name_ex = '$executive'";
                            }
                            else{
                                $query = "SELECT p.project_id, p.title, p.start_date, p.end_date, p.abstract, p.funds 
                                            FROM project p
                                            INNER JOIN executive e
                                            ON e.executive_id = p.executive_id
                                            WHERE e.name_ex = '$executive'
                                            AND datediff(end_date, start_date) <= '$less_than_duration' * 30";
                            }
                        }
                        elseif (!empty($user_date) and !empty($more_than_duration) and empty($executive)){
                            if(empty($less_than_duration)){
                                $query = "SELECT project_id, title, start_date, end_date, abstract, funds FROM project
                                            WHERE datediff(project.start_date, '$user_date') <=0 AND datediff(project.end_date, '$user_date') >= 0
                                            AND datediff(project.end_date, project.start_date) >= 30*'$more_than_duration'";
                            }
                            else{
                                $query = "SELECT project_id, title, start_date, end_date, abstract, funds FROM project
                                            WHERE datediff(project.start_date, '$user_date') <=0 AND datediff(project.end_date, '$user_date') >= 0
                                            AND datediff(project.end_date, project.start_date) >= 30*'$more_than_duration'
                                            AND datediff(end_date, start_date) <= '$less_than_duration' * 30";
                            }
                        }
                        elseif (!empty($user_date) and empty($more_than_duration) and !empty($executive)){
                            if(empty($less_than_duration)){
                                $query = "SELECT p.project_id, p.title, p.start_date, p.end_date, p.abstract, p.funds 
                                            FROM project p
                                            INNER JOIN executive e
                                            ON e.executive_id = p.executive_id
                                            WHERE e.name_ex = '$executive'
                                            AND datediff(p.start_date, '$user_date') <=0 AND datediff(p.end_date, '$user_date') >= 0";
                            }
                            else{
                                $query = "SELECT p.project_id, p.title, p.start_date, p.end_date, p.abstract, p.funds 
                                            FROM project p
                                            INNER JOIN executive e
                                            ON e.executive_id = p.executive_id
                                            WHERE e.name_ex = '$executive'
                                            AND datediff(p.start_date, '$user_date') <=0 AND datediff(p.end_date, '$user_date') >= 0
                                            AND datediff(end_date, start_date) <= '$less_than_duration' * 30";
                            }
                        }
                        elseif (empty($user_date) and !empty($more_than_duration) and !empty($executive)){
                            if(empty($less_than_duration)){
                                $query = "SELECT p.project_id, p.title, p.start_date, p.end_date, p.abstract, p.funds 
                                            FROM project p
                                            INNER JOIN executive e
                                            ON e.executive_id = p.executive_id
                                            WHERE e.name_ex = '$executive'
                                            AND datediff(p.end_date, p.start_date) >= 30*'$more_than_duration'";
                            }
                            else{
                                $query = "SELECT p.project_id, p.title, p.start_date, p.end_date, p.abstract, p.funds 
                                FROM project p
                                INNER JOIN executive e
                                ON e.executive_id = p.executive_id
                                WHERE e.name_ex = '$executive'
                                AND datediff(p.end_date, p.start_date) >= 30*'$more_than_duration'
                                AND datediff(end_date, start_date) <= '$less_than_duration' * 30";
                            }
                        }
                        elseif (!empty($user_date) and !empty($more_than_duration) and !empty($executive)){
                            if(empty($less_than_duration)){
                                $query = "SELECT p.project_id, p.title, p.start_date, p.end_date, p.abstract, p.funds 
                                            FROM project p
                                            INNER JOIN executive e
                                            ON e.executive_id = p.executive_id
                                            WHERE e.name_ex = '$executive'
                                            AND datediff(p.end_date, p.start_date) >= 30*'$more_than_duration'
                                            AND datediff(p.start_date, '$user_date') <=0 AND datediff(p.end_date, '$user_date') >= 0";
                            }
                            else{
                                $query = "SELECT p.project_id, p.title, p.start_date, p.end_date, p.abstract, p.funds 
                                            FROM project p
                                            INNER JOIN executive e
                                            ON e.executive_id = p.executive_id
                                            WHERE e.name_ex = '$executive'
                                            AND datediff(p.end_date, p.start_date) >= 30*'$more_than_duration'
                                            AND datediff(p.start_date, '$user_date') <=0 AND datediff(p.end_date, '$user_date') >= 0
                                            AND datediff(end_date, start_date) <= '$less_than_duration' * 30";
                            }
                        }

                        $result = mysqli_query($conn, $query);
                        
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Projects Found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Project_ID</th>';
                                            echo '<th>Title</th>';
                                            echo '<th>Start Date</th>';
                                            echo '<th>End Date</th>';
                                            echo '<th>Abstract</th>';
                                            echo '<th>Funds (Euro)</th>';
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

                                            echo '<td>';
                                                echo '<a type="button" href="./show_researchers_of_project.php?id=' . $row[0]. '">';
                                                echo 'show researchers';
                                                echo '</a>';
                                            echo '</td>';
                                            
                                            echo '<td>';
                                                 echo '<a type="button" href="./delete_project.php?id=' . $row[0]. '&udate=' . $user_date . '&lduration=' . $less_than_duration . '&mduration=' . $more_than_duration . '&exname=' . $executive . '">';
                                                echo 'delete project';
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