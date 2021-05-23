<?php 
    $senha = $_POST["senha"]; //pega senha via post
    $nome = $_POST["nome"]; //pega nome via post
    $address = $_POST["address"]; //pega address via post
    $tudo = $address.",".$nome.","; // junta a o address e o nome
    $hash = "[hash da sua senha]"; //hash da senha(aqui você pode aprender a pegar https://www.php.net/manual/pt_BR/function.password-hash.php)

    //verifica se a senha esat certa
    if(password_verify($senha, $hash)) {
        //se a senha estiver certa ele manda a para função file_prepend, e depois redireciona pro site principal
        header('Location: /pudimcoin');
        file_prepend($tudo, '../../src/nomes.txt');
    } else {
        //se a senha estiver errada ele só mostra um alerta na pagina
        echo '<script>alert("SENHA INCORRETA")</script>';
    }

    //função que bota as informações dentro do nomes.txt
    function file_prepend ($string, $filename) {
        //abre o arquivo nomes.txt
        $fileContent = file_get_contents ($filename);
        //coloca o nome e o address no arquivo
        file_put_contents ($filename, $string . "\n" . $fileContent);
      }
?>