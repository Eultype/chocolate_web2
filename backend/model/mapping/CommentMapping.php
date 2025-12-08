<?php

namespace model\mapping;

use model\AbstractMapping;
use Exception;

class CommentMapping extends AbstractMapping
{
    // Propriétés correspondant aux colonnes de la table `comments`
    protected ?int $comments_id = null;
    protected ?string $comment_sujet = null;
    protected ?string $comment_message = null;
    protected ?string $comment_created_date = null;
    protected ?int $comment_is_published = null;
    protected ?UserMapping $users = null;
    protected ?RecipesMapping $recipes = null;

    public function getCommentsId(): ?int
    {
        return $this->comments_id;
    }

    public function setCommentsId(?int $comments_id): void
    {
        if($comments_id<=0) throw new Exception("comments_id doit être un entier positif");
        $this->comments_id = $comments_id;
    }

    public function getCommentSujet(): ?string
    {
        return $this->comment_sujet;
    }

    public function setCommentSujet(?string $comment_sujet): void
    {
        if(is_null($comment_sujet)) return;

        $comment_sujet = htmlspecialchars(strip_tags(trim($comment_sujet)));
        if(strlen($comment_sujet) > 120)
            throw new Exception("Le sujet du commentaire doit être inférieur à 120 caractères");
        $this->comment_sujet = $comment_sujet;
    }

    public function getCommentMessage(): ?string
    {
        return html_entity_decode($this->comment_message);
    }

    public function setCommentMessage(?string $comment_message): void
    {
        $comment_message = htmlspecialchars(strip_tags(trim($comment_message)));
        if(empty($comment_message))
            throw new Exception("Le message du commentaire ne doit pas être vide !");
        if(strlen($comment_message) < 3 || strlen($comment_message) > 500)
            throw new Exception("Le message du commentaire doit être compris entre 3 et 500 caractères");
        $this->comment_message = $comment_message;
    }

    public function getCommentCreatedDate(): ?string
    {
        return $this->comment_created_date;
    }

    public function setCommentCreatedDate(?string $comment_created_date): void
    {
        if(is_null($comment_created_date)) return;
        $comment_created_date = date('Y-m-d H:i:s', strtotime($comment_created_date));
        $this->comment_created_date = $comment_created_date;
    }

    public function getCommentIsPublished(): ?int
    {
        return $this->comment_is_published;
    }

    public function setCommentIsPublished(?int $comment_is_published): void
    {
        $this->comment_is_published = $comment_is_published;
    }

    public function getUsers(): ?UserMapping
    {
        return $this->users;
    }

    public function setUsers(?UserMapping $users): void
    {
        $this->users = $users;
    }

    public function getRecipes(): ?RecipesMapping
    {
        return $this->recipes;
    }

    public function setRecipes(?RecipesMapping $recipes): void
    {
        $this->recipes = $recipes;
    }
}