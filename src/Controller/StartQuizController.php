<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Quiz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StartQuizController extends AbstractController
{
    /**
     * @Route("/start/quiz/{id}", name="start_quiz")
     */

    public function index($id)
    {
        $em = $this->getDoctrine()->getManager();

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $quiz = $em->getRepository(Quiz::class)->find($id);


        return $this->render('start_quiz/new.html.twig', [
            'controller_name' => 'StartQuizController',
            'quiz' => $quiz,
        ]);
    }
}
