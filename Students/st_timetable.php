<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>Расписание</title>
</head>
<body>
    <div class="parent">

    <?php
    include "../header.php";
    require "../dbconnect.php"; // Подключаемся к бд


    //Переменные/Массивы
    $days=['ПН','ВТ','СР','ЧТ','ПТ']; // Массив с днями недели 


    // принимаемые переменные 
    $group_name=$_POST["group_name"];    


    // запросы


    ?>
    <div class="timetable">
<div style="float: left;">
    <h1 align="center">Расписание предметов</h1>
    <table align="center">
        <tr>
            <th>День | Группа</th>
            <th colspan="2"><?php echo $group_name;?>(Четная неделя)</th>
            <th><?php echo $group_name;?>(Нечетная неделя)</th>
        </tr>
<?php
       for($i=0; $i!=5; $i++) { ?>
            

            <tr>
                <th rowspan="5"><?php echo $days[$i];?>:</th>   
            </tr>


        <?php
            for ($j=1;$j!=5;$j++){
                ?>
                <tr>
                    <td width='10'><?php echo $j;?></td>
                    <td><?php 
                        // Выборка предметов в определенный день в определенной группе в четную неделю
                            $tt_query="SELECT groupes.group_name, subjects.subj_name, timetable.tt_day , timetable.tt_num, timetable.tt_week
                                FROM subjects, groupes, timetable, specialities
                                WHERE timetable.subject=subjects.subj_id AND subjects.speciality=specialities.speciality_id 
                                AND groupes.speciality=specialities.speciality_id AND subjects.Course=groupes.course 
                                AND groupes.group_name='$group_name' AND (tt_week='Четная' or tt_week='Всегда') AND tt_day='$days[$i]' AND timetable.tt_num='$j';";                                                
                            $tt_result=mysqli_query($link,$tt_query);
                            $tt_row=mysqli_fetch_array($tt_result);
                            $tt_num=mysqli_num_rows($tt_result);
                            if ($tt_num==1){ echo $tt_row['subj_name'];} else {echo " ";}

                    ?></td>
                    <td><?php 
                            // Выборка предметов в определенный день в определенной группе в нечетную неделю
                            $tt_uneven_query="SELECT groupes.group_name, subjects.subj_name, timetable.tt_day , timetable.tt_num, timetable.tt_week
                                FROM subjects, groupes, timetable, specialities
                                WHERE timetable.subject=subjects.subj_id AND subjects.speciality=specialities.speciality_id 
                                AND groupes.speciality=specialities.speciality_id AND subjects.Course=groupes.course 
                                AND groupes.group_name='$group_name' AND (tt_week='Нечетная' or tt_week='Всегда') AND tt_day='$days[$i]' AND timetable.tt_num='$j';";                                                
                            $tt_uneven_result=mysqli_query($link,$tt_uneven_query);
                            $tt_uneven_row=mysqli_fetch_array($tt_uneven_result);
                            $tt_uneven_num=mysqli_num_rows($tt_uneven_result);
                            if ($tt_uneven_num==1){ echo $tt_uneven_row['subj_name'];} else {echo " ";}
                    ?></td>
                </tr>
            <?php } ?>
        
        <?php } ?>
    </table>
</div>
<div style="float:right;">
    <h1>Расписание звонков </h1>
    <table align="center">
    <tr>
        <th>1 пара</th>
        <td>9:15-10:00<br>
            Перерыв 5 минут<br>
            10:05-10:50<br>
            Перерыв 20 минут<br>
        </td>
    </tr>
    <tr>
        <th>2 пара</th>
        <td>11:10-11:55<br>
            Перерыв 5 минут<br>
            12:00-12:45<br>
            Перерыв на обед 45 минут<br>
        </td>
    </tr>
    <tr>
        <th>3 пара</th>
        <td>13:30-14:15<br>
            Перерыв 5 минут<br>
            14:20-15:05<br>
            Перерыв 10 минут<br>
        </td>
    </tr>
    <tr>
        <th>4 пара</th>
        <td>15:15-16:00<br>
            Перерыв 5 минут<br>
            16:05-16:50<br>
            Перерыв 10 минут<br>
        </td>
    </tr>

    </table>
</div>
</div>
</div>
</body>
</html>