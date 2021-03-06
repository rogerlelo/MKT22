<?php
use CodeEmailMKT\Domain\Service\AuthInterface;
use CodeEmailMKT\Domain\Service\CampaignEmailSenderInterface;
use CodeEmailMKT\Domain\Service\FlashMessageInterface;
use CodeEmailMKT\Infrastructure\Service\AuthServiceFactory;
use CodeEmailMKT\Infrastructure\Service\CampaignEmailSenderFactory;
use CodeEmailMKT\Infrastructure\Service\FlashMessageFactory;
use CodeEmailMKT\Infrastructure\Service\MailgunFactory;
use Mailgun\Mailgun;
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;
use CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository\CustomerRepositoryFactory;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository\TagRepositoryFactory;
use CodeEmailMKT\Domain\Persistence\TagRepositoryInterface;
use CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository\CampaignRepositoryFactory;
use CodeEmailMKT\Domain\Persistence\CampaignRepositoryInterface;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Application::class => ApplicationFactory::class,
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
            CustomerRepositoryInterface::class => CustomerRepositoryFactory::class,
            TagRepositoryInterface::class => TagRepositoryFactory::class,
            CampaignRepositoryInterface::class => CampaignRepositoryFactory::class,/////////////////////
            FlashMessageInterface::class => FlashMessageFactory::class,
            'doctrine:fixtures_cmd:load'   => \CodeEdu\FixtureFactory::class,
            AuthInterface::class => AuthServiceFactory::class,
            Mailgun::class => MailgunFactory::class,
            CampaignEmailSenderInterface::class => CampaignEmailSenderFactory::class
        ],
        'aliases' => [
            'Configuration' => 'config', //Doctrine needs a service called Configuration
            'Config' => 'config', //Doctrine needs a service called Configuration
            \Zend\Authentication\AuthenticationService::class => 'doctrine.authenticationservice.orm_default'
        ],
    ],
    'debug' => true,
    'config_cache_enabled' => false,
];
