<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>Document</title>
</head>
<body>
    <?php
    header('location:lect_grades_final.php');
    include '../../dbconnect.php'; // Подключение к бд


    // принимаемые массивы
    $subj_name=$_POST['subj']; // Принимаем название предмета 
    $grades=$_POST['grades'];  // Принимаем значения оценок в виде массива (st_name =>'',lession=>'',grade_lect=>'',grade_test=>'')
    print_r($grades);


    $count=count($grades); //Считаем количество элементов массива


    for ($i=0; $i!=$count; $i++){

            $st_name=$grades[$i]['st_name'];  // Имя студента
            $lession=$grades[$i]['lession']; // Номер занятия
            $lect_grade=$grades[$i]['lect_grade'];  // Оценка за занятие
            $test_grade=$grades[$i]['test_grade'];  // Оценка за занятие


            $st_id_query="SELECT students.st_id FROM students WHERE students.st_name='$st_name'";
            $st_id_result=mysqli_query($link,$st_id_query);
            $st_id_row=mysqli_fetch_array($st_id_result);
            $st_id=$st_id_row['st_id']; // id студента
            echo $st_id."<br>";

            $subj_id_query="SELECT subjects.subj_id FROM subjects WHERE subj_name='$subj_name'";
            $subj_id_result=mysqli_query($link,$subj_id_query);
            $subj_id_row=mysqli_fetch_array($subj_id_result);
            $subj_id=$subj_id_row['subj_id']; // id предмета


                // оценки за лекции
            $lect_grade_query="SELECT grade FROM journal            
            WHERE journal.student='$st_id'
            AND journal.subject='$subj_id'
            AND journal.lession='$lession' 
            AND type='Лекция';";
            $lect_grade_result=mysqli_query($link,$lect_grade_query);
            $lect_grade_rows=mysqli_num_rows($lect_grade_result);


            //Оценки за тесты
            $test_grade_query="SELECT grade FROM journal
            WHERE journal.student='$st_id'
            AND journal.subject='$subj_id'
            AND journal.lession='$lession' AND type='Тест';";
            $test_grade_result=mysqli_query($link,$test_grade_query);
            $test_grade_rows=mysqli_num_rows($test_grade_result);

        
            if($lect_grade_rows == 0){
                $lect_grade_insert="INSERT INTO journal VALUES('$lession','$subj_id','$st_id','Лекция','$lect_grade')";
                $lect_grade_insert_result=mysqli_query($link,$lect_grade_insert);

            }
            
          else {
                $lect_grade_update="UPDATE journal SET journal.grade='$lect_grade'
                WHERE journal.student='$st_id' 
                AND journal.subject='$subj_id'
                AND journal.lession='$lession' AND type='Лекция';";
                $lect_grade_update_result=mysqli_query($link,$lect_grade_update);
                if($lect_grade_update_result){
                    echo "ok";
                } else echo "nook";
            }


            if($test_grade_rows == 0){
                $test_grade_insert="INSERT INTO journal VALUES('$lession','$subj_id','$st_id','Тест','$test_grade')";
                $test_grade_insert_result=mysqli_query($link,$test_grade_insert);

            }
            
            else {
                $test_grade_update="UPDATE journal SET journal.grade='$test_grade'
                WHERE journal.student='$st_id' 
                AND journal.subject='$subj_id'
                AND journal.lession='$lession' AND type='Тест';";
                $test_grade_update_result=mysqli_query($link,$test_grade_update); 
                if($test_grade_update_result){
                    echo "ok";
                } else echo "nook";
            }
        }
?>
 
</body>
</html>