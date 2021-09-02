<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipesController extends AbstractController
{
    /**
     * @Route ("/recipe/add" , name="add_recipe")
     */
    public function addRecipe(){

        return new Response('trying to add');

    }
}
