<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Account;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route('/login/redirect', name: 'app_login_redirect')]
    #[IsGranted('ROLE_USER')]
    
    public function redirectAfterLogin(): Response
    {
        if ('1' == $this->getUser()->isIsCommunity()) {
            return $this->redirectToRoute('app_form_community', [], Response::HTTP_SEE_OTHER);
        }
        if ('0' == $this->getUser()->isIsCommunity()) {
            return $this->redirectToRoute('app_form_user', [], Response::HTTP_SEE_OTHER);
        }
        // if (in_array('ROLE_USER', $this->getUser()->getRoles())) {
        //     return $this->redirectToRoute('app_form_user', [], Response::HTTP_SEE_OTHER);
        // }
        // if (in_array('ROLE_COMMUNITY', $this->getUser()->getRoles())) {
        //     return $this->redirectToRoute('app_form_community', [], Response::HTTP_SEE_OTHER);
        // }
        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}
