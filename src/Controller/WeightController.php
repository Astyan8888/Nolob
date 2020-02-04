<?php

namespace App\Controller;

use App\Entity\Poids;
use App\Entity\Users;
use App\Form\WeightformType;
use App\Repository\PoidsRepository;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WeightController extends AbstractController
{
    /**
     * @Route("/poids", name="poids")
     */

    public function poids(UsersRepository $repoUser, PoidsRepository $repo,Request $request, ObjectManager $manager, SessionInterface $session){

        $poid    = new Poids();
        // get the user  of the session
        $user    = $this->getUser();
        //retrieving the child's gender from the database
        $gender  = $repoUser->findOneById($user)->getGender();
        //instance my array variables,dataD =array date of weight , dataP = array weight value
        $dataD = array();
        $dataP = array();
        $form=$this->createForm(WeightformType::class, $poid);
        $form->handleRequest($request);
        
        foreach ( $user->getPoidsuser()->toArray() as $key ) {
                    array_push($dataD, $key->getCreateAtpoids());
                    array_push($dataP, $key->getWeight());
        }

        //array_walk($data , preg_match )
        $countdate = count($dataP);
        $test = $form->getData()->getCreateAtpoids();
            
        // tested form
        if ($form->isSubmitted() && $form->isValid()) { 
                    //save in db
                    $poid->setUser($user);
                    $manager->persist($poid);
                    $manager->flush();
                    return $this->redirectToRoute('poids');
        }
                
        //gender-specific condition 
        if($gender = "1"){
                $genderdatamin = "2.5,3.4,4.2,5,5.5,6,6.4,6.8,7.1,7.4,7.6,7.9,8,9.2,10.1";
                $genderdatamax = "4.7,5.4,6.5,7.5,8.3,9,9.6,10.2,10.6,10.8,11.4,11.7,12,13.7,15.3";
        }
        else{
                $genderdatamin = "2.5,3.4,4,4.5,5,5.5,5.9,6.5,6.7,6.8,7.1,7.4,7.6,8.7,9.7";
                $genderdatamax = "4.5,5,6,6.9,7.7,8.4,9,9.5,10,10.4,10.7,11,11.4,13,14.5";

        }
        
        //transforms array data into a string
        $weightarray = implode(",", $dataP);
        $dateweight =implode("_", $dataD);

        //render vues with prepared data
        return $this->render('userdata/poids.html.twig', [
        'formPoids'  => $form->createView(),
        'weight'     => $weightarray,
        'dateweight' => $dateweight,  
        'gendermin'  => $genderdatamin,
        'gendermax'  => $genderdatamax,
            
        ]); 
    }
}
