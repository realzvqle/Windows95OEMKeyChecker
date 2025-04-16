<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Windows 95 Key Checker</title>
    <style>
        body {
            background-color: black;
            color: white;
            text-align: center;
            font-family: monospace;
        }
        input, button {
            background-color: black;
            color: white;
            font-family: monospace;
            border-color: cyan;
            border-radius: 90px;
        }
        .fail {
            color: red;
        }
        .pass {
            color: green;
        }

    </style>
</head>
<body>
    <h1>Windows 95 OEM Key Checker!</h1>
    <form method="POST" action="index.php">
        <input type="text" name="input">
        <button type="submit" name="enter">Enter Key</button>
    </form>
</body>
</html>

<?php

function PrintPassedResult($string){
    echo("<div class=pass><h3>$string</h3></div>");
}

function PrintFailedResult($string){
    echo("<div class=fail><h3>$string</h3></div>");
}

if(!isset($_POST['enter'])){
    die();
}

$trimmed = trim($_POST['input']);
$parsed = explode('-', $trimmed);
if(!isset($parsed[0]) || !isset($parsed[1]) || !isset($parsed[2]) || !isset($parsed[3])){
    PrintFailedResult("No Key Inputted");
    die();
}
if($parsed[1] != "OEM"){
    PrintFailedResult("Not an OEM Key!");
    die();
}
PrintPassedResult("Key Detected as OEM!");
if(strlen($parsed[0]) != 5) {
    PrintFailedResult("Date Tag is Invalid");
    die();
}
$firstnumofdyear = (int)$parsed[0][0];
$secondnumofdyear = (int)$parsed[0][1];
$thirdnumofdyear = (int)$parsed[0][2];
if(!isset($firstnumofdyear) || !isset($secondnumofdyear) || !isset($thirdnumofdyear)){
    PrintFailedResult("Date Tag must be an Integer");
    die();
}
if($firstnumofdyear > 3 || $firstnumofdyear < 0){
    PrintFailedResult("Invalid Key<br>Day of the Year can not be over 365 or under 001");
    die();
}
if($firstnumofdyear == 3){
    if($secondnumofdyear > 6){
        PrintFailedResult("Invalid Key<br>Day of the Year can not be over 365 or under 001");
        die();
    }
    if($secndnumofdyear == 6){
        if($thirdnumofdyear > 6){
            PrintFailedResult("Invalid Key<br>Day of the Year can not be over 365 or under 001");
        }
    }
    
}

$fourthnumofdyear = (int)$parsed[0][3];
$fifthnumofdyear = (int)$parsed[0][4];
if(!isset($fourthnumofdyear) || !isset($fifthnumofdyear)){
    PrintFailedResult("Date Tag must be an Integer");
    die();
}

if($fourthnumofdyear != 9){
    PrintFailedResult("The Product Key can NOT be newer then 1999 or older then 1995!");
    die();
}
if($fifthnumofdyear > 9 || $fifthnumofdyear < 5){
    PrintFailedResult("The Product Key can NOT be newer then 1999 or older then 1995!");
    die();
}
    
PrintPassedResult("First Section Passed\n");

if(strlen($parsed[2]) != 7) {
    PrintFailedResult("Second Section is Invalid");
    die();
}
$num1 = (int)$parsed[2][0];
$num2 = (int)$parsed[2][1];
$num3 = (int)$parsed[2][2];
$num4 = (int)$parsed[2][3];
$num5 = (int)$parsed[2][4];
$num6 = (int)$parsed[2][5];
$num7 = (int)$parsed[2][6];
if(!isset($num1) || !isset($num2) || !isset($num3) || 
    !isset($num4) || !isset($num5) || !isset($num5) || !isset($num7)){
    PrintFailedResult("Second Section is Invalid");
    die();
}
$sum = $num1 + $num2 + $num3 + $num4 + $num5 + $num6 + $num7;

if($sum % 7 != 0){
    PrintFailedResult("Sum for the Second Section Divided by 7 does not equal 0!");
    die();
}

PrintPassedResult("Second Section Passed");

if(strlen($parsed[3]) != 5) {
    PrintFailedResult("Third Section is Invalid");
    die();
}


PrintPassedResult("Third Section Passed");

PrintPassedResult("Congrats! $trimmed is a valid key!")




?>