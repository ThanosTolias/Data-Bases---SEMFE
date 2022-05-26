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

                        $query = "with budget_pr(executive_id, organization_id, value)as
                                (select executive_id, organization_id, -1*sum(funds) from project group by executive_id, organization_id) ,
                                top5ing(executive_id, organization_id, value) as
                                (select executive_id, organization_id, -1*value from budget_pr group by value limit 5 )
                                select name_ex, name_org, value from executive, organization, top5ing where (executive.executive_id, organization.organization_id) = (top5ing.executive_id,top5ing.organization_id)";
                        

                        $result = mysqli_query($conn, $query);


                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Projects Found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                            echo '<table class="table">';
                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th>Executive Name</th>';
                                        echo '<th>Organization Name</th>';
                                        echo '<th>Total Funds</th>';
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