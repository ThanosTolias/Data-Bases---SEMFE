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

        $name_org = $_GET['name1'];
        $abbreviation = $_GET['abbr1'];
        $city = $_GET['city1'];
        $street = $_GET['street1'];
        $postal_code = $_GET['postal1'];
        $org_type = $_GET['type1'];
        $funds_company= $_GET['fundsc1'];
        $budget_uni_ministry = $_GET['unibudget1'];
        $budget_rc1 = $_GET['budgetrc1'];
        $budget_rc2 = $_GET['budgetrc2'];

        $query = "INSERT INTO organization (name_org, abbreviation, city, street, postal_code, org_type, funds_company, budget_uni_ministry, budget_rc1, budget_rc2)
                    VALUES ('$name_org', '$abbreviation', '$city', '$street', '$postal_code', '$org_type', '$funds_company', '$budget_uni_ministry', '$budget_rc1', '$budget_rc2');";

        
        if (mysqli_query($conn, $query)) {
            echo '<p style="font-size: 24px; text-align: center;"> Insert was successful!</p>';
            exit();
        }
        else{
            echo "Error while deleting record: <br>" . mysqli_error($conn) . "<br>";
        }
    ?>

</body>

</html>