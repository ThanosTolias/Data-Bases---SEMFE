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

    <div class="wrapper">   
        <h1 style="font-size:xx-large;">Query 3.3</h1>
    </div> 

    <form action="query33.php" method="get">
        <p style="font-size: 24px;">Insert the research field of your interest in order to acquire projects and researchers associated with it:</p><input type="text" name="foi" id="field" placeholder="Reasearch Field" style="font-size: 1.5rem;" >
        <input class="q33b" style="font-size: 1.5rem; margin-left: 20px;" type="submit" value="Submit Field">
    </form> 

    <div style="margin-top: 20px; margin-left:90px;">
        <p><h2>Available Fields:</h2></p>
        <ol style="margin-left:50px">
            <li style="font-size: 1.5rem;">Mathematics</li>
            <li style="font-size: 1.5rem;">Computer Science</li>
            <li style="font-size: 1.5rem;">Physics</li>
            <li style="font-size: 1.5rem;">Biology</li>
            <li style="font-size: 1.5rem;">Chemistry</li>
            <li style="font-size: 1.5rem;">Geology</li>
            <li style="font-size: 1.5rem;">Law</li>
            <li style="font-size: 1.5rem;">Natural Sciences</li>
            <li style="font-size: 1.5rem;">Economics</li>
            <li style="font-size: 1.5rem;">Irrelevant</li>
        </ol>
    </div>
<ul>
                    <?php
                        include 'db_connection.php';
                        $conn = OpenCon();

                        $scfield = $_GET['foi'];

                        $query1 = "with given(project_id) as
                                    (select project_id 
                                    from scientific_field_project
                                    inner join scientific_field
                                    on scientific_field.scfield_id = scientific_field_project.scfield_id
                                    where scientific_field.name_scfield = '$scfield'
                                    )
                                    select title 
                                    from project 
                                    where project.project_id in
                                    (select project_id from given)";
                        $query2 = "with given(project_id) as
                                    (select project_id 
                                    from scientific_field_project
                                    inner join scientific_field
                                    on scientific_field.scfield_id = scientific_field_project.scfield_id
                                    where scientific_field.name_scfield = '$scfield'
                                    ),
                                    resIDs(researcher_id) as
                                    (select researcher_id 
                                    from works_on_project 
                                    where works_on_project.project_id in
                                    (select project_id from given))
                                    select first_name, last_name from researcher 
                                    where researcher.researcher_id in 
                                    (select researcher_id from resIDs)";

                        $result1 = mysqli_query($conn, $query1);
                        $result2 = mysqli_query($conn, $query2);

                        if(mysqli_num_rows($result1) == 0){
                            echo '<h1 style="margin-top: 5rem;">No Results</h1>';
                        }
                        else{
                        echo '<li>';
                            echo '<div class="table-responsive" style="margin-left:100px;">';
                            echo '<table class="table">';
                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th>projects</th>';
                                    echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while($row = mysqli_fetch_row($result1)){
                                    echo '<tr>';
                                        echo '<td>' . $row[0] . '</td>';
                                    echo '</tr>';
                                }
                                echo '</tbody>';
                            echo '</table>';
                        echo '</div>';
                        echo '</li>';
                    }

                    if(mysqli_num_rows($result2) == 0){
                        echo '<h1 style="margin-top: 5rem;">No Results</h1>';
                    }
                    else{
                    echo '<li>';
                        echo '<div class="table-responsive" style="margin-left:100px;">';
                        echo '<table class="table">';
                            echo '<thead>';
                                echo '<tr>';
                                    echo '<th>First Name</th>';
                                    echo '<th>Last Name</th>';
                                echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            while($row = mysqli_fetch_row($result2)){
                                echo '<tr>';
                                    echo '<td>' . $row[0] . '</td>';
                                    echo '<th>' . $row[1] . '</th>';
                                echo '</tr>';
                            }
                            echo '</tbody>';
                        echo '</table>';
                    echo '</div>';
                    echo '</li>';
                    echo '</ul>';
                }
                ?>
               

</body>

</html>