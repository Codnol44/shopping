<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route(path="/home", name="main_home", methods={"GET"})
     */
    public function home()
    {
        return $this->render('main/home.html.twig');
    }

    /**
     * @Route(path="/contact", name="main_contact", methods={"GET"})
     */
    public function contact()
    {
        return $this->render('main/contact.html.twig');
    }

}