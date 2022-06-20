<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="favicon.ico">
    
    <title></title>
</head>
<body>
    <?php 
    session_start(); ?>
    <div class="header">
        <div class="header__section">
            <div class="header__item headerlogo">
                КАЛП
            </div>
            <div class="header__item headerButton">
                <a href="/index.php">Главная</a>
            </div>
            <div class="header__item headerButton">
                <a href="https://spbftu.ru/institut-page/kolledzh-avtomatizatsii-lesopromyshlennogo-proizvodstva/" target="_blank">О нас</a>
            </div>
        </div>
        <div class="header__section">
            <div class="header__item headerButton">
                <?php 
                if(isset($_SESSION['login']) && isset($_SESSION['password'])){?>
                <a href="/authentification.php">Личный кабинет</a>
                <?php } 
                else { ?>
                <a href="/auth.php">Войти</a> <?php }?>
            </div>
        </div>

    </div>
</body>
</html>