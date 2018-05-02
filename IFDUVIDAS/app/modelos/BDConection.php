<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 02/05/18
 * Time: 14:45
 */

class BDConection
{
    const HOST      = "localhost";
    const NOMEBANCO = "IFDUVIDAS";
    const USUARIO   = "IFDUVIDAS";
    const SENHA     = "IFDUVIDAS";

    public static function getConexao(){
        $conexao = new PDO("mysql:host=".self::HOST.";dbname=".self::IFDUVIDAS, self::IFDUVIDAS, self::IFDUVIDAS);

        return $conexao;
    }

}