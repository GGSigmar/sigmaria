<?php


namespace App\Controller\Core;


use App\Entity\Core\User;
use App\Form\Core\UserRolesType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class UserController extends CoreController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/core/user/list", name="list_users")
     * @Template("core/user/list.html.twig")
     */
    public function listFeatsAction()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        $templateData = [
            'users' => $users,
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_ADMIN));
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/core/user/{id}/roles", name="user_roles")
     * @Template("core/user/roles.html.twig")
     */
    public function userRolesAction(Request $request, User $user)
    {
        $form = $this->createForm(UserRolesType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Uprawnienia zaktualizowane!');

            return $this->redirectToRoute('user_roles', ['id' => $user->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_ADMIN));
    }
}