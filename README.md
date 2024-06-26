# ella123/hyperf-wechat

微信 SDK for Hyperf， 基于 [w7corp/wechat](https://easywechat.com/6.x/)

> 注意：组件依赖 `Context` 中的 `Request`

## 安装

```shell script
composer require ella123/hyperf-wechat
```

## 配置

1. 发布配置文件

```shell script
php ./bin/hyperf.php vendor:publish ella123/hyperf-wechat
```

2. 修改应用根目录下的 `config/autoload/wechat.php` 中对应的参数即可。
3. 每个模块基本都支持多账号，默认为 `default`。

## 使用

下面以接收普通消息为例写一个例子：
> 假设您的域名为 `nxx.cloud` 那么请登录微信公众平台 “开发者中心” 修改 “URL（服务器配置）” 为： `http://nxx.cloud/wechat`。

路由：

```php
Router::addRoute(['GET', 'POST', 'HEAD'], '/wechat', 'App\Controller\WeChatController@serve');
```

> 注意：一定是 `Router::addRoute`, 因为微信服务端认证的时候是 `GET`, 接收用户消息时是 `POST` ！

然后创建控制器 `WeChatController`：

```php
<?php

declare(strict_types=1);

namespace App\Controller;

use EasyWeChat\Kernel\Exceptions\BadRequestException;use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;use EasyWeChat\Kernel\Exceptions\InvalidConfigException;use Ella123\HyperfWechat\EasyWechat;use ReflectionException;

class WeChatController extends AbstractController
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     * @throws BadRequestException
     * @throws InvalidArgumentException
     * @throws InvalidConfigException
     * @throws ReflectionException
     */
    public function serve()
    {

        $app = EasyWechat::officialAccount();
        // 监听事件
        $app->getServer()->addEventListener();
        // 监听消息
        $app->getServer()->addMessageListener();
        
        return $app->getServer()->serve();
    }
}
```

> 上面例子里的 在return的时候必须调用``Ella123\HyperfWechat\Helper::Response``去转换，否则会报错。

### 我们有以下方式获取 SDK 的服务实例

##### 使用外观

```php
  use \Ella123\HyperfWechat\EasyWechat;
  $officialAccount = EasyWechat::officialAccount(); // 公众号
  $work = EasyWechat::work(); // 企业微信
  $pay = EasyWechat::pay(); // 微信支付
  $openPlatform = EasyWechat::openPlatform(); // 开放平台
  $miniApp = EasyWechat::miniApp(); // 小程序
  
  // 均支持传入配置账号名称以及配置
  EasyWeChat::officialAccount('foo',[]); // `foo` 为配置文件中的名称，默认为 `default`。`[]` 可覆盖账号配置
  //...
```

更多 SDK 的具体使用请参考：https://easywechat.com

## License

MIT