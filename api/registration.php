<?php
require_once('../utils/echoError.php');
// При обращении к этому файлу по адресу webprof-kupriun.unpe.ru/api/registration.php сервер возвращает 200, исправить

function registration(PDO $db, $input, $pathParts, $method) {
    if ($pathParts[1]) {
        echoRes(['message' => 'Invalid request, $pathParts[1] exists']); // Не соответствует требованиям
        return;
    } else if ($method !== 'POST') {
        echoRes(['message' => 'Invalid request, $method !== POST']); // Не соответствует требованиям
        return;
    }

    $checkEmailExistance = 'SELECT * FROM users WHERE email = :email';
    
    $checkEmailStmt = $db->prepare($checkEmailExistance);
    $checkEmailStmt->execute(["email" => $input->email]);

    if ((bool) $checkEmailStmt->fetch()) {
        http_response_code(409);
        echoValidationError(409, 'Conflict', []); // не передаёт ошибку
        return;
    }

    $regSql = 'INSERT INTO users (
            first_name, 
            last_name, 
            patronymic, 
            email, 
            password, 
            birth_date, 
            token
        )
        VALUES (
            :first_name, 
            :last_name, 
            :patronymic, 
            :email, 
            :password, 
            :birth_date, 
            :token
        )
    ';

    $regStmt = $db->prepare($regSql);
    $regStmt->execute([
        'first_name' => $input->first_name,
        'last_name' => $input->last_name,
        'patronymic' => $input->patronymic,
        'email' => $input->email,
        'password' => password_hash($input->password, PASSWORD_DEFAULT),
        'birth_date' => $input->birth_date,
        'token' => '',
    ]);

    http_response_code(201);

    echoRes(
        ['data' => [
                "user" => [
                    "name" => "$input->last_name $input->first_name $input->patronymic",
                    "email" => $input->email
                ],
                "code" => 201,
                "message" => "Пользователь создан"
            ]
        ]
    );
}
