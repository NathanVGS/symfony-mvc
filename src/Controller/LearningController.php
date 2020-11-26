<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;


class LearningController extends AbstractController
{
    /**
     * @Route("/learning", name="learning")
     */
    public function index() : Response
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'LearningController',
        ]);
    }
    /**
     * @Route("/about-becode", name="about-me")
     */
    public function aboutMe() : Response
    {
        $session = new Session();
        if(!$session->has('name'))
        {
        return $this->forward('App\Controller\LearningController::showMyName');
        }
        $name = $session->get('name');
        $date = new DateTime();
        return $this->render('about-me.html.twig', [
            'controller_name' => 'LearningController',
            'name' => $name,
            'date' => $date
        ]);
    }
    /**
     * @Route("/", name="showMyName")
     */
    public function showMyName(): Response
    {
        $session = new Session();
        $name = $session->get('name', 'Unknown');
        /*$name = "Unknown";
        if(!empty($_SESSION['name'])){
            $name = $_SESSION['name'];
        }*/
        return $this->render('showMyName.html.twig', [
            'controller_name' => 'LearningController',
            'name' => $name
        ]);
    }
    /**
     * @Route("/changeMyName", name="changeMyName")
     */
    public function changeMyName(): Response
    {
        $session = new Session();
        //$session->start(); cannot start session, already started in homepage

        // set and get session attributes
        $session->set('name', $_POST['new_name']);
        //$session->get('name');

        /*if(!isset($_SESSION['name'])){
            session_start();
        }
        $_SESSION['name'] = $_POST['new_name'];
        $name = $_SESSION['name'];*/
        return $this->redirectToRoute('showMyName');

        //return $this->render('changeMyName.html.twig', ['name' => $name]);
    }
}
