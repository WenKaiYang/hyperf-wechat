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

use Exception;
use Hyperf\Context\Context;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Guzzle\CoroutineHandler;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Factory.
 *
 * @method \EasyWeChat\OfficialAccount\Application officialAccount(string|array $name = "default", array $config = [])
 * @method \EasyWeChat\Work\Application work(string|array $name = "default", array $config = [])
 * @method \EasyWeChat\MiniApp\Application miniApp(string|array $name = "default", array $config = [])
 * @method \EasyWeChat\Pay\Application pay(string|array $name = "default", array $config = [])
 * @method \EasyWeChat\OpenPlatform\Application openPlatform(string|array $name = "default", array $config = [])
 * @method \EasyWeChat\OpenWork\Application openWork(string|array $name = "default", array $config = [])
 */
class Factory
{
    protected array $configMap = [
        'officialAccount' => 'official_account',
        'work' => 'work',
        'miniApp' => 'mini_app',
        'pay' => 'pay',
        'openPlatform' => 'open_platform',
        'openWork' => 'open_work',
    ];

    protected ContainerInterface $container;

    /**
     * @var ConfigInterface
     */
    protected mixed $config;

    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->config = $container->get(ConfigInterface::class);
        $this->cache = $container->get(CacheInterface::class);
    }

    /**
     * @param mixed $functionName
     * @param mixed $args
     * @throws Exception
     */
    public function __call($functionName, $args)
    {
        $accountName = $args[0] ?? 'default';
        $accountConfig = $args[1] ?? [];
        if (! isset($this->configMap[$functionName])) {
            throw new Exception('方法不存在');
        }
        $configName = $this->configMap[$functionName];
        $config = is_array($accountName)
            ? $accountName
            : $this->getConfig(sprintf('wechat.%s.%s', $configName, $accountName), $accountConfig);
        $app = Factory::$functionName($config);
        $app->rebind('cache', $this->cache);
        $app['guzzle_handler'] = CoroutineHandler::class;
        Context::get(ServerRequestInterface::class) && $app->rebind('request', $this->getRequest());
        return $app;
    }

    /**
     * 获得配置.
     */
    private function getConfig(string $name, array $config = []): array
    {
        $defaultConfig = $this->config->get('wechat.defaults', []);
        $moduleConfig = $this->config->get($name, []);
        return array_merge($moduleConfig, $defaultConfig, $config);
    }

    /**
     * 获取Request请求
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getRequest(): Request
    {
        $request = $this->container->get(RequestInterface::class);
        $uploadFiles = $request->getUploadedFiles() ?? [];
        $files = [];
        foreach ($uploadFiles as $k => $v) {
            $files[$k] = $v->toArray();
        }
        return new Request(
            $request->getQueryParams(),
            $request->getParsedBody(),
            [],
            $request->getCookieParams(),
            $files,
            $request->getServerParams(),
            $request->getBody()->getContents()
        );
    }
}
