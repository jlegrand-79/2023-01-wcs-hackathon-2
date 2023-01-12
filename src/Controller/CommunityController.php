<?php

namespace App\Controller;

use App\Entity\Community;
use App\Form\CommunityType;
use App\Repository\CommunityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


#[Route('/community')]
//#[IsGranted('ROLE_ADMIN')]
class CommunityController extends AbstractController
{
    #[Route('/', name: 'app_community_index', methods: ['GET'])]
    public function index(CommunityRepository $communityRepository): Response
    {
        return $this->render('community/index.html.twig', [
            'communities' => $communityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_community_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommunityRepository $communityRepository): Response
    {
        $community = new Community();
        $form = $this->createForm(CommunityType::class, $community);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $communityRepository->save($community, true);

            return $this->redirectToRoute('app_community_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('community/new.html.twig', [
            'community' => $community,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_community_show', methods: ['GET'])]
    public function show(Community $community): Response
    {
        return $this->render('community/show.html.twig', [
            'community' => $community,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_community_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Community $community, CommunityRepository $communityRepository): Response
    {
        $form = $this->createForm(CommunityType::class, $community);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $communityRepository->save($community, true);

            return $this->redirectToRoute('app_community_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('community/edit.html.twig', [
            'community' => $community,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_community_delete', methods: ['POST'])]
    public function delete(Request $request, Community $community, CommunityRepository $communityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$community->getId(), $request->request->get('_token'))) {
            $communityRepository->remove($community, true);
        }

        return $this->redirectToRoute('app_community_index', [], Response::HTTP_SEE_OTHER);
    }
}
