<?php

namespace App\Controller;

use App\Entity\Community;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CommunityFormType;
use App\Repository\CommunityRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;



class CommunityFormController extends AbstractController
{
    #[Route('/form/community', name: 'app_form_community')]
    public function communityRegister(Request $request, EntityManagerInterface $entityManager, CommunityRepository $communityRepository): Response
    {
        $account = $this->getUser(); 
        $accountId = $account->getId();
        $community = $communityRepository->findOneBy(
            [
                'account' => $accountId,
            ]
        );
        if ($community)
            return $this->redirectToRoute('app_vehicle_index', [], Response::HTTP_SEE_OTHER);

        $community = new Community();
        $form = $this->createForm(CommunityFormType::class, $community);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $community->setAccount($account);
            $entityManager->persist($community);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $this->addFlash('success', "Merci!");

            return $this->redirectToRoute('app_home');
        }

        return $this->render('community_form/index.html.twig', [
            'form' => $form
        ]);
    }
}
