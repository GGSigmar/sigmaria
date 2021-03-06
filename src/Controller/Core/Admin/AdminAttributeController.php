<?php

namespace App\Controller\Core\Admin;

use App\Controller\Base\BaseController;
use App\Entity\Core\Attribute;
use App\Form\Core\AttributeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminAttributeController extends BaseController
{
    /**
     * @Route("/admin/core/trait/list", name="trait_list")
     * @Template("core/trait/list.html.twig")
     */
    public function listAttributesAction()
    {
        $attributes = $this->getDoctrine()->getRepository(Attribute::class)->findAll();

        $templateData = [
            'attributes' => $attributes,
            'entityName' => Attribute::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/trait/create", name="trait_create")
     * @Template("base/base_form.html.twig")
     */
    public function createAttributeAction(Request $request)
    {
        $form = $this->createForm(AttributeType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attribute = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($attribute);
            $entityManager->flush();

            $this->addEntityActionFlash(Attribute::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('trait_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Attribute::ENTITY_NAME,
            'formattedEntityName' => Attribute::getFormattedName(),
            'actionName' => BaseController::ENTITY_CREATE_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/trait/{id}/edit", name="trait_edit")
     * @Template("base/base_form.html.twig")
     */
    public function editAttributeAction(Request $request, Attribute $attribute)
    {
        $form = $this->createForm(AttributeType::class, $attribute);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attribute = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($attribute);
            $entityManager->flush();

            $this->addEntityActionFlash(Attribute::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('trait_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Attribute::ENTITY_NAME,
            'formattedEntityName' => Attribute::getFormattedName(),
            'actionName' => BaseController::ENTITY_EDIT_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/trait/{id}/kill", name="trait_kill")
     */
    public function killAttributeAction(Attribute $attribute)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $attribute->setIsActive(false);

        $entityManager->persist($attribute);
        $entityManager->flush();

        $this->addEntityActionFlash(Attribute::getFormattedName(), BaseController::ENTITY_KILL_ACTION);

        return $this->redirectToRoute('trait_list');
    }

    /**
     * @Route("/admin/core/trait/{id}/revive", name="trait_revive")
     */
    public function reviveAttributeAction(Attribute $attribute)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $attribute->setIsActive(true);

        $entityManager->persist($attribute);
        $entityManager->flush();

        $this->addEntityActionFlash(Attribute::getFormattedName(), BaseController::ENTITY_REVIVE_ACTION);

        return $this->redirectToRoute('trait_list');
    }

    /**
     * @Route("/admin/core/trait/{id}/delete", name="trait_delete")
     */
    public function deleteAttributeAction(Attribute $attribute)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($attribute);
        $entityManager->flush();

        $this->addEntityActionFlash(Attribute::getFormattedName(), BaseController::ENTITY_DELETE_ACTION);

        return $this->redirectToRoute('trait_list');
    }
}