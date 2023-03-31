<?php
require 'Core/AutoLoad.php';

$S_urlToPeer = isset($_GET['url']) ? $_GET['url'] : null;
$A_postParams = isset($_POST) ? $_POST : null;
View::openBuffer();

session_start();

try{
    $O_controller = new Controller($S_urlToPeer, $A_postParams);
    $O_controller->execute();
}catch (ControllerException $O_exception){
    echo ('Une erreur s\'est produite : ' . $O_exception->getMessage());
}

$contentForDisplay = View::getBufferContent();

View::show('gabarit', array('body' => $contentForDisplay));