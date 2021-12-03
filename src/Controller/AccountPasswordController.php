<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Form\ChangePasswordType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountPasswordController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    /**
     * @Route("/account/change-password", name="account_password")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {   
        $notification = null;

        $curUser = $this->getUser(); #Get current user
        $form = $this->createForm(ChangePasswordType::class,$curUser);
        
        $form->handleRequest($request); #Retreive form data
        
        if($form->isSubmitted() && $form->isValid()){
            $old_pwd = $form->get('old_password')->getData();

            if($encoder->isPasswordValid($curUser,$old_pwd)){
                #Mettre à jour le nouveau pour ce user
                $new_pwd = $form->get('new_password')->getData();
                $pwd = $encoder->encodePassword($curUser,$new_pwd);
                // dd([$new_pwd,$pwd]);
                $curUser->setPassword($pwd);
                $this->em->flush();
                $notification = "Password updated !";
            }else{
                #Message d'erreur
                // dd("erreur");
                $notification = "Wrong current password, please try again!";
            }
        }

        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification,
        ]);
    }
}
