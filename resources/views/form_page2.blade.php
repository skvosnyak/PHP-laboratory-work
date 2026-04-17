<?php
$title = "Feedback Form";
$url = 'https://httpbin.org/get';
$headers = get_headers($url, 1);
if ($headers === false) {
    $output = "Не удалось получить заголовки от '$url'.";
} else {
    $output = print_r($headers, true);
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/styles/welcome.css">
    <link rel="stylesheet" href="/styles/form_page2.css">
</head>
<body>
<header class="header">
    <a href="/"><img class="logo" src="/src/polytech_logo_main_RGB.png"></a>
    <div class="title"><?= $title ?></div>
    <div style="width: 100px;"></div>
</header>

<main>
    <textarea rows="15" cols="80"><?php echo htmlspecialchars($output); ?></textarea>
</main>

<footer class="footer">
    Задание для самостоятельной работы
</footer>
</body>
</html>
