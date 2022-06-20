<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>Авторизация</title>
</head>
<body>
    <div class="parent">
    <?php include "header.php";?>
        <div class="block">
        
        <h1>Авторизация</h1>
        <div class="main">
            <form action="authentification.php" method="POST" >
                <div class="field">
                    <label for="a">Логин: </label>
                    <input required type="text" name="login" id="a">
                </div>

                <div class="field">
                    <label for="b">Пароль: </label>
                    <input required type="password" name="password" id="b">
                </div>
                <div class="field">
                    <div class="center">
                <input type="submit" value="Войти" id="authButton">
                </div>
                </div>
            </form>
    </div>
    </div>
    </div>

</form>
</body>
</html>