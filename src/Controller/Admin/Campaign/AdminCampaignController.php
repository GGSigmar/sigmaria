<?php

namespace App\Controller\Admin\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\Lore;
use App\Form\Core\LoreType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminLoreController extends BaseController
{
    /**
     * @Route("/admin/core/lore/list", name="lore_list")
     * @Template("core/lore/list.html.twig")
     */
    public function listLoresAction()
    {
        $lores = $this->getDoctrine()->getRepository(Lore::class)->findAll();

        $templateData = [
            'lores' => $lores,
            'entityName' => Lore::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/lore/create", name="lore_create")
     * @Template("base/base_form.html.twig")
     */
    public function createLoreAction(Request $request)
    {
        $form = $this->createForm(LoreType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lore = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lore);
            $entityManager->flush();

            $this->addEntityActionFlash(Lore::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('lore_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Lore::ENTITY_NAME,
            'formattedEntityName' => Lore::getFormattedName(),
            'actionName' => BaseController::ENTITY_CREATE_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/lore/{id}/edit", name="lore_edit")
     * @Template("base/base_form.html.twig")
     */
    public function editLoreAction(Request $request, Lore $lore)
    {
        $form = $this->createForm(LoreType::class, $lore);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lore = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lore);
            $entityManager->flush();

            $this->addEntityActionFlash(Lore::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('lore_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Lore::ENTITY_NAME,
            'formattedEntityName' => Lore::getFormattedName(),
            'actionName' => BaseController::ENTITY_EDIT_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/lore/{id}/kill", name="lore_kill")
     */
    public function killLoreAction(Lore $lore)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $lore->setIsActive(false);

        $entityManager->persist($lore);
        $entityManager->flush();

        $this->addEntityActionFlash(Lore::getFormattedName(), BaseController::ENTITY_KILL_ACTION);

        return $this->redirectToRoute('lore_list');
    }

    /**
     * @Route("/admin/core/lore/{id}/revive", name="lore_revive")
     */
    public function reviveLoreAction(Lore $lore)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $lore->setIsActive(true);

        $entityManager->persist($lore);
        $entityManager->flush();

        $this->addEntityActionFlash(Lore::getFormattedName(), BaseController::ENTITY_REVIVE_ACTION);

        return $this->redirectToRoute('lore_list');
    }

    /**
     * @Route("/admin/core/lore/{id}/delete", name="lore_delete")
     */
    public function deleteLoreAction(Lore $lore)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($lore);
        $entityManager->flush();

        $this->addEntityActionFlash(Lore::getFormattedName(), BaseController::ENTITY_DELETE_ACTION);

        return $this->redirectToRoute('lore_list');
    }
}