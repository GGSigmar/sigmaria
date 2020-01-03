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
     * @Route("/admin/ancestry/feature/create", name="ancestral_feature_create")
     * @Template("ancestry/feature/form.html.twig")
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

            $this->addFlash('success', 'Zdolność rasowa stworzona!');

            return $this->redirectToRoute('ancestral_feature_list');
        }

        $templateData = [
            'form' => $form->createView()
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/ancestry/feature/{id}/edit", name="ancestral_feature_edit")
     * @Template("ancestry/feature/form.html.twig")
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

            $this->addFlash('success', 'Zdolność rasowa edytowana!');

            return $this->redirectToRoute('ancestral_feature_list');
        }

        $templateData = [
            'form' => $form->createView()
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/ancestry/feature/{id}/delete", name="ancestral_feature_delete")
     */
    public function deleteWeaponPropertyAction(AncestralFeature $ancestralFeature)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $ancestralFeature->setIsActive(false);

        $entityManager->persist($ancestralFeature);
        $entityManager->flush();

        $this->addFlash('success', 'Zdolność rasowa usunięta!');
        $this->addFlash('warning', 'Zdolność rasowa usunięta z ras!');

        return $this->redirectToRoute('ancestral_feature_list');
    }
}