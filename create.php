<?php

    $studentsString = file_get_contents('database.json');
    $studentsDecoded = json_decode($studentsString, true);

    $newStudent = [
        'first_name' => $_POST['student']['firstName'],
        'last_name' => $_POST['student']['lastName'],
        'email' => $_POST['student']['email'],
    ];

    $studentsDecoded[] = $newStudent;

    $studentsEncoded = json_encode($studentsDecoded);

    file_put_contents('database.json', $studentsEncoded);

    $response = [
        'success' => true,
        'message' => 'Ok',
        'code' => 200
    ];

    header('Content-Type: application/json');

    echo json_encode($response);