<?php
require_once 'private/functions.php';
function validUser($usrName, $password)
{
    $user = readLine_('users', $usrName, 'name');
    $level = 0;
    foreach ($user as $name => $infos) {

        if (password_verify($password, $infos["password"])) {
            global $level;
            $level = $infos['level'];
            session_start();
            $_SESSION['login'] = $level;
        }
    };
    return $level;
};
