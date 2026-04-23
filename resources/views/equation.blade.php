<?php
$title = "Solve the equation";
$equation = "76 + X = 129";
$parts = explode(" ", $equation);
$a = $parts[0];
$op = $parts[1];
$b = $parts[2];
$c = $parts[4];

if ($a == "X") $result = ($op == "+") ? $c - $b : $c + $b;
elseif ($b == "X") $result = ($op == "+") ? $c - $a : $a - $c;
else $result = ($op == "+") ? $a + $b : $a - $b;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/styles/welcome.css">
    <link rel="stylesheet" href="/styles/equation.css">
    <title>Solve the equation</title>
</head>
<body>
    <header class="header">
        <a href="/"><img class="logo" src="/src/polytech_logo_main_RGB.png"></a>
        <div class="title"><?= $title ?></div>
        <div style="width: 100px;"></div>
    </header>

    <section>
        <h2 class="equationTitle"><?= $equation ?></h2>
        <div class="resultTitle">Result: <?= $result ?></div>
    </section>
    <footer>
        <div>Задание для самостоятельной работы</div>
    </footer>
</body>
</html>
