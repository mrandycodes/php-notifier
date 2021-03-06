<?php

declare(strict_types=1);

namespace Tests\Notifier\Notification\Infrastructure\Behat;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Driver\DriverInterface;
use Behat\Mink\Driver\GoutteDriver;
use Behat\Mink\Session;
use Behat\MinkExtension\Context\RawMinkContext;
use Goutte\Client;
use PHPUnit\Framework\Assert;
use Symfony\Component\DomCrawler\Crawler;

final class ApiFeatureContext extends RawMinkContext
{
    private Session $session;

    public function __construct()
    {
        $client = new Client();
        $driver = new GoutteDriver($client);

        $this->session = new Session($driver);
    }

    /**
     * @Given I send a :method request to :url with body:
     */
    public function iSendARequestToWithBody($method, $url, PyStringNode $body): void
    {
        $this->sendRequest($method, $this->locatePath($url), ['content' => $body->getRaw()]);
    }

    /**
     * @Then the response status code should be :expectedResponseCode
     */
    public function theResponseStatusCodeShouldBe($expectedResponseCode): void
    {
        Assert::assertSame((int) $expectedResponseCode, $this->session->getStatusCode());
    }

    public function sendRequest(string $method, string $url, array $optionalParams = []): Crawler
    {
        $defaultOptionalParams = [
            'parameters'    => [],
            'files'         => [],
            'server'        => ['HTTP_ACCEPT' => 'application/json', 'CONTENT_TYPE' => 'application/json'],
            'content'       => null,
            'changeHistory' => true,
        ];

        $optionalParams = array_merge($defaultOptionalParams, $optionalParams);

        $crawler = $this->getClient()->request(
            $method,
            $url,
            $optionalParams['parameters'],
            $optionalParams['files'],
            $optionalParams['server'],
            $optionalParams['content'],
            $optionalParams['changeHistory']
        );

        $this->resetRequestStuff();

        return $crawler;
    }

    private function getDriver(): DriverInterface
    {
        return $this->session->getDriver();
    }

    private function getClient(): Client
    {
        return $this->getDriver()->getClient();
    }

    private function resetRequestStuff(): void
    {
        $this->getSession()->reset();
        $this->resetServerParameters();
    }

    public function resetServerParameters(): void
    {
        $this->getClient()->setServerParameters([]);
    }
}
