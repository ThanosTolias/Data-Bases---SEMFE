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

    <?php
        include 'db_connection.php';
        $conn = OpenCon();

        $title = $_GET['ptitle1'];
        $name_scfield = $_GET['scfield1'];

        $query1 = "SELECT scfield_id FROM scientific_field WHERE name_scfield = '$name_scfield';";
        $result1 = mysqli_query($conn, $query1);
        $row1 = mysqli_fetch_row($result1);

        $query2 = "SELECT project_id FROM project WHERE title = '$title';";
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_row($result2);

        $query = "INSERT INTO scientific_field_project VALUES ('$row1[0]', '$row2[0]');";

        if (mysqli_query($conn, $query)) {
            echo '<p style="font-size: 24px; text-align: center;"> Assignment was successful!</p>';
            exit();
        }
        else{
            echo "Error while deleting record: <br>" . mysqli_error($conn) . "<br>";
        }
    ?>

</body>

</html>