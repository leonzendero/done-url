<?php



class pdo_connect
{


    private $host;
    private $user;
    private $password;
    private $options;
    private $data_base;
    private $charset = "UTF8";
    public $PDO;


    public function __construct($host_copy,$user_copy,$password_copy,$db_copy)
    {

        $this->host = $host_copy;
        $this->user = $user_copy;
        $this->password = $password_copy;
        $this->data_base = $db_copy;
        $this->options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

    }


    public function connect_pdo()
    {



        $this->PDO = new PDO("mysql:host=$this->host;dbname=$this->data_base;charset=$this->charset" , $this->user , $this->password , $this->options);


    }


    public function close_connect_pdo()
    {

        $this->PDO = null;

    }

    public function getInfoPDO()
    {

        return $this->PDO;

    }

}


?>