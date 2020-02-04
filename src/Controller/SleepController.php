<?php

namespace App\Controller;

use App\Entity\Sleeper;
use App\Form\SleepType;
use App\Repository\SleeperRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SleepController extends AbstractController
{
     /**
     * @Route("/sleep" ,name="sleep")
     */

     public function sleep(SleeperRepository $repo,Request $request, ObjectManager $manager,  SessionInterface $session )
     {
        $sleep = new Sleeper();
        $form = $this->createForm(SleepType::class, $sleep);
        $user = $this->getUser();
        $sleepamount = $repo->findOneByUser($user);
        $sleep_date_array = array();
        $duration_array=array();

        
        foreach ($user->getSleeper()->toArray() as $sleeperAll) {

        array_push($sleep_date_array, $sleeperAll->getstartsleep()->format('d-m-Y'));

        }
        

        $form->handleRequest($request);

       

        if ($form->isSubmitted() && $form->isValid()) {



            //checks the data sleep quantity exists
            if($sleep_date_array){



                //retrieve the dates 
                $dateSleepString       = implode(",", $sleep_date_array);
                $search                 = $sleep->getStartsleep();
                $searchformat           = $search->format('d-m-Y');
                //explores the variable to test if a date already exists 
                $dateSleepSearch       = preg_match("/$searchformat/",$dateSleepString );

                if ( $dateSleepSearch   == 1 ) {
                    //Data recovery on the date selected in the form
                    $sleep = $repo->findOneBy([
                        'user' => $user,
                        'startsleep' => $search,
                                        ]);
                        //Data recovery of the date duration data selected in the form
                        $duration = $sleep->getDurationsleep();
                      
                       //Testing and retrieving the duration in the form
                       $duration_exist=$form->getData()->getDurationsleep();
                       //If the duration exists in the form I added it to the existing duration
                       if ($duration_exist) {
                           
                           $newduration=$form->getData()->getDurationsleep()->format('H-i-s');
                           $timeValue = explode('-', $newduration);
                           $h = $timeValue[0];
                           $m = $timeValue[1];
                           $s = $timeValue[2];
                           $duration_add=$duration;
                           $duration_add->modify("+ $h hour $m min");
                           $duration_add_db= $duration_add->format('H-i-s');
                           $sleep->setDurationsleep(\DateTime::createFromFormat('H-i-s',$duration_add_db ));
                            $manager->persist($sleep);
                            $manager->flush();
                       }

                       else{
       
                               $sleep->setUser($user);
                               $manager->persist($sleep);
                               $manager->flush();
                        }        
                      
                }else{
       
                               $sleep->setUser($user);
                               $manager->persist($sleep);
                               $manager->flush();
                        } 


            }
             else{
       
                               $sleep->setUser($user);
                               $manager->persist($sleep);
                               $manager->flush();
                        }        
            
       
        }

        $datenow=date('Y-m-d');  
        $date= (\DateTime::createFromFormat('Y-m-d' ,$datenow));

        $sleep = $repo->findOneBy([
                        'user' => $user,
                         'startsleep' =>$date,
                                         ]);
     

        if ( $sleep !== NULL){
            $newduration = $sleep->getDurationsleep()->format('H-i-s');
            $timeValue = explode('-', $newduration);
            $h = $timeValue[0];
            $m = $timeValue[1];    
            $durationSleepSecond= $h*3600 + $m*60;
            $totalday = 86400- $durationSleepSecond;

            }
            else{
                   $durationSleepSecond = 0;
                   $totalday= 86400;
             }
                    
 
           

            return $this->render('userdata/sleep.html.twig',[
            'formSleep' => $form->createView(),
            'sleep'=>$sleep,
            'duration'=>$durationSleepSecond,
            'totalday'=>$totalday
                    ]);
    }

}
