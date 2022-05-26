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

                        //$program_name = $_POST['Program Name'];
                        //$program_ID = $_POST['Program ID'];

                        $user_year = $_POST['Year'];
                        $user_month = $_POST['Month'];
                        $user_day = $_POST['Day'];

                        //$user_year = 2023;
                        //$user_month = 12;
                        //$user_day = 16;
                        //$project_duration = 20;
                        //$executive = "Philip Stewart";

                        //$user_date = $user_year . "-" . $user_month . "-" . $user_day; // san na leme energa projects
                        //$project_duration = $_POST['< Project Duration (months)']; // diarkoun mexri $project_duration mhnes
                        //$executive = $_POST['Executive of the Project']; //The name of the executive (NO IDs, !!I should ask!!)

                        if (empty($user_date) and empty($project_duration) and empty($executive)){
                            //$query = "SELECT * FROM project p;"
                            $query = "SELECT project_id, title, start_date, end_date, abstract, funds FROM project";
                        }
                        elseif (!empty($user_date) and empty($project_duration) and empty($executive)){
                            $query = "SELECT project_id, title, start_date, end_date, abstract, funds FROM project
                                        WHERE datediff(project.start_date, '$user_date') <=0 AND datediff(project.end_date, '$user_date') >= 0";
                        }
                        elseif (empty($user_date) and !empty($project_duration) and empty($executive)){
                            $query = "SELECT project_id, title, start_date, end_date, abstract, funds FROM project
                                        WHERE datediff(project.end_date, project.start_date) <= 30*'$project_duration'";
                        }
                        elseif (empty($user_date) and empty($project_duration) and !empty($executive)){
                            $query = "SELECT p.project_id, p.title, p.start_date, p.end_date, p.abstract, p.funds 
                                        FROM project p
                                        INNER JOIN executive e
                                        ON e.executive_id = p.executive_id
                                        WHERE e.name_ex = '$executive'";
                        }
                        elseif (!empty($user_date) and !empty($project_duration) and empty($executive)){
                            $query = "SELECT project_id, title, start_date, end_date, abstract, funds FROM project
                                        WHERE datediff(project.start_date, '$user_date') <=0 AND datediff(project.end_date, '$user_date') >= 0
                                        AND datediff(project.end_date, project.start_date) <= 30*'$project_duration'";
                        }
                        elseif (!empty($user_date) and empty($project_duration) and !empty($executive)){
                            $query = "SELECT p.project_id, p.title, p.start_date, p.end_date, p.abstract, p.funds 
                                        FROM project p
                                        INNER JOIN executive e
                                        ON e.executive_id = p.executive_id
                                        WHERE e.name_ex = '$executive'
                                        AND datediff(p.start_date, '$user_date') <=0 AND datediff(p.end_date, '$user_date') >= 0";
                        }
                        elseif (empty($user_date) and !empty($project_duration) and !empty($executive)){
                            $query = "SELECT p.project_id, p.title, p.start_date, p.end_date, p.abstract, p.funds 
                                        FROM project p
                                        INNER JOIN executive e
                                        ON e.executive_id = p.executive_id
                                        WHERE e.name_ex = '$executive'
                                        AND datediff(p.end_date, p.start_date) <= 30*'$project_duration'";
                        }
                        else{
                            $query = "SELECT p.project_id, p.title, p.start_date, p.end_date, p.abstract, p.funds 
                            FROM project p
                            INNER JOIN executive e
                            ON e.executive_id = p.executive_id
                            WHERE e.name_ex = '$executive'
                            AND datediff(p.end_date, p.start_date) <= 30*'$project_duration'
                            AND datediff(p.start_date, '$user_date') <=0 AND datediff(p.end_date, '$user_date') >= 0";
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
                                            echo '<td>' . $row[1] . '    </td>';
                                            echo '<td>' . $row[2] . '</td>';
                                            echo '<td>' . $row[3] . '</td>';
                                            echo '<td>' . $row[4] . '</td>';
                                            echo '<td>' . $row[5] . '</td>';
                                            // echo '<td>';
                                               /* echo '<a type="button" href="./update_student.php?id=' . $row[0]. '">';
                                                    echo '<i class="fa fa-edit"></i>';
                                                echo '</a>'; */
                                            // echo '</td>';
                                            /* echo '<td>';
                                                echo '<a type="button" href="./delete_student.php?id=' . $row[0]. '">';
                                                    echo '<i class = "fa fa-trash"></i>';
                                                echo '</a>';
                                            echo '</td>'; */
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                echo '</table>';
                            echo '</div>'; // logika sto idio arxeio 8a prepei na ftiaxw ena query gia tous ereunhtes tou ergou pou 8a epile3ei o xrhsths. apla prwta prepei na doume pws 8a to kanoume apo apopsh html auto
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
