<?php

require_once "src/dados/Conexao.php";

class Usuario
{
    private Int $id;
    private String $email;
    private String $nomeCompleto;
    private String $username;
    private String $senha;

    function __construct(String $email, String $username, String $nomeCompleto, String $senha)
    {
        $this->email = $email;
        $this->username = $username;
        $this->nomeCompleto = $nomeCompleto;
        $this->senha = $senha;
    }

    public function salvar()
    {
        try {
            $this->hashSenha();
            $email =  $this->getEmail();
            $senha = $this->getSenha();
            $username = $this->getUsername();
            $nomeCompleto = $this->getNomeCompleto();
            $stmt = Conexao::getConnection()->prepare('INSERT INTO usuarios (username, email, nome_completo, senha) VALUES (:username, :email, :nome_completo, :senha)');
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":senha", $senha);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":nome_completo", $nomeCompleto);
            $stmt->execute();
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    private function hashSenha()
    {
        $this->setSenha(password_hash($this->getSenha(), PASSWORD_DEFAULT));
    }

    public static function listarUsuarios()
    {
        try {
            $query = Conexao::getConnection()->query('SELECT * FROM usuarios');
            $list = $query->fetchAll(PDO::FETCH_ASSOC);
            $users = array_map(function ($e) {
                $user =  new Usuario($e['email'], $e['username'], $e['nome_completo'], $e['senha']);
                $user->setId($e['id']);
                return $user;
            }, $list);
            return $users;
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }
    public static function buscar(String $stringDeBusca)
    {
        try {
            $stmt = Conexao::getConnection()->prepare('SELECT * FROM usuarios WHERE email like :string_de_busca or username like :string_de_busca or nome_completo like :string_de_busca ');
            $stringDeBusca = '%' . $stringDeBusca . '%';
            $stmt->bindParam(":string_de_busca", $stringDeBusca);
            $fetchAll = $stmt->execute();
            $fetchAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fetchAll;
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    public static function logIn(String $email, String $senha)
    {
        try {
            $stmt = Conexao::getConnection()->prepare('SELECT * FROM usuarios WHERE email = :email');
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $user = sizeof($result) > 0 ? $result[0] : NULL;
            if (is_null($user)) {
                throw new Exception("User not found");
            }
            if (!password_verify($senha, $user['senha'])) {
                throw new Exception("Invalid password");
            }
            $return = new Usuario($user['email'], $user['username'], $user['nome_completo'], $user['senha']);
            $return->setId($user['id']);
            return $return;
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

    /**
     * Set the value of senha
     *
     * @return  String
     */
    public function setSenha(String $senha)
    {
        $this->senha = $senha;

        return $this;
    }
}
