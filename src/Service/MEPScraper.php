<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class MEPScraper
{
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function scrapeContactInfo(array $urls): array
    {
        $contacts = [];

        foreach ($urls as $url) {
            $responses = $this->httpClient->request('GET', $url);
            $crawler = new Crawler($responses->getContent());

            // Scrape contact information from the response
            $contactNodes = $crawler->filter('.erpl_contact-card-list > span');

            $contactList = [];
            $contactNodes->each(function ($node) use (&$contactList) {
                $contactList[] = $node->text();
            });

            $contacts[] = $contactList;
        }

        return $contacts;


//
//        $mepIndex = array_search($responses->getInfo('url'), $urls);
//        $mep = $meps[$mepIndex];
//        $mep->setContacts($contacts);

//        foreach ($responses as $response) {
//            $crawler = new Crawler($response->getContent());
//
//            // Scrape contact information from the response
//            $contactNodes = $crawler->filter('.erpl_contact-card-list > li');
//
//            $contacts = [];
//            foreach ($contactNodes as $node) {
//                $type = trim($node->filter('.erpl_contact-card-label')->text());
//                $value = trim($node->filter('.erpl_contact-card-value')->text());
//                $contacts[$type] = $value;
//            }
//            $mepIndex = array_search($response->getInfo('url'), $urls);
//            $mep = $meps[$mepIndex];
//            $mep->setContacts($contacts);
//
//        }
    }
}