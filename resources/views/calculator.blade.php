<?php
$title = "Calculator";
$jsInput = $_POST;
// вызов функции
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/styles/welcome.css">
    <link rel="stylesheet" href="/styles/calculator.css">
    <script defer src="/scripts/calculator.js"></script>
</head>
<body>
    <header class="header">
        <a href="/"><img class="logo" src="/src/polytech_logo_main_RGB.png"></a>
        <div class="title"><?= $title ?></div>
        <div style="width: 100px;"></div>
    </header>

    <div class="main">
        <div class="gridContainer">
            <div class="gridCalculator">
                <div class="showInput"></div>
                <div class="buttonCalc" id="1">1</div>
                <div class="buttonCalc" id="2">2</div>
                <div class="buttonCalc" id="3">3</div>
                <div class="buttonCalc" id="4">4</div>
                <div class="buttonCalc" id="5">5</div>
                <div class="buttonCalc" id="6">6</div>
                <div class="buttonCalc" id="7">7</div>
                <div class="buttonCalc" id="8">8</div>
                <div class="buttonCalc" id="9">9</div>
                <div class="buttonCalc" id="0">0</div>
                <div class="buttonCalc buttonPlus" id="+">+</div>
                <div class="buttonCalc buttonMinus" id="-">-</div>
                <div class="buttonCalc buttonMultiple" id="*">*</div>
                <div class="buttonCalc buttonDivide" id="/">/</div>
                <div class="buttonCalc button(" id="(">(</div>
                <div class="buttonCalc button)" id=")">)</div>
                <div class="buttonCalc buttonCount" id="=">=</div>
                <div class="buttonCalc buttonClear" id="C">C</div>
            </div>
        </div>
    </div>


    <footer class="footer">Задание для самостоятельной работы</footer>
</body>
</html>
