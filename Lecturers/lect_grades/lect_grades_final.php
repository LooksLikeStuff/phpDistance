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
<?php   
include "../../header.php";
session_start();
require "../../dbconnect.php"; // Подключение к БД

$array_count=0;  // Индексы для массива
$st_num=1; // Номер студента в журнале

//Принимаемые переменные

if(isset($_POST['group']) && isset($_POST['subj_name'])){

    $_SESSION['group']=$_POST["group"]; // Группа
    $_SESSION['subj_name']=$_POST["subj_name"]; // Предмет 

    $group=$_SESSION['group'];
    $subj=$_SESSION['subj_name'];

} else {

    $group=$_SESSION['group'];
    $subj=$_SESSION['subj_name'];?>
    <h1>Оценки успешно обновлены!</h1>

<?php } 


// Запросы
$lession_count="SELECT COUNT(DISTINCT lession_id) FROM lessions,subjects 
WHERE lessions.subject=subjects.subj_id AND subjects.subj_name='$subj'
GROUP BY lessions.subject;";                                                         //Выборка количества занятий по определенному предмету


$students="SELECT students.st_name, groupes.group_name FROM students, groupes
            WHERE students.class=groupes.group_id AND groupes.group_name='$group' 
            ORDER BY students.st_name ASC;";                                        // Выборка всех студентов из определенной группы


// получение данных из запроса $lession_count
$result_count=mysqli_query($link,$lession_count);
$row_count=mysqli_fetch_array($result_count);

// Получение данных из запроса $students
$result_students=mysqli_query($link,$students);


?>

<h1><?php echo $subj;?></h1>
<!-- Таблица с оценками -->
<form action="lect_grades_update.php" method="POST">
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
                    <input type="hidden" name="grades[<?php echo $array_count?>][st_name]" value="<?php echo $st_name?>">     <!-- Передаем в lect_grades_update фио студента-->
                    <input type="hidden" name="grades[<?php echo $array_count?>][lession]" value="<?php echo $lession_num?>">   <!-- Передаем в lect_grades_update номер занятия--> 
                <td><input type="text" size="3" name="grades[<?php echo $array_count?>][lect_grade]" 
                value="<?php if ($num_grades_lect == 1){echo $row_grades_lect['grade'];}?>"></td> <!-- Передаем в lect_grades_update оценку-->
                <td><input type="text" size="3" name="grades[<?php echo $array_count?>][test_grade]" 
                value="<?php if ($num_grades_test == 1){ echo $row_grades_test['grade'];}?>"></td> 
                
                
                <?php 
                    $array_count+=1; // увеличиваем индексы передаваемого массива
                    $lession_num+=1; // увеличиваем номер занятия
                    } ?>
            </tr>
        <?php } ?>
</table> 
<input type="hidden" name ="subj" value="<?php echo $subj;?>">
<input type="submit" value="Выставить оценки">
</form>
</div>
</body>
</html>
