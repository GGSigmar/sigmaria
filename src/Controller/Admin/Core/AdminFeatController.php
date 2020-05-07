<?php

namespace App\Controller\Admin\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\EntitySource;
use App\Entity\Core\Feat;
use App\Form\Core\FeatType;
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
     * @Template("core/feat/create.html.twig")
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

            $this->addFlash('success', 'Atut stworzony!');

            return $this->redirectToRoute('feat_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'feat',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/core/feat/{id}/edit", name="feat_edit")
     * @Template("core/feat/edit.html.twig")
     */
    public function editFeatAction(Request $request, Feat $feat, SourcableService $sourcableService)
    {
        $form = $this->createForm(FeatType::class, $feat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feat = $form->getData();

            $sourcableService->ensureEmptySourceNullification($feat);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feat);
            $entityManager->flush();

            $this->addFlash('success', 'Atut zmieniony!');

            return $this->redirectToRoute('feat_show', ['id' => $feat->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'feat',
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

        $this->addFlash('warning', 'Atut zabity!');

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

        $this->addFlash('success', 'Atut wskrzeszony!');

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

        $this->addFlash('danger', 'Atut usunięty!');

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

        $this->addFlash('success', 'Atut oznaczony do wydania!');

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

        $this->addFlash('warning', 'Atut wyłączony z wydania!');

        return $this->redirectToReferer($request);
    }
}