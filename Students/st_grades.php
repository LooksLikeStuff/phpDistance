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
    <form action="st_grades">
        
    </form>
<?php  

include "../header.php"; 
require "../dbconnect.php"; // Подключение к бд
$st_num=1; // Номер студента в журнале

//Принимаемые переменные
$group=$_POST["group"]; // Группа
$subj=$_POST["subj"]; // Предмет
?>


<h1 align="center"><?php echo $subj;?></h1>


<?php
// Запросы
$lession_count="SELECT COUNT(DISTINCT lession_id) FROM lessions,subjects 
WHERE lessions.subject=subjects.subj_id AND subjects.subj_name='$subj'
GROUP BY lessions.subject;";                                                         //Выборка количества занятий по определенному предмету


$students="SELECT students.st_name, groupes.group_name FROM students, groupes
            WHERE students.class=groupes.group_id AND groupes.group_name='$group' 
            ORDER BY students.st_name ASC;";                                        // Выборка всех студентов из определенной группы


$st_subj_query="SELECT subjects.subj_name FROM groupes,specialities,subjects 
WHERE subjects.speciality=specialities.speciality_id AND specialities.speciality_id=groupes.speciality AND groupes.group_name='$group';"; // Запрос на выбор предметов для группы
$st_subj_result=mysqli_query($link,$st_subj_query);


// получение данных из запроса $lession_count
$result_count=mysqli_query($link,$lession_count);
$row_count=mysqli_fetch_array($result_count);

// Получение данных из запроса $students
$result_students=mysqli_query($link,$students);


?>

<!-- Таблица с оценками -->
<table align="center">
<tr><td>№</td>
    <th align="center">Студент/Занятие</th>


<?php // Вывод каждого занятия 
    for($i = 1; $i <= $row_count['COUNT(DISTINCT lession_id)']; $i++){?> 
        
            <th><?php echo $i;?> Лекция</th>
            <th><?php echo $i;?> Тест</th>
      
<? }?> 
</tr>
       <?php
        while($row_students=mysqli_fetch_array($result_students)){
            ?>
            <tr>
                <td><?php echo $st_num;?></td>
                <th align="left"><?php echo $row_students["st_name"]; ?> </th>
                

                <?php 
                $lession_num=1; // Номер занятия
                $st_num+=1; // Номер студента в журнале
                $st_name=$row_students['st_name']; // Переменная с именем студента


                // запрос на выборку всех оценок по лекциям студента $st_name по предмету $subj 
                ?>


                <?php for($j=1;$j <= $row_count['COUNT(DISTINCT lession_id)']; $j++){
                     $grades_lect_query="SELECT journal.lession, journal.grade FROM journal, students, subjects 
                     WHERE journal.student=students.st_id AND journal.subject=subjects.subj_id AND subjects.subj_name='$subj' AND students.st_name='$st_name' 
                     AND journal.type='Лекция' AND lession='$j';";
                    $grades_lect_result=mysqli_query($link,$grades_lect_query);
                    $row_grades_lect=mysqli_fetch_array($grades_lect_result);
                    $num_grades_lect=mysqli_num_rows($grades_lect_result);

                     $grades_test_query="SELECT journal.lession, journal.grade FROM journal, students, subjects 
                     WHERE journal.student=students.st_id AND journal.subject=subjects.subj_id AND subjects.subj_name='$subj' AND students.st_name='$st_name' 
                     AND journal.type='Тест' AND lession='$j';";
                     $grades_test_result=mysqli_query($link,$grades_test_query);
                     $row_grades_test=mysqli_fetch_array($grades_test_result);
                     $num_grades_test=mysqli_num_rows($grades_test_result);
                        ?> 
                <td><?php if ($num_grades_lect == 1){echo $row_grades_lect['grade'];}?></td> <!-- Передаем в lect_grades_update оценку-->
                <td><?php if ($num_grades_test == 1){ echo $row_grades_test['grade'];}?></td> 
                
                
                <?php 
                    $lession_num+=1; // увеличиваем номер занятия
                    } ?>
            </tr>
        <?php } ?>
</table> 

<div class="bottom">
    <div class="select">
        <div class="field">
            <div class="center">

          
    <form action="st_grades.php" method="POST">
            <label for="a">Выберите предмет:
                <select name="subj" id="a">
                <?php while($st_subj_row=mysqli_fetch_array($st_subj_result)){?>
                    <option value="<?php echo $st_subj_row['subj_name']?>"><?php echo $st_subj_row['subj_name']?></option>
                <?php } ?>
            </select>
            </label>
        <input type="hidden" name="group" value="<?php echo $group?>">

        <input type="submit" value='Выбрать'>
    </form>
    </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>
