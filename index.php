<?php
    // uzmi master kontolere
    require ( "system/mother_controller.php");
    require ( "system/mother_model.php");

    // da li ima neceg u URL?
    if (isset($_GET['controller']) && isset($_GET['method']))
    {
        $controller = $_GET['controller'];
        $method     = $_GET['method'];
    }
    else
    {
        $controller = 'form';  // default kontroler
        $method     = 'index'; // default metoda
    }

    // napravi ime klase na osnovu ulaza
    $controller_name = ucwords($controller) . "Controller";

    // pozovi kontroler
    require_once('controllers/' . $controller . '_controller.php'); // napravi ime fajla i daj ga
    $controller = new $controller_name();                           // napravi novi kontoler objekat
    $controller->$method();                                         // pusti metod
?>