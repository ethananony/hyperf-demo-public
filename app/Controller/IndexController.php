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

use App\Exception\AppException;
use App\Support\Functions;

class IndexController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}. swoole  2",
        ];
    }

    public function apiSucc()
    {
        $ret = [
            'user' => [
                'id' => 123,
                'nickname' => 'John',
            ]
        ];

        return $this->success($ret);
    }

    public function apiFail()
    {
        $ret = [
            'errors' => [
                'username' => 'username is required.'
            ]
        ];

        return $this->failed('invalid failed', $ret, 422);
    }

    public function apiExcep()
    {
        throw new AppException(101018, 'test exception', [
            'orgId' => 12,
            'appId' => 18,
        ]);
    }

    public function apiValid()
    {
        $param = $this->validate([
            'org_id' => 'nullable|integer|min:1',
            'search' => 'nullable|string',
            'page' => 'nullable|integer|min:1',
            'pagesize' => 'nullable|integer|min:1|max:100',
            'order' => 'nullable',
        ]);
        $param = Functions::arrNull2default($param, [
            'org_id' => null,
            'search' => null,
            'page' => 1,
            'pageSize' => 20,
            'order' => [],
        ]);

        return $this->success($param);
    }

    public function apiValidFail()
    {
        $param = $this->validate([
            'org_id' => 'required|integer|min:1',
            'search' => 'nullable|string',
            'page' => 'nullable|integer|min:1',
            'pagesize' => 'nullable|integer|min:1|max:100',
            'order' => 'nullable',
        ]);
        $param = Functions::arrNull2default($param, [
            'search' => null,
            'page' => 1,
            'pageSize' => 20,
            'order' => [],
        ]);

        return $this->success($param);
    }

    public function hello()
    {
        $data = [
            'hello' => 'world'
        ];

        return $this->success($data);
    }
}
