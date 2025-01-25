<?php
// При обращении к этому файлу по адресу webprof-kupriun.unpe.ru/api/registration.php сервер возвращает 200, исправить

function registration(PDO $db, $input) {
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
        'password' => $input->password, // Пароль надо хэшировать
        'birth_date' => $input->birth_date,
        'token' => '',
    ]);

    echoRes(['message' => 'success!']); // Не соответствует требованиям, временная мера
}
