<?php
// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WildController extends AbstractController
{
    /**
     * @Route("/wild", name="wild_index")
     */
    public function index(): Response
    {
        return $this->render(
            'wild/index.html.twig', [
            'website' => 'Wild Séries',
        ]);
    }
//
//    /**
//     * @Route("/wild/show/{name}" name="wild_show")
//     */
//    public function show($slug): Response
//    {
//        return $this->render('wild/show.html.twig', ['seriename' => $slug]);
//    }
}