<?php

namespace App\Controller\Core\Admin;

use App\Controller\Base\BaseController;
use App\Entity\Core\User;
use App\Form\Core\UserRolesType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminUserController extends BaseController
{
    /**
     * @Route("/admin/core/user/list", name="user_list")
     * @Template("core/user/list.html.twig")
     */
    public function listUsersAction()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        $templateData = [
            'users' => $users,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/user/{id}/roles", name="user_roles")
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

            $this->addFlash('success', 'Privileges updated!');

            return $this->redirectToRoute('user_roles', ['id' => $user->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => User::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/user/{id}/disable", name="user_disable")
     */
    public function disableUserAction(User $user)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user->setEnabled(false);

        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('warning', 'User disabled!');

        return $this->redirectToRoute('user_list');
    }

    /**
     * @Route("/admin/core/user/{id}/enable", name="user_enable")
     */
    public function enableUserAction(User $user)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user->setEnabled(true);

        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'User enabled!');

        return $this->redirectToRoute('user_list');
    }
}