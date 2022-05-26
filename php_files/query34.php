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

                        $query = "with table1(organization_id, year1, num1) as(
                                    select pr.organization_id, year(pr.start_date) YYYY, count(*) from project pr group by pr.organization_id, 
                                    year(pr.start_date) having count(*) >=2 order by pr.organization_id, year(pr.start_date)),
                                    findtheorg(organization_id) as 
                                    (select t1.organization_id from table1 t1 -- , t1.year1, t1.num1, t2.year1, t2.num1 
                                    inner join table1 t2 on t1.organization_id = t2.organization_id and t1.year1 = t2.year1 + 1
                                    where t1.num1 = t2.num1)
                                    select name_org from organization 
                                    where organization.organization_id in
                                    (Select organization_id from findtheorg);";

                        $result = mysqli_query($conn, $query);

                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Projects Found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                            echo '<table class="table">';
                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th>Organization</th>';
                                        echo '<th>Year</th>';
                                        echo '<th>Number of Projects</th>';
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
                            echo '</table>';
                        echo '</div>';
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