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
            'entityName' => 'source',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/source/create", name="source_create")
     * @Template("core/source/create.html.twig")
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

            $this->addFlash('success', 'Źródło stworzone!');

            return $this->redirectToRoute('source_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'source',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/source/{id}/edit", name="source_edit")
     * @Template("core/source/edit.html.twig")
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

            $this->addFlash('success', 'Źródło zmienione!');

            return $this->redirectToRoute('source_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'source',
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

        $this->addFlash('warning', 'Źródło zabite!');

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

        $this->addFlash('success', 'Źródło wskrzeszone!');

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

        $this->addFlash('danger', 'Dziedzina wiedzy usunięta!');

        return $this->redirectToRoute('source_list');
    }
}