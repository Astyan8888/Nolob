<?php

namespace App\Controller;

use App\Entity\Users;
use DateTimeInterface;
use App\Entity\Feeding;
use App\Form\FeedingformType;
use App\Repository\UsersRepository;
use App\Controller\FeedingController;
use App\Repository\FeedingRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FeedingController extends AbstractController
{
   /**
     *@Route("/feeding" ,name="feeding")
     */

    public function feeding(FeedingRepository $repo,Request $request, ObjectManager $manager,  SessionInterface $session , UsersRepository $userRepo )
    {
     $feeding = new Feeding();
     $form=$this->createForm(FeedingformType::class, $feeding);
     $user = $this->getUser();
  
     $feeding_date_array=array();
     $feeding_duration_array=array();
    
        
     foreach($user->getFeedings()->toArray() as $feedingAll) {
      
        array_push($feeding_date_array,$feedingAll->getDatefeeding()->format('d-m-Y'));

        }

     $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            
            //checks the data feeding quantity exists
            if($feeding_date_array){
                
                //retrieve the dates 
                $dateFeedingString       = implode(",", $feeding_date_array);
                $search                 = $feeding->getDatefeeding();
                $searchformat           = $feeding->getDatefeeding()->format('d-m-Y');
                //explores the variable to test if a date already exists 
                $dateFeedingSearch       = preg_match("/$searchformat/",  $dateFeedingString   );
                            
                if ($dateFeedingSearch == 1 ) {
                    //Data recovery on the date selected in the form
                    $feeding = $repo->findOneBy([
                        'user' => $user,
                        'datefeeding' => $search,
                                        ]);
                        //Data recovery of the date duration data selected in the form
                       $duration=$feeding->getDuration();
                       //Testing and retrieving the duration in the form
                       $duration_exist=$form->getData()->getDuration();
                       //If the duration exists in the form I added it to the existing duration
                       if ($duration_exist) {
                           
                           $newduration=$form->getData()->getDuration()->format('H-i-s');
                           $timeValue = explode('-', $newduration);
                           $h = $timeValue[0];
                           $m = $timeValue[1];
                           $s = $timeValue[2];
                           $duration_add=$duration;
                           $duration_add->modify("+ $h hour $m min");
                           $duration_add_db= $duration_add->format('H-i-s');
                           $feeding->setDuration(\DateTime::createFromFormat('H-i-s',$duration_add_db ));

                       }
                       //I add the quantity of the form with the quantity already displayed in the database
                       $amount=$feeding->getAmount();
                       $newamount = $form->getData()->getAmount();
                       $feeding->setAmount(($amount+$newamount));
                       
                       //Adding the used breasts
                       $feeding->setBreast($form->getData()->getBreast());
                       //Addition of the relationship with 
                       $feeding->setUser($user);

                       $manager->persist($feeding);
                       $manager->flush();      
                       
                    
                }
                else{
                     $feeding->setUser($user);
                     $manager->persist($feeding);
                     $manager->flush();
                }           
            }
            else{
                    $error="Une erreur est survenue";              
            }             
        } 
        $datenow=date('Y-m-d');       
        $date= (\DateTime::createFromFormat('Y-m-d' ,$datenow));
   


        $feeding = $repo->findOneBy([
                        'user' => $user,
                         'datefeeding' =>$date,
                                         ]);

        
       
           
                
        return $this->render('userdata/feeding.html.twig',[
            'formFeeding' => $form->createView(),
            'feeding' =>$feeding,
            
          
        ]);
      
    }  
}
