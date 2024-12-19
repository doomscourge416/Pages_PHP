<?php

//  Страница авторизации
//  Функция для генерации случайной строки

function generateCode($length = 6){
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $codelength = strlen($chars) - 1;

    while (strlen($code) < $length){
        $code . = $chars[mt_rand(0, $codelength)];
    }

    return $code;
}

//  Соединяемся с БД
$link = mysqli_connect("localhost", "mysql_user", "mysql_password", "testtable");
if(isset($_POST['submit'])){

    //  Вытаскиваем из БД запись, у которой логин равняется введенному
    $query = mysqli_query($link, "SELECT user_id, user_password FROM users WHERE user_login = '" . mysqli_real_escape_string($link, $_POST['login']) . "' LIMIT 1");
    $data = mysqli_fetch_assoc($query);
    //  Сравниваем пароли
    if($data['user_password'] === md5(md5($_POST['password']))){

        //  Генерируем случаное число и шифруем его
        $hash = md5(generateCode(10));

        if(!empty($_POST['not_attach_ip'])){

            //  Если пользователь выбрал привязку к IP
            //  Переводим IP в строку

        }

    }

}

?>