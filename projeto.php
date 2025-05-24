<?php
    //$start = false;
    $logged = false;

    $users = ["user" => "1234"];

    function startScreen() {
        echo "Sistema de gerenciamento de caixa™\n 1 - Fazer Login\n 2 - Sair\n";

        $input = readline();
        return $input;
    }

    function login(&$logged) {
        global $users;

        echo "Fazer login\n Nome de usuário:\n";
        $user = readline();

        echo "Senha: ";
        $password = readline();

        for ($i = 0; $i < count($users); $i++) {
            if ($password == $users[$user]) {
                echo "Bem vindo $user";
                $logged = true;
            } 
            else {
                system("clear");
                echo "Usuário ou senha inválidos\n";
                startScreen();
            }
        }
    }

    function logout(&$logged) {
        return $logged = false;
    }

    function menuScreen(&$logged) {
        system("clear");
        echo "MENU\n 1 - Vender\n 2 - Criar usuário\n 3 - Verificar log\n 4 - Deslogar\n";
        $input = readline();

        options($input);
    }

    function newUser() {
        global $users;

        system("clear");
        echo "Cadastrar novo usuário\n Nome: \n";
        $name = readline();

        echo "Senha:\n";
        $senha = readline();

        $users[$name] = $senha;
        echo "Novo usuário cadastrado\n";
    }

    function options($option) {
        global $logged;
        $option = match ($option) {
            "1" => "Vender",
            "2" => newUser(),
            "3" => "Log",
            "4" => logout($logged),
            default => "Opção inválida"
        };

        return $option;
    }

    while (!$logged) {
        if (startScreen() == "1") {
            system("clear");
            //startScreen();
            login($logged);
        }

        else {
            die("Até mais\n");
        }
        
        while ($logged) {
            system("clear");
            menuScreen($logged);
        }
    }

