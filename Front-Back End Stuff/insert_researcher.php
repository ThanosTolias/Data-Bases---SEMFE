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

         $fname1 = $_GET['fname1'];
         $lname1 = $_GET['lname1'];
         $birthdate = $_GET['bdate1'];
         $gender = $_GET['gender1'];
         $org_name = $_GET['org_name1'];
         $datework = $_GET['ddate1'];

        $query1 = "SELECT organization_id FROM organization WHERE name_org = '$org_name';";
        $result1 = mysqli_query($conn, $query1);
        $row1 = mysqli_fetch_row($result1);
        $org_id = $row1[0];

        $query = "INSERT INTO researcher (first_name, last_name, birthdate, gender, organization_id, datework)
                    VALUES ('$fname1', '$lname1', '$birthdate', '$gender', '$org_id', '$datework')";

        
        if (mysqli_query($conn, $query)) {
            echo '<p style="font-size: 24px; text-align: center;"> Insert was successful!</p>';
            exit();
        }
        else{
            echo "Error while deleting record: <br>" . mysqli_error($conn) . "<br>";
        }
    ?>

</html>