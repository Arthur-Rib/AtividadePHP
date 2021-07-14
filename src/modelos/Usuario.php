<?php

class Usuario
{
    private Int $id;
    private String $email;
    private String $nomeCompleto;
    private String $username;
    private String $senha;

    function __construct(Int $id, String $email, String $username, String $nomeCompleto, String $senha)
    {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->nomeCompleto = $nomeCompleto;
        $this->senha = $senha;
    }

    public function salvar(){
        $stmt = $this->conn->prepare('INSERT INTO users (username, senha, nome_completo, email) VALUES (:username, :senha, :nome_completo, :email)');
        $stmt->bindParam(":email", $this->getEmail());
        $stmt->bindParam(":senha", $this->getSenha());
        $stmt->bindParam(":username", $this->getUsername());
        $stmt->bindParam(":nome_completo", $this->getNomeCompleto());
        $stmt->execute();
    }

    private function hashSenha(){
        password_hash($this->getSenha(), PASSWORD_DEFAULT);
    }

    public static function listarUsuarios(){
        $query = $this->conn->query('SELECT * FROM users');
        $list = $query->fetchAll(PDO::FETCH_ASSOC);
        $users = array_map(function ($e) {
            return new User($e['id'], $e['email'], $e['username'], $e['fullname'], $e['password']);
        }, $list);
        return $users;
    }

    public static function logIn(String $email, String $senha){
        try {
            $fetch = $this->userRepository->findByEmal($email);
            if (is_null($fetch)) {
                throw new Exception("User not found");
            }
            if (!password_verify($password, $fetch['password'])) {
                throw new Exception("Invalid password");
            }
            $user = new User($fetch['id'], $fetch['email'], $fetch['username'], $fetch['fullname']);
            return $user;
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    /**
     * Get the value of nomeCompleto
     *
     * @return  String
     */
    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }

    /**
     * Set the value of nomeCompleto
     *
     * @param  String  $nomeCompleto
     *
     * @return  self
     */
    public function setNomeCompleto(String $nomeCompleto)
    {
        $this->nomeCompleto = $nomeCompleto;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return  Int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  Int  $id
     *
     * @return  self
     */
    public function setId(Int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of username
     *
     * @return  String
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param  String  $username
     *
     * @return  self
     */
    public function setUsername(String $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  String
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  String  $email
     *
     * @return  self
     */
    public function setEmail(String $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of senha
     *
     * @return  String
     */
    public function getSenha()
    {
        return $this->senha;
    }
}
