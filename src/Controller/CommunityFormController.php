<?php

namespace App\Controller;

use App\Entity\Community;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CommunityFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;



class CommunityFormController extends AbstractController
{
    #[Route('/form/community', name: 'app_form_community')]
    public function communityRegister(Request $request, EntityManagerInterface $entityManager): Response
    {
        $community = new Community();
        $form = $this->createForm(CommunityFormType::class, $community);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($community);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $this->addFlash('success', "Merci!");

            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('community_form/index.html.twig', [
            'form' => $form
        ]);
    }
}
