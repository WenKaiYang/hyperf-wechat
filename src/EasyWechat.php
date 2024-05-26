<?php

namespace Ella123\HyperfWechat;


use Hyperf\Context\ApplicationContext;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class EasyWechat.
 *
 * @method static \EasyWeChat\OfficialAccount\Application  officialAccount(string|array $name = "default", array $config = [])
 * @method static \EasyWeChat\Work\Application  work(string|array $name = "default", array $config = [])
 * @method static \EasyWeChat\MiniApp\Application  miniApp(string|array $name = "default", array $config = [])
 * @method static \EasyWeChat\Pay\Application  pay(string|array $name = "default", array $config = [])
 * @method static \EasyWeChat\OpenPlatform\Application  openPlatform(string|array $name = "default", array $config = [])
 * @method static \EasyWeChat\OpenWork\Application  openWork(string|array $name = "default", array $config = [])
 */
class EasyWechat
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function __callStatic($functionName, $args)
    {
        return ApplicationContext::getContainer()->get(Factory::class)->{$functionName}(...$args);
    }
}