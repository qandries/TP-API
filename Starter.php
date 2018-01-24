<?php

include_once ('Facade.php');

//$weather = new YWeather();
//$data = $weather->getInfo();

//$derive = new Newton();
//$derive->getdata();

echo ("Choose your API : \n 1. for Yahoo Weather \n 2. for Newton\n");
$switch = readline("");


if ($switch == 1)
{
    $facade = new Facade();
    $data = $facade->getYWeather();
}
elseif ($switch == 2)
{
    $facade = new Facade();
    $data_newton = $facade->getNewton();
}
else
    echo "It's not the right number !\n";
