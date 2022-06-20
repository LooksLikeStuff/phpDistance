<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>Добавить предмет</title>
</head>
<body>
    <div class="parent">
    <?php 
    require "../dbconnect.php";
    require "../header.php";

    $lecturers_query="SELECT lect_name FROM lecturers;";
    $lecturers_result=mysqli_query($link,$lecturers_query);

    $specialities_query="SELECT speciality_id FROM specialities;";
    $specialities_result=mysqli_query($link,$specialities_query);
    ?>
<div class="widthblock">
<h1>Добавление предмета</h1>
<?php

if(isset($_POST['subj_name'],$_POST['lect_name'],$_POST['lecture_hours'],$_POST['practice_hours'],$_POST['speciality'],$_POST['course'],$_POST['semester'])){

    $subj_name=$_POST['subj_name'];
    $lect_name=$_POST['lect_name'];
    $lecture_hours=$_POST['lecture_hours'];
    $practice_hours=$_POST['practice_hours'];
    $speciality=$_POST['speciality'];
    $course=$_POST['course'];
    $semester=$_POST['semester'];



 $lect_id_query="SELECT lect_id FROM lecturers WHERE lect_name='$lect_name';";
 $lect_id_result=mysqli_query($link,$lect_id_query);
 $lect_id_row=mysqli_fetch_array($lect_id_result);
 $lect_id=$lect_id_row['lect_id'];


 $subj_select_query="SELECT * FROM subjects WHERE subj_name='$subj_name' AND lecturer='$lect_id' AND lecture_hours='$lecture_hours' AND practice_hours='$practice_hours' 
                    AND speciality='$speciality' AND course='$course' AND semester='$semester';";
$subj_select_result=mysqli_query($link,$subj_select_query);
$subj_select_rows=mysqli_num_rows($subj_select_result);
if($subj_select_rows == 0){
    $subj_insert_query="INSERT INTO subjects(subj_name,lecturer,lecture_hours,practice_hours,speciality,course,semester)
                 VALUES('$subj_name','$lect_id','$lecture_hours','$practice_hours','$speciality','$course','$semester');";
    $subj_insert_result=mysqli_query($link,$subj_insert_query);
    if($subj_insert_result){ ?>
        <h1><?php echo 'Предмет успешно добавлен';?></h1>

        <?} else {?>
            <h1><?php echo 'Что-то пошло не так';?></h1>
        <?}
} else { ?> <h1><?php echo "Такой предмет уже существует";?></h1>
<?}

}

?>
    <div class="main">

    <form action="create_subject.php" method="POST">
        <div class="field">
            <label for="a">Введите название предмета: </label>
                <input type="text" id="a" name="subj_name" placeholder="Управление проектами" required>
        </div>
        <div class="field">
            <label for="b">Выберите преподавателя: </label>
                <div class="right">
                    <select name="lect_name" id="b" required>
                        <?php while($lecturers_row=mysqli_fetch_array($lecturers_result)){ ?>
                            <option value="<?php echo $lecturers_row['lect_name']?>"><?php echo $lecturers_row['lect_name']?></option>
                        <?php } ?>
                    </select>
                </div>
        </div>

        <div class="field">
            <label for="c">Введите кол-во лекционных часов: </label>
                <input type="text" name="lecture_hours" id="c" required placeholder="Например: 48">
        </div>

        <div class="field">
            <label for="d">Введите кол-во практических часов: </label>
                <input type="text" id="d" name="practice_hours" placeholder="Например: 48" required>
        </div>

        <div class="field">
            <label for="e">Выберите специальность: </label>
            <div class="right">
                <select name="speciality" id="e" required>
                    <?php while($specialities_row=mysqli_fetch_array($specialities_result)){?>
                            <option value="<?php echo $specialities_row['speciality_id'];?>"><?php echo $specialities_row['speciality_id'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="field">
            <label for="f">Введите курс: </label>
            <input type="text" id="f" name="course" placeholder="Например: 4" required>
        </div>

        <div class="field">
            <label for="g">Введите семестр: </label>
                <input type="text" id="g" name="semester" placeholder="Например 7" required>
        </div>

        <div class="field">
            <div class="center">
                    <input type="submit" value="Добавить">
            </div>
        </div>


    </form>

    </div>

    </div>
    </div>
</body>
</html>