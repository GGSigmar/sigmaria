<?php

namespace App\Controller\Admin\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\CharacterCreationStep;
use App\Form\Core\CharacterCreationStepType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminCharacterCreationStepController extends BaseController
{
    /**
     * @Route("/admin/core/character-creation-step/list", name="character_creation_step_list")
     * @Template("core/character_creation_step/list.html.twig")
     */
    public function listCharacterCreationStepsAction()
    {
        $characterCreationSteps = $this->getDoctrine()->getRepository(CharacterCreationStep::class)->findAll();

        $templateData = [
            'steps' => $characterCreationSteps,
            'entityName' => CharacterCreationStep::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/character-creation-step/create", name="character_creation_step_create")
     * @Template("core/character_creation_step/create.html.twig")
     */
    public function createCharacterCreationStepAction(Request $request)
    {
        $form = $this->createForm(CharacterCreationStepType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $characterCreationStep = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($characterCreationStep);
            $entityManager->flush();

            $this->addFlash('success', 'Krok tworznia postaci stworzony!');

            return $this->redirectToRoute('character_creation_step_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => CharacterCreationStep::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/character-creation-step/{id}/edit", name="character_creation_step_edit")
     * @Template("core/character_creation_step/edit.html.twig")
     */
    public function editCharacterCreationStepAction(Request $request, CharacterCreationStep $characterCreationStep)
    {
        $form = $this->createForm(CharacterCreationStepType::class, $characterCreationStep);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $characterCreationStep = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($characterCreationStep);
            $entityManager->flush();

            $this->addFlash('success', 'Krok tworznia postaci zmieniony!');

            return $this->redirectToRoute('character_creation_step_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => CharacterCreationStep::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/character-creation-step/{id}/kill", name="character_creation_step_kill")
     */
    public function killCharacterCreationStepAction(CharacterCreationStep $characterCreationStep)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $characterCreationStep->setIsActive(false);

        $entityManager->persist($characterCreationStep);
        $entityManager->flush();

        $this->addFlash('warning', 'Krok tworznia postaci zabity!');

        return $this->redirectToRoute('character_creation_step_list');
    }

    /**
     * @Route("/admin/core/character-creation-step/{id}/revive", name="character_creation_step_revive")
     */
    public function reviveCharacterCreationStepAction(CharacterCreationStep $characterCreationStep)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $characterCreationStep->setIsActive(true);

        $entityManager->persist($characterCreationStep);
        $entityManager->flush();

        $this->addFlash('success', 'Krok tworznia postaci wskrzeszony!');

        return $this->redirectToRoute('character_creation_step_list');
    }

    /**
     * @Route("/admin/core/character-creation-step/{id}/delete", name="character_creation_step_delete")
     */
    public function deleteCharacterCreationStepAction(CharacterCreationStep $characterCreationStep)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($characterCreationStep);
        $entityManager->flush();

        $this->addFlash('danger', 'Krok tworznia postaci usunięty!');

        return $this->redirectToRoute('character_creation_step_list');
    }
}