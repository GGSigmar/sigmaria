<?php

namespace App\Controller\Admin\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\Release;
use App\Form\Core\ReleaseType;
use App\Service\Core\ReleaseService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminReleaseController extends BaseController
{
    /**
     * @Route("/admin/core/release/list", name="release_list")
     * @Template("core/release/list.html.twig")
     */
    public function listReleasesAction()
    {
        $releases = $this->getDoctrine()->getRepository(Release::class)->findAll();

        $templateData = [
            'releases' => $releases,
            'entityName' => 'release',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/release/{id}/show", name="release_show")
     * @Template("core/release/show.html.twig")
     */
    public function showReleaseAction(Release $release)
    {
        $templateData = [
            'release' => $release,
            'entityName' => 'release',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/release/create", name="release_create")
     * @Template("core/release/create.html.twig")
     */
    public function createReleaseAction(Request $request, ReleaseService $releaseService)
    {
        $form = $this->createForm(ReleaseType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $release = $form->getData();

            $release = $releaseService->releaseContent($release);

            $this->addFlash('success', 'Wydanie zrealizowane!');

            return $this->redirectToRoute('release_show', ['id' => $release->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'release',
            'contentToBeReleased' => $releaseService->getContentToBeReleased(),
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/release/{id}/edit", name="release_edit")
     * @Template("core/release/edit.html.twig")
     */
    public function editReleaseAction(Request $request, Release $release)
    {
        $form = $this->createForm(ReleaseType::class, $release);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $release = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($release);
            $entityManager->flush();

            $this->addFlash('success', 'Wydanie zmienione!');

            return $this->redirectToRoute('release_show', ['id' => $release->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'release',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }
}