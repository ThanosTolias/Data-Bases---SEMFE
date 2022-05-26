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
                            echo '<h1 style="margin-top: 5rem;">No Projects Found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                            echo '<table class="table">';
                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th>First Name</th>';
                                        echo '<th>Last Name</th>';
                                        echo '<th>num projects</th>';
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