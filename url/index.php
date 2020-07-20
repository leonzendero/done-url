<?php

// http://url?type=add&data=<any data>

if ($_GET['type'] === 'add' and !empty($_GET['data'])) {


    if ($_GET['data'] === $_GET['']) {

    }

    require_once "db.php";

    $connect = new pdo_connect("localhost", "root", "", "storage");

    $connect->connect_pdo();

    $query = $connect->PDO->prepare("SELECT * FROM `request`");
    $query->execute();

    $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";

    $max = 10;

    $size = StrLen($chars) - 1;

    $password = null;

    while ($max--)
        $password .= $chars[rand(0, $size)];

    foreach ($query as $row) {
        $arr = array(
            'id' => $row['id'] + 1,
            'password' => $password,
        );
    }


    $update_q = $connect->PDO->prepare("INSERT INTO 
	`request` (`password`, `text`) VALUES (?,?)");

    $update_q->execute(array($password));


    echo json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

    $log = date('Y-m-d H:i:s') . ' ' . print_r($arr, true) . 'ADD';
    file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);


    $connect->close_connect_pdo();
    unset($connect);
}

// http://url?type=delete&password=<password>&id=<id>

if ($_GET['type'] === 'delete' and !empty($_GET['password'])) {

    require_once "db.php";

    $connect = new pdo_connect("localhost", "root", "", "storage");

    $connect->connect_pdo();

    $query = $connect->PDO->prepare("SELECT * FROM `request`");
    $query->execute();

    $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";

    $max = 10;

    $size = StrLen($chars) - 1;

    $password = null;

    while ($max--)
        $password .= $chars[rand(0, $size)];

            foreach ($query as $row) {
                if ($_GET['password'] === $row['password']) {
                    if ($_GET['id'] === '<' . $row['id'] . '>') {
                        $arr = array(
                            'id' => $row['id'],
                            'password' => $row['password'],
                        );

                        $delete_q = $connect->PDO->prepare("DELETE FROM 
	`request` WHERE id = :id");

                        $delete_q->bindValue(':id', $row['id']);

                        $delete_q->execute();

                        echo 'Delete<br>';
                        echo json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                        $log = date('Y-m-d H:i:s') . ' ' . print_r($arr, true) . 'DELETE';
                        file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);

                    }
                }
            }

            $connect->close_connect_pdo();
            unset($connect);
}

// http://url?type=edit&data=anydata&password=<password>&id=<id>

if ($_GET['type'] === 'edit' and !empty($_GET['data']) and !empty($_GET['password'])) {

    if ($_GET['data'] === $_GET['']) {

    }

    require_once "db.php";

    $connect = new pdo_connect("localhost", "root", "", "storage");

    $connect->connect_pdo();

    $query = $connect->PDO->prepare("SELECT * FROM `request`");
    $query->execute();

    $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";

    $max = 10;

    $size = StrLen($chars) - 1;

    $password = null;

    while ($max--)
        $password .= $chars[rand(0, $size)];

    foreach ($query as $row) {
        if ($_GET['password'] === $row['password']) {
            if ($_GET['id'] === '<' . $row['id'] . '>') {
                $arr = array(
                    'id' => $row['id'],
                    'password' => $row['password'],
                );

                $edit_q = $connect->PDO->prepare("UPDATE
	`request` SET password = :password, text = :text WHERE id = :id");

                $edit_q->execute(array(
                    ':id' => $row['id'],
                    ':password' => $password,
                    ':text' => $_GET['data']
                ));
                echo 'Edit done';
            }
        }
    }

    $log = date('Y-m-d H:i:s') . ' ' . print_r($arr, true) . 'EDIT';
    file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);


    $connect->close_connect_pdo();
    unset($connect);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
