<?php

namespace App\Controller\Admin\Campaign;

use App\Controller\Base\BaseController;
use App\Entity\Campaign\Campaign;
use App\Form\Campaign\CampaignType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminCampaignController extends BaseController
{
    /**
     * @Route("/admin/core/campaign/create", name="campaign_create")
     * @Template("base/base_form.html.twig")
     */
    public function createCampaignAction(Request $request)
    {
        $form = $this->createForm(CampaignType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $campaign = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($campaign);
            $entityManager->flush();

            $this->addEntityActionFlash(Campaign::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('campaign_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Campaign::ENTITY_NAME,
            'formattedEntityName' => Campaign::getFormattedName(),
            'actionName' => BaseController::ENTITY_CREATE_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/campaign/{id}/edit", name="campaign_edit")
     * @Template("base/base_form.html.twig")
     */
    public function editCampaignAction(Request $request, Campaign $campaign)
    {
        $form = $this->createForm(CampaignType::class, $campaign);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $campaign = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($campaign);
            $entityManager->flush();

            $this->addEntityActionFlash(Campaign::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('campaign_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Campaign::ENTITY_NAME,
            'formattedEntityName' => Campaign::getFormattedName(),
            'actionName' => BaseController::ENTITY_EDIT_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/campaign/{id}/kill", name="campaign_kill")
     */
    public function killCampaignAction(Campaign $campaign)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $campaign->setIsActive(false);

        $entityManager->persist($campaign);
        $entityManager->flush();

        $this->addEntityActionFlash(Campaign::getFormattedName(), BaseController::ENTITY_KILL_ACTION);

        return $this->redirectToRoute('campaign_list');
    }

    /**
     * @Route("/admin/core/campaign/{id}/revive", name="campaign_revive")
     */
    public function reviveCampaignAction(Campaign $campaign)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $campaign->setIsActive(true);

        $entityManager->persist($campaign);
        $entityManager->flush();

        $this->addEntityActionFlash(Campaign::getFormattedName(), BaseController::ENTITY_REVIVE_ACTION);

        return $this->redirectToRoute('campaign_list');
    }

    /**
     * @Route("/admin/core/campaign/{id}/delete", name="campaign_delete")
     */
    public function deleteCampaignAction(Campaign $campaign)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($campaign);
        $entityManager->flush();

        $this->addEntityActionFlash(Campaign::getFormattedName(), BaseController::ENTITY_DELETE_ACTION);

        return $this->redirectToRoute('campaign_list');
    }
}