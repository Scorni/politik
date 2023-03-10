<?php

namespace App\Service;

use App\Entity\MEP;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MEPImporter
{
    private $httpClient;
    private $serializer;

    public function __construct(HttpClientInterface $httpClient,EntityManagerInterface $entityManager)
    {
        $this->httpClient = $httpClient;
        $this->entityManager = $entityManager;
        $encoders = [new XmlEncoder()];
        $normalizers = [new ObjectNormalizer(null, null, null, null, null, null, [MEP::class]), new ArrayDenormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function import()
    {
        $response = $this->httpClient->request('GET', 'https://www.europarl.europa.eu/meps/en/full-list/xml/a');

        $xml = $response->getContent();
        $data = $this->serializer->decode($xml, 'xml');

        $meps = $this->serializer->denormalize($data['mep'], MEP::class.'[]');
        $urls = [];
        foreach ($meps as $mep) {
            $formattedName = strtoupper(str_replace(' ', '_', $mep->getFullname()));
            $urls[] = "https://www.europarl.europa.eu/meps/en/{$mep-> getId()}/{$formattedName}/home";
        }
        $mepScraper = new MEPScraper($this->httpClient);
        $mepContacts = $mepScraper->scrapeContactInfo($urls);
        foreach ($meps as $index => $mep) {
            $mep->setContacts($mepContacts[$index]);
            $this->entityManager->persist($mep);
        }
        $this->entityManager->flush();
        return $meps;
    }
}
