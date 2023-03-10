<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type, authorization");

    class Config {
        protected $localhost = "localhost";
        protected $username ="root";
        protected $dbName = "e-learning";
        protected $password = "";
        public $connectDb = "";
        public $res = [];

        public function __construct (){
            $this->connectDb = new mysqli($this->localhost, $this->username, $this->password, $this->dbName);
            if($this->connectDb->connect_error){
                die("unable to connect". $this->connectDb->connect_error);
            }
        }

        // public function insert($query, $binder) {
        //     $statement = $this->connectDb->prepare($query);
        //     $statement->bind_param(...$binder);
        //     if ($statement->execute()) {
        //         $this->res['id'] = $this->connectDb->insert_id;
        //         $this->res['true'] = true;
        //        return $this->res;
        //     } else {
        //         return false;
        //     }
        // }


        public function create ($query, $binder) {
            // $stmt = $this->con->prepare($query);
            $statement= $this->connectDb->prepare($query);
            $statement->bind_param(...$binder);
            if($statement->execute()){
                $this->res['id'] = $this->connectDb->insert_id;
                $this->res['success'] = true;
                return $this->res;
            }else{
                $this->res['success'] = false;
            }
        }

        public function read ($query, $binder) {
            $statement = $this->connectDb->prepare($query);
            if($binder){
                $statement->bind_param(...$binder);
            }
            if ($statement->execute()) {
               $fetch = $statement->get_result();
               $this->res['true'] = true;
               $this->res['fetched'] = $fetch;
               return $this->res;
            } else {
               return false;
            }  
        }

        public function readAll($query) {
            $statement = $this->connectDb->prepare($query);
            if ($statement->execute()) {
                $fetch = $statement->get_result();
                $this->res['true'] = true;
                $this->res['fetched'] = $fetch;
                return $this->res;
            } else {
               return false;
            }   
        }

        public function update () {

        }

        public function delete () {

        }
    }

?>