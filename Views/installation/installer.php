

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php 
    if($step == 1) {
        include('steps/1.php');
    }
    if($step == 2) {
        include('steps/2.php');
    }
    if($step == 3) {
        include('steps/3.php');
    }
   

    ?> 


</body>
</html>