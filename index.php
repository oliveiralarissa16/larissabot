<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <?php
        
        $token = file_get_contents("token.txt");
        
        $website = "https://api.telegram.org/bot".$token."/getUpdates";
        $url = file_get_contents($website);

        $x = json_decode($url, true);
        $xLen = count($x['result']);
        $ids = array();

        for ($i = 0; $i < $xLen; $i++) {
            $id = $x["result"][$i]['message']['chat']['id'];

            $ids[$i] = $id;
        }
        ?>

    </body>
</html>

