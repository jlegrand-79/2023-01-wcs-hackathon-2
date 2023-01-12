<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserFormType;
use App\Entity\Account;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class UserFormController extends AbstractController
{
    #[Route('/form/user', name: 'app_form_user')]
    public function userRegister(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setIsValidated('1');
            $user->setAccount($this->getUser());
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $this->addFlash('success', "Merci!");

            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('user_form/index.html.twig', [
            'form' => $form
        ]);
    }
}

