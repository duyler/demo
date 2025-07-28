<?php

declare(strict_types=1);

namespace Market\Application\StateHandler;

use Duyler\EventBus\Contract\State\MainAfterStateHandlerInterface;
use Duyler\EventBus\State\Service\StateMainAfterService;
use Duyler\EventBus\State\StateContext;
use Duyler\Http\Action\Request;
use League\OpenAPIValidation\PSR7\OperationAddress;
use League\OpenAPIValidation\PSR7\ServerRequestValidator;
use League\OpenAPIValidation\PSR7\ValidatorBuilder;
use Market\Application\Config\OpenApiConfig;
use Override;
use Psr\Http\Message\ServerRequestInterface;

final class RequestValidationStateHandler implements MainAfterStateHandlerInterface
{
    private ServerRequestValidator $requestValidator;

    public function __construct(
        OpenApiConfig $openApiConfig,
        ValidatorBuilder $validatorBuilder,
    ) {
        $this->requestValidator = $validatorBuilder
            ->fromYamlFile($openApiConfig->pathToOpenApiSpec)
            ->getServerRequestValidator();
    }

    #[Override]
    public function handle(StateMainAfterService $stateService, StateContext $context): void
    {
        /** @var ServerRequestInterface $request */
        $request = $stateService->getResultData();

        if (false === $this->requestValidator->getSchema()->paths->hasPath($request->getUri()->getPath())) {
            return;
        }

        $body = clone $request->getBody();

        $this->requestValidator->validate($request->withBody($body));

        $context->write(
            'operationAddress',
            new OperationAddress(
                $request->getUri()->getPath(),
                strtolower($request->getMethod()),
            ),
        );
    }

    #[Override]
    public function observed(StateContext $context): array
    {
        return [Request::GetRequest];
    }
}
