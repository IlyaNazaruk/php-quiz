<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\Quiz;
use App\Form\AddQuestionType;
use App\Form\AddQuizType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddQuestionController extends AbstractController
{
    /**
     * @Route("/add/question/{id}", name="add_question")
     */
    public function index($id, Request $request)
    {
        $quiz = $this->getDoctrine()->getRepository(Quiz::class)->find($id);

        $question = new Question();

        $answer1 = new Answer();
        $answer2 = new Answer();
        $answer3 = new Answer();

        $question->addAnswer($answer1);
        $question->addAnswer($answer2);
        $question->addAnswer($answer3);

        $quiz->addQuestion($question);

        $form = $this->createForm(AddQuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();
        }


        return $this->render('add_question/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
