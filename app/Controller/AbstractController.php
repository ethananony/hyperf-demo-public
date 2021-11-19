<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\Support\Functions;
use App\Support\Response;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use Hyperf\Validation\ValidationException;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @Inject
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;

    /**
     * 响应成功信息.
     *
     * @param array $data
     * @return PsrResponseInterface
     */
    protected function success($data = [], string $msg = 'success', int $code = 0, array $extend = [])
    {
        $json = Response::json($code, $msg, $data, $extend);

        return $this->response->json($json);
    }

    /**
     * 响应失败信息.
     *
     * @param array $data
     * @return PsrResponseInterface
     */
    protected function failed(string $msg = 'failed', $data = [], int $code = 1, array $extend = [])
    {
        return $this->success($data, $msg, $code, $extend);
    }

    /**
     * 返回所有字段的参数验证
     *
     * @throws ValidationException
     * @return array
     */
    protected function validateAll(array $rules, array $messages = [], array $params = [])
    {
        if (empty($params)) {
            $params = $this->request->all();
        }

        $validator = $this->validationFactory->make($params, $rules, $messages);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $params;
    }

    /**
     * 只返回被验证字段的参数验证
     *
     * @throws ValidationException
     * @return array
     */
    protected function validate(array $rules, array $messages = [])
    {
        $params = Functions::arrayOnlyKeys($this->request->all(), array_keys($rules));

        return $this->validateAll($rules, $messages, $params);
    }
}
