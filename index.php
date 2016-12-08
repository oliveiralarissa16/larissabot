<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <?php
        include './ConexaoBD.php';
        
        $banco = new ConexaoBD();

        $token = file_get_contents("token.txt");
        $file = 'updateId.txt';

        $website = "https://api.telegram.org/bot" . $token . "/getUpdates";
        $url = file_get_contents($website);

        $x = json_decode($url, true);
        $xLen = count($x['result']);


            for ($i = 0; $i < $xLen; $i++) {
            $id = $x["result"][$i]['message']['chat']['id'];
            $updateId = $x["result"][$i]['update_id'];
            
            if(isset ($x["result"][$i]['message']['text'])){
                $message = $x["result"][$i]['message']['text'];

            if ($message == "/megaSena") {
                $str = file_get_contents($file);

                $arrUpdateId = explode(',', $str);
                if (!in_array($updateId, $arrUpdateId)) {
                    # Gera os 6 números
                    for ($i = 1; $i <= 6; $i++) {
                        $n[] = str_pad(rand(1, 60), 2, '0', STR_PAD_LEFT);
                    }

                    # Ordena os números
                    sort($n);

                    # Exibe os números
                    $numerosmega = implode(' - ', $n);

                    $texto = urlencode($numerosmega);

                    $urlenviar = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . $texto;
                    file_get_contents($urlenviar);
                    file_put_contents($file, $updateId . ',', FILE_APPEND | LOCK_EX);
                
                    $banco->inserirdados($updateId, $message, $texto);
                    }
            }
        }
         elseif (isset($x["result"][$i]['message']['photo'])){
            echo 'foto recebida';
         }
                
        }
        
        ?>

    </body>
</html>
