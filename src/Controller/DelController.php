<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DelController extends AbstractController
{
      /**
         * @Route("/del", name="deleteUser")  
        * 
        */
        public function deleteUser(UsersRepository $repo,  ObjectManager $manager)
        {
      
            $user = $this->getUser();
            $user = $repo->findOneById(
                             array('id' => $user));
            $manager->remove($user);
            $manager->flush();

            $this->get('security.token_storage')->setToken(null);
            

           return $this->redirectToRoute('security_registration');

        
        }
}
