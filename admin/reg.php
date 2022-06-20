<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>Регистрация</title>
</head>
<body>
    <div class="parent">
    <?php
    include "../header.php";
    session_start();
    require "../dbconnect.php";
    $group_query="SELECT group_name, group_id FROM groupes  ORDER BY group_name DESC;"; // Запрос на выборку всех групп и их айди
    $group_result=mysqli_query($link,$group_query);



if($_SESSION['login']=='21232f297a57a5a743894a0e4a801fc3' && $_SESSION['password']='21232f297a57a5a743894a0e4a801fc3'){?>


    <!--ФОРМА РЕГИСТРАЦИИ-->
<div class="widthblock">
    <h1>Регистрация аккаунта</h1>
    <div class="main">
    <form action="reg.php" method="POST">

        <div class="field">
            <label for="a">Группа(для студентов): </label>
            <div class="right">
                <select name="group" id="a">
                    <option value='0'></option>

                    <?php while ($row_group=mysqli_fetch_array($group_result)){ // Вывод всех групп в виде списка?> 

                        <option value="<?php echo $row_group["group_id"] // Вывод номера группы ?>"><?php echo $row_group["group_name"] //Вывод названия группы ?></option>

                    <?php } ?>

                </select>
            </div>
        </div>

        <div class="field">
            <label for="b">ФИО(Полностью): </label>
                <input required type="text" id="b", name="name">
        </div>

        <div class="field">
            <label for="c">Дата рождения(Год-Месяц-День): </label>
                <input required type="text" id="c" name="date" value="2002-01-31">
        </div>

        <div class="field">
            <label for="d">Номер телефона:</label>
                <input required type="text" id="d" name="phone">
        </div>

        <div class="field">
            <label for="e">Логин: </label>
                <input required type="text" id="e" name="login">
        </div>

        <div class="field">
            <label for="f">Пароль: </label>
                <input required type="password" id="f" name="password">
        </div>
        
        <div class="field">
            <div class="center">
                <input type="submit" value="Зарегистрировать">
            </div>
        </div>

    </form>
    </div>
    <?php 
    if(!empty($_POST['group']) && isset($_POST["name"],$_POST["date"],$_POST["phone"],$_POST["login"],$_POST["password"])){ // регистрация студента
    
        $st_group=$_POST["group"];
        $st_name=$_POST['name'];
        $st_date=$_POST["date"];
        $st_phone=$_POST['phone'];
        $st_login=md5($_POST["login"]);
        $st_password=md5($_POST['password']);
    
    
        //Запрос для проверки наличия аккаунта студента
        $st_query="SELECT st_name FROM students WHERE st_name='$st_name';";
        $st_result=mysqli_query($link,$st_query);
        
    
        if (($st_count=mysqli_num_rows($st_result)) < 1){
            
    
            $st_reg_query="INSERT INTO students(class,st_name,st_birthdate,st_telephone,st_login,st_pass) 
            VALUES ('$st_group','$st_name','$st_date','$st_phone','$st_login','$st_password');";
            $st_reg_result=mysqli_query($link,$st_reg_query);
            
    
            if ($st_reg_result) { ?>
              <h1><?php echo "Аккаунт успешно зарегистрирован";?></h1>
            <?php } 
    
        } else {?> <h1><?php echo "Такой аккаунт уже существует";?></h1> 
        <? } 
    
    
    } elseif (isset($_POST["name"],$_POST["date"],$_POST["phone"],$_POST["login"],$_POST["password"])){  // Регистрация преподавателя
        $lect_name=$_POST['name'];
        $lect_date=$_POST["date"];
        $lect_phone=$_POST['phone'];
        $lect_login=md5($_POST["login"]);
        $lect_password=md5($_POST['password']);
    
    
        // Запрос для проверки наличия аккаунта преподавателя
        $lect_query="SELECT lect_name FROM lecturers WHERE lect_name='$lect_name';";
        $lect_result=mysqli_query($link,$lect_query);
        if(($lect_count=mysqli_num_rows($lect_result)) < 1){
            $lect_reg_query="INSERT INTO lecturers(lect_name,lect_birthdate,lect_telephone,lect_login,lect_pass) 
                            VALUES('$lect_name','$lect_date','$lect_phone','$lect_login','$lect_password');";
            $lect_reg_result=mysqli_query($link,$lect_reg_query);
            if($lect_reg_result){ ?>
                 <h1><?php echo "Аккаунт успешно зарегистрирован";?></h1> 
            <?php } else { ?>
                <h1><?php echo "Что то пошло не так";}?></h1> 
        <?php } else { ?>
            <h1><?php echo "Такой аккаунт уже существует";?></h1> 
            
            <?php }
    
        } 
}
    
    else {?>
        <h1><?php echo "У вас недостаточно прав для регистрации";?></h1> <?php }
    ?>
</div>
</div>
</body>
</html>