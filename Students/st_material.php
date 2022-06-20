<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>Материал</title>
</head>
<body>
<div class="parent">
<?php

include "../dbconnect.php";
include "../header.php";
$group_name=$_SESSION['group_name'];

$st_subj_query="SELECT subjects.subj_name FROM groupes,specialities,subjects 
WHERE subjects.speciality=specialities.speciality_id AND specialities.speciality_id=groupes.speciality AND groupes.group_name='$group_name';"; // Запрос на выбор предметов для группы
$st_subj_result=mysqli_query($link,$st_subj_query);

if(isset($_POST['subj_name'])){

    $subj_name=$_POST['subj_name'];


    $group_id_query="SELECT group_id FROM groupes WHERE group_name='$group_name';";  // Запрос на выборку айди группы по названию группы
    $group_id_result=mysqli_query($link,$group_id_query);
    $group_id_row=mysqli_fetch_array($group_id_result);
    $group_id=$group_id_row['group_id'];  // Переменная с айди группы


    $subj_id_query="SELECT subj_id FROM subjects WHERE subj_name='$subj_name';";
    $subj_id_result=mysqli_query($link,$subj_id_query);
    $subj_id_row=mysqli_fetch_array($subj_id_result);
    $subj_id=$subj_id_row['subj_id']; // Айди предмета


    $lession_query="SELECT lession_id, topic, work FROM lessions WHERE subject='$subj_id' AND lessions.class='$group_id';";
    $lession_result=mysqli_query($link,$lession_query);
    ?>
    <h1><?php echo $subj_name;?></h1>

    <table align="center">
        <tr>
            <th>№ Лекции</th>
            <th>Тема</th>
            <th>Материал</th>
        </tr>
        <?php 
        while($lession_row=mysqli_fetch_array($lession_result)){ 
            
            $work_id=$lession_row['work'];
            $work_name_query="SELECT file_name FROM works WHERE work_id='$work_id';";
            $work_name_result=mysqli_query($link,$work_name_query);
            $work_name_row=mysqli_fetch_array($work_name_result);
            ?>
            <tr>
                <td><?php echo $lession_row['lession_id']?></td>
                <td><?php echo $lession_row['topic']?></td>
                <td>
                    <form action="">
                    <a id="table" href="/works/<?php echo $work_name_row['file_name'];?>" download>Скачать материал</a>
                </form></td>
            </tr>
       <?php } ?>
    </table>
<?php } ?>

<div class="bottom">
    <div class="select">
        <div class="field">
            <div class="center">

<form action="st_material.php" method="POST">
    <label for="a">Выберите предмет:
        <select id="a" name="subj_name">
        <?php while($st_subj_row=mysqli_fetch_array($st_subj_result)){?>
                <option value="<?php echo $st_subj_row['subj_name'];?>"><?php echo $st_subj_row['subj_name'];?></option> 
        <?php } ?>
        </select>
    </label>
            <input type="submit" value="Выбрать">
</form>
</div>

        </div>
      </div>
      </div>
</div>

</body>
</html>