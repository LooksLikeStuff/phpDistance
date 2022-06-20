<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>Лекция</title>
</head>
<body>
<div class="parent">
    <?php
include "../../header.php";
require "../../dbconnect.php"; ?>
        <div class="block">
            <?php



$subj_name=$_POST['subj_name'];
$group_name=$_POST['group_name']; 
$lession_id=$_POST['lession_id'];
$topic=$_POST['topic'];


// Добавляем теорию

$name=$_FILES['work_file']['name'];
$type=$_FILES['work_file']['type'];
move_uploaded_file($_FILES['work_file']['tmp_name'], "../../works/".$_FILES['work_file']['name']);   // Перемещаем загруженный файл в папку works

$insert_work_query="INSERT INTO works(file_name) VALUES('$name');";
$insert_work_result=mysqli_query($link,$insert_work_query);




$subj_id_query="SELECT subjects.subj_id FROM subjects WHERE subjects.subj_name='$subj_name';";
$subj_id_result=mysqli_query($link,$subj_id_query);
$subj_id_row=mysqli_fetch_array($subj_id_result);
$subj_id=$subj_id_row['subj_id'];

$group_id_query="SELECT groupes.group_id FROM groupes WHERE groupes.group_name='$group_name';";
$group_id_result=mysqli_query($link,$group_id_query);
$group_id_row=mysqli_fetch_array($group_id_result);
$group_id=$group_id_row['group_id'];


// Получаем айди добавленной записи
$work_id_query="SELECT work_id FROM works WHERE file_name='$name';";
$work_id_result=mysqli_query($link,$work_id_query);
$work_id_row=mysqli_fetch_array($work_id_result);
$work_id=$work_id_row['work_id'];


// Добавляем лекцию 
$lession_query="INSERT INTO lessions VALUES('$lession_id','$subj_id','$group_id','$topic','$work_id')";
$lession_result=mysqli_query($link,$lession_query);
if($lession_result){?>
    <h1><?php echo 'Лекция успешно добавлена';?></h1>
<?php } else {?> <h1><?php echo 'Такая лекция уже существует';?></h1><?php } ?>


</body>
</html>