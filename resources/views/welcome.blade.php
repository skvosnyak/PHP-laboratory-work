<?php
date_default_timezone_set('Europe/Moscow');
$title = "Задание: Hello, World!";
$currentTime = date("d.m.Y H:i:s");
$helloMessage = "Hello, World!";

$hour = date("H");
if ($hour < 12) {
    $greeting = "Доброе утро";
} elseif ($hour < 18) {
    $greeting = "Добрый день";
} else {
    $greeting = "Добрый вечер";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/styles/welcome.css">
</head>
<body>
    <header class="header">
        <a href="/"><img class="logo" src="/src/polytech_logo_main_RGB.png"></a>
        <div class="title"><?= $title ?></div>
        <div style="width: 100px;"></div>
    </header>

    <div class="main">
        <div class="content">
            <div class="greeting"><?=$greeting?>!</div>
            <div class="hello"><?=$helloMessage?></div>
            <div class="time">Серверное время: <?= $currentTime ?></div>
        </div>
    </div>

    <ul class="tasks">
        <li><a href="/form">Перейти к форме</a></li>
    </ul>
    <footer class="footer">
      Задание для самостоятельной работы
    </footer>
</body>
</html>
