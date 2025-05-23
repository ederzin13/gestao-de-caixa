<?php
    $start = true;
    //$logged = false;

    $users = ["user" => "1234"];

    function startScreen() {
        echo "Sistema de gerenciamento de caixa™\n 1 - Fazer Login\n 2 - Sair\n";

        $input = readline();

        return $input;
    }

    function login() {
        global $users;

        echo "Fazer login\n Nome de usuário:\n";
        $user = readline();

        echo "Senha: ";
        $password = readline();

        for ($i = 0; $i < count($users); $i++) {
            if ($password == $users[$user]) {
                echo "entrou";
            } 
            else {
                system("clear");
                echo "Usuário ou senha inválidos\n";
                startScreen();
            }
        }
    }

    login();