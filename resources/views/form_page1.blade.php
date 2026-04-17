<?php
$title = "Feedback Form"

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/styles/welcome.css">
    <link rel="stylesheet" href="/styles/form_page1.css">
</head>
<body>
<header class="header">
    <a href="/"><img class="logo" src="/src/polytech_logo_main_RGB.png"></a>
    <div class="title"><?= $title ?></div>
    <div style="width: 100px;"></div>
</header>

<main>
    <form action="https://httpbin.org/post" method="POST">
        <div>
            <label for="nameInput">Ваше имя:</label>
            <input id="nameInput" type="text">
        </div>

        <div>
            <label for="emailInput">Email:</label>
            <input id="emailInput" type="email">
        </div>

        <div>Тип обращения:</div>
        <div class="radioInput">
            <input id="complain" type="radio" name="requestGroup" value="жалоба">
            <label for="complain">Жалоба</label>

            <input id="suggestion" type="radio" name="requestGroup" value="предложение">
            <label for="suggestion">Предложение</label>

            <input id="gratitude" type="radio" name="requestGroup" value="благодарность">
            <label for="gratitude">Благодарность</label>
        </div>

        <button type="submit">Отправить заявку</button>

        <a class="linkToFormData" href="/form/data">Перейти к данным формы</a>
    </form>
</main>

<footer class="footer">
    Задание для самостоятельной работы
</footer>
</body>
</html>
