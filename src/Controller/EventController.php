<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventformType;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class EventController extends AbstractController
{
   /**
     * @Route("/event", name="event")
     */

    public function event(EventRepository $repo,Request $request, ObjectManager $manager, SessionInterface $session){

      $event = new Event();
      $user= $this->getUser();

      $form=$this->createForm(EventformType::class, $event);

        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                
               if ($file = $event->getPict()){
                   $file = $event->getPict();
                   $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                   
                   try {
                       $file->move(
                           $this->getParameter('picture'),
                           $fileName
                       );
                   } catch (FileException $e) {
                      $error="Erreur dans le chargement de l\'image";
                }
              $event->setPict($fileName);

            }
                    $datetime = date("Y-m-d H:i:s");
                    $event->setUser($user);
                    $event->setDatecreate(new \DateTime());
                    $manager->persist($event);
                    $manager->flush();
                    
            }
        
        
        $event = $repo->findBy(
          array('user' => $user)
        );
              
        return $this->render('userdata/event.html.twig', [
          'formEvent' => $form->createView(),
          'event' => $event

      ]); 
    }

     /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        
        return md5(uniqid());
    }
   
}
