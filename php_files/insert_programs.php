            <?php
                include 'db_connection.php';
                $conn = OpenCon();
                    //$name = $_POST['Program Name'];
                    //$management = $_POST['Management'];

                    $name = "php_program";
                    $management = "PHP Manager";

                    
                    $query = "INSERT INTO program (name_pr, management) VALUES ('$name', '$management')";
                    if (mysqli_query($conn, $query)) {
                        echo "New record created successfully";
                        // header("Location: ./students.php");
                        exit();
                    }
                    else{
                            echo "Error while creating record: <br>" . mysqli_error($conn) . "<br>";
                    }
                
            ?>