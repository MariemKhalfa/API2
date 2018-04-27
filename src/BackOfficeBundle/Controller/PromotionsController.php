<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Promotions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile ;

/**
 * Promotion controller.
 *
 */
class PromotionsController extends Controller
{
    /**
     * Lists all promotion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $promotions = $em->getRepository('BackOfficeBundle:Promotions')->findAll();

        return $this->render('promotions/index.html.twig', array(
            'promotions' => $promotions,
        ));
    }

    /**
     * Creates a new promotion entity.
     *
     */
    public function newAction(Request $request)
    {
        $promotion = new Promotions();
        $form = $this->createForm('BackOfficeBundle\Form\PromotionsType', $promotion);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid())
        {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $promotion->getImage();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('brochures_directory'),
                $fileName
            ); //definitlou brochures_directory win ?nsitXD shit bruh




           //definitlou brochures_directory win ?nsitXD shit bruh

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $promotion->setImage($fileName);

            // ... persist the $product variable or any other work

            dump($promotion);
            $em->persist($promotion);
            $em->flush();

            return $this->redirectToRoute('promotions_show', array('id' => $promotion->getId()));
        }




        return $this->render('promotions/new.html.twig', array(
            'promotion' => $promotion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a promotion entity.
     *
     */
    public function showAction(Promotions $promotion)
    {
        $deleteForm = $this->createDeleteForm($promotion);

        return $this->render('promotions/show.html.twig', array(
            'promotion' => $promotion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing promotion entity.
     *
     */
    public function editAction(Request $request, Promotions $promotion)
    {
        $deleteForm = $this->createDeleteForm($promotion);
        $editForm = $this->createForm('BackOfficeBundle\Form\PromotionsType', $promotion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promotions_edit', array('id' => $promotion->getId()));
        }

        return $this->render('promotions/edit.html.twig', array(
            'promotion' => $promotion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a promotion entity.
     *
     */
    public function deleteAction(Request $request, Promotions $promotion)
    {
        $form = $this->createDeleteForm($promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($promotion);
            $em->flush();
        }

        return $this->redirectToRoute('promotions_index');
    }

    /**
     * Creates a form to delete a promotion entity.
     *
     * @param Promotions $promotion The promotion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Promotions $promotion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('promotions_delete', array('id' => $promotion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
