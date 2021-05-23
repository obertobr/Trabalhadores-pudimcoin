<html>
    <head>
        <title>Trabalhadores da pudimcoin</title><!-- titulo da aba -->
        <meta charset="UTF-8"><!-- usar caracteres UTF-8, pois o sistema de carcter padrão não aceita acento -->
        <link href="css/css.css" rel="stylesheet"><!-- usa o css(que é o que deixa as coisas bonitas) na pagina -->
        <link rel="icon"  href="src/coin.png"><!-- icone que aparece do lado do lado do titulo da aba -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"><!-- \/ -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script><!-- os dois são os links pro bootstrap, que é pra ja ter umas coisas ja prontas na pagina -->
  </head>
    </head>
    <body id="body" class="d-flex flex-column h-100">
        <div class="container-fluid text-center">
            <p id="titulo">Trabalhadores da <img id="pudimcoin" src="src/pudimcoin.png"></p><!-- o titulo da pagina, com uma parte escrita e outra uma imagem escrita pudimcoin -->
        </div>
        <div class="container-xl meio">
            <table class="table table-bordered table-dark"> <!-- uma tabela usando classes do bootstrap ja prontas -->
                <tr> <!-- parte de cima da tabela -->
                    <th>Nomes</th>
                    <th>Endereços</th>
                    <th>Shares</th>
                    <th>Shares Invalidos</th>
                    <th>Eficiência</th>
                    <th>Hashrate</th>
                </tr>
                <?php // codigo php que pega dados da api do pudimcoin

                    //pega dados da api e guarda na variavel $obj
                    ini_set("allow_url_fopen", 1);
                    $json = file_get_contents('http://[ip do servidor]/api/stats');//como o andré aninda não divulgou o ip do servidor, não posso vazar ele aqui
                    $obj = json_decode($json, true);

                    //usa um for para pegar todos endereços que estão minerando e as informações sobre eles
                    foreach($obj["pools"]["pudimcoin"]["workers"] as $key => $teste) {
                        echo "<tr>";

                        //verifica se tem algum endereço que possa colocar o nome da pessoa que esta minerando para ele
                        $arq = fopen('src/nomes.txt','r');
                        while(true){
                            $linha = fgets($arq);
                            $dado = explode(',', $linha);

                            // se acho o nome, ele coloca e depois para o while
                            if($key==$dado[0]){
                                echo "<th>",$dado[1],"</th>";
                                break;
                            }
                            //se não achou ele coloca como anonimo e para o while
                            if ($linha==null){
                                echo "<th>Anonimo</th>";
                                break;
                            }
                        }
                        fclose($arq);

                        //coloca o resto das informações como as shares, invalidshares e hashrate
                        echo "<th>",$key,"</th>";
                        echo "<th>",$teste["shares"],"</th>";
                        echo "<th>",$teste["invalidshares"],"</th>";
                        echo "<th>",intval(100-$teste["invalidshares"]*100/$teste["shares"]),"%</th>";
                        echo "<th>",$teste["hashrateString"],"</th>";
                        echo "</tr>";
                    }
                    
                ?>
            </table>
            <!-- roda pé da tabela explicando como colocar seu nome nela -->
            <p id="subtexto">Esta vendo seu endereço aqui e quer colocar seu nome ?, basta mandar um print comprovando que é seu endereço no discord: obertobr#4333</p>
        </div>
        
        <!-- roda pé da pagina -->
        <footer class="footer mt-auto py-3">
            <hr>
            <div class="container text-center">
                <span class="text-muted">Sou criador desse site magnifico, se você gostou do site e quer me ajudar, doe para minha carteira da pudimcoin(P9JzZAdjypcaD26DAKMnu4eeYhxNrvhzoi)</span>
                <span class="text-muted">Esse site é de codigo aberto, esta no github caso alguem quera aprender a usar a api do pudimcoin, tudo bem explicadinho até pra quem não sabe muito sobre programação de html</span>
            </div>
        </footer>
    </body>
</html>