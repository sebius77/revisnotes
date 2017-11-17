<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testUrls($url)
    {
      $client = static::createClient();

      $client->request('GET', $url);

      $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function provideUrls()
    {
        return [
          ['/'],
        ];
    }
}
