<?php

namespace App\Controller;

use App\Entity\Bath;
use App\Form\BathType;
use App\Repository\BathRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BathController extends AbstractController
{
    /**
      * @Route("/bath", name="bath")
      */

      public function  bath(BathRepository $repo,Request $request, ObjectManager $manager,  SessionInterface $session )
      {

        $bath= new Bath();       
        $form = $this->createForm(BathType::class, $bath);
        $form->handleRequest($request);
        $user=$this->getUser();
        $datebath= array();
        

       
        foreach ( $user->getBath()->toArray() as $date ) {
              
            array_push($datebath, $date->getDatebath()->format('d-m-Y'));
                   
        };
        $date=$bath->getDatebath();

        if ($form->isSubmitted() && $form->isValid()) {

          if($datebath) {
                $search = $bath->getDatebath();
                
                $bath = $repo->findOneBy([ 'user' => $user ]);
                $bath_form=$form->getData()->getDatebath()->format('Y-m-d');
                $bath->setDatebath(\DateTime::createFromFormat('Y-m-d',$bath_form));
                $bath->setUser($user);
                $manager->persist($bath);
                $manager->flush();

           }
           else{
              $bath->setUser($user);
              $manager->persist($bath);
              $manager->flush();
           }      
        }

        $bath= $repo->findOneBy(['user' => $user]);
                  

        return $this->render('userdata/bath.html.twig',[
            'formBath' => $form->createView(),
            'bath'=>$bath
        ]);

      }
}
