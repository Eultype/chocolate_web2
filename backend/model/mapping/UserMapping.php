<?php

namespace model\mapping;


use model\AbstractMapping;
use InvalidArgumentException;
use Exception;

class UserMapping extends AbstractMapping
{
    // Propriétés correspondant aux colonnes de la table `users`
    protected ?int $users_id = null;
    protected ?string $user_name = null;
    protected ?string $user_mail = null;
    protected ?string $user_pwd = null;
    protected ?string $user_role = null;

    public function getUsersId(): ?int
    {
        return $this->users_id;
    }

    public function setUsersId(?int $users_id): void
    {
        if($users_id<=0) throw new Exception("users_id doit être un entier positif");
        $this->users_id = $users_id;
    }

    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    public function setUserName(?string $user_name): void
    {
        $user_name = strip_tags(trim($user_name));
        if(empty($user_name))
            throw new Exception("Login non valide");
        if(strlen($user_name)<3 || strlen($user_name)>45)
            throw new Exception("Le login doit faire entre 3 et 45 caractères");
        // Ne peut pas commencer par un chiffre, ni contenir des espaces ou des caractères spéciaux
        if(preg_match('/^[a-zA-Z][a-zA-Z0-9]{2,44}$/',$user_name)){
            $this->user_name = $user_name;
        }else{
            throw new Exception("Votre username doit faire de 3 à 45 caractères, commencer par une lettre et ne contenir que des lettres et des chiffres non accentués");
        }
    }

    public function getUserMail(): ?string
    {
        return $this->user_mail;
    }

    public function setUserMail(?string $user_mail): void
    {
        $user_mail = trim($user_mail);
        if(filter_var($user_mail,FILTER_VALIDATE_EMAIL)){
            $this->user_mail = $user_mail;
        }else{
            throw new Exception("Votre email n'est pas valide");
        }
    }

    public function getUserPwd(): ?string
    {
        return $this->user_pwd;
    }

    public function setUserPwd(string $user_pwd): void
    {
        $user_pwd = trim($user_pwd);
        $this->user_pwd = $user_pwd;
    }

    public function getUserRole(): ?string
    {
        return $this->user_role;
    }

    public function setUserRole(?string $user_role): void
    {
        $user_role = trim($user_role);
        $roles_autorises = ["admin","user"];
        if (!in_array($user_role , $roles_autorises, true)) {
            throw new InvalidArgumentException("Rôle utilisateur non reconnu.");
        }
        $this->user_role = $user_role;
    }
}
