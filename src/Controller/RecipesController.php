<?php


namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

class RecipesController extends AbstractController
{
    /**
     * @Route("/recipe/add", name="add_new_recipe", methods={"POST"})
     */

    public function addRecipe(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);

        $newRecipe = new Recipe();
        $newRecipe->setName($data["name"]);
        $newRecipe->setTime($data["time"]);
        $newRecipe->setDifficulty($data["difficulty"]);
        $newRecipe->setPortions($data["portions"]);
        $newRecipe->setIngredients($data["ingredients"]);
        $newRecipe->setInstructions($data["instructions"]);
        //$newRecipe->setImage($data["image"]);


        $entityManager->persist($newRecipe);

        $entityManager->flush();

        return new Response('trying to add new recipe...' . $newRecipe->getId());
    }

    /**
     * @Route("/recipe/all", name="get_all_recipe", methods={"GET"})
     */

    public function getAllRecipe()
    {
        $recipes = $this->getDoctrine()->getRepository(Recipe::class)->findAll();

        $response = [];

        foreach ($recipes as $recipe) {
            $response[] = array(
                'id' => $recipe->getId(),
                'name' => $recipe->getName(),
                'time' => $recipe->getTime(),
                'difficulty' => $recipe->getDifficulty(),
                'portions' => $recipe->getPortions(),
                'ingredients' => $recipe->getIngredients(),
                'instructions' => $recipe->getInstructions(),
             //   'image' => $recipe->getImage()
            );
        }
        return $this->json($response);
    }
    /**
     * @Route("/recipe/find/{id}", name="find_a_recipe")
     */

    public function findRecipe($id) {
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        if(!$recipe) {
            throw $this->createNotFoundException(
                'No recipe was found with the id: ' . $id
            );
        } else {
            return $this->json([
                'id' => $recipe->getId(),
                'name' => $recipe->getName(),
                'time' => $recipe->getTime(),
                'difficulty' => $recipe->getDifficulty(),
                'portions' => $recipe->getPortions(),
                'ingredients'=> $recipe->getIngredients(),
                'instructions'=>$recipe->getInstructions(),
             //   'image'=>$recipe->getImage()
            ]);
        }
    }

    /**
     * @Route("/recipe/edit/{id}/{name}", name="edit_a_recipe")
     */
    public function editRecipe($id, $name) {
        $entityManager = $this->getDoctrine()->getManager();
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        if(!$recipe) {
            throw $this->createNotFoundException(
                'No recipe was found with the id: ' . $id
            );
        }else {
            $recipe->setName($name);
            $entityManager->flush();

            return $this->json([
                'message' => 'Edited a recipe with id:' . $id
            ]);
        }
    }

    /**
     * @Route("/recipe/remove/{id}", name="remove_a_recipe")
     */
    public function removeRecipe($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        if (!$recipe) {
            throw $this->createNotFoundException(
                'No recipe was found with the id: ' . $id
            );
        } else {
            $entityManager->remove($recipe);
            $entityManager->flush();

            return $this->json([
                'message' => 'Removed the recipe with id ' . $id
            ]);
        }
    }
}

