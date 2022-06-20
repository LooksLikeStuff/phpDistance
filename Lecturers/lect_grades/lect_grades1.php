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
    <div class="parent">
<?php
include "../../header.php";?>
<div class="block">
 <?php   
session_start();
require "../../dbconnect.php"; // Подключение к БД


// Принимаемые переменные
$lect_name=$_SESSION["lect_name"];

// Запросы
$lect_subj_query="SELECT DISTINCT groupes.group_name 
FROM groupes, lecturers, subjects, specialities
WHERE subjects.lecturer=lecturers.lect_id AND subjects.speciality=specialities.speciality_id AND specialities.speciality_id=groupes.speciality 
AND subjects.Course=groupes.course AND lecturers.lect_name='$lect_name';";
$lect_subj_result=mysqli_query($link,$lect_subj_query);


if (isset($_POST["lect_name"]) && isset($_POST["group"])) {
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
<h1>Выставление оценок</h1>
<div class="select">
    <div class="field">
        <div class="center">
<form action="lect_grades_final.php" method="POST">
    <label for="a">Выберите предмет:
        <select name="subj_name" id="a" width="5">
            <?php while($subj_count_row=mysqli_fetch_array($subj_count_result)){?>
                <option value="<?php echo $subj_count_row['subj_name'];?>"><?php echo $subj_count_row['subj_name'];?></option>
                <?php } ?>
        </select>
            </label>

    <input type="hidden" name="group" value="<?php echo $lect_group;?>">
    <input type="submit" value="Выбрать">
</form>
</div>
</div>
</div>
<?php } 

elseif(isset($_SESSION["lect_name"])){?>

<h1>Выставление оценок</h1>
<div class="select">
<div class="field">
    <div class="center">
    <form action="lect_grades1.php" method="POST">
        <label for="b">Выберите группу:
            <select name="group" id="b">
                <?php while($lect_subj_row=mysqli_fetch_array($lect_subj_result)){?>
                    <option value="<?php echo $lect_subj_row['group_name'];?>"><?php echo $lect_subj_row['group_name'];?></option>
                    <?php } ?>
            </select>
                </label>
        <input type="hidden" name="lect_name" value="<?php echo $lect_name;?>">
        <input type="submit" value="Выбрать">
    </form> <?php } ?>
 
    </div>
    </div>

</div>
</div>
</div>
</body>
</html>

