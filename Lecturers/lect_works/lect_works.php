<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>Тест</title>
</head>
<body>

    <div class="parent">
<?php
include "../../header.php";?>
<div class="block">
<?php session_start();
    require "../../dbconnect.php";  // Подключаемся к бд

    
    if(isset($_POST['lect_name']) && isset($_POST['subj_name'])){       // Выбор группы


        $lect_name=$_POST['lect_name'];
        $subj_name=$_POST['subj_name'];
    
    
        // Запросы
        $groupes_query="SELECT groupes.group_name
        FROM subjects, specialities, groupes
        WHERE subjects.speciality=specialities.speciality_id AND specialities.speciality_id=groupes.speciality AND subjects.Course=groupes.course 
        AND subjects.subj_name='$subj_name';";
        $groupes_result=mysqli_query($link,$groupes_query);
        ?>
<h1>Создание теста</h1>
<div class="select">
    <div class="field">
        <div class="center">
            <form action="lect_works_create.php" method="POST">
                <label for ="b">Выберите Группу:
                    <select name="group_name" id="b">
                        <?php 
                        while($groupes_row=mysqli_fetch_array($groupes_result)){?>
                        <option value="<?php echo $groupes_row['group_name'];?>"><?php echo $groupes_row['group_name'];?></option>
                        <?php } ?>
                    </select></label>
                <input type="hidden" value="<?php echo $lect_name;?>" name="lect_name">
                <input type="hidden" value="<?php echo $subj_name;?>" name ="subj_name">
                <input type="submit" value="Выбрать">
         </form>
             </div>
             </div>
             </div>
    <?php } 



    elseif (isset($_SESSION['lect_name'])){        // Выбор предмета

        
    $lect_name=$_SESSION['lect_name'];  // ФИО преподавателя
    

    // Запросы
    $subjects_query="SELECT subjects.subj_name, lecturers.lect_name
    FROM subjects, lecturers
    WHERE subjects.lecturer=lecturers.lect_id AND lecturers.lect_name='$lect_name';";  // Запрос на выбор предметов которые преподает  $lect_name
    $subjects_result=mysqli_query($link,$subjects_query);?>
<h1>Создание теста</h1>
<div class="select">
    <div class="field">
        <div class="center">
    <form action="lect_works.php" method="POST">
        <label for="a">Выберите предмет:
        <select name="subj_name" id="a">
            <?php 
            while($subjects_row=mysqli_fetch_array($subjects_result)){?>
            <option value="<?php echo $subjects_row['subj_name'];?>"><?php echo $subjects_row['subj_name'];?></option>
            <?php } ?>
        </select></label>
        <input type="hidden" name="lect_name" value="<?php echo $lect_name;?>">
        <input type="submit" value="Выбрать">
    </form> 
    </div>
    <?php } ?>
    </div>
    </div>
    </div>
    </div>
</body>
</html>