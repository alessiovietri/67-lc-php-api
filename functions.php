<?php

function generateStrongPassword($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&?';
    
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, strlen($characters) - 1);
        $password .= $characters[$randomIndex];
    }

    return $password;
}

function start() {
    $password = '';
    $error = null;
    $success = false;

    if (
        isset($_GET['length'])
        &&
        is_numeric($_GET['length'])
    ) {

        $passwordLength = intval($_GET['length']);
        if ($passwordLength < 8) {
            $error = 'Lunghezza MINIMA della password: 8 caratteri (furbetto)';
        }
        else if ($passwordLength > 32) {
            $error = 'Lunghezza MASSIMA della password: 32 caratteri (furbetto!)';
        }
        else{
            $password = generateStrongPassword($passwordLength);

            $success = true;
        }

    }

    return [
        'password' => $password,
        'error' => $error,
        'success' => $success,
    ]; 
}