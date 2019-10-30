<?php

namespace App\Controller\Ancestry;

use App\Entity\Ancestry\AncestralFeature;
use App\Form\Ancestry\AncestralFeatureType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AncestralFeatureController extends AbstractController
{
    /**
     * @Route("/ancestry/feature/list", name="list_ancestral_features")
     * @Template("ancestry/feature/list.html.twig")
     */
    public function listAncestralFeaturesAction() {
        $ancestralFeatures = $this->getDoctrine()->getRepository(AncestralFeature::class)
            ->findBy(['isActive' => true]);

        return [
            'ancestralFeatures' => $ancestralFeatures,
        ];
    }

    /**
     * @Route("/ancestry/feature/create", name="create_ancestral_feature")
     * @Template("ancestry/feature/form.html.twig")
     */
    public function createAncestralFeatureAction(Request $request) {
        $form = $this->createForm(AncestralFeatureType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ancestralFeature = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ancestralFeature);
            $entityManager->flush();

            $this->addFlash('success', 'Ancestral feature created!');

            return $this->redirectToRoute('list_ancestral_features');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/ancestry/feature/{id}/edit", name="edit_ancestral_feature")
     * @Template("ancestry/feature/form.html.twig")
     */
    public function editAncestralFeatureAction(Request $request, AncestralFeature $ancestralFeature) {
        $form = $this->createForm(AncestralFeatureType::class, $ancestralFeature);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ancestralFeature = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ancestralFeature);
            $entityManager->flush();

            $this->addFlash('success', 'Ancestral feature edited!');

            return $this->redirectToRoute('list_ancestral_features');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/ancestry/feature/{id}/delete", name="delete_ancestral_feature")
     */
    public function deleteWeaponPropertyAction(AncestralFeature $ancestralFeature) {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($ancestralFeature);
        $entityManager->flush();

        $this->addFlash('success', 'Ancestral feature deleted!');
        $this->addFlash('warning', 'Ancestral feature removed from ancestries!');

        return $this->redirectToRoute('list_ancestral_features');
    }
}