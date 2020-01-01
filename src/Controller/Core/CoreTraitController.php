<?php

namespace App\Controller\Core;

use App\Entity\Core\CoreTrait;
use App\Form\Core\CoreTraitType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class CoreTraitController extends CoreController
{
    /**
     * @Route("/core/trait/list", name="list_core_traits")
     * @Template("core/trait/list.html.twig")
     */
    public function listTraitsAction()
    {
        $traits = $this->getDoctrine()->getRepository(CoreTrait::class)
            ->findBy(['isActive' => true]);

        $templateData = [
            'traits' => $traits,
            'entityName' => 'core_trait',
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/core/trait/create", name="create_core_trait")
     * @Template("core/trait/form.html.twig")
     */
    public function createTraitAction(Request $request)
    {
        $form = $this->createForm(CoreTraitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trait = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trait);
            $entityManager->flush();

            $this->addFlash('success', 'Cecha stworzona!');

            return $this->redirectToRoute('list_core_traits');
        }

        $templateData = [
            'form' => $form->createView(),
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/core/trait/{id}/edit", name="edit_core_trait")
     * @Template("core/trait/form.html.twig")
     */
    public function editTraitAction(Request $request, CoreTrait $trait)
    {
        $form = $this->createForm(CoreTraitType::class, $trait);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trait = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trait);
            $entityManager->flush();

            $this->addFlash('success', 'Cecha zmieniona!');

            return $this->redirectToRoute('list_core_traits');
        }

        $templateData = [
            'form' => $form->createView(),
        ];

        return array_merge($templateData, $this->getTemplateData(CoreController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/core/trait/{id}/delete", name="delete_core_trait")
     */
    public function deleteTraitAction(CoreTrait $trait)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $trait->setIsActive(false);

        $entityManager->persist($trait);
        $entityManager->flush();

        $this->addFlash('success', 'Cecha usunięta!');

        return $this->redirectToRoute('list_core_traits');
    }
}