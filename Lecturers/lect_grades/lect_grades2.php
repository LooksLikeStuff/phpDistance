<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>Электронный журнал</title>
</head>
<body>
<?php
include "../../header.php";
require "../../dbconnect.php"; // Подключение к БД


// Принимаемые переменные
$lect_name=$_POST["lect_name"];
$lect_group=$_POST["group"];


//Запросы
// Запрос на выборку всех предметов которые ведутся у определенной группы у определенного преподавателя
$subj_count_query="SELECT subjects.subj_name, groupes.group_name
FROM subjects, groupes, lecturers, specialities
WHERE subjects.lecturer=lecturers.lect_id AND subjects.speciality=specialities.speciality_id AND specialities.speciality_id=groupes.speciality  
AND lecturers.lect_name='$lect_name' AND subjects.Course=groupes.course AND groupes.group_name='$lect_group';";  
$subj_count_result=mysqli_query($link,$subj_count_query);
?>
<form action="lect_grades_final.php" method="POST">
    <p>Выберите группу:
        <select name="subj_name" id="">
            <?php while($subj_count_row=mysqli_fetch_array($subj_count_result)){?>
                <option value="<?php echo $subj_count_row['subj_name'];?>"><?php echo $subj_count_row['subj_name'];?></option>
                <?php } ?>
        </select>
    </p>
    <input type="hidden" name="group" value="<?php echo $lect_group;?>">
    <input type="submit" value="Выбрать">
</form>

</body>
</html>
