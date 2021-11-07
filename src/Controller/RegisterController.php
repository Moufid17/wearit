<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class RegisterController extends AbstractController
{

    /**
     * @var RegisterRepository
     */
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }


    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Get data submit
            $user = $form->getData();
            
            // Perssit submitted datas to db.
            $this->em->persist($user);
            $this->em->flush();
            dd($user);
            
        }
        return $this->render('register/index.html.twig', 
        [
            'form' => $form->createView(),
        ]);
    }
}
