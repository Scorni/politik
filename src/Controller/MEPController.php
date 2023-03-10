<?php

namespace App\Controller;

use App\Service\MEPImporter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MEPController extends AbstractController
{
    #[Route('/meps', name: 'app_m_e_p')]
    public function index(MEPImporter $mepImporter): Response
    {
        $meps = $mepImporter->import();

        return $this->render('components/mep.html.twig', [
            'meps' => $meps,
        ]);
    }
}
