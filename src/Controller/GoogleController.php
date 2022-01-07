<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class GoogleController extends AbstractController
{

    /**
     * Link to this controller to start the "connect" process
     *
     * @Route("/connect/google", name="connect_google")
     * @param ClientRegistry $clientRegistry
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function connect(ClientRegistry $clientRegistry): RedirectResponse
    {
        return $clientRegistry
            ->getClient('google')
            ->redirect([], [
                'prompt' => 'consent',
            ]);
    }

    /**
     * Facebook redirects to back here afterward
     *
     * @Route("/connect/google/check", name="connect_google_check")
     */
    public function connectCheck()
    {
        if (!$this->getUser()) {
            return $this->render('security/login.html.twig', ['error' => 'User not found! Please try again.']);
        } else {
            return $this->redirectToRoute('/');
        }
    }

    /**
     * @Route("/login", name="login")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('apod');
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('security/login.html.twig', ['error' => $error]);
    }

    /**
     * @Route("/logout", name="logout")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        if ($this->getUser()) {
            $request->getSession()->invalidate(1);
        }
        return $this->redirectToRoute('login');
    }

    /**
     * @Route("/logged", name="logged")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function logged(): Response
    {
        return $this->render('security/logged.html.twig', ['user' => $this->getUser()]);
    }
}
