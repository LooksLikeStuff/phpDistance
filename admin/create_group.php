<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>Добавление группы</title>
</head>
<body>
    <div class="parent">
    <?php
    include "../dbconnect.php";
    include "../header.php";


    $specialities_query="SELECT speciality_id FROM specialities;";
    $specialities_result=mysqli_query($link,$specialities_query);
    ?>

<div class="widthblock">
<?php

if(isset($_POST['group_name'],$_POST['speciality'],$_POST['num_of_students'],$_POST['course'])){

    $group_name=$_POST['group_name'];
    $speciality=$_POST['speciality'];
    $num_of_students=$_POST['num_of_students'];
    $course=$_POST['course'];

    $group_select_query="SELECT * FROM groupes WHERE group_name='$group_name' AND speciality='$speciality' AND num_of_students='$num_of_students' AND course='$course';";
    $group_select_result=mysqli_query($link,$group_select_query);
    $group_select_rows=mysqli_num_rows($group_select_result);
    
    if($group_select_rows == 0){
        $insert_group_query="INSERT INTO groupes(group_name,speciality,num_of_students,course) VALUES('$group_name','$speciality','$num_of_students','$course');";
        $insert_group_result=mysqli_query($link,$insert_group_query);
        if($insert_group_result){ ?>
           <h1><?php echo 'Группа успешно добавлена';?></h1>
        <?php } else {?> <h1><?php echo 'Что-то пошло не так';?></h1> 
        <?php }
    } else { ?>
       <h1><?php echo 'Такая группа уже существует';?></h1>
    <?php }

}

?>
        <h1>Добавление Группы</h1>
<div class="main">
<form action="create_group.php" method="POST">
    <div class="field">
        <label for="a">Введите название группы: </label>
            <input type="text" id="a" name="group_name" placeholder="Например: ИС-401" required>
    </div>
    <div class="field">
        <label for="b">Выберите специальность: </label>
        <div class="right">
                <select name="speciality" id="b" required>
                    <?php while($specialities_row=mysqli_fetch_array($specialities_result)){?>
                        <option value="<?php echo $specialities_row['speciality_id'];?>"><?php echo $specialities_row['speciality_id'];?></option>
                    <?php } ?>
             </select>
        </div>
        </div>
        <div class="field">
            <label for="c">Введите кол-во студентов в группе: </label>
                <input type="text" value='25' name="num_of_students" id="c" required>
        </div>
        <div class="field">
            <label for="d">Введите номер курса: </label>
                <input type="text" name="course" id="d" required>
        </div>
        <div class="field">
            <div class="center">
                <input type="submit" value="Добавить">
            </div>
        </div>
</form>


</div>
</body>
</html>