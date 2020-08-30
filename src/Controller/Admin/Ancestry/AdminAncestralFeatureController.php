<?php

namespace App\Controller\Admin\Ancestry;

use App\Controller\Base\BaseController;
use App\Entity\Ancestry\AncestralFeature;
use App\Form\Ancestry\AncestralFeatureType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminAncestralFeatureController extends BaseController
{
    /**
     * @Route("/admin/ancestry/feature/list", name="ancestral_feature_list")
     * @Template("ancestry/feature/list.html.twig")
     */
    public function listAncestralFeaturesAction()
    {
        $ancestralFeatures = $this->getDoctrine()->getRepository(AncestralFeature::class)->findAll();

        $templateData = [
            'ancestralFeatures' => $ancestralFeatures,
            'entityName' => AncestralFeature::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/ancestry/feature/create", name="ancestral_feature_create")
     * @Template("base/base_form.html.twig")
     */
    public function createAncestralFeatureAction(Request $request)
    {
        $form = $this->createForm(AncestralFeatureType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ancestralFeature = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ancestralFeature);
            $entityManager->flush();

            $this->addEntityActionFlash(AncestralFeature::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('ancestral_feature_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => AncestralFeature::ENTITY_NAME,
            'formattedEntityName' => AncestralFeature::getFormattedName(),
            'actionName' => BaseController::ENTITY_CREATE_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/ancestry/feature/{id}/edit", name="ancestral_feature_edit")
     * @Template("base/base_form.html.twig")
     */
    public function editAncestralFeatureAction(Request $request, AncestralFeature $ancestralFeature)
    {
        $form = $this->createForm(AncestralFeatureType::class, $ancestralFeature);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ancestralFeature = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ancestralFeature);
            $entityManager->flush();

            $this->addEntityActionFlash(AncestralFeature::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('ancestral_feature_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => AncestralFeature::ENTITY_NAME,
            'formattedEntityName' => AncestralFeature::getFormattedName(),
            'actionName' => BaseController::ENTITY_EDIT_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/ancestry/feature/{id}/kill", name="ancestral_feature_kill")
     */
    public function killAncestralFeatureAction(AncestralFeature $ancestralFeature)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $ancestralFeature->setIsActive(false);

        $entityManager->persist($ancestralFeature);
        $entityManager->flush();

        $this->addEntityActionFlash(AncestralFeature::getFormattedName(), BaseController::ENTITY_KILL_ACTION);

        return $this->redirectToRoute('ancestral_feature_list');
    }

    /**
     * @Route("/admin/ancestry/feature/{id}/revive", name="ancestral_feature_revive")
     */
    public function reviveAncestralFeatureAction(AncestralFeature $ancestralFeature)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $ancestralFeature->setIsActive(true);

        $entityManager->persist($ancestralFeature);
        $entityManager->flush();

        $this->addEntityActionFlash(AncestralFeature::getFormattedName(), BaseController::ENTITY_REVIVE_ACTION);

        return $this->redirectToRoute('ancestral_feature_list');
    }

    /**
     * @Route("/admin/ancestry/feature/{id}/delete", name="ancestral_feature_delete")
     */
    public function deleteAncestralFeatureAction(AncestralFeature $ancestralFeature)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($ancestralFeature);
        $entityManager->flush();

        $this->addEntityActionFlash(AncestralFeature::getFormattedName(), BaseController::ENTITY_DELETE_ACTION);

        return $this->redirectToRoute('ancestral_feature_list');
    }
}