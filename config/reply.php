<?php

    $getReply = function (){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $message = $_POST['usermessage'];
            echo "Запрос ушел. ";

            if(!empty($message)){
                $success = true;
                echo "Спасибо за обратную связь!";
            } else {
                $success = false;
                echo "Упс! Что-то пошло не так!";
            };  
        } else {
            echo "Нет данных для обработки";
        };

    };
?>