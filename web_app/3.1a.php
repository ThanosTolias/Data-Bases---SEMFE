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
        <h1 style="font-size:xx-large;">Query 3.1</h1>
    </div>

    <div>
        <ul class="lista" style="margin-left: 36px;">
            <li><p style="font-size: 1.5rem; margin-left: 70px ; margin-top: 20px;">Press to view all active <b>programs</b>:</p></li>
            <li><a href="3.1a.php" class="but_but">Execute Query</a></li>
        </ul>
    </div>

    <div>
        <ul class="lista" style="margin-left: 36px;">
            <li><p style="font-size: 1.5rem; margin-left: 70px ; margin-top: 20px;">Click this button to <b>insert a new program</b>:</p></li>
            <li><a href="insert_program.html" class="but_but">Click Here!</a></li>
        </ul>
    </div>

    <div style="margin:110px 0 0 100px ;"><p style="font-size: 1.5rem;">In order to view your desired <b>projects</b>, submit your filters below:</p></div>

    <form action="query31.php" method="get">
        <ul class="forma" style="margin-top: 10px;">
            <li><p style="font-size: 24px; text-align: center;">Insert date:</p> <input type="date" name="date1" style="font-size: 1.5rem;"></li>
            <li><p style="font-size: 24px; text-align: center;">Insert duration (months):</p> <input name="duration1" type="value" placeholder="More Than" style="font-size: 1.5rem;">
                <input name="duration11" type="value" placeholder="Less Than" style="font-size: 1.5rem;"> </li>
            <li><p style="font-size: 24px; text-align: center;">Insert Executive Name:</p><input type="text" name="name1" placeholder="Executive Name"  style="font-size: 1.5rem;"></li>
            <li style="margin-top: 99px;"><input class="q31b" type="submit" value="Submit Filters" style="font-size: 1.5rem;"></li>
        </ul>
    </form>

    <div style="margin: 230px 0 0 90px;">
        <table style="column-gap: 100px;">
        <colgroup>
                <col>
            </colgroup>

            <?php
                include 'db_connection.php';
                $conn = OpenCon();
                $query = "SELECT * FROM program";
                $result = mysqli_query($conn, $query);
                
            echo '<thead>';
                echo '<caption style="font-size: 2rem;"> Active Programs</caption>';
                echo '<tr style="background-color:rgb(31, 106, 177); color: rgb(255, 255, 255); font-size: 1.5rem;"> <!-- prwth grammh-->';
                echo '</tr>';
            echo '</thead>';

            echo '<tbody>';
            while($row = mysqli_fetch_row($result)){
                echo '<tr>';
                    echo '<td>' . $row[1] . '</td>';
                    echo '<td>';
                    echo '<a type="button" href="./delete_program.php?id=' . $row[0]. '">';
                    echo 'delete program';
                    echo '</a>';
                    echo '</td>'; 
                echo'</tr>';
            }
            echo'</tbody>';
            ?>
        </table>
    </div>

</body>

</html>