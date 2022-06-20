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
  include "../../header.php";
    require "../../dbconnect.php";  // Подключаемся к бд


    $abcd=['a','b','c','d'];  // Массив для вариантов ответа


    $group_name=$_POST['group_name'];
    $lect_name=$_POST['lect_name'];
    $subj_name=$_POST['subj_name'];

    $lession_id_query="SELECT DISTINCT lession_id, topic FROM lessions  
    WHERE subject=(SELECT subj_id FROM subjects WHERE subj_name='$subj_name') AND class=(SELECT group_id FROM groupes WHERE group_name='$group_name');"; // Получение id и тем всех лекций
    $lession_id_result=mysqli_query($link,$lession_id_query);



if (isset($_POST['lession']) && isset($_POST['question']) && isset($_POST['answer'])){  // Добавление теста в таблицу


        $lession=$_POST['lession']; // Номер лекции
      $questions=$_POST['question'];  // Массив с вопросами вида array[0]['question']
      $answers=$_POST['answer'];   // Массив с ответами вида array[0][0]['answer','correct']
  
      
      // Запросы
      $subj_id_query="SELECT subjects.subj_id FROM subjects WHERE subjects.subj_name='$subj_name';";  // Запрос на получение айди предмета по названию предмета
      $subj_id_result=mysqli_query($link,$subj_id_query);
      $subj_id_row=mysqli_fetch_array($subj_id_result);
      $subj_id=$subj_id_row['subj_id'];
      
      
      $group_id_query="SELECT groupes.group_id FROM groupes WHERE groupes.group_name='$group_name';";  // Запрос на получение айди группы по названию группы
      $group_id_result=mysqli_query($link,$group_id_query);
      $group_id_row=mysqli_fetch_array($group_id_result);
      $group_id=$group_id_row['group_id']; // group_id
  

      // Добавление вопросов в таблицу
      for($i=0;$i!=5;$i++){

      $question=$questions[$i]['question'];  // Получаем текст вопроса из массива

    
      $question_insert_query="INSERT INTO test_questions(lession,subject,class,question) VALUES('$lession','$subj_id','$group_id','$question');"; // Запрос на добавление вопросов в таблицу test_questions
      $question_insert_result=mysqli_query($link,$question_insert_query);


      $question_id_query="SELECT question_id FROM test_questions WHERE question='$question';"; // Запрос на получение айди вопроса по тексту вопроса
      $question_id_result=mysqli_query($link,$question_id_query);
      $question_id_row=mysqli_fetch_array($question_id_result);
      $question_id=$question_id_row['question_id'];  //question_id 

        // Добавление ответов в таблицу 
      for($j=0;$j!=4;$j++){
        
        $answer=$answers[$i][$j]['answer'];
        
        if(array_key_exists('correct',$answers[$i][$j])){  // Если в массиве есть correct то добавляем в таблицу как правильный ответ

            $answer_insert_query="INSERT INTO test_answers(question,answer,correct) VALUES ('$question_id','$answer','1');";
            $answer_insert_result=mysqli_query($link,$answer_insert_query);
    
          } else {  // Иначе ответ неправильный
            $answer_insert_query="INSERT INTO test_answers(question,answer,correct) VALUES ('$question_id','$answer','0');";
            $answer_insert_result=mysqli_query($link,$answer_insert_query);  
          } } } ?> <h1><?php echo "Тест успешно добавлен";?> </h1>

<?php }
?>
<h1>Создание теста</h1>
  <div class="test">
    <form action="lect_works_create.php" method="POST">

    <div class="question">
            <div class="testmain">

        <label for="a" ><strong>Выберите лекцию:</strong></label>
          <select name="lession" id="a">
           <?php while($lession_id_row=mysqli_fetch_array($lession_id_result)){?>
              <option value="<?php echo $lession_id_row['lession_id']?>"><?php echo $lession_id_row['lession_id'].' - '.$lession_id_row['topic']?></option>
              <?php } ?>
          </select>
        


        <?php for($i=0; $i!=5;$i++){?>

            <div class="field" id="question">
        <label for="question"><strong>Введите <?php echo $i+1; ?> вопрос:</strong> </label>
        <input type="text" name='question[<?php echo $i;?>][question]' id='question' required>
       <br>
        </div>
        <p id="answer">Введите варианты ответа:</p>
        <?php for($j=0; $j!=4; $j++){ ?>
        <p id="radio"> <?php echo $abcd[$j].': ';?><input type="text" id="answer" name='answer[<?php echo $i; ?>][<?php echo $j;?>][answer]' reqiured> 
            <input type="checkbox" id="radio" name="answer[<?php echo $i; ?>][<?php echo $j;?>][correct]">Правильный ответ</p> 
        <?php } ?>             

      <?php }?>

  
        <input type="hidden" name="group_name" value='<?php echo $group_name;?>'>
        <input type="hidden" name="lect_name" value='<?php echo $lect_name;?>'>
        <input type="hidden"  name="subj_name" value='<?php echo $subj_name;?>'>
        </div>
        <div class="field">
          <div class="center">
            <input type="submit" value="Создать тест">
          </div>
        </div>
    </form>

    </div>

    </div>
    </div>
</body>
</html>