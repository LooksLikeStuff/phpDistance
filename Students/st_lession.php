<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>Лекции</title>
</head>
<body>

<div class="parent">
<?php

session_start();
include "../header.php";
require "../dbconnect.php";


$group_name=$_SESSION['group_name'];

$st_subj_query="SELECT subjects.subj_name FROM groupes,specialities,subjects 
WHERE subjects.speciality=specialities.speciality_id AND specialities.speciality_id=groupes.speciality AND groupes.group_name='$group_name';"; // Запрос на выбор предметов для группы
$st_subj_result=mysqli_query($link,$st_subj_query);?>

<div class="block">
<h1>Лекции</h1>
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