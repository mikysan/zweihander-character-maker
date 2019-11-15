<?php

namespace App\Security;

use App\Entity\ApiToken;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class LoginFormAuthenticator extends AbstractGuardAuthenticator
{
    private $userRepository;
    private $router;
    private $passwordEncoder;
    private $apiTokenRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, RouterInterface $router, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $entityManager->getRepository(User::class);
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
        $this->apiTokenRepository = $entityManager->getRepository(ApiToken::class);
        $this->entityManager = $entityManager;
    }

    public function supports(Request $request)
    {
        // do your work when we're POSTing to the login page
        return 'app_login' === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $credentials = [
            'username' => $request->request->get('username'),
            'password' => $request->request->get('password'),
        ];

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $this->userRepository->findOneBy(['username' => $credentials['username']]);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $apiToken, $providerKey)
    {
        $user = $apiToken->getUser();
        if (!$user instanceof User) {
            throw new \Exception('Authenticator isn\'t providing a valid user object.');
        }
        $apiToken = $this->apiTokenRepository->findOneBy(['appUser' => $user]);
        if (!$apiToken || $apiToken->isExpired()) {
            $apiToken = new ApiToken($user);
        }
        $this->entityManager->persist($apiToken);
        $this->entityManager->flush();

        return new JsonResponse([
            'message' => 'Authentication success.',
            'token' => $apiToken->getToken(),
        ], Response::HTTP_OK);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse([
            'message' => 'Authentication failure.',
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe()
    {
        return false;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse([
            'message' => 'Authentication required.',
        ], Response::HTTP_UNAUTHORIZED);
    }
}
