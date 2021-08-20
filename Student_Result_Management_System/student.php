<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/student.css">
    <title>Result</title>
    <style>
        .container main s1{
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
        include("init.php");

        if(!isset($_GET['class']))
            $class=null;
        else
            $class=$_GET['class'];
        $rn=$_GET['rn'];

        // validation
        if (empty($class) or empty($rn) or preg_match("/[a-z]/i",$rn)) {
            if(empty($class))
                echo '<p class="error">Please select your class</p>';
            if(empty($rn))
                echo '<p class="error">Please enter your roll number</p>';
            if(preg_match("/[a-z]/i",$rn))
                echo '<p class="error">Please enter valid roll number</p>';
            exit();
        }

        $name_sql=mysqli_query($conn,"SELECT `name` FROM `students` WHERE `rno`='$rn' and `class_name`='$class'");
        while($row = mysqli_fetch_assoc($name_sql))
        {
        $name = $row['name'];
        }

        $result_sql=mysqli_query($conn,"SELECT `p1`, `p2`, `p3`, `p4`, `p5`, `marks`, `percentage` FROM `result` WHERE `rno`='$rn' and `class`='$class'");
        while($row = mysqli_fetch_assoc($result_sql))
        {
            $p1 = $row['p1'];
            $p2 = $row['p2'];
            $p3 = $row['p3'];
            $p4 = $row['p4'];
            $p5 = $row['p5'];
            $mark = $row['marks'];
            $percentage = $row['percentage'];
        }
        if(mysqli_num_rows($result_sql)==0){
            echo "no result";
            exit();
        }
    ?>

    <div class="container">
        <div class="details">
        <center><span> <strong> Name:</strong> </span> <?php echo $name ?></center> <br>
        <center><span><strong>Class:</strong></span> <?php echo $class; ?></center> <br>
        <center><span><strong>Roll No:</strong></span> <?php echo $rn; ?> </center><br>
        </div>

        <div class="main">
            <div class="s1">
                <p><center><strong> Subjects</p>
                <p><center>Paper 1</p>
                <p><center>Paper 2</p>
                <p><center>Paper 3</p>
                <p><center>Paper 4</p>
                <p><center>Paper 5</p>
            </div>
            <div class="s2">
                <p><center><strong> Marks</p>
                <?php echo '<center><p></center>'.$p1.'</p>';?>
                <?php echo '<center><p></center>'.$p2.'</p>';?>
                <?php echo '<center><p></center>'.$p3.'</p>';?>
                <?php echo '<center><p></center>'.$p4.'</p>';?>
                <?php echo '<center><p></center>'.$p5.'</p>';?>
            </div>
        </div>

        <div class="result">
            <?php echo '<center><p><strong>Total Marks:</strong>&nbsp'.$mark.'</p>';?>
            <?php echo '<center><p><strong>Percentage:</strong>&nbsp'.$percentage.'%</p>';?>
        </div>
    </div>
</body>
</html>