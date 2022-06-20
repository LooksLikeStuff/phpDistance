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
    
    $group_query="SELECT groupes.group_name
    FROM groupes, subjects, specialities
    WHERE subjects.speciality=specialities.speciality_id AND specialities.speciality_id=groupes.speciality AND subjects.Course=groupes.course AND
    subjects.subj_name='$subj_name';";
    $group_result=mysqli_query($link,$group_query);
?>
    <h1>Добавление лекции</h1>
<div class="select">
        <div class="field">
            <div class="center">
    <form action="/Lecturers/lect_lessions/lect_lession3.php" method="POST">
        <label for="a">Выберите группу:<select id="a" name="group_name">
            <?php while($group_row=mysqli_fetch_array($group_result)){ ?>
                <option value="<?php echo $group_row['group_name'];?>">
                    <?php echo $group_row['group_name'];?>
                </option> <?php } ?>
        </select>
        </label>
        <input type="hidden" name="subj_name" value="<?php echo $subj_name;?>">
        <input type="submit" value='Выбрать'>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
</body>
</html>