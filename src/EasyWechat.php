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

namespace Ella123\HyperfWechat;

use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;
use EasyWeChat\MiniApp\Application as MiniAppApplication;
use EasyWeChat\OfficialAccount\Application as OfficialAccountApplication;
use EasyWeChat\OpenPlatform\Application as OpenPlatformApplication;
use EasyWeChat\OpenWork\Application as OpenWorkApplication;
use EasyWeChat\Pay\Application as PayApplication;
use EasyWeChat\Work\Application as WorkApplication;
use Hyperf\Context\ApplicationContext;
use Hyperf\Context\Context;
use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\SimpleCache\CacheInterface;
use function Hyperf\Support\make;

/**
 * Class EasyWechat.
 */
class EasyWechat
{
    /**
     * @throws ContainerExceptionInterface
     * @throws InvalidArgumentException
     * @throws NotFoundExceptionInterface
     */
    public static function officialAccount(string $name = 'default', array $config = []): OfficialAccountApplication
    {
        // 容器
        $container = ApplicationContext::getContainer();
        // 配置
        $config = array_merge($container->get(ConfigInterface::class)
            ->get('wechat.official_account.' . $name, []), $config);
        // 实例化
        $app = new OfficialAccountApplication($config);
        // 设置缓存
        $app->setCache($container->get(CacheInterface::class));
        // 请求对象(当前上下文)
        $app->setRequest(Context::has(ServerRequestInterface::class)
            ? Context::get(ServerRequestInterface::class)
            : make(ServerRequestInterface::class));

        return $app;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws InvalidArgumentException
     * @throws NotFoundExceptionInterface
     */
    public static function openPlatform(string $name = 'default', array $config = []): OpenPlatformApplication
    {
        // 容器
        $container = ApplicationContext::getContainer();
        // 配置
        $config = array_merge($container->get(ConfigInterface::class)
            ->get('wechat.open_platform.' . $name, []), $config);
        // 实例化
        $app = new OpenPlatformApplication($config);
        // 设置缓存
        $app->setCache($container->get(CacheInterface::class));
        // 请求对象(当前上下文)
        $app->setRequest(Context::has(ServerRequestInterface::class)
            ? Context::get(ServerRequestInterface::class)
            : make(ServerRequestInterface::class));

        return $app;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws InvalidArgumentException
     * @throws NotFoundExceptionInterface
     */
    public static function miniApp(string $name = 'default', array $config = []): MiniAppApplication
    {
        // 容器
        $container = ApplicationContext::getContainer();
        // 配置
        $config = array_merge($container->get(ConfigInterface::class)
            ->get('wechat.mini_app.' . $name, []), $config);
        // 实例化
        $app = new MiniAppApplication($config);
        // 设置缓存
        $app->setCache($container->get(CacheInterface::class));
        // 请求对象(当前上下文)
        $app->setRequest(Context::has(ServerRequestInterface::class)
            ? Context::get(ServerRequestInterface::class)
            : make(ServerRequestInterface::class));

        return $app;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws InvalidArgumentException
     * @throws NotFoundExceptionInterface
     */
    public static function work(string $name = 'default', array $config = []): WorkApplication
    {
        // 容器
        $container = ApplicationContext::getContainer();
        // 配置
        $config = array_merge($container->get(ConfigInterface::class)
            ->get('wechat.work.' . $name, []), $config);
        // 实例化
        $app = new WorkApplication($config);
        // 设置缓存
        $app->setCache($container->get(CacheInterface::class));
        // 请求对象(当前上下文)
        $app->setRequest(Context::has(ServerRequestInterface::class)
            ? Context::get(ServerRequestInterface::class)
            : make(ServerRequestInterface::class));

        return $app;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws InvalidArgumentException
     * @throws NotFoundExceptionInterface
     */
    public static function openWork(string $name = 'default', array $config = []): OpenWorkApplication
    {
        // 容器
        $container = ApplicationContext::getContainer();
        // 配置
        $config = array_merge($container->get(ConfigInterface::class)
            ->get('wechat.open_work.' . $name, []), $config);
        // 实例化
        $app = new OpenWorkApplication($config);
        // 设置缓存
        $app->setCache($container->get(CacheInterface::class));
        // 请求对象(当前上下文)
        $app->setRequest(Context::has(ServerRequestInterface::class)
            ? Context::get(ServerRequestInterface::class)
            : make(ServerRequestInterface::class));

        return $app;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws InvalidArgumentException
     * @throws NotFoundExceptionInterface
     */
    public static function pay(string $name = 'default', array $config = []): PayApplication
    {
        // 容器
        $container = ApplicationContext::getContainer();
        // 配置
        $config = array_merge($container->get(ConfigInterface::class)
            ->get('wechat.pay.' . $name, []), $config);
        // 实例化
        $app = new PayApplication($config);
        // 请求对象(当前上下文)
        $app->setRequest(Context::has(ServerRequestInterface::class)
            ? Context::get(ServerRequestInterface::class)
            : make(ServerRequestInterface::class));

        return $app;
    }
}
