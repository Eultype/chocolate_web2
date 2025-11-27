<?php
// Recipes.php

namespace model\mapping;

use model\AbstractMapping;
use Exception;

class Recipes extends AbstractMapping
{
  // Propriétés correspondant aux colonnes de la table `Recipes`
  protected ?int $recipes_id;
  protected ?string $recipes_title;
  protected ?string $recipes_slug;
  protected ?string $recipes_desc;
  protected ?string $recipes_img;
  protected ?int $recipes_cook_time;
  protected ?string $recipes_created_date;

  public function getRecipesId(): ?int
  {
    return $this->recipes_id;
  }

  public function setRecipesId(?int $recipes_id): void
  {
    // si l'id est negatif ou nul, on lève une exception
    if ($recipes_id <= 0) {
      throw new Exception('L\'id doit être un entier positif');
    }
    $this->recipes_id = $recipes_id;
  }

  public function getRecipesTitle(): ?string
  {
    return $this->recipes_title;
  }

  public function setRecipesTitle(?string $recipes_title): void
  {
    $recipes_title = htmlspecialchars(strip_tags(trim($recipes_title)));
    if (strlen($recipes_title) < 5 || strlen($recipes_title) > 120) {
      throw new Exception(
        "Le titre doit être compris entre 5 et 120 caractères",
      );
    }
    $this->recipes_title = $recipes_title;
  }

  public function getRecipesSlug(): ?string
  {
    return $this->recipes_slug;
  }

  public function setRecipesSlug(?string $recipes_slug): void
  {
    $recipes_slug = htmlspecialchars(strip_tags(trim($recipes_slug)));
    if (strlen($recipes_slug) < 3 || strlen($recipes_slug) > 125) {
      throw new Exception(
        "Le slug doit être compris entre 3 et 125 caractères",
      );
    }

    $this->recipes_slug = $recipes_slug;
  }

  public function getRecipesDesc(): ?string
  {
    return $this->recipes_desc;
  }
  public function setRecipesDesc(?string $recipes_desc): void
  {
    $recipes_desc = htmlspecialchars(strip_tags(trim($recipes_desc)));
    if (strlen($recipes_desc) < 10) {
      throw new Exception("La description doit être de minim 10 caractères");
    }
    $this->recipes_desc = $recipes_desc;
  }

  public function getRecipesImg(): ?string
  {
    return $this->recipes_img;
  }

  public function setRecipesImg(?string $recipes_img): void
  {
    $this->recipes_img = $recipes_img;
  }

  public function getRecipesCookTime(): ?int
  {
    return $this->recipes_img;
  }

  public function setRecipesCookTime(?int $recipes_cook_time): void
  {
    if (
      $recipes_cook_time < 0 ||
      $recipes_cook_time > 10000 ||
      $recipes_cook_time === null
    ) {
      throw new Exception(
        "Le temps de cuisson doit être positif et compris entre 0 et 10000 minutes",
      );
    }

    $this->recipes_cook_time = $recipes_cook_time;
  }

  public function getRecipesCreatedDate(): ?string
  {
    return $this->recipes_created_date;
  }

  public function setRecipesCreatedDate(?string $recipes_created_date): void
  {
    if ($recipes_created_date === null) {
      return;
    }
    $date = date("Y-m-d H:i:s", strtotime($recipes_created_date));
    if (!$date) {
      throw new Exception("La date est invalide");
    }
    $this->recipes_created_date = $date;
  }
}
