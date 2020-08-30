<?php

namespace App\Controller\Admin\Core;

use App\Controller\Base\BaseController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Core\Source;
use App\Form\Core\SourceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminSourceController extends BaseController
{
    /**
     * @Route("/admin/core/source/list", name="source_list")
     * @Template("core/source/list.html.twig")
     */
    public function listSourcesAction()
    {
        $sources = $this->getDoctrine()->getRepository(Source::class)->findAll();

        $templateData = [
            'sources' => $sources,
            'entityName' => Source::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/source/create", name="source_create")
     * @Template("base/base_form.html.twig")
     */
    public function createSourceAction(Request $request)
    {
        $form = $this->createForm(SourceType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $source = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($source);
            $entityManager->flush();

            $this->addEntityActionFlash(Source::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('source_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Source::ENTITY_NAME,
            'formattedEntityName' => Source::getFormattedName(),
            'actionName' => BaseController::ENTITY_CREATE_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/source/{id}/edit", name="source_edit")
     * @Template("base/base_form.html.twig")
     */
    public function editSourceAction(Request $request, Source $source)
    {
        $form = $this->createForm(SourceType::class, $source);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $source = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($source);
            $entityManager->flush();

            $this->addEntityActionFlash(Source::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('source_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Source::ENTITY_NAME,
            'formattedEntityName' => Source::getFormattedName(),
            'actionName' => BaseController::ENTITY_EDIT_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/source/{id}/kill", name="source_kill")
     */
    public function killSourceAction(Source $source)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $source->setIsActive(false);

        $entityManager->persist($source);
        $entityManager->flush();

        $this->addEntityActionFlash(Source::getFormattedName(), BaseController::ENTITY_KILL_ACTION);

        return $this->redirectToRoute('source_list');
    }

    /**
     * @Route("/admin/core/source/{id}/revive", name="source_revive")
     */
    public function reviveSourceAction(Source $source)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $source->setIsActive(true);

        $entityManager->persist($source);
        $entityManager->flush();

        $this->addEntityActionFlash(Source::getFormattedName(), BaseController::ENTITY_REVIVE_ACTION);

        return $this->redirectToRoute('source_list');
    }

    /**
     * @Route("/admin/core/source/{id}/delete", name="source_delete")
     */
    public function deleteSourceAction(Source $source)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($source);
        $entityManager->flush();

        $this->addEntityActionFlash(Source::getFormattedName(), BaseController::ENTITY_DELETE_ACTION);

        return $this->redirectToRoute('source_list');
    }
}