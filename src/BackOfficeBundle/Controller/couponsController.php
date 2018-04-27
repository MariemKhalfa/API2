<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Coupons;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile ;
/**
 * Coupon controller.
 *
 */
class couponsController extends Controller
{
    /**
     * Lists all coupon entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $coupons = $em->getRepository('BackOfficeBundle:Coupons')->findAll();

        return $this->render('coupons/index.html.twig', array(
            'coupons' => $coupons,
        ));
    }

    /**
     * Creates a new coupon entity.
     *
     */
    public function newAction(Request $request)
    {
        $coupon = new Coupons();
        $form = $this->createForm('BackOfficeBundle\Form\couponsType', $coupon);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid())
        {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $coupon->getImageCoupon();

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
            $coupon->setImageCoupon($fileName);

            // ... persist the $product variable or any other work

            dump($coupon);
            $em->persist($coupon);
            $em->flush();

            return $this->redirectToRoute('coupons_show', array('id' => $coupon->getId()));
        }

        return $this->render('coupons/new.html.twig', array(
            'coupon' => $coupon,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a coupon entity.
     *
     */
    public function showAction(Coupons $coupon)
    {
        $deleteForm = $this->createDeleteForm($coupon);

        return $this->render('coupons/show.html.twig', array(
            'coupon' => $coupon,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing coupon entity.
     *
     */
    public function editAction(Request $request, Coupons $coupon)
    {
        $deleteForm = $this->createDeleteForm($coupon);
        $editForm = $this->createForm('BackOfficeBundle\Form\couponsType', $coupon);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coupons_edit', array('id' => $coupon->getId()));
        }

        return $this->render('coupons/edit.html.twig', array(
            'coupon' => $coupon,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a coupon entity.
     *
     */
    public function deleteAction(Request $request, Coupons $coupon)
    {
        $form = $this->createDeleteForm($coupon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($coupon);
            $em->flush();
        }

        return $this->redirectToRoute('coupons_index');
    }

    /**
     * Creates a form to delete a coupon entity.
     *
     * @param coupons $coupon The coupon entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Coupons $coupon)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('coupons_delete', array('id' => $coupon->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
