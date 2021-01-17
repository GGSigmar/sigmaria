<?php

namespace App\Service\Core;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class EditHelper
{
    /** @var FormFactoryInterface */
    private $formFactory;

    /** @var SourcableService */
    private $sourcableService;

    /** @var EntityManagerInterface */
    private $em;

    /** @var object|null */
    private $editedEntity;

    /** @var FormInterface|null */
    private $entityForm;

    public function __construct(
        FormFactoryInterface $formFactory,
        SourcableService $sourcableService,
        EntityManagerInterface $em
    ) {
        $this->formFactory = $formFactory;
        $this->sourcableService = $sourcableService;
        $this->em = $em;
    }

    public function getEditedEntity()
    {
        return $this->editedEntity;
    }

    public function getEntityForm()
    {
        return $this->entityForm;
    }

    public function editEntity(Request $request, string $formClass, $entity)
    {
        $edits = $entity->getEdits();

        if ($entity->isEdit()) {
            $entityToBeEdited = $entity;
        } else {
            $entityToBeEdited = $edits ? $edits : clone $entity;
        }

        $form = $this->formFactory->create($formClass, $entityToBeEdited);
        $this->entityForm = $form;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($entityToBeEdited->isEdit()) {
                $editedEntity = $form->getData();
            } else {
                $editedEntity = $form->getData();
                $editedEntity->setIsEdit(true);
                $editedEntity->setIsActive(true);
                $entity->setEdits($editedEntity);
                $editedEntity->setEditParent($entity);
            }

            if (property_exists($entity, 'source')) {
                $this->sourcableService->ensureEmptySourceNullification($editedEntity);
            }

            $this->em->persist($editedEntity);
            $this->em->persist($entity);

            $this->editedEntity = $editedEntity;
            return $editedEntity;
        }

        return null;
    }
}