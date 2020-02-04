<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationType;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extention\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
    *@Route("/" , name="security_registration")
    */
    // function registration
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, SessionInterface $session, \Swift_Mailer $mailer)
    {
        $user= new Users();
        //creation of the form using form classes 
        $form=$this->createForm(RegistrationType::class, $user);
        //management of form submissions
        $form->handleRequest($request);
        //check form , if submitted and validated
        if ($form->isSubmitted() && $form->isValid()) {
            //password encoding
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            //recovery of the date of creation of the account
            $user->setCreateAt(new \DateTime());
            //account not activated
            $user->setActivate('0');
            //registration in db
            $manager->persist($user);
            $manager->flush();
            //send an email
            $message = (new \Swift_Message('Confirmation d\'inscription au service NoLoB'))
                ->setFrom('liberden@gmail.com')
                ->setTo($user->getEmail())
                ->setBody($this->renderView('security/email.html.twig',[
                    'email'=>$user
                ] ));
              
            $mailer->send($message);
            
            //redirection after processing the form
            return $this->redirectToRoute('security_login');

        }
        //sends the view with the form
        return $this->render('security/home.html.twig', [
          'formUsers' => $form->createView()
      ]);
    }

    

    /**
    *@Route("/login" ,name="security_login")
    */

    public function login()
    {
        
        return $this->render('security/login.html.twig');
    }


    /**
    *@Route("/logout" ,name="security_logout")
    */

    public function logout()
    {
    }
}
