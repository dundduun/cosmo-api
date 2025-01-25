<?php
// При обращении к этому файлу по адресу webprof-kupriun.unpe.ru/api/registration.php сервер возвращает 200, исправить

function registration(PDO $db, $input, $pathParts, $method) {
    if ($pathParts[1]) {
        echoRes(['message' => 'Invalid request']); // Не соответствует требованиям, временная мера
        return;
    } else if ($method !== 'POST') {
        echoRes(['message' => 'Invalid request']); // Не соответствует требованиям, временная мера
        return;
    }

    // if () {} // проверить существование данных в $input

    $sql = 'INSERT INTO users (
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

    $stmt = $db->prepare($sql);
    $stmt->execute([
        'first_name' => $input->first_name,
        'last_name' => $input->last_name,
        'patronymic' => $input->patronymic,
        'email' => $input->email,
        'password' => password_hash($input->password, PASSWORD_DEFAULT),
        'birth_date' => $input->birth_date,
        'token' => '',
    ]);

    echoRes(['message' => 'success!']); // Не соответствует требованиям, временная мера
}
