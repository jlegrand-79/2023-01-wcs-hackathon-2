<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Community;
use App\Form\CommunityFormType;

class CommunityFormController extends AbstractController
{
    #[Route('/form/community', name: 'app_form_community')]
    public function index(): Response
    {
        $community = new Community();
        $form = $this->createForm(CommunityFormType::class, $community);

        return $this->renderForm('community_form/index.html.twig', [
            'form' => $form,
        ]);
    }
}
