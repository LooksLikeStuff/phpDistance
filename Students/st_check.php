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
    include "../header.php";
    session_start();
        require '../dbconnect.php';  // Подключаемся к бд


        $right_answers=0; // Счетчик правильных ответов 
        $count=0; // индексы массива

        $answers=$_POST['answer'];  // Получаем ответы на вопросы в виде массива answer[0][answer]
        $lession_id=$_POST['lession_id'];
        $subj_id=$_POST['subj_id'];
        $group_id=$_POST['group_id'];
        $st_name=$_SESSION['st_name'];


        $questions_query="SELECT question_id, question FROM test_questions WHERE lession='$lession_id' AND subject='$subj_id' AND class='$group_id';";  // Запрос на выборку вопросов
        $questions_result=mysqli_query($link,$questions_query);


        while($questions_row=mysqli_fetch_array($questions_result)){

            $question_id=$questions_row['question_id'];

            $answer=$answers[$count]['answer'];
        
            $check_query="SELECT correct FROM test_answers WHERE question='$question_id' AND answer='$answer';";
            $check_result=mysqli_query($link,$check_query);
            $check_row=mysqli_fetch_array($check_result);

            $count+=1;

            if($check_row['correct']=='1'){
                $right_answers+=1;
            
        } } ?>

        <div class="block">
        <h1><?php echo 'Правильные ответы: '.$right_answers.'/5'.'<br>';?></h1>
        <?php if($right_answers<=2){
            $grade=2;?>
            <h2><?php echo 'Ваша оценка: '.$grade;?></h2>
        <? } 
        else {
            $grade=$right_answers;?>
           <h2><?php echo 'Ваша оценка: '.$grade;?></h2>
        <?php }

        
    
        $st_id_query="SELECT st_id FROM students WHERE st_name='$st_name';";
        $st_id_result=mysqli_query($link,$st_id_query);
        $st_id_row=mysqli_fetch_array($st_id_result);
        $st_id=$st_id_row['st_id'];
        $grade_insert_query="INSERT INTO journal VALUES('$lession_id','$subj_id','$st_id','Тест','$grade');";
        $grade_insert_result=mysqli_query($link,$grade_insert_query);
        if($grade_insert_result){?>
            <h3><?php echo "Оценка успешно выставлена";?></h3>
        <?php }
    ?>
    </div>
    </div>
</body>

</html>