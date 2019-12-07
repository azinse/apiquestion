<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Entity\Question;
use App\Form\QuestionType;

/**
 * @Route("/api")
 */
class QuestionController extends FOSRestController {

    /**
     * * @Route("/questions", name="get_questions")
     */
    public function getQuestionsAction(Request $request): Response 
    {
        
        if ($request->isMethod('GET')) {
            
            return $this->getQuestions($request->query->get('lang') ?? 'en');
            
        } 
        
        elseif ($request->isMethod('POST')) {
            
            return $this->postQuestion($request);
            
        }
    }

    private function getQuestions($lang) 
    {

        $questions = $this->container->get('app.question.repository')->getQuestions($lang);
        if (!$questions) {
            throw new HttpException(400, "Invalid data");
        }
        
        $data = $this->get('serializer')->serialize($questions, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    private function postQuestion(Request $request): Response 
    {
        
        $data = $request->getContent();
        
        $question = $this->get('serializer')->deserialize($data, Question::class, 'json');
        $this->container->get('app.question.repository')->addQuestion($question);
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }

}
