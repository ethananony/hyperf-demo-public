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
namespace App\Model;

use Hyperf\DbConnection\Model\Model as BaseModel;

abstract class Model extends BaseModel
{
    /**
     * 默认禁用自动时间戳管理，如需开启，请在父类中设置其值为true.
     *
     * @var bool
     */
    public $timestamps = false;

    protected function getInstance($class)
    {
        return $this->getContainer()->get($class);
    }
}
