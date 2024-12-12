<?php
	//Инициализируем сессию:
	session_start();
	if (!isset($_SESSION['counter'])) {
		$_SESSION['counter'] = 1;
	} else {
		$_SESSION['counter'] = $_SESSION['counter'] + 1;
	}
	//Выведем значение счетчика:
	echo 'Вы обновили эту страницу '.$_SESSION['counter'].' раз!</br></br>';

      // unset($_SESSION['var']);         -- удаление переменной сессии 
      // session_destroy();               -- удалить все переменные сессии для данного пользователя
?>
<?php include 'config/lib.php'; ?> <!-- getPage(array $pages) -->
<?php $pages = include 'config/pages.php';   
      echo"var_dump ($ pages ) : "; 
      var_dump($pages); 
      echo "</br></br></br>"
?>    <!-- array[1 - main.php, 2 - about.php, 3 - contacts.php] -->
<?php $page = getPage($pages); ?>
<?php include 'config/reply.php'; ?> <!-- Файл с функцией ответа на заполненную (или не заполненную) форму   -->


<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
      </head>

      <body>
            <!-- Меню перехода по страницам через массив pages.php ( Страницы ) -->
            <header>
                  <nav>
                        <a href="?page=1">Главная</a>
                        <a href="?page=2">О нас</a>
                        <a href="?page=3">Контакты</a>
                  </nav>
            </header>

            <!-- Форма отправки сообщения в виде «Обратная связь» так.
            После удачной отправки выводится сообщение «Спасибо за Вашу обратную связь»,
            при ошибке — «Упс, что-то пошло не так». -->
            <form method="post" name="reply" id="replyForm"> 
                  <p>Имя: <input type="text" name="username"></p>
                  <p>Фамилия: <input type="text" name="usersurname"></p>
                  <p>Почта: <input type="email" name="useremail"></p>
                  <p>Телефон: <input type="tel" name="userphone"></p>
                  <p>Сообщение: <textarea name="usermessage" required></textarea></p>
                  <input type="submit" value="Отправить"/>
            </form>

            <div id="responseMessage"></div>

            <script>
                  document.querySelector("#replyForm").addEventListener('submit', async (event) => {
                        event.preventDefault();
                        const formData = new FormData(event.target);
                        console.log("Событие обработано!"); // проперка работоспособности асинк листнера
                        
                        fetch("http://pagesphp/config/reply.php" , {
                              method: "POST",
                              body: formData
                        })

                        .then(response => response.text())
                        .then(result => {
                              document.querySelector("#responseMessage").innerText = result;
                        })
                        .catch(error => {
                              document.querySelector("#responseMessage").innerText = "Ошибка: " + error.message;
                        })
                        
                        alert("<?php $getReply(); ?>");
                  });   
            </script>
            
            
            <?php include "pages/" . $page; ?>
      </body>
</html>