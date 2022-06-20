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
    require "../dbconnect.php";  // соединяемся с бд


    if(isset($_POST['lession_id']) && isset($_POST['subj_id']) && isset($_POST['group_id'])){


        $question_count=1; // Счетчик


        $lession_id=$_POST['lession_id'];
        $subj_id=$_POST['subj_id'];
        $group_id=$_POST['group_id'];


        $questions_query="SELECT question_id, question FROM test_questions WHERE lession='$lession_id' AND subject='$subj_id' AND class='$group_id';";  // Запрос на выборку вопросов
        $questions_result=mysqli_query($link,$questions_query); ?>

<div class="test">


        <form action="st_check.php" method="POST">
            <?php while($questions_row=mysqli_fetch_array($questions_result)){ 
                

                $question_id=$questions_row['question_id']; // Получаем айди вопроса
                $question_id_arr[]=$question_id; // Заносим в массив айди вопроса
                $answers_query="SELECT answer, correct FROM test_answers, test_questions 
                                WHERE test_answers.question=test_questions.question_id AND test_questions.question_id='$question_id';";  // Запрос на выборку ответов на вопрос
                $answers_result=mysqli_query($link,$answers_query);

                ?>
                <div class="question">
                <p id="question"><strong><?php echo $question_count.'. '.$questions_row['question'];?></strong></p>
                <p id="answer">Варианты ответа:</p>
                    <?php while($answers_row=mysqli_fetch_array($answers_result)){?>
                        <p id="radio"><?php echo $answers_row['answer']?>
                        <input type="radio" name="answer[<?php echo $question_count-1;?>][answer]" value="<?php echo $answers_row['answer']?>" required></p>
                    </p>
                        <?php } ?>
                        </div>
            <?php $question_count+=1; }?>

            <input type="hidden" value="<?php echo $lession_id;?>" name="lession_id">
            <input type="hidden" value="<?php echo $subj_id;?>" name="subj_id">
            <input type="hidden" value="<?php echo $group_id;?>" name="group_id">
            </div>
            <input type="submit" value="Завершить тест" id="button">
        </form>
  
    <?php }

    elseif(isset($_POST['group_name'])){
    $group_name=$_SESSION['group_name'];    


    $group_id_query="SELECT group_id FROM groupes WHERE group_name='$group_name';";  // Запрос на выборку айди группы по названию группы
    $group_id_result=mysqli_query($link,$group_id_query);
    $group_id_row=mysqli_fetch_array($group_id_result);
    $group_id=$group_id_row['group_id'];  // Переменная с айди группы


    $subj_query="SELECT DISTINCT subjects.subj_name FROM test_questions,subjects WHERE test_questions.subject=subjects.subj_id AND test_questions.class='$group_id';";
    $subj_result=mysqli_query($link,$subj_query); ?>

<div class="block">
<h1>Тестирование</h1>
    <div class="select">
        <div class="field">
            <div class="center">


    <form action="st_works.php" method="POST">
        <label for="a">Выберите предмет:
            <select name="subj_name" id="a">

            <?Php
                while($subj_row=mysqli_fetch_array($subj_result)){ ?>
                    <option value="<?php echo $subj_row['subj_name'];?>"><?php echo $subj_row['subj_name'];?></option>
               <?php } ?>

        </select></label>
        <input type="hidden" name="group_id" value="<?php echo $group_id;?>">
        <input type="submit" value="Выбрать">
    </form>
</div>
</div>
        </div>
    </div>

    <?php }
    elseif (isset($_POST['group_id']) && isset($_POST['subj_name'])){  // Выбор номера занятия

        $group_id=$_POST['group_id'];  // айди группы
        $subj_name=$_POST['subj_name'];  // название предмета 


        $subj_id_query="SELECT subj_id FROM subjects WHERE subj_name='$subj_name';";
        $subj_id_result=mysqli_query($link,$subj_id_query);
        $subj_id_row=mysqli_fetch_array($subj_id_result);
        $subj_id=$subj_id_row['subj_id']; // Айди предмета

        $lession_query="SELECT DISTINCT lessions.topic, test_questions.lession FROM test_questions, lessions 
        WHERE lessions.lession_id=test_questions.lession AND test_questions.class='$group_id' AND test_questions.subject='$subj_id';";
        $lession_result=mysqli_query($link,$lession_query);?>
        <div class="block">
        <h1>Тестирование</h1>
        <div class="select">
        <div class="field">
            <div class="center">
        <form action="st_works.php" method="POST">
            <label for="b">Выберите лекцию:
            <select name="lession_id" id="b">
                <?php while($lession_row=mysqli_fetch_array($lession_result)) { ?>
                    <option value="<?php echo $lession_row['lession']?>"><?php echo $lession_row['lession'].' - '.$lession_row['topic']?></option> 
                <?php }?>

            </select></label>
            <input type="submit" value="Выбрать">
            <input type="hidden" name="group_id" value="<?php echo $group_id;?>">
            <input type="hidden" name="subj_id" value="<?php echo $subj_id;?>">

        </form>
        </div>
</div>
</div>
        </div>
        <?php } ?> 

</body>
</html>