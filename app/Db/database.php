<?php
namespace App\Db;
//DEPENDENCIA DA CLASSA ~PDO
use \PDO;
//GERENCIAR AS EXCEÇÕES DO PDO
use PDOException;

class Database{
    /**
     * HOST da conexão com o banco de dados 
     */
    const HOST = 'localhost';
    
    /**
     * NAME do banco de dados criado
     */
    const NAME = 'dev_vagas';
    
    /**
    * USER usuário do banco de dados
    */
    const USER = 'root'; 
    
    /**
     * Senha do banco de dados que é em branco
     */
    const PASS = '';
    
    /**
      * Nome da tabela para ser manipulada
      * 
      */
    private $table; 
    
    /**
     * Instancia de conexão com o banco de dados
     * @var PDO
     */ 
    private $connection; 
    

    //PASSANDO A TABELA AO CONSTRUCT QUE SERÁ MANIPULADA ~PASSANDO COM VALOR NULL
    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }


    /**
     * Método responsável por criar uma conexão com o banco de dados
     */
    private function setConnection(){
        try{
            //Fazendo conexão chamando o connection e PDO recebe uma string de dados, tipo do banco, host, usuário e senha
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER, self::PASS);
            //Caso ocorra um erro no banco de dados travar o sistema recebendo parâmetros
            //Primeiro parâmetro é o atributo que iremos alterar e o segundo é o valor que o atributo vai receber
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('ERROR'.$e->getMessage());
        }
    }

    /**
      * Padronizando as query criando um método único
      * Método responsável por executar querys dentro do banco de dados
      */  
      public function execute($query, $params = []){ //Recebendo nos parâmetros os valores que são passados no $binds
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
           
        }catch(PDOException $e){
            die('ERROR'.$e->getMessage());
        }

     }

    /**
     * Método responsável por inserir dados no banco
     * @param array $values [ field => value ]
     * @return integer
     */
    public function insert($values){
        //DADOS DA QUERY ~Já traz todos os campos através do parâmetro values que foi definido no insert criado em vagas.php
        $campos = array_keys($values);
        
        /**Array_pad faz criar quantas posições forem necessárias
         *
         * [] -> criar array vazio;
         * count($campos)-> mesmo número de posições da variável;
         * '?'-> caso não tenha o número de posições, as posições novas vão ser interrogações(?)
         *  */   
        $binds  = array_pad([], count($campos), '?');

        //CRIANDO A QUERY
        //Query de insert comum ~implode concatena todos os dados dentro do array com o separador que é a vírgula
        $query = 'INSERT INTO '.$this->table.' ('.implode(',', $campos).') VALUES ('.implode(',', $binds).')';

        //Executa o INSERT
        $this->execute($query, array_values($values));

        //Retorna o ID inserido 
        return $this->connection->lastInsertId();
    }

    /**
     * Método responsável por executar uma CONSULTA no banco
     */
    public function select($where = null, $order = null, $limit = null, $campos = '*'){
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';
        //MONTANDO A QUERY
        $query = 'SELECT '.$campos.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        return $this->execute($query);
    }
    
    /**
     * Método responsável por atualizar o banco de dados
     */
    public function update($where, $values){
        //Dados da query 
        $campos = array_keys($values);

        //Montando a query
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$campos). '=? WHERE '.$where;

        //Executar a query
        $this->execute($query, array_values($values));
        return true;
    }
}