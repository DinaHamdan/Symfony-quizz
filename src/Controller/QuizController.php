<?php

// src/Controller/QuizController.php
namespace App\Controller;

use App\Entity\Question;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    private $entityManager;

    // Inject the EntityManagerInterface in the constructor
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/quizz', name: 'quizz')]
    public function quiz(): Response
    {
        // Use the injected entity manager to fetch all questions from the database
        $questions = $this->entityManager->getRepository(Question::class)->findAll();

        // Render the Twig template and pass the questions to it
        return $this->render('quiz/index.html.twig', [
            'questions' => $questions,
        ]);
    }
}

///////////
