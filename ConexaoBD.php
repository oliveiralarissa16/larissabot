<?php
class ConexaoBD {
    public static function conectarbanco(){
        $conexao = new PDO("mysql:host=localhost;dbname=bot_telegram","root","");
        return $conexao;
        
    }
    private static function verificarComando($texto) {

        $verificarComando = "SELECT idComando FROM comando WHERE texto = ?";

        $idComando = "";
        try {
            $rs = self::conectarbanco()->prepare($verificarComando);
            $rs->bindParam(1, $texto);
            $rs->execute();

            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                $idComando = $row->idComando;
            }

            return $idComando;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
     public function inserirdados($updateid,$comando,$resposta){
         $sql = "insert into tbbotresponse(update_id,comando,resposta) values (?,?,?)";
         
         $id_comando = self::verificarComando($comando);
        
         $prepararcomando = self::conectarbanco()->prepare($sql);
         $prepararcomando->bindParam(1, $updateid);
         $prepararcomando->bindParam(2, $id_comando);
         $prepararcomando->bindParam(3, $resposta);
         
         $prepararcomando->execute();
    }
}

