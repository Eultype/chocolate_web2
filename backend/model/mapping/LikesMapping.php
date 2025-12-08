<?php
// LikesMapping.php
namespace model\mapping;

use model\AbstractMapping;
use Exception;

class LikesMapping extends AbstractMapping
{
    protected ?int $likes_id;
    protected ?int $users_users_id;
    protected ?int $recipes_recipes_id;
    protected ?int $like_cote;

    // Jointure
    protected ?UserMapping $user = null;
    protected ?RecipesMapping $recipe = null;

    public function getLikesId(): ?int
    {
        return $this->likes_id;
    }

    public function setLikesId(?int $likes_id): void
    {
        if ($likes_id <= 0) {
            throw new Exception("L'id doit être un entier positif");
        }
        $this->likes_id = $likes_id;
    }

    public function getUsersUsersId(): ?int
    {
        return $this->users_users_id;
    }

    public function setUsersUsersId(?int $users_users_id): void
    {
        $this->users_users_id = $users_users_id;
    }

    public function getRecipesRecipesId(): ?int
    {
        return $this->recipes_recipes_id;
    }

    public function setRecipesRecipesId(?int $recipes_recipes_id): void
    {
        $this->recipes_recipes_id = $recipes_recipes_id;
    }

    public function getLikeCote(): ?int
    {
        return $this->like_cote;
    }

    public function setLikeCote(?int $like_cote): void
    {
        if($like_cote < 1 || $like_cote > 5){
            throw new Exception("La note doit être comprise entre 1 et 5");
        }
        $this->like_cote = $like_cote;
    }

    public function getUser(): ?UserMapping
    {
        return $this->user;
    }

    public function setUser(?UserMapping $user): void
    {
        $this->user = $user;
    }

    public function getRecipe(): ?RecipesMapping
    {
        return $this->recipe;
    }

    public function setRecipe(?RecipesMapping $recipe): void
    {
        $this->recipe = $recipe;
    }
}
