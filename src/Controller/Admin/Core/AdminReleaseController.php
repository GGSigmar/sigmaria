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
     * @Route("/admin/core/release/create", name="release_create")
     * @Template("core/release/create.html.twig")
     */
    public function createReleaseAction(Request $request, ReleaseService $releaseService)
    {
        $form = $this->createForm(ReleaseType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $release = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($release);
            $entityManager->flush();

            $this->addEntityActionFlash(Release::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('release_show', ['id' => $release->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Release::ENTITY_NAME,
            'bag' => $releaseService->getContentToBeReleased(),
            'formattedEntityName' => Release::getFormattedName(),
            'actionName' => BaseController::ENTITY_CREATE_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/release/{id}/edit", name="release_edit")
     * @Template("base/base_form.html.twig")
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

            $this->addEntityActionFlash(Release::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('release_show', ['id' => $release->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Release::ENTITY_NAME,
            'formattedEntityName' => Release::getFormattedName(),
            'actionName' => BaseController::ENTITY_EDIT_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/release/{id}/launch", name="release_launch")
     */
    public function launchReleaseAction(Release $release, ReleaseService $releaseService)
    {
        $releaseService->releaseContent($release);

        $this->addFlash('success', 'Release launched!');

        return $this->redirectToRoute('release_show', ['id' => $release->getId()]);
    }
}