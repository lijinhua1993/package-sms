# laravel 短信

## 安装
```shell
composer require lijinhua/sms
```
发布配置文件
```shell
php artisan vendor:publish --provider="Lijinhua\Sms\ServiceProvider"
```
创建短信发送日志数据表
```
CREATE TABLE `sms_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varbinary(255) DEFAULT '',
  `data` text,
  `is_sent` tinyint(4) NOT NULL DEFAULT '0',
  `result` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mobile` (`mobile`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='短信记录';
```


## 使用方法

### 发送验证码
```php
// 发端短信验证码
$bool = \Sms::sendCode("131111111111");
// 发端短信验证码-带上手机区号
$bool = \Sms::sendCode("131111111111",86);
var_dump($bool); // true or false
```

> 环境变量(SMS_DEBUG=true)时短信验证码为666666
> 且不会真实调用第三方短信服务商发送短信