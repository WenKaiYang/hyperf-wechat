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
use function Hyperf\Support\env;

/**
 * 参考 EasyWechat 官方文档.
 * @see https://easywechat.com/6.x/
 */
return [
    // 公众号
    'official_account' => [
        'default' => [
            'app_id' => env('WECHAT_OFFICIAL_ACCOUNT_APPID', ''),
            'secret' => env('WECHAT_OFFICIAL_ACCOUNT_SECRET', ''),
            'token' => env('WECHAT_OFFICIAL_ACCOUNT_TOKEN', ''),
            'aes_key' => env('WECHAT_OFFICIAL_ACCOUNT_AES_KEY', ''),
        ],
    ],
    // 第三方开发平台
    'open_platform' => [
        'default' => [
            'app_id' => env('WECHAT_OPEN_PLATFORM_APPID', ''),
            'secret' => env('WECHAT_OPEN_PLATFORM_SECRET', ''),
            'token' => env('WECHAT_OPEN_PLATFORM_TOKEN', ''),
            'aes_key' => env('WECHAT_OPEN_PLATFORM_AES_KEY', ''),
        ],
    ],
    // 小程序
    'mini_app' => [
        'default' => [
            'app_id' => env('WECHAT_MINI_APP_APPID', ''),
            'secret' => env('WECHAT_MINI_APP_SECRET', ''),
            'token' => env('WECHAT_MINI_APP_TOKEN', ''),
            'aes_key' => env('WECHAT_MINI_APP_AES_KEY', ''),
        ],
    ],
    // 支付
    'pay' => [
        'default' => [
            'sandbox' => env('WECHAT_PAY_SANDBOX', false),
            'app_id' => env('WECHAT_PAY_APPID', ''),
            'mch_id' => env('WECHAT_PAY_MCH_ID', ''),
            'key' => env('WECHAT_PAY_KEY', ''),
            'cert_path' => env('WECHAT_PAY_CERT_PATH', BASE_PATH . '/storage/pay/cert.pem'),    // XXX: 绝对路径！！！！
            'key_path' => env('WECHAT_PAY_KEY_PATH', BASE_PATH . '/storage/pay/key.pem'),      // XXX: 绝对路径！！！！
            'notify_url' => env('WECHAT_PAY_NOTIFY', 'https://example.com/wechat/pay/notify'),                             // 默认支付结果通知地址
        ],
    ],
    // 企业微信
    'work' => [
        'default' => [
            'corp_id' => env('WECHAT_WORK_AGENT_CONTACTS_CORP', ''),
            'agent_id' => 100020,
            'secret' => env('WECHAT_WORK_AGENT_CONTACTS_SECRET', ''),
        ],
    ],
    // 企业开放平台
    'open_work' => [
        'default' => [
        ],
    ],
];
