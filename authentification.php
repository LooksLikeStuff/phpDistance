<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Аккаунт</title>
</head>
<body>
<div class="parent">
    <?php require "header.php";


require "dbconnect.php";

session_start();  // Запускаем сессию


if(isset($_POST['login']) && isset($_POST['password'])){  //Сохраняем логин и пароль в сессию


    $_SESSION['login']=md5($_POST['login']);
    $_SESSION['password']=md5($_POST['password']);


    $login=$_SESSION["login"];
    $password=$_SESSION["password"];

}

else {
  
    // ПРИНИМАЕМЫЕ ПЕРЕМЕННЫЕ
    $login=$_SESSION["login"];
    $password=$_SESSION["password"]; 

}


// ЗАПРОСЫ
$st_query="SELECT groupes.group_name, students.st_name, students.st_birthdate, students.st_telephone FROM students, groupes 
WHERE groupes.group_id=students.class AND st_login='$login' AND st_pass='$password' ;";                                         //Запрос на поиск аккаунта в студентах
$st_result=mysqli_query($link,$st_query); 
$st_row=mysqli_fetch_array($st_result);


$lect_query="SELECT lect_name, lect_birthdate, lect_telephone FROM lecturers WHERE lect_login='$login' AND lect_pass='$password';";   // запрос на поиск аккаунта в преподавателях
$lect_result=mysqli_query($link,$lect_query);
$lect_row=mysqli_fetch_array($lect_result);




//ПРОВЕРКА ДАННЫХ 
if($login=='21232f297a57a5a743894a0e4a801fc3' && $password=='21232f297a57a5a743894a0e4a801fc3'){ ?>
    <!-- Форма для типа аккаунта админ -->
    
        <div class="block" id="auth">
        <h1 id="auth">Вы авторизованы!</h1>
        <h2 id="auth">Информация об аккаунте:</h2>
           <ul>
               <li><strong>Тип аккаунта: </strong> Администратор</li>
           </ul>
        <form action ="/admin/create_speciality.php" target="_blank">
            <input type="submit" value="Специальность" id="authButton" >
        </form> 
        <form action ="/admin/create_group.php" target="_blank">
            <input type="submit" value="Группа" id="authButton" >
        </form>
        <form action ="/admin/create_subject.php" target="_blank">
            <input type="submit" value="Предмет" id="authButton" >
        </form>
        <form action ="/admin/reg.php" target="_blank">
            <input type="submit" value="Регистрация" id="authButton">
        </form>
    </div>


<? } 
elseif(($count_st=mysqli_num_rows($st_result))==1){


    $st_subj=$st_row["group_name"]; // Сохраняем имя группы авторизирующегося студента 
    $st_subj_query="SELECT subjects.subj_name FROM groupes,specialities,subjects 
                    WHERE subjects.speciality=specialities.speciality_id AND specialities.speciality_id=groupes.speciality AND groupes.group_name='$st_subj';"; // Запрос на выбор предметов для группы
    $st_subj_result=mysqli_query($link,$st_subj_query);
    $st_subj_row=mysqli_fetch_array($st_subj_result);  


    $_SESSION['st_name']=$st_row['st_name'];
    $_SESSION['group_name']=$st_row['group_name']; ?>
     <!-- Форма для типа аккаунта студент -->
     <div class="parent">
     <?php require "header.php";?>
         <div class="block" id="auth">
         <h1 id="auth">Вы авторизованы!</h1>   
         <h2 id="auth">Информация об аккаунте:</h2>
            <ul>
                <li><strong>Группа: </strong><?php echo $st_row["group_name"]?></li>
                <li><strong>ФИО: </strong><?php echo $st_row["st_name"]?></li>
                <li><strong>Дата рождения: </strong><?php echo $st_row["st_birthdate"]?></li> 
                <li><strong>Номер телефона: </strong><?php echo $st_row["st_telephone"]?></li>
                <li><strong>Тип аккаунта: </strong> Студент</li>
            </ul> 

                <form action="Students/st_grades.php" method="POST" target="_blank">
                    <input type="hidden" name="group" value="<?php echo $st_row['group_name'];?>">  <!--Передаем название группы на страницу оценки("st_grades")-->
                    <input type="hidden" name="subj" value="<?php echo $st_subj_row['subj_name'];?>">  <!--Передаем название предмета на страницу оценки("st_grades")-->
                    <input type="submit" value="Оценки" id="authButton">

                </form>
                <form action ="Students/st_timetable.php" method="POST" target="_blank">
                    <input type="hidden"  name ="group_name" value='<?php echo $st_row["group_name"];?>'>
                    <input type="submit" value="Расписание"  id="authButton">
                </form>

                <form action="Students/st_works.php" method="POST" target="_blank">
                    <input type="hidden" name="group_name" value="<?php echo $st_row['group_name'];?>">
                    <input type="submit" value="Тесты"  id="authButton">
                </form>

                <form action="Students/st_lession.php" target="_blank">
                    <input type="submit" value="Лекции"  id="authButton">
                </form>
                </div> 
            </div>
    </div>

    
     <?php } elseif($count_lect=mysqli_num_rows($lect_result)==1){
        

         // Сохраняем имя преподавателя чтобы передать его в другую форму -->
        $_SESSION["lect_name"]=$lect_row["lect_name"];?>


        <!-- Форма для типа аккаунта преподаватель -->
    <div class="parent">
        <?php require "header.php"?>
        <div class="block" id="auth">
        <h1 id="auth">Вы авторизованы!</h1>
            <h2 id="auth">Информация об аккаунте:</h2>
            <ul>
                <li><strong>ФИО: </strong><?php echo $lect_row["lect_name"];?></li>
                <li><strong>Дата рождения: </strong><?php echo $lect_row["lect_birthdate"];?></li>
                <li><strong>Номер телефона: </strong><?php echo $lect_row["lect_telephone"];?></li>
                <li><strong>Тип аккаунта: </strong> Преподаватель</li>
            </ul>
            <div class="center">
                <form action="Lecturers/lect_grades/lect_grades1.php" method="POST" target="_blank"> <!-- Передаем имя преподавателя в форму lect_grades-->
                    <input type="submit" value="Выставить оценки" id="authButton">
                </form>
                <form action="Lecturers/lect_timetable.php" method="POST" target="_blank">

                    <input type="submit" value="Расписание" id="authButton" >
                </form>
                <form action="Lecturers/lect_works/lect_works.php" method="POST" target="_blank">

                    <input type="submit" value="Создать тест" id="authButton" >
                </form>
                <form action="Lecturers/lect_lessions/lect_lession1.php" method="POST" target="_blank">
                    <input type="submit" value="Добавить лекцию" id="authButton" >
                </form>
            </div>
        </div>
    </div>


<?php } else { ?>


    <div class="block">
        <h1><?php echo "Данные введены неверно, попробуйте еще раз";?></h1>
        <form action="auth.php">

            <div class="field">
                <div class="center">
                <input type="submit" value="Войти">
                </div>
            </div>

        </form>
    </div>

    
<?php }
?>
</body>
</html>
