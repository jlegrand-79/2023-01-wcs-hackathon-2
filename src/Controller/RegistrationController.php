<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\Community;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register/user', name: 'app_register_user')]
    public function userRegister(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Account();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_USER']);
            $user->setIsCommunity(0);

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $this->addFlash('success', "Your account has been successfully created.");

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/user.register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/register/community', name: 'app_register_community')]
    public function communityRegister(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $community = new Account();
        $form = $this->createForm(RegistrationFormType::class, $community);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $community->setPassword(
                $userPasswordHasher->hashPassword(
                    $community,
                    $form->get('plainPassword')->getData()
                )
            );
            $community->setRoles(['ROLE_COMMUNITY']);
            $community->setIsCommunity(1);

            $entityManager->persist($community);
            $entityManager->flush();
            // do anything else you need here, like send an email

            $this->addFlash('success', "Your account has been successfully created.");
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/community.register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
