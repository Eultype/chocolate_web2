<?php

namespace App\Mapping;

class Ingredients extends AbstractMapping
{
    /**
     * @var int
     */
    protected int $ingredients_id;

    /**
     * @var string
     */
    protected string $ingredient_name;

    /**
     * @var string
     */
    protected string $ingredient_slug;

    /**
     * Get the value of ingredients_id
     * @return int
     */
    public function getIngredientsId(): int
    {
        return $this->ingredients_id;
    }

    /**
     * Set the value of ingredients_id
     * @param int $ingredients_id
     * @return self
     */
    public function setIngredientsId(int $ingredients_id): self
    {
        $this->ingredients_id = $ingredients_id;
        return $this;
    }

    /**
     * Get the value of ingredient_name
     * @return string
     */
    public function getIngredientName(): string
    {
        return $this->ingredient_name;
    }

    /**
     * Set the value of ingredient_name
     * @param string $ingredient_name
     * @return self
     */
    public function setIngredientName(string $ingredient_name): self
    {
        $this->ingredient_name = $ingredient_name;
        return $this;
    }

    /**
     * Get the value of ingredient_slug
     * @return string
     */
    public function getIngredientSlug(): string
    {
        return $this->ingredient_slug;
    }

    /**
     * Set the value of ingredient_slug
     * @param string $ingredient_slug
     * @return self
     */
    public function setIngredientSlug(string $ingredient_slug): self
    {
        $this->ingredient_slug = $ingredient_slug;
        return $this;
    }
}
