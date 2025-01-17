<?php
// src/Controller/QuizAdminController.php
namespace App\Controller;

use App\Entity\Question;
use App\Entity\Answer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizAdminController extends AbstractController
{
    #[Route('/admin/quiz/new', name: 'admin_quiz_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $questionText = $request->request->get('question');
            $answers = $request->request->all('answers', []);

            if ($questionText && count($answers) > 0) {
                // Create a new Question entity
                $question = new Question();
                $question->setText($questionText);

                /*  // Create Answer entities and associate them with the question
                foreach ($answers as $answerText) {
                    $answer = new Answer();
                    $answer->setText($answerText);
                    $answer->setQuestion($question);
                    $entityManager->persist($answer);
                } */
                foreach ($answers as $answerData) {
                    $answer = new Answer();
                    $answer->setText($answerData['text']);
                    $answer->setCorrectAnswer(isset($answerData['correct']) ? true : false);
                    $answer->setQuestion($question);
                    $entityManager->persist($answer);
                }
                // Persist the question along with its answers
                $entityManager->persist($question);
                $entityManager->flush();

                $this->addFlash('success', 'Question and answers added successfully!');
                return $this->redirectToRoute('admin_quiz_new');
            }

            $this->addFlash('error', 'Please provide a question and at least one answer.');
        }

        return $this->render('quiz/admin/new.html.twig');
    }
}
