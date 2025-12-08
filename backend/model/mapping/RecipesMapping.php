<?php
// RecipesMapping.php

namespace model\mapping;

use model\AbstractMapping;
use Exception;
use model\mapping\UserMapping;

class RecipesMapping extends AbstractMapping
{
  // Propriétés correspondant aux colonnes de la table `recipes`
  protected ?int $recipes_id;
  protected ?string $recipe_title;
  protected ?string $recipe_slug;
  protected ?string $recipe_desc;
  protected ?string $recipe_img;
  protected ?int $recipe_cook_time;
  protected ?string $recipe_created_date;
  protected ?int $users_users_id = null;

  // Champs des jointures
  protected ?UserMapping $user = null;
  protected ?array $comments = null;
  protected ?array $likesInfo = null;

    public function getUsersUsersId(): ?int
    {
        return $this->users_users_id;
    }

  public function getRecipesId(): ?int
  {
    return $this->recipes_id;
  }
  
  public function getLikesInfo(): ?array
    {
        return $this->likesInfo;
    }

    public function setLikesInfo(?array $likesInfo): void
    {
        $this->likesInfo = $likesInfo;
    }


  public function setRecipesId(?int $recipes_id): void
  {
    // si l'id est négatif ou null, on lève une exception
    if ($recipes_id <= 0) {
      throw new Exception('L\'id doit être un entier positif');
    }
    $this->recipes_id = $recipes_id;
  }

  public function getRecipeTitle(): ?string
  {
    return $this->recipe_title;
  }

  public function setRecipeTitle(?string $recipe_title): void
  {
    $recipe_title = htmlspecialchars(strip_tags(trim($recipe_title)));
    if (strlen($recipe_title) < 5 || strlen($recipe_title) > 120) {
      throw new Exception(
        "Le titre doit être compris entre 5 et 120 caractères",
      );
    }
    $this->recipe_title = $recipe_title;
  }

  public function getRecipeSlug(): ?string
  {
    return $this->recipe_slug;
  }

  public function setRecipeSlug(?string $recipe_slug): void
  {
    $recipe_slug = htmlspecialchars(strip_tags(trim($recipe_slug)));
    if (strlen($recipe_slug) < 3 || strlen($recipe_slug) > 125) {
      throw new Exception(
        "Le slug doit être compris entre 3 et 125 caractères",
      );
    }

    $this->recipe_slug = $recipe_slug;
  }

  public function getRecipeDesc(): ?string
  {
    return $this->recipe_desc;
  }
  public function setRecipeDesc(?string $recipe_desc): void
  {
    $recipe_desc = htmlspecialchars(strip_tags(trim($recipe_desc)));
    if (strlen($recipe_desc) < 10) {
      throw new Exception("La description doit être de minim 10 caractères");
    }
    $this->recipe_desc = $recipe_desc;
  }

  public function getRecipeImg(): ?string
  {
    return $this->recipe_img;
  }

  public function setRecipeImg(?string $recipe_img): void
  {
    $this->recipe_img = $recipe_img;
  }

  public function getRecipeCookTime(): ?int
  {
    return $this->recipe_cook_time;
  }

  public function setRecipeCookTime(?int $recipe_cook_time): void
  {
    if (
      $recipe_cook_time < 0 ||
      $recipe_cook_time > 10000 ||
      $recipe_cook_time === null
    ) {
      throw new Exception(
        "Le temps de cuisson doit être positif et compris entre 0 et 10000 minutes",
      );
    }

    $this->recipe_cook_time = $recipe_cook_time;
  }

  public function getRecipeCreatedDate(): ?string
  {
    return $this->recipe_created_date;
  }

  public function setRecipeCreatedDate(?string $recipe_created_date): void
  {
    if ($recipe_created_date === null) {
      return;
    }
    $date = date("Y-m-d H:i:s", strtotime($recipe_created_date));
    if (!$date) {
      throw new Exception("La date est invalide");
    }
    $this->recipe_created_date = $date;
  }

    public function getUser(): ?UserMapping
    {
        return $this->user;
    }

    public function setUser(?UserMapping $user): void
    {
        $this->user = $user;
    }

    public function getComments(): ?array
    {
        return $this->comments;
    }

    public function setComments(?array $comments): void
    {
        $this->comments = $comments;
    }
}
