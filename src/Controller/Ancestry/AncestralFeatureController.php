<?php

namespace App\Controller\Ancestry;

use App\Controller\Core\CoreController;
use App\Entity\Ancestry\AncestralFeature;
use App\Form\Ancestry\AncestralFeatureType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AncestralFeatureController extends CoreController
{
    /**
     * @Route("/ancestry/feature/list", name="list_ancestral_features")
     * @Template("ancestry/feature/list.html.twig")
     */
    public function listAncestralFeaturesAction()
    {
        $ancestralFeatures = $this->getDoctrine()->getRepository(AncestralFeature::class)
            ->findBy(['isActive' => true]);

        $templateData = [
            'ancestralFeatures' => $ancestralFeatures,
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_RULES));
    }

    /**
     * @Route("/ancestry/feature/create", name="create_ancestral_feature")
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

            return $this->redirectToRoute('list_ancestral_features');
        }

        $templateData = [
            'form' => $form->createView()
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_RULES));
    }

    /**
     * @Route("/ancestry/feature/{id}/edit", name="edit_ancestral_feature")
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

            return $this->redirectToRoute('list_ancestral_features');
        }

        $templateData = [
            'form' => $form->createView()
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_RULES));
    }

    /**
     * @Route("/ancestry/feature/{id}/delete", name="delete_ancestral_feature")
     */
    public function deleteWeaponPropertyAction(AncestralFeature $ancestralFeature)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $ancestralFeature->setIsActive(false);

        $entityManager->persist($ancestralFeature);
        $entityManager->flush();

        $this->addFlash('success', 'Zdolność rasowa usunięta!');
        $this->addFlash('warning', 'Zdolność rasowa usunięta z ras!');

        return $this->redirectToRoute('list_ancestral_features');
    }
}