<?php


namespace App\Controller;

use DateTime;
use App\Entity\PC;

use App\Entity\Bath;
use App\Entity\Size;
use App\Entity\Event;
use App\Entity\Poids;
use App\Entity\Users;
use App\Entity\Diaper;
use App\Form\BathType;
use App\Form\SizeType;
use App\Entity\Feeding;
use App\Entity\Sleeper;
use App\Form\SleepType;
use App\Form\DiaperType;
use App\Form\PCformType;
use App\Form\EventformType;
use App\Form\WeightformType;
use App\Form\FeedingformType;
use App\Form\RegistrationType;
use App\Repository\PCRepository;
use App\Repository\BathRepository;
use App\Repository\SizeRepository;
use App\Repository\EventRepository;
use App\Repository\PoidsRepository;
use App\Repository\UsersRepository;
use App\Repository\DiaperRepository;
use App\Repository\FeedingRepository;
use App\Repository\SleeperRepository;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserdataController extends AbstractController
{

    /**
     * @Route("/userdata", name="userdata")
     */

    public function account(UsersRepository $repo, SessionInterface $session, Request $request)
    {
        $user = $this->getUser();
        $user_data=$repo->find($user);

        return $this->render('userdata/account.html.twig', [
          'user' =>$user_data
        ]);
    }

    
    

     /**
     *@Route("/homedata" ,name="homedata")
     */

    public function homedata()
    {
    
        return $this->render('userdata/homedata.html.twig',[
            
            
        ]);
    }


}   