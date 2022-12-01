<?php

    class Person{
        private $name;
        private $endereco;
        private $cep;
        private $dataNasc;
        private $telefone;


        public function __construct($name,$endereco, $cep, $dataNasc, $telefone)
        {
                $this->name = $name;
                $this->endereco = $endereco;
                $this-> cep = $cep;
                $this->dataNasc = $dataNasc;
                $this->telefone = $telefone;   
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of endereco
         */ 
        public function getEndereco()
        {
                return $this->endereco;
        }

        /**
         * Set the value of endereco
         *
         * @return  self
         */ 
        public function setEndereco($endereco)
        {
                $this->endereco = $endereco;

                return $this;
        }

        /**
         * Get the value of cep
         */ 
        public function getCep()
        {
                return $this->cep;
        }

        /**
         * Set the value of cep
         *
         * @return  self
         */ 
        public function setCep($cep)
        {
                $this->cep = $cep;

                return $this;
        }

        /**
         * Get the value of dataNasc
         */ 
        public function getDataNasc()
        {
                return $this->dataNasc;
        }

        /**
         * Set the value of dataNasc
         *
         * @return  self
         */ 
        public function setDataNasc($dataNasc)
        {
                $this->dataNasc = $dataNasc;

                return $this;
        }

        /**
         * Get the value of telefone
         */ 
        public function getTelefone()
        {
                return $this->telefone;
        }

        /**
         * Set the value of telefone
         *
         * @return  self
         */ 
        public function setTelefone($telefone)
        {
                $this->telefone = $telefone;

                return $this;
        }

        public function __toString()
        {
                return $this->name ." (".$this->endereco.", ".$this->cep.", ".$this->dataNasc.", ".$this->telefone.")";
        }

        /**
         * Função para criar novo registro
         */
        public function create(){
                $conteudoArquivo = file_get_contents("../data/person.json");
                $pessoa = json_decode($conteudoArquivo, true);
                $pessoa[] = array(
                        "name" => $this->name,
                        "endereco" => $this->endereco,
                        "cep" => $this->cep,
                        "dataNasc" => $this->dataNasc,
                        "telefone" => $this->telefone
                );
                $arquivo = fopen("../data/person.json","w");
                fwrite($arquivo, json_encode($pessoa));
                fclose($arquivo);
        }


        /**
         * Função para listar todos os registros
         *
         * @return void
         */
        public static function readAll(){
                $conteudoArquivo = file_get_contents("../data/person.json");   
                echo $conteudoArquivo;
        }

        /**
         * fnção para listar um registro
         */
        public static function read($id){
                $conteudoArquivo = file_get_contents("../data/person.json");   
                $pessoas = json_decode($conteudoArquivo, true);
                echo json_encode($pessoas[$id]);
        }

        /**
         * Função responsavel por alterar um registro
         *
         * @param [type] $id
         * @return void
         */
        public function update($id){
                $conteudoArquivo = file_get_contents("../data/person.json");   
                $pessoas = json_decode($conteudoArquivo, true);
                $pessoa = array(
                        'name'=> $this->name,
                        'endereco'=> $this->endereco,
                        'cep'=> $this->cep,
                        'dataNasc'=> $this->dataNasc,
                        'telefone'=> $this->telefone
                );
                $pessoas[$id] = $pessoa;
                $arquivo = fopen('../data/person.json', 'w');
                fwrite($arquivo, json_encode($pessoas));
                fclose($arquivo);
        }

        /**
         * Função para deletar um registro
         *
         * @param [type] $id
         * @return void
         */
        public static function delete($id){
                $conteudoArquivo = file_get_contents("../data/person.json");   
                $pessoas = json_decode($conteudoArquivo, true);
                array_splice($pessoas, $id,1);
                $arquivo = fopen('../data/person.json', 'w');
                fwrite($arquivo, json_encode($pessoas));
                fclose($arquivo);
        }
    }
