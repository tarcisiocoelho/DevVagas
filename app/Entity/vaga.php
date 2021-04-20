<?php

namespace App\Entity;

use App\Db\Database;
use PDO;

class Vaga{
    
    public $id_vagas; 
    /**
    * Identificador único da vaga
    * @var integer
    */
    
    public $titulo;
    /**
    * Título da vaga
    * @var string
    */
    
    public $descricao;
    /**
    * Descrição da vaga
    * @var string
    * 
    */
    
     public $ativo;
    /**
    * Definir se a vaga está ativa
    * Passando como parametro que pode ser S ou N
    * @var string(s/n)
    */

    public $data;
    /**
     * Data da vaga
     * @var string
     */


     /**
      * Método responsável por excluir a vaga do banco
      */
      public function excluir(){
         return (new Database('vagas'))->delete('id_vagas = '.$this->id_vagas);
         
      }

      


     /**
      * Método responsável por cadastrar uma nova vaga no banco de dados
      * @var boolean
      */
     public function cadastrar(){
        //DEFINIR DATA // Ano, mês, dia, horas, minutos, segundos
        $this->data = date('Y-m-d H:i:s');
        //INSERIR VAGA NA TABELA
        $obDatabase = new Database('vagas');
        //Query para inserir na tabela os valores
        $this->id_vagas = $obDatabase->insert([ //ID da vaga vai ser o resultado do insert
         'titulo' => $this->titulo,
         'descricao' => $this->descricao,
         'ativo' => $this->ativo,
         'data' => $this->data
        ]);
         
        //RETORNAR SUCESSO
        return true;
     }

     /**
      * Método responsável por atualizar a vaga no banco
      */
     public function atualizar(){
      return (new Database('vagas'))->update('id_vagas = '.$this->id_vagas, [
         'titulo' => $this->titulo,
         'descricao' => $this->descricao,
         'ativo' => $this->ativo,
         'data' => $this->data
      ]);
     }
     


      /**
       * Método responsável por obter as vagas do banco de dados
       * @param string $where
       * @param string $order
       * @param string $limit
       * @return array   
       */
      public static function getVagas($where = null, $order = null, $limit = null){
         return (new Database('vagas'))->select($where, $order, $limit) ->fetchAll(PDO::FETCH_CLASS, self::class);
      }

      /**
       * Método responsável por buscar uma vaga com base em seu ID
       * @param integer $id
       * @return Vaga
       */
      public static function getVaga($id){
         return (new Database('vagas'))->select('id_vagas = '.$id)->fetchObject(self::class); //fetch unitário onde pega apenas uma posição
      }
}