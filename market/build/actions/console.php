<?php

declare(strict_types=1);

use Duyler\Builder\Build\Action\Action;
use Duyler\Config\ConfigInterface;
use Duyler\EventBus\Action\Context\ActionContext;
use Duyler\IO\File;
use Market\Application\Action\OpenAPI;
use Market\Application\Config\OpenApiConfig;
use Symfony\Component\Yaml\Yaml;

/**
 * @var ConfigInterface $config
 */

Action::declare(OpenAPI::GenerateUI)
    ->description('Generate Swagger UI json file')
    ->handler(function (ActionContext $context) {
        /** @var OpenApiConfig $oaConfig */
        $oaConfig = $context->call(fn(OpenApiConfig $oaConfig): OpenApiConfig => $oaConfig);

        $yaml = Yaml::parseFile($oaConfig->pathToOpenApiSpec);

        File::write(
            $oaConfig->pathToJsonForUI,
            json_encode($yaml, JSON_UNESCAPED_UNICODE),
        )->await();
    });
