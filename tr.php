<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
// Получаем айди добавленной записи
$work_id_query="SELECT work_id FROM works WHERE name='$name';";
$work_id_result=mysqli_query($link,$work_id_query);
$work_id_row=mysqli_fetch_array($work_id_result);
$work_id=$work_id_row['work_id'];


// Добавляем лекцию 
$lession_query="INSERT INTO lessions VALUES('$lession_id','$subj_id','$group_id','$topic','$work_id')";
$lession_result=mysqli_query($link,$lession_query);
if($lession_result){?>
    <h1><?php echo 'Лекция успешно добавлена';?></h1>
<?php } else {?> <h1><?php echo 'Такая лекция уже существует';?></h1><?php }

?>    

</div>
    </div>



</body>
</html>
?>
</body>
</html>