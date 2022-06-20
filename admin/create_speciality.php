<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>Добавление специальности</title>
</head>
<body>
    <div class="parent">
    <?php 
    include "../header.php";
    include "../dbconnect.php";
    ?>


<div class="widthblock">
        <h1>Добавление специальности</h1>


        <?php
    if(isset($_POST['speciality_id'],$_POST['education_form'],$_POST['spec_name'],$_POST['abbreviation'],$_POST['study_duration'])){

        $speciality_id=$_POST['speciality_id'];
        $education_form=$_POST['education_form'];
        $spec_name=$_POST['spec_name'];
        $abbreviation=$_POST['abbreviation'];
        $study_duration=$_POST['study_duration'];


        $speciality_select_query="SELECT * FROM specialities 
        WHERE speciality_id='$speciality_id' AND education_form='$education_form' AND spec_name='$spec_name' AND abbreviation='$abbreviation' AND study_duration='$study_duration';";
        $specialty_select_result=mysqli_query($link,$speciality_select_query);
        $specialty_select_rows=mysqli_num_rows($specialty_select_result);
        if($specialty_select_rows==0){
            $speciality_insert_query="INSERT INTO specialities VALUES('$speciality_id','$education_form','$spec_name','$abbreviation','$study_duration');";
            $speciality_insert_result=mysqli_query($link,$speciality_insert_query);
            if($speciality_insert_result){?>
                <h1><?php echo 'Специальность успешно добавлена';?></h1>
            <?php }
            else { ?>
                 <h1><?php echo 'Что-то пошло не так';?></h1>
          <?php  }
        }
        else { ?>
            <h1><?php echo 'Такая специальность уже существует';?></h1>
      <?  }
    } ?>


<div class="main">
    <form action="create_speciality.php" method="POST">
        <div class="field">
            <label for="a">Введите код специальности: </label>
            <input type="text" id="a" name="speciality_id" placeholder="Например:09.02.04" required>
        </div>
        <div class="field">
            <label for="c">Введите название специальности: </label>
                <input type="text" placeholder="Информационные системы" name="spec_name" id="c" required>
        </div>
        <div class="field">
            <label for="d">Введите аббревиатуру: </label>
                <input type="text" id="d" name="abbreviation" placeholder="Например: ИС" required>

        </div>
        <div class="field">
            <label for="spec">Выберите форму обучения: </label>
            <div class="right">
                <select id="spec" name="education_form" required>
                    <option value="Очная">Очная</option>
                    <option value="Заочная">Заочная</option>
                </select>
                </div>

        </div>
        <div class="field">
        <label for="spec">Выберите длительность обучения: </label>
        <div class="right">
            <select name="study_duration" id="spec" required>
                <option value="2г. 10мес.">2г. 10мес.</option>
                <option value="3г. 10мес.">3г. 10мес.</option>
                <option value="4г. 10мес.">4г. 10мес.</option>
            </select>
            </div>

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