<?php
// src/Controller/WildController.php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WildController
 * @package App\Controller
 * @Route("/wild", name="wild_")
 */
class WildController extends AbstractController


{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()->getRepository(Program::class)->findAll();
        if (!$programs)
        {
            throw $this->createNotFoundException('No program found in program\'s table');
        }

        return $this->render(
            'wild/index.html.twig', [
            'website' => 'Wild Séries',
            'programs' => $programs
        ]);
    }

    /**
     * @Route("/show/{slug<^[a-z-]+>}",  name="show")
     */
    public function show(?string $slug = ""): Response
    {
        if (!$slug)
        {
            throw $this
                ->createNotFoundException('Aucune série sélectionnée, veuillez choisir une série.');
        }
        $slug = str_replace('-', ' ', $slug);
        $slug = ucwords($slug);

        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);
        if (!$program)
        {
            throw $this->createNotFoundException(
                'Pas de série nommée ' . $slug . ' dans la base.'
            );
        }

        return $this->render(
            'wild/show.html.twig', [
            'slug' => $slug,
            'program' => $program,
            'slug' => $slug
        ]);
    }

    /**
     * @Route("/category/{categoryName<^[a-zA-Z-]+>}",  name="showByCategory")
     */
    public function showByCategory(?string $categoryName = "")
    {
        if (!$categoryName)
        {
            throw $this
                ->createNotFoundException('Aucune catégorie sélectionnée, veuillez choisir en choisir une.');
        }
        $categoryName = ucwords($categoryName);

        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => mb_strtolower($categoryName)]);


        $programs = $this->getDoctrine()->getRepository(Program::class)->findBy(['category' =>$category], ['id'=>'DESC'], 3);


        if (!$category)
        {
            throw $this->createNotFoundException(
                'Pas de catégorie nommée ' . $categoryName . ' dans la base.'
            );
        }

        return $this->render(
            'wild/category.html.twig', [
            'categories' => $category,
                'programs'=>$programs
        ]);
    }
}