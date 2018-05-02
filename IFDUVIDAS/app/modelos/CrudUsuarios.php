<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 27/04/18
 * Time: 13:23
 */

require_once "Usuario.php";
require_once "BDConection.php";

class CrudUsuarios
{
    public function __construct()
    {
        $this->conexao = BDConection::getConexao();
    }

    public function getUsuarios(){

        $sql = "select * from Usuarios order by nome ";
        $resultado = $this->conexao->query($sql);
        $listaUsuarios = [];

        $usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($usuarios as $usuario){
            $objeto = new Usuario($usuario['Nome'], $usuario['senha'], $usuario['email'], $usuario['num_matricula'],$usuario['data_nasc'], $usuario['turma'], $usuario['RG'],
                                  $usuario['foto_perf'], $usuario['login'], $usuario['id_usuario'], $usuario['valido'], $usuario['cod_tip']);

            $listaUsuarios[] = $objeto;
        }
        return $listaUsuarios;
    }

    public function insertUsuario(Usuario $usuario){

        $consulta = "INSERT INTO Usuarios (Nome, senha, email, num_matricula, data_nasc, turma, RG, foto_perf, login, id_usuario, valido, cod_tip) VALUES ('{$usuario->getNome()}', '{$usuario->getSenha()}', 
                                                  '{$usuario->getEmail()}', '{$usuario->getNumMatricula()}', '{$usuario->getDataNasc()}', '{$usuario->getTurma()}', '{$usuario->getRG()}', '{$usuario->getFotoPerf()}',
                                                   '{$usuario->getLogin()}', '{$usuario->getIdUsuario()}',
                                                  '{$usuario->getValido()}', '{$usuario->getCodTip()}')";
        //echo $consulta;
        try{
            $res = $this->conexao->exec($consulta);
            //return $res;
        }catch (PDOException $erro){
            return $erro->getMessage();
        }

    }

    public function getUsuario($id){

        $sql      = "SELECT * FROM Usuarios WHERE id_usuario = $id";
        $resultado = $this->conexao->query($sql);
        $usuario  = $resultado->fetch(PDO::FETCH_ASSOC);
        $objeto = new Usuario($usuario['Nome'], $usuario['senha'], $usuario['email'], $usuario['num_matricula'],$usuario['data_nasc'], $usuario['turma'], $usuario['RG'],
            $usuario['foto_perf'], $usuario['login'], $usuario['id_usuario'], $usuario['valido'], $usuario['cod_tip'];

        return $objeto;
    }

    public function updateUsuario(Usuario $usuario){

        $consulta = "UPDATE Usuarios SET nome = '{$usuario->getNome()}', senha = '{$usuario->getSenha()}', email = '{$usuario->getEmail()}', num_matricula = '{$usuario->getNumMatricula()}' , data_nasc = '{$usuario->getDataNasc()}', turma = '{$usuario->getTurma()}', RG = '{$usuario->getRG()}', foto_perf = '{$usuario->getFotoPerf()}', 
                                        login = '{$usuario->getLogin()}', id_usuario = '{$usuario->getIdUsuario()}', valido = '{$usuario->getValido()}', cod_tip = '{$usuario->getCodTip()}'
 WHERE id={$usuario->getId()}";

        echo $consulta;
        try{
            $res = $this->conexao->exec($consulta);
            //return $res;
        }catch (PDOException $erro){
            return $erro->getMessage();
        }
    }

    public function deleteUsuario($id){

        $consulta = "DELETE FROM Usuarios WHERE id_usuario = {$id}";
        echo $consulta;
        try{
            $res = $this->conexao->exec($consulta);
            //return $res;
        }catch (PDOException $erro){
            return $erro->getMessage();
        }
    }

    public function login($login, $senha){
        $sql      = "SELECT * FROM Usuarios WHERE login = '$login' and senha='$senha' ";
        $resultado = $this->conexao->query($sql);
        if($resultado->rowCount() > 0) {
            $usuario = $resultado->fetch(PDO::FETCH_ASSOC);
            $objeto = new Usuario($usuario['Nome'], $usuario['senha'], $usuario['email'], $usuario['num_matricula'],$usuario['data_nasc'], $usuario['turma'], $usuario['RG'],
                $usuario['foto_perf'], $usuario['login'], $usuario['id_usuario'], $usuario['valido'], $usuario['cod_tip'];);
            return $objeto;
        }else{
            return false;
        }

    }
