<?php

namespace App\Controller;

use App\Entity\PC;
use App\Form\PCformType;
use App\Repository\PCRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PCController extends AbstractController
{
    /**
 * @Route("/pc", name="pc")
 */


    public function PC(PCRepository $repo,Request $request, ObjectManager $manager, SessionInterface $session){

      $pc = new PC();
      $user=$this->getUser();
      $dataDpc = array();
      $dataPc = array();

      $form=$this->createForm(PCformType::class, $pc);

        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                
                $pc->setUser($user);
                $manager->persist($pc);
                $manager->flush();
                return $this->redirectToRoute('pc');

                
            }
        
        
        $pcarr[] = $repo->findBy(
          array('user' => $user),
          array('datepc' => 'ASC')
        );
      
        foreach ($pcarr as $key => $value) {
           
           foreach ($value as $val) {
               $dataPc[] = $val->getPC();
               $dataDpc[] = $val->getDatePc()->format('d-m-Y');
               
           }
        }
    
       $pcarray = implode(",", $dataPc);
       $datepc =implode("_", $dataDpc);
        
       return $this->render('userdata/PC.html.twig', [
          'formPC' => $form->createView(),
          'pc' =>$pcarray,
          'datepc' => $datepc 
      ]); 
    }
}
