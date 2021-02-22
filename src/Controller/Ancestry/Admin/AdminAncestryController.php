<?php

namespace App\Controller\Ancestry\Admin;

use App\Controller\Base\BaseController;
use App\Entity\Ancestry\Ancestry;
use App\Entity\Ancestry\Heritage;
use App\Entity\Core\Feat;
use App\Entity\Core\Paragraph;
use App\Form\Ancestry\AncestryType;
use App\Form\Ancestry\HeritageType;
use App\Form\Core\FeatType;
use App\Form\Core\ParagraphType;
use App\Service\Core\SourcableService;
use App\Service\Helper\EntityControllerHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminAncestryController extends BaseController
{
    /**
     * @Route("/admin/ancestry/create", name="ancestry_create")
     * @Template("base/base_form.html.twig")
     */
    public function createAncestryAction(Request $request)
    {
        $form = $this->createForm(AncestryType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ancestry = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ancestry);
            $entityManager->flush();

            $this->addEntityActionFlash(Ancestry::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('ancestry_show', ['slug' => $ancestry->getSlug()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Ancestry::ENTITY_NAME,
            'formattedEntityName' => Ancestry::getFormattedName(),
            'actionName' => BaseController::ENTITY_CREATE_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/ancestry/{id}/edit", name="ancestry_edit")
     * @Template("base/base_form.html.twig")
     */
    public function editAncestryAction(Request $request, Ancestry $ancestry)
    {
        $form = $this->createForm(AncestryType::class, $ancestry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ancestry = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ancestry);
            $entityManager->flush();

            $this->addEntityActionFlash(Ancestry::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('ancestry_show', ['slug' => $ancestry->getSlug()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Ancestry::ENTITY_NAME,
            'formattedEntityName' => Ancestry::getFormattedName(),
            'actionName' => BaseController::ENTITY_EDIT_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/ancestry/{id}/kill", name="ancestry_kill")
     */
    public function killAncestryAction(Ancestry $ancestry)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $ancestry->setIsActive(false);

        $entityManager->persist($ancestry);
        $entityManager->flush();

        $this->addEntityActionFlash(Ancestry::getFormattedName(), BaseController::ENTITY_KILL_ACTION);

        return $this->redirectToRoute('ancestry_list');
    }

    /**
     * @Route("/admin/ancestry/{id}/revive", name="ancestry_revive")
     */
    public function reviveAncestryAction(Ancestry $ancestry)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $ancestry->setIsActive(true);

        $entityManager->persist($ancestry);
        $entityManager->flush();

        $this->addEntityActionFlash(Ancestry::getFormattedName(), BaseController::ENTITY_REVIVE_ACTION);

        return $this->redirectToRoute('ancestry_list');
    }

    /**
     * @Route("/admin/ancestry/{id}/delete", name="ancestry_delete")
     */
    public function deleteAncestryAction(Ancestry $ancestry)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($ancestry);
        $entityManager->flush();

        $this->addEntityActionFlash(Ancestry::getFormattedName(), BaseController::ENTITY_DELETE_ACTION);

        return $this->redirectToRoute('ancestry_list');
    }

    /**
     * @Route("/admin/ancestry/{id}/stage", name="ancestry_stage")
     */
    public function stageAncestryAction(Ancestry $ancestry)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $ancestry->setIsToBeReleased(true);

        $entityManager->persist($ancestry);
        $entityManager->flush();

        $this->addEntityActionFlash(Ancestry::getFormattedName(), BaseController::ENTITY_STAGE_ACTION);

        return $this->redirectToRoute('ancestry_list');
    }

    /**
     * @Route("/admin/ancestry/{id}/unstage", name="ancestry_unstage")
     */
    public function unstageAncestryAction(Ancestry $ancestry)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $ancestry->setIsToBeReleased(false);

        $entityManager->persist($ancestry);
        $entityManager->flush();

        $this->addEntityActionFlash(Ancestry::getFormattedName(), BaseController::ENTITY_UNSTAGE_ACTION);

        return $this->redirectToRoute('ancestry_list');
    }

    /**
     * @Route("/admin/ancestry/{id}/feat/create", name="ancestry_feat_create")
     * @Template("base/base_form.html.twig")
     */
    public function createAncestryFeatAction(Request $request, Ancestry $ancestry, SourcableService $sourcableService)
    {
        $form = $this->createForm(FeatType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feat = $form->getData();

            $ancestry->addFeat($feat);

            $sourcableService->ensureEmptySourceNullification($feat);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feat);
            $entityManager->persist($ancestry);
            $entityManager->flush();

            $this->addEntityActionFlash(Feat::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('ancestry_show', ['slug' => $ancestry->getSlug()]);
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
     * @Route("/admin/ancestry/{baseId}/feat/{id}/edit", name="ancestry_feat_edit")
     * @Template("base/base_form.html.twig")
     * @ParamConverter("ancestry", class="App\Entity\Ancestry\Ancestry", options={"id"="baseId"})
     * @ParamConverter("feat", class="App\Entity\Core\Feat", options={"id"="id"})
     */
    public function editAncestryFeatAction(Request $request, Ancestry $ancestry, Feat $feat, EntityControllerHelper $entityControllerHelper)
    {
        $result = $entityControllerHelper->editEntity($request, FeatType::class, $feat);

        if ($result) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addEntityActionFlash(Feat::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('ancestry_show', ['slug' => $ancestry->getSlug()]);
        }

        $templateData = [
            'form' => $entityControllerHelper->getEntityForm()->createView(),
            'entityName' => Feat::ENTITY_NAME,
            'formattedEntityName' => Feat::getFormattedName(),
            'actionName' => BaseController::ENTITY_EDIT_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/ancestry/{id}/heritage/create", name="ancestry_heritage_create")
     * @Template("base/base_form.html.twig")
     */
    public function createAncestryHeritageAction(Request $request, Ancestry $ancestry)
    {
        $form = $this->createForm(HeritageType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $heritage = $form->getData();

            $ancestry->addHeritage($heritage);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($heritage);
            $entityManager->persist($ancestry);
            $entityManager->flush();

            $this->addEntityActionFlash(Heritage::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('ancestry_show', ['slug' => $ancestry->getSlug()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Heritage::ENTITY_NAME,
            'formattedEntityName' => Heritage::getFormattedName(),
            'actionName' => BaseController::ENTITY_CREATE_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/ancestry/{baseId}/heritage/{id}/edit", name="ancestry_heritage_edit")
     * @Template("base/base_form.html.twig")
     * @ParamConverter("ancestry", class="App\Entity\Ancestry\Ancestry", options={"id"="baseId"})
     * @ParamConverter("heritage", class="App\Entity\Ancestry\Heritage", options={"id"="id"})
     */
    public function editAncestryHeritageAction(Request $request, Ancestry $ancestry, Heritage $heritage)
    {
        $form = $this->createForm(HeritageType::class, $heritage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $heritage = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($heritage);
            $entityManager->flush();

            $this->addEntityActionFlash(Heritage::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('ancestry_show', ['slug' => $ancestry->getSlug()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Heritage::ENTITY_NAME,
            'formattedEntityName' => Heritage::getFormattedName(),
            'actionName' => BaseController::ENTITY_EDIT_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/ancestry/{id}/paragraph/create", name="ancestry_paragraph_create")
     * @Template("base/base_form.html.twig")
     */
    public function createAncestryParagraphAction(Request $request, Ancestry $ancestry)
    {
        $form = $this->createForm(ParagraphType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paragraph = $form->getData();

            $ancestry->addParagraph($paragraph);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($paragraph);
            $entityManager->persist($ancestry);
            $entityManager->flush();

            $this->addEntityActionFlash(Paragraph::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('ancestry_show', ['slug' => $ancestry->getSlug()]);
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
     * @Route("/admin/ancestry/{baseId}/paragraph/{id}/edit", name="ancestry_paragraph_edit")
     * @Template("base/base_form.html.twig")
     * @ParamConverter("ancestry", class="App\Entity\Ancestry\Ancestry", options={"id"="baseId"})
     * @ParamConverter("paragraph", class="App\Entity\Core\Paragraph", options={"id"="id"})
     */
    public function editAncestryParagraphAction(Request $request, Ancestry $ancestry, Paragraph $paragraph)
    {
        $form = $this->createForm(ParagraphType::class, $paragraph);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paragraph = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($paragraph);
            $entityManager->persist($ancestry);
            $entityManager->flush();

            $this->addEntityActionFlash(Paragraph::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('ancestry_show', ['slug' => $ancestry->getSlug()]);
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