<?php

namespace App\Controller\Equipment\Weapon;

use App\Entity\Equipment\Weapon\WeaponProperty;
use App\Form\Equipment\Weapon\WeaponPropertyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WeaponPropertyController extends AbstractController
{
    /**
     * @Route("/equipment/weapon/property/list", name="list_weapon_properties")
     * @Template("equipment/weapon/property/list.html.twig")
     */
    public function listWeaponPropertiesAction() {
        $weaponProperties = $this->getDoctrine()->getRepository(WeaponProperty::class)
            ->findBy(['isActive' => true]);

        return [
            'weaponProperties' => $weaponProperties,
        ];
    }

    /**
     * @Route("/equipment/weapon/property/create", name="create_weapon_property")
     * @Template("equipment/weapon/property/form.html.twig")
     */
    public function createWeaponPropertyAction(Request $request) {
        $form = $this->createForm(WeaponPropertyType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weaponProperty = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($weaponProperty);
            $entityManager->flush();

            $this->addFlash('success', 'Weapon property created!');

            return $this->redirectToRoute('list_weapon_properties');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/equipment/weapon/property/{id}/edit", name="edit_weapon_property")
     * @Template("equipment/weapon/property/form.html.twig")
     */
    public function editWeaponPropertyAction(Request $request, WeaponProperty $weaponProperty) {
        $form = $this->createForm(WeaponPropertyType::class, $weaponProperty);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weaponProperty = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($weaponProperty);
            $entityManager->flush();

            $this->addFlash('success', 'Weapon property edited!');

            return $this->redirectToRoute('list_weapon_properties');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/equipment/weapon/property/{id}/delete", name="delete_weapon_property")
     */
    public function deleteWeaponPropertyAction(WeaponProperty $weaponProperty) {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($weaponProperty);
        $entityManager->flush();

        $this->addFlash('success', 'Weapon property removed!');

        return $this->redirectToRoute('list_weapon_properties');
    }
}