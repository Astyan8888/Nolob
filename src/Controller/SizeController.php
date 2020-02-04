<?php

namespace App\Controller;

use App\Entity\Size;
use App\Entity\Users;
use App\Form\SizeType;
use App\Repository\SizeRepository;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SizeController extends AbstractController
{
    /**
     * @Route("/size", name="size")
     */

    public function size(UsersRepository $repoUser, SizeRepository $repo,Request $request, ObjectManager $manager, SessionInterface $session){

      $size  = new Size();
      $user  = $this->getUser();

      //I get the user id of the session
     
      //retrieving the child's gender from the database
      $gender   = $repoUser->findOneById($user)->getGender();

    
    //instance my array variables,dataD =array date of weight , dataP = array weight value
      $dataD = array();
      $dataS = array();
     


      $form=$this->createForm(SizeType::class, $size);
        //
      $form->handleRequest($request);

      
      //get data weight adn date in db
        $weight[] = $repo->findBy(
            array('user' => $user),
            array('datesize' => 'ASC')

        );

        
       
        foreach ( $user->getSize()->toArray() as $key ) {

            array_push($dataD, $key->getDatesize());
            array_push($dataS, $key->getSize());
            
        }


        //array_walk($data , preg_match )
      
        $test = $form->getData()->getDatesize();
        
            // tested form
            if ($form->isSubmitted() && $form->isValid()) {
                
                
                $size->setUser($user);
                    
                //save in db
                $manager->persist($size);
                $manager->flush();
                return $this->redirectToRoute('size');

                
            }
               
        
            //gender-specific condition 
        if($gender = "1"){
            $genderdatamin = "47,50,54,57,59,62,63.5,65,66,67.5,68.5,69.5,71,76.5,82";
            $genderdatamax = "54,58,62,65,68,70,72,74,75,77,78,79.5,81,88,94";
        }
        else{
            $genderdatamin = "47,49.5,53.5,55,58,60,62,63,64.5,66,67,68,69,75,80.5";
            $genderdatamax = "54,57,60,63.5,66,68,70,72,73,76.5,78,79,86.5,93";

        }
       
       //transforms array data into a string
           $sizearray = implode(",", $dataS);
           $datesize =implode("_", $dataD);

          


           //render vues with prepared data
    return $this->render('userdata/size.html.twig', [
          'formSize'  => $form->createView(),
          'size'     => $sizearray,
          'datesize' => $datesize,  
          'gendermin'  => $genderdatamin,
          'gendermax'  => $genderdatamax,
        
      ]); 
    }
}
