<?php

    $studentsString = file_get_contents('database.json');
    $studentsDecoded = json_decode($studentsString, true);

    if (isset($_GET['student'])) {
        // Recupero le informazioni del singolo studente

        /*
        
            Validazioni possibili:
            - l'indice esiste nell'array?
            - l'indice è un numero? (is_numeric)

        */

        if (
            is_numeric($_GET['student'])
        ) {
            $studentIndex = intval($_GET['student']);

            if (
                $studentIndex >= 0
                &&
                $studentIndex < count($studentsDecoded)
            ) {
                $student = $studentsDecoded[$studentIndex];
            
                $response = [
                    'success' => true,
                    'message' => 'Ok',
                    'code' => 200,
                    'student' => $student
                ];
            }
            else {
                $response = [
                    'success' => false,
                    'message' => 'Invalid data',
                    'code' => 400,
                ];
            }
        }
        else{
            $response = [
                'success' => false,
                'message' => 'Invalid data',
                'code' => 400,
            ];
        }
    }
    else{
        $students = [];
        foreach ($studentsDecoded as $student) {
            $students[] = [
                'full_name' => $student['first_name'].' '.$student['last_name']
            ];
        }
    
        // var_dump($students);
    
        $response = [
            'success' => true,
            'message' => 'Ok',
            'code' => 200,
            'students' => $students
        ];
    }

    $jsonResponse = json_encode($response);

    // // var_dump($jsonResponse);

    header('Content-Type: application/json');

    echo $jsonResponse;