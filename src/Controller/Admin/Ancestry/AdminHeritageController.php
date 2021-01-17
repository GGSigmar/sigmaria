<?php

namespace App\Controller\Admin\Ancestry;

use App\Controller\Base\BaseController;
use App\Entity\Ancestry\Heritage;
use App\Entity\Core\Feat;
use App\Entity\Core\Paragraph;
use App\Form\Ancestry\HeritageType;
use App\Form\Core\FeatType;
use App\Form\Core\ParagraphType;
use App\Service\Core\EditHelper;
use App\Service\Core\SourcableService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminHeritageController extends BaseController
{
    /**
     * @Route("/admin/ancestry/heritage/create", name="heritage_create")
     * @Template("base/base_form.html.twig")
     */
    public function createHeritageAction(Request $request)
    {
        $form = $this->createForm(HeritageType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $heritage = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($heritage);
            $entityManager->flush();

            $this->addEntityActionFlash(Heritage::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('heritage_show', ['slug' => $heritage->getSlug()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Heritage::ENTITY_NAME,
            'formattedEntityName' => Heritage::getFormattedName(),
            'actionName' => BaseController::ENTITY_CREATE_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/ancestry/heritage/{id}/edit", name="heritage_edit")
     * @Template("base/base_form.html.twig")
     */
    public function editHeritageAction(Request $request, Heritage $heritage)
    {
        $form = $this->createForm(HeritageType::class, $heritage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $heritage = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($heritage);
            $entityManager->flush();

            $this->addEntityActionFlash(Heritage::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('heritage_show', ['slug' => $heritage->getSlug()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Heritage::ENTITY_NAME,
            'formattedEntityName' => Heritage::getFormattedName(),
            'actionName' => BaseController::ENTITY_EDIT_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/ancestry/heritage/{id}/kill", name="heritage_kill")
     */
    public function killHeritageAction(Heritage $heritage)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $heritage->setIsActive(false);

        $entityManager->persist($heritage);
        $entityManager->flush();

        $this->addEntityActionFlash(Heritage::getFormattedName(), BaseController::ENTITY_KILL_ACTION);

        return $this->redirectToRoute('heritage_list');
    }

    /**
     * @Route("/admin/ancestry/heritage/{id}/revive", name="heritage_revive")
     */
    public function reviveHeritageAction(Heritage $heritage)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $heritage->setIsActive(true);

        $entityManager->persist($heritage);
        $entityManager->flush();

        $this->addEntityActionFlash(Heritage::getFormattedName(), BaseController::ENTITY_REVIVE_ACTION);

        return $this->redirectToRoute('heritage_list');
    }

    /**
     * @Route("/admin/ancestry/heritage/{id}/delete", name="heritage_delete")
     */
    public function deleteHeritageAction(Heritage $heritage)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($heritage);
        $entityManager->flush();

        $this->addEntityActionFlash(Heritage::getFormattedName(), BaseController::ENTITY_DELETE_ACTION);

        return $this->redirectToRoute('heritage_list');
    }

    /**
     * @Route("/admin/ancestry/heritage/{id}/stage", name="heritage_stage")
     */
    public function stageHeritageAction(Request $request, Heritage $heritage)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $heritage->setIsToBeReleased(true);

        $entityManager->persist($heritage);
        $entityManager->flush();

        $this->addEntityActionFlash(Heritage::getFormattedName(), BaseController::ENTITY_STAGE_ACTION);

        return $this->redirectToReferer($request);
    }

    /**
     * @Route("/admin/ancestry/heritage/{id}/unstage", name="heritage_unstage")
     */
    public function unstageHeritageAction(Request $request, Heritage $heritage)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $heritage->setIsToBeReleased(false);

        $entityManager->persist($heritage);
        $entityManager->flush();

        $this->addEntityActionFlash(Heritage::getFormattedName(), BaseController::ENTITY_UNSTAGE_ACTION);

        return $this->redirectToReferer($request);
    }

    /**
     * @Route("/admin/ancestry/heritage/{id}/feat/create", name="heritage_feat_create")
     * @Template("base/base_form.html.twig")
     */
    public function createHeritageFeatAction(Request $request, Heritage $heritage, SourcableService $sourcableService)
    {
        $form = $this->createForm(FeatType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feat = $form->getData();

            $heritage->addFeat($feat);

            $sourcableService->ensureEmptySourceNullification($feat);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feat);
            $entityManager->persist($heritage);
            $entityManager->flush();

            $this->addEntityActionFlash(Feat::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('heritage_show', ['slug' => $heritage->getSlug()]);
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
     * @Route("/admin/ancestry/heritage/{baseId}/feat/{id}/edit", name="heritage_feat_edit")
     * @Template("base/base_form.html.twig")
     * @ParamConverter("heritage", class="App\Entity\Ancestry\Heritage", options={"id"="baseId"})
     * @ParamConverter("feat", class="App\Entity\Core\Feat", options={"id"="id"})
     */
    public function editHeritageFeatAction(Request $request, Heritage $heritage, Feat $feat, EditHelper $editHelper)
    {
        $result = $editHelper->editEntity($request, FeatType::class, $feat);

        if ($result) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addEntityActionFlash(Feat::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('heritage_show', ['slug' => $heritage->getSlug()]);
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
     * @Route("/admin/ancestry/heritage/{id}/paragraph/create", name="heritage_paragraph_create")
     * @Template("base/base_form.html.twig")
     */
    public function createHeritageParagraphAction(Request $request, Heritage $heritage)
    {
        $form = $this->createForm(ParagraphType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paragraph = $form->getData();

            $heritage->addParagraph($paragraph);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($paragraph);
            $entityManager->persist($heritage);
            $entityManager->flush();

            $this->addEntityActionFlash(Paragraph::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('heritage_show', ['slug' => $heritage->getSlug()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Paragraph::ENTITY_NAME,
            'formattedEntityName' => Paragraph::getFormattedName(),
            'actionName' => BaseController::ENTITY_CREATE_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/ancestry/heritage/{baseId}/paragraph/{id}/edit", name="heritage_paragraph_edit")
     * @Template("base/base_form.html.twig")
     * @ParamConverter("heritage", class="App\Entity\Ancestry\Heritage", options={"id"="baseId"})
     * @ParamConverter("paragraph", class="App\Entity\Core\Paragraph", options={"id"="id"})
     */
    public function editHeritageParagraphAction(Request $request, Heritage $heritage, Paragraph $paragraph)
    {
        $form = $this->createForm(ParagraphType::class, $paragraph);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paragraph = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($paragraph);
            $entityManager->persist($heritage);
            $entityManager->flush();

            $this->addEntityActionFlash(Paragraph::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('heritage_show', ['slug' => $heritage->getSlug()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Paragraph::ENTITY_NAME,
            'formattedEntityName' => Paragraph::getFormattedName(),
            'actionName' => BaseController::ENTITY_EDIT_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }
}