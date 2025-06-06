<?php
    $logged = false;

    $users = ["user" => "1234", "eder" => "123"];
    $currentUser = "";

    $log = [];

    $totalSales = 0;

    function startScreen() {
        echo "Sistema de gerenciamento de caixa™\n 1 - Fazer Login\n 2 - Sair\n";

        $input = readline();
        return $input;
    }

    function login(&$logged) {
        global $users;
        global $currentUser;
        global $log;

        echo "Fazer login\n Nome de usuário:\n";
        $user = readline();

        echo "Senha: ";
        $password = readline();

        system("clear");

        for ($i = 0; $i < count($users); $i++) {
            if ($password == $users[$user]) {
                echo "Bem vindo $user\n";
                $logged = true;
                $currentUser = $user;

                $message = "$currentUser entrou no sistema em " . date("d/m/Y H:i:s\n");
                $log[] = $message;
                break;
            } 
            else {
                system("clear");
                echo "Usuário ou senha inválidos\n";
            }
        }
    }

    function logout(&$logged) {
        global $log;
        global $currentUser;
        
        $message = "$currentUser saiu do sistema em " . date("d/m/Y H:i:s\n");
        $log[] = $message;

        system("clear");

        return $logged = false;
    }

    function menuScreen(&$logged) {
        global $currentUser;

        echo "Usuário: $currentUser\n";
        echo "MENU\n 1 - Vender\n 2 - Criar usuário\n 3 - Verificar log\n 4 - Deslogar\n 5 - Total das vendas\n";
        $input = readline();
        
        options($input);
        //system("clear");
    }

    function sale() {
        global $log;
        global $currentUser;
        global $totalSales;
        
        system("clear");
        echo "Nova venda\n PRODUTO VENDIDO:\n";
        $item = readline();

        echo "VALOR DA VENDA:\n";
        $price = readline();

        system("clear");

        $message = "$currentUser realizou uma venda do item $item no valor $price em " . date("d/m/Y H:i:s\n");
        $log[] = $message;
        $totalSales += $price;
    }

    function newUser() {
        global $users;

        system("clear");
        echo "Cadastrar novo usuário\n Nome: \n";
        $name = readline();

        echo "Senha:\n";
        $senha = readline();

        system("clear");

        $users[$name] = $senha;
        echo "Novo usuário cadastrado\n";
    }

    function logView() {
        global $log;
        $view = "";

        foreach ($log as $value) {
            $view .= $value;
        }

        system("clear");
        echo $view;
    }

    function totalView() {
        global $totalSales;
        system("clear");

        echo "Valor total das vendas: $totalSales\n";
    }

    function options($option) {
        global $logged;
        $option = match ($option) {
            "1" => sale(),
            "2" => newUser(),
            "3" => logView(),
            "4" => logout($logged),
            "5" => totalView(),
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
            //system("clear");
            menuScreen($logged);
        }
    }

