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

                        $query = "SELECT * FROM program";
                        $result = mysqli_query($conn, $query);
                        
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Programs found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Program_ID</th>';
                                            echo '<th>Name       </th>';
                                            echo '<th>Management</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_row($result)){
                                        echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>';
                                            echo '<td>' . $row[1] . '    </td>';
                                            echo '<td>' . $row[2] . '</td>';
                                            echo '<td>';
                                               echo '<a type="button" href="./update_program.php?id=' . $row[0]. '">';
                                                    echo '<i class="fa fa-edit"></i>';
                                                echo '</a>';
                                            echo '</td>';
                                            echo '<td>';
                                                echo '<a type="button" href="./delete_program.php?id=' . $row[0]. '">';
                                                    echo '<i class = "fa fa-trash"></i>';
                                                echo '</a>';
                                            echo '</td>';
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

    <!-- <script src = "{{ url_for('static', filename = 'bootstrap/js/bootstrap.min.js') }}"></script> -->
</body>

</html>