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

        $project_title = $_GET['title1'];
        $start_date = $_GET['sdate1'];
        $end_date = $_GET['edate1'];
        $abstract = $_GET['abstract1'];
        $funds = $_GET['funds1'];
        $ev_first_name = $_GET['fevaluator1'];
        $ev_last_name = $_GET['levaluator1'];
        $acc_first_name = $_GET['faccountable1'];
        $acc_last_name = $_GET['laccountable1'];
        $name_pr = $_GET['progtitle1'];
        $name_ex = $_GET['exname1'];
        $name_org = $_GET['org1'];
        $evaluation_id = $_GET['eval_id1'];

        $query1 = "SELECT researcher_id FROM researcher WHERE first_name = '$ev_first_name' AND last_name = '$ev_last_name';";
        $result1 = mysqli_query($conn, $query1);
        $row1 = mysqli_fetch_row($result1);

        $query2 = "SELECT researcher_id FROM researcher WHERE first_name = '$acc_first_name' AND last_name = '$acc_last_name';";
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_row($result2);

        $query3 = "SELECT program_id FROM program WHERE name_pr = '$name_pr';";
        $result3 = mysqli_query($conn, $query3);
        $row3 = mysqli_fetch_row($result3);

        $query4 = "SELECT executive_id FROM executive WHERE name_ex = '$name_ex';";
        $result4 = mysqli_query($conn, $query4);
        $row4 = mysqli_fetch_row($result4);

        $query5 = "SELECT organization_id FROM organization WHERE name_org = '$name_org';";
        $result5 = mysqli_query($conn, $query5);
        $row5 = mysqli_fetch_row($result5);

        $query = "INSERT INTO project (title, start_date, end_date, abstract, funds, evaluator_id, accountable_id, program_id, executive_id, organization_id, evaluation_id)
                    VALUES ('$project_title', '$start_date', '$end_date', '$abstract', '$funds', '$row1[0]', '$row2[0]', '$row3[0]', '$row4[0]', '$row5[0]', '$evaluation_id');";

        if (mysqli_query($conn, $query)) {
            echo '<p style="font-size: 24px; text-align: center;"> Insert was successful!</p>';
            exit();
        }
        else{
            echo "Error while inserting record: <br>" . mysqli_error($conn) . "<br>";
        }
    ?>

</body>
</html>