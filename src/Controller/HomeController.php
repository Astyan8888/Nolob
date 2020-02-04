<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/contacte", name="contacte")
     */
    public function contact()
    {
        return $this->render('home/contacte.html.twig');
    }
    /**
     * @Route("/Conditions-Gererales", name="CG")
     */
    public function CG()
    {
        return $this->render('home/condition.html.twig');
    }
}
