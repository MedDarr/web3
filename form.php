<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
    print('Спасибо, результаты сохранены.');
  }
  // Включаем содержимое файла form.php.
  include('form.php');
  // Завершаем работу скрипта.
  exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

// Проверяем ошибки.
$errors = FALSE;
if (empty($_POST['name'])) {
  print('Введите имя.<br/>');
  $errors = TRUE;
}

if (empty($_POST['email']) ||  !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  print('Введите почту.<br/>');
  $errors = TRUE;
}
if (empty($_POST['year'])) {
  print('Выберите год.<br/>');
  $errors = TRUE;
}
if (empty($_POST['pol']) || !($_POST['pol']=='м' || $_POST['pol']=='ж')) {
  print('Выберите пол.<br/>');
  $errors = TRUE;
}
if (empty($_POST['kolvo']) || !is_numeric($_POST['kol-vo']) || ($_POST['kol-vo']<2) || ($_POST['kol-vo']>4)) {
  print('Выберите количество конечностей.<br/>');
  $errors = TRUE;
}

if (empty($_POST['bio'])) {
    print('Заполните биографию.<br/>');
    $errors = TRUE;
  }
  
  if (empty($_POST['info']) || !($_POST['informed'] == 'on' || $_POST['informed'] == 1)) {
    print('Поставьте галочку "С контрактом ознакомлен(а)".<br/>');
    $errors = TRUE;
  }
  

if ($errors) {
  // При наличии ошибок завершаем работу скрипта.
  exit();
}

// Сохранение в базу данных.

$user = '52810'; 
$pass = '1211928';
$db = new PDO('mysql:host=localhost;dbname=u52810', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); 

// Подготовленный запрос. Не именованные метки.
try {
    $stmt = $db->prepare("INSERT INTO application SET name = ?, email=?, year=?, pol=?, kolvo=?, bio=?,");
    $stmt -> execute([$_POST['name'], $_POST['email'],$_POST['year'],$_POST['pol'], $_POST['kolvo'],$_POST['bio'] ]);
    $strId = $db -> lastInsertId();
    if (isset($_POST['sposobn'])) {
        foreach ($_POST['sposobn'] as $ability) {
            switch ($ability) {
                case "immortal":
                    $stmt = $db -> prepare("INSERT INTO connection (id, a_id) VALUES (:id, :a_id);");
                    $stmtErr = $stmt -> execute(['id' => intval($strId), 'a_id' => 1]);
                    break;
                case "throughwalls":
                    $stmt = $db -> prepare("INSERT INTO connection (id, a_id) VALUES (:id, :a_id);");
                    $stmtErr = $stmt -> execute(['id' => intval($strId), 'a_id' => 2]);
                    break;
                case "levitation":
                    $stmt = $db -> prepare("INSERT INTO connection (id, a_id) VALUES (:id, :a_id);");
                    $stmtErr = $stmt -> execute(['id' => intval($strId), 'a_id' => 3]);
                    break;
            }
        }
    }
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}
    

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1');

/*
CREATE TABLE application(
    id int(10) unsigned NOT NULL AUTO_INCREMENT,
    name varchar(128) NOT NULL DEFAULT '',
    email varchar(128) NOT NULL DEFAULT '',
    year int(4) NOT NULL DEFAULT 0,
    pol varchar(1) NOT NULL DEFAULT '',
    kolvo int(1) NOT NULL DEFAULT 0,
    bio  varchar(128) NOT NULL DEFAULT '',
    info int(1)  NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);


CREATE TABLE ability (
  a_id int(10) unsigned NOT NULL AUTO_INCREMENT,
  a_name varchar(128) NOT NULL,
  PRIMARY KEY (a_id)
);
INSERT INTO ability (a_name) VALUES ('immortal');
INSERT INTO ability (a_name) VALUES ('throughwalls');
INSERT INTO ability (a_name) VALUES ('levitation');

CREATE TABLE connection (
  id int(10) unsigned NOT NULL,
  a_id int(10) unsigned NOT NULL,
  FOREIGN KEY (id)  REFERENCES application (id),
  FOREIGN KEY (a_id) REFERENCES ability (a_id)
);

*/
