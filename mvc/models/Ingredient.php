<?php

require_once 'AbstractModel.php';

class Ingredient extends AbstractModel {
    private string $name;
    private string $unit;

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Ingredient
     */
    public function setName(string $name): Ingredient {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnit(): string {
        return $this->unit;
    }

    /**
     * @param string $unit
     * @return Ingredient
     */
    public function setUnit(string $unit): Ingredient {
        $this->unit = $unit;
        return $this;
    }
}
