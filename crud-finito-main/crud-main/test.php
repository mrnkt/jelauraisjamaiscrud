<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/crud-main/models/Car.php");


$car = new Car;
?><br><br>
<?php

var_dump($car->deleteCar("car2"));
var_dump($car->deleteCar("2"));
echo "hello";

// $cars = $car->findAll();
// var_dump($cars);