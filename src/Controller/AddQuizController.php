<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\Quiz;
use App\Form\AddAnswersType;
use App\Form\AddQuestionType;
use App\Form\AddQuizType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddQuizController extends AbstractController
{
    /**
     * @Route("/add/quiz", name="add_quiz")
     */
    public function index(Request $request)
    {

        $quiz = new Quiz();

        $question = new Question();

        $answer1 = new Answer();
        $answer2 = new Answer();
        $answer3 = new Answer();

        $question->addAnswer($answer1);
        $question->addAnswer($answer2);
        $question->addAnswer($answer3);

        $quiz->addQuestion($question);

        $form = $this->createForm(AddQuizType::class, $quiz);
        $form->handleRequest($request);
//        $form = $this->createForm(AddQuiz Type::class, $quiz);
//        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $quiz->getQuiz();
            $em->persist($quiz);
            $em->flush();
        }

        return $this->render('add_quiz/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
