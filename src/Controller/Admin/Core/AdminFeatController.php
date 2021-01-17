<?php

namespace App\Controller\Admin\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\Feat;
use App\Form\Core\FeatType;
use App\Service\Core\EditHelper;
use App\Service\Core\SourcableService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminFeatController extends BaseController
{
    /**
     * @Route("/admin/core/feat/create", name="feat_create")
     * @Template("base/base_form.html.twig")
     */
    public function createFeatAction(Request $request, SourcableService $sourcableService)
    {
        $form = $this->createForm(FeatType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feat = $form->getData();

            $sourcableService->ensureEmptySourceNullification($feat);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feat);
            $entityManager->flush();

            $this->addEntityActionFlash(Feat::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('feat_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Feat::ENTITY_NAME,
            'formattedEntityName' => Feat::getFormattedName(),
            'actionName' => BaseController::ENTITY_CREATE_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/core/feat/{id}/edit", name="feat_edit")
     * @Template("base/base_form.html.twig")
     */
    public function editFeatAction(Request $request, Feat $feat, EditHelper $editHelper)
    {
        $result = $editHelper->editEntity($request, FeatType::class, $feat);

        if ($result) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addEntityActionFlash(Feat::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('feat_show', ['id' => $result->getId()]);
        }

        $templateData = [
            'form' => $editHelper->getEntityForm()->createView(),
            'entityName' => Feat::ENTITY_NAME,
            'formattedEntityName' => Feat::getFormattedName(),
            'actionName' => BaseController::ENTITY_EDIT_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/core/feat/{id}/kill", name="feat_kill")
     */
    public function killFeatAction(Feat $feat)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $feat->setIsActive(false);

        $entityManager->persist($feat);
        $entityManager->flush();

        $this->addEntityActionFlash(Feat::getFormattedName(), BaseController::ENTITY_KILL_ACTION);

        return $this->redirectToRoute('feat_list');
    }

    /**
     * @Route("/admin/core/feat/{id}/revive", name="feat_revive")
     */
    public function reviveFeatAction(Feat $feat)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $feat->setIsActive(true);

        $entityManager->persist($feat);
        $entityManager->flush();

        $this->addEntityActionFlash(Feat::getFormattedName(), BaseController::ENTITY_REVIVE_ACTION);

        return $this->redirectToRoute('feat_list');
    }

    /**
     * @Route("/admin/core/feat/{id}/delete", name="feat_delete")
     */
    public function deleteFeatAction(Feat $feat)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($feat);
        $entityManager->flush();

        $this->addEntityActionFlash(Feat::getFormattedName(), BaseController::ENTITY_DELETE_ACTION);

        return $this->redirectToRoute('feat_list');
    }

    /**
     * @Route("/admin/core/feat/{id}/stage", name="feat_stage")
     */
    public function stageFeatAction(Request $request, Feat $feat)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $feat->setIsToBeReleased(true);

        $entityManager->persist($feat);
        $entityManager->flush();

        $this->addEntityActionFlash(Feat::getFormattedName(), BaseController::ENTITY_STAGE_ACTION);

        return $this->redirectToReferer($request);
    }

    /**
     * @Route("/admin/core/feat/{id}/unstage", name="feat_unstage")
     */
    public function unstageFeatAction(Request $request, Feat $feat)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $feat->setIsToBeReleased(false);

        $entityManager->persist($feat);
        $entityManager->flush();

        $this->addEntityActionFlash(Feat::getFormattedName(), BaseController::ENTITY_UNSTAGE_ACTION);

        return $this->redirectToReferer($request);
    }
}