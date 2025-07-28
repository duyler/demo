<?php

declare(strict_types=1);

namespace Market\Application\Aspect;

use Duyler\Config\ConfigInterface;
use Duyler\Http\Exception\NotFoundHttpException;

final class DeniedForProdEnv
{
    public function __construct(
        private ConfigInterface $config,
    ) {}

    /**
     * @throws NotFoundHttpException
     */
    public function __invoke(): void
    {
        if ($this->config->env('APP_ENV') === 'prod') {
            throw new NotFoundHttpException();
        }
    }
}
