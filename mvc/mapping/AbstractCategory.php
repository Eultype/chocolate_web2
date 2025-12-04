<?php

namespace model\mapping;

abstract class AbstractCategory
{
    /**
     * Définit la valeur de category_id
     * @param int $category_id
     * @return self
     */
    private $category_id;
    public function setCategoryId(int $category_id): self
    {
    
    }

    /**
     * Récupère la valeur de category_title
     * @return string
     */
    public function getCategoryTitle(): string
    {
        
    }

    /**
     * Définit la valeur de category_title
     * @param string $category_title
     * @return self
     */
    public function setCategoryTitle(string $category_title): self
    {
        
    }

    /**
     * Récupère la valeur de category_slug
     * @return string
     */
    public function getCategorySlug(): string
    {
        
    }

    /**
     * Définit la valeur de category_slug
     * @param string $category_slug
     * @return self
     */
    protected $category_slug;
    
    public function setCategorySlug(string $category_slug): self
    {
        
    }

    /**
     * Récupère la valeur de category_desc
     * @return string|null
     */
    public function getCategoryDesc(): ?string
    {
        
    }

    /**
     * Définit la valeur de category_desc
     * @param string|null $category_desc
     * @return self
     */
    public function setCategoryDesc(?string $category_desc): self
    {
        
    }
}