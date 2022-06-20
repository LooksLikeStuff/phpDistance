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
<?php
    require "../../dbconnect.php";


    $subj_name=$_POST['subj_name'];
    $group_name=$_POST['group_name']; 
    
    $lession_id_query="SELECT max(lession_id) FROM lessions 
    WHERE subject=(SELECT subj_id FROM subjects WHERE subj_name='$subj_name') AND class=(SELECT group_id FROM groupes WHERE group_name='$group_name');";
    $lession_id_result=mysqli_query($link,$lession_id_query);
    $lession_id_row=mysqli_fetch_array($lession_id_result);
    $lession_id=$lession_id_row['max(lession_id)']+1;
    ?>

<div class="parent">
    <?php     include "../../header.php"; ?>
        <div class="block">
<h1>Добавление лекции</h1>

    <form action="/Lecturers/lect_lessions/lect_lession4.php" method="POST" enctype="multipart/form-data">
        <div class="field">
        <label for="a">Введите номер лекции: </label>
        <input type="text" id="a" name="lession_id" value="<?php echo $lession_id?>">
        </div>
        <div class="field">
        <label for="b">Введите тему лекции: </label>
            <input type="text"  id="b"name="topic">
        </div>
        <div class="field">
            <label for="c">Загрузите материал: </label>
            <input type="file" name="work_file" id="c">
        </div>
        <input type="hidden" name="subj_name" value="<?php echo $subj_name?>">
        <input type="hidden" name="group_name" value="<?php echo $group_name?>">

        <div class="field">
            <div class="center">
                <input type="submit" value='Добавить лекцию' id="authButton">
            </div>
        </div>   
        
    </form>
    </div>
    </div>
</body>
</html>