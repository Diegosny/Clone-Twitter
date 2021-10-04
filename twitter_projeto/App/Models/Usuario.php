<?php

namespace App\Models;

use MF\Model\Model;

class Usuario extends Model
{
    protected array $fillable = [
        'id',
        'nome',
        'email',
        'senha'
    ];

    /**
     * @return string[]
     */
    public function getCampos(): array
    {
        return $this->fillable;
    }

    /**
     * @param array|string[] $fillable
     */
    public function setCampos(array $fillable): void
    {
        $this->fillable = $fillable;
    }

    public function salvaDados(): Usuario
    {
        $query = "INSERT INTO usuarios(nome, email, senha) values (:nome, :email, :senha)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->getCampos()['nome']);
        $stmt->bindValue(':email', $this->getCampos()['email']);
        $stmt->bindValue(':senha', $this->getCampos()['senha']);
        $stmt->execute();

        return $this;
    }

    public function validaFormulario(array $dados): bool
    {            
       if(
            empty($dados['nome']) ||
            empty($dados['email']) ||
            empty($dados['senha'])
        ) {
            return false;
        }

        return true;
    }

    public function verificaEmail(string $email): bool
    {
        $query = "SELECT * FROM usuarios where email = :email ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if(count($row) > 0) {
            return true;
        }
        return false;
    }
}
