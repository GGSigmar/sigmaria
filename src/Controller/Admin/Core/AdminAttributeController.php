<?php

namespace App\Controller\Admin\Core;

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
     * @Route("/core/attribute/list", name="attribute_list")
     * @Template("core/attribute/list.html.twig")
     */
    public function listAttributesAction()
    {
        $attributes = $this->getDoctrine()->getRepository(Attribute::class)->findAll();

        $templateData = [
            'attributes' => $attributes,
            'entityName' => 'attribute',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/attribute/create", name="attribute_create")
     * @Template("core/attribute/form.html.twig")
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

            $this->addFlash('success', 'Cecha stworzona!');

            return $this->redirectToRoute('attribute_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'attribute',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/attribute/{id}/edit", name="attribute_edit")
     * @Template("core/attribute/form.html.twig")
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

            $this->addFlash('success', 'Cecha zmieniona!');

            return $this->redirectToRoute('attribute_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'attribute',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/attribute/{id}/delete", name="attribute_delete")
     */
    public function deleteAttributeAction(Attribute $attribute)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $attribute->setIsActive(false);

        $entityManager->persist($attribute);
        $entityManager->flush();

        $this->addFlash('success', 'Cecha usunięta!');

        return $this->redirectToRoute('attribute_list');
    }

    /**
     * @Route("/admin/core/attribute/{id}/activate", name="attribute_activate")
     */
    public function activateAttributeAction(Attribute $attribute)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $attribute->setIsActive(true);

        $entityManager->persist($attribute);
        $entityManager->flush();

        $this->addFlash('success', 'Cecha aktywowana!');

        return $this->redirectToRoute('attribute_list');
    }
}