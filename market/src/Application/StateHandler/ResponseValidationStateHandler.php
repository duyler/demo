<?php

declare(strict_types=1);

namespace Market\Application\StateHandler;

use Duyler\EventBus\Contract\State\MainCyclicStateHandlerInterface;
use Duyler\EventBus\State\Service\StateMainCyclicService;
use Duyler\EventBus\State\StateContext;
use Duyler\Http\Event\Response;
use League\OpenAPIValidation\PSR7\OperationAddress;
use League\OpenAPIValidation\PSR7\ResponseValidator;
use League\OpenAPIValidation\PSR7\ValidatorBuilder;
use Market\Application\Config\OpenApiConfig;
use Override;
use Psr\Http\Message\ResponseInterface;

final class ResponseValidationStateHandler implements MainCyclicStateHandlerInterface
{
    private ResponseValidator $responseValidator;

    public function __construct(
        OpenApiConfig $openApiConfig,
        ValidatorBuilder $validatorBuilder,
    ) {
        $this->responseValidator = $validatorBuilder
            ->fromYamlFile($openApiConfig->pathToOpenApiSpec)
            ->getResponseValidator();
    }

    #[Override]
    public function handle(StateMainCyclicService $stateService, StateContext $context): void
    {
        if (false === $stateService->resultIsExists(Response::ResponseCreated)) {
            return;
        }

        /** @var OperationAddress $operationAddress */
        $operationAddress = $context->read('operationAddress');

        if (null === $operationAddress) {
            return;
        }

        /** @var ResponseInterface $response */
        $response = $stateService->getResult(Response::ResponseCreated)->data;

        $this->responseValidator->validate($operationAddress, $response);
    }
}
