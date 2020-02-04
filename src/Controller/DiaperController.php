<?php

namespace App\Controller;

use App\Entity\Diaper;
use App\Form\DiaperType;
use App\Repository\DiaperRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DiaperController extends AbstractController
{
    /**
    *@Route("/diaper" ,name="diaper")
    */

    public function diaper(DiaperRepository $repo,Request $request, ObjectManager $manager,  SessionInterface $session )
    {
       $diaper          = new Diaper();
       $form            = $this->createForm(DiaperType::class, $diaper);
       $user            = $this->getUser();
       $diaperamount    = $repo->findOneByUser($user);
       $dataD           = array();
       $dataA           = array();
      
       
          foreach ( $user->getDiaper()->toArray() as $key ) {
              
                   array_push($dataD, $key->getDatediaper()->format('d-m-Y'));
                   array_push($dataA, $key->getDiaperamount());

        }

       $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
               
                
                
                //checks the data layer quantity exists
                if ($dataD){
                            //retrieve the dates 
                            $dateDiaperstring       = implode(",", $dataD);
                            $search                 = $diaper->getDatediaper();
                            $searchformat           = $diaper->getDatediaper()->format('d-m-Y');
                            //explores the variable to test if a date already exists 
                            $dateDiaperSearch       = preg_match("/$searchformat/", $dateDiaperstring );
                         //if the date already exists have recovered the layer value and have the increment of 1    
                        if($dateDiaperSearch == 1){

                            $diaper = $repo->findOneBy([
                                'user' => $user,
                                'datediaper' => $search
                            ]);

                           
                            $diaper->setDiaperamount(($diaper->getDiaperamount() + 1));
                            $diaper->setUser($user);
                            $manager->persist($diaper);
                            $manager->flush();
                            return $this->redirectToRoute('diaper');


                        }
                        //if the date is not found we create it and have incremented the layer value by 1
                        else{
                             $diaper->setUser($user);
                             $diaper->setDiaperamount(1);
                             $manager->persist($diaper);
                             $manager->flush();
                             return $this->redirectToRoute('diaper');


                        }        
                 }
                else {
                        $diaper->setUser($user);
                        $diaper->setDiaperamount(1);
                        $manager->persist($diaper);
                        $manager->flush();
                        return $this->redirectToRoute('diaper');

                }
             }

        $data_Date   = array();
        $data_Diaper = array();    
        foreach ($user->getDiaper()->toArray() as $key) {
                    array_push($data_Date , $key->getdatediaper()->format('d-m-Y'));
                    array_push($data_Diaper, $key->getDiaperamount());

                       }
                 

         $diaper_string=implode(",",$data_Diaper);         
         $datediaper=implode("_", $data_Date);



        return $this->render('userdata/diaper.html.twig',[
            'formDiaper' => $form->createView(),
            'datediaper' =>$datediaper,
            'diaperamount' => $diaper_string,

        ]);
    }
}
