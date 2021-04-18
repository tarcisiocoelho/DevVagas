<?php

namespace App\Entity;

use App\Db\Database;

class Vaga{
    
    public $id; 
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

     public function cadastrar(){
        //DEFINIR DATA // Ano, mês, dia, horas, minutos, segundos
        $this->data = date('Y-m-d H:i:s');
        //INSERIR VAGA NA TABELA
        $obDatabase = new Database('vagas');
        //Query para inserir na tabela os valores
        $this->id = $obDatabase->insert([ //ID da vaga vai ser o resultado do insert
         'titulo' => $this->titulo,
         'descricao' => $this->descricao,
         'ativo' => $this->ativo,
         'data' => $this->data
        ]);
         
        //RETORNAR SUCESSO
        return true;
     }
     /**
      * Método responsável por cadastrar uma nova vaga no banco de dados
      * @var boolean
      */
}