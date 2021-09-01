<?php

namespace App\Entity;

use cymApp\Repository\RecipesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipesRepository::class)
 */
class Recipes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $time;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $difficulty;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $portions;

    /**
     * @ORM\Column(type="array")
     */
    private $ingredients = [];

    /**
     * @ORM\Column(type="array")
     */
    private $instructions = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getPortions(): ?string
    {
        return $this->portions;
    }

    public function setPortions(string $portions): self
    {
        $this->portions = $portions;

        return $this;
    }

    public function getIngredients(): ?array
    {
        return $this->ingredients;
    }

    public function setIngredients(array $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getInstructions(): ?array
    {
        return $this->instructions;
    }

    public function setInstructions(array $instructions): self
    {
        $this->instructions = $instructions;

        return $this;
    }
}
