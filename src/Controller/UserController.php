<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_register")
     */
    public function register(LoggerInterface $logger)
    {
        $logger->info('suck my cock');
        //return new Response('<html>sucky-sucky!</html>');

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}