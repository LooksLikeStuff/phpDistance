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
    include "../../header.php"; ?>
    <div class="block">
    <?php
    session_start();
    require "../../dbconnect.php";


    $lect_name=$_SESSION["lect_name"];  // Достаем имя преподавателя


    $subjects_query="SELECT subjects.subj_name
    FROM subjects, lecturers
    WHERE subjects.lecturer=lecturers.lect_id AND lecturers.lect_name='$lect_name';"; // Выбор всех предметов по имени преподавателя
    $subjects_result=mysqli_query($link,$subjects_query);

    ?>
    <h1>Добавление лекции</h1>
    <div class="select">
        <div class="field">
            <div class="center">
        <form action="/Lecturers/lect_lessions/lect_lession2.php" method="POST">
            <label for="a">Выберите предмет:
            <select name="subj_name" id="a">
                <?php while($subjects_row=mysqli_fetch_array($subjects_result)){ ?>
                    <option value="<?php echo $subjects_row['subj_name']?>">
                        <?php echo $subjects_row['subj_name']?>
                    </option> <?php } ?>
            </select> </label>
            <input type="submit" value='Выбрать'>
        </form>
    </div>
    </div>
    </div>
        </div>
    </div>
</body>
</html>