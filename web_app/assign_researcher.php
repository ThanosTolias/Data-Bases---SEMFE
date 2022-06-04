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
        $first_name = $_GET['fname1'];
        $last_name = $_GET['lname1'];

        $query1 = "SELECT project_id FROM project WHERE title = '$title';";
        $result1 = mysqli_query($conn, $query1);
        $row1 = mysqli_fetch_row($result1);

        $query2 = "SELECT researcher_id FROM researcher WHERE first_name = '$first_name' AND last_name = '$last_name';";
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_row($result2);

        $query = "INSERT INTO works_on_project VALUES ('$row1[0]', '$row2[0]');";

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