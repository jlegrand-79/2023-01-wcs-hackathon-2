<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserFormType;

class UserFormController extends AbstractController
{
    #[Route('/form/user', name: 'app_form_user')]
    public function index(): Response
    {

        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);

        return $this->renderForm('user_form/index.html.twig', [
            'form' => $form,
        ]);
    }
}
