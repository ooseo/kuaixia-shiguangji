## 介绍

- PHP7 代码加密扩展

## 特点

- 简单快速，几乎不影响性能
- 兼容 Linux、macOS，暂不支持 Windows 系统
- 兼容 Apache、Nginx + PHP-fpm、CLI等运行模式
- 要求 PHP >= 7.0 & PHP <= 7.2

## 安装

#### 在 centos 7.2 上编译，已安装宝塔面板（nginx 1.16.0 + php-7.2)
```
git clone https://github.com/ooseo/safegou.git
cd safegou
phpize
./configure --with-php-config=/www/server/php/72/bin/php-config
make && make install
```
修改 PHP 配置文件，在配置文件最后加入：
```
extension = /www/server/php/72/lib/php/extensions/no-debug-non-zts-20170718/safegou.so
```
重启 PHP 服务

## 加密
**加密前请先备份源代码**

代码中的 `safegou.php` 是加密工具:
```bash
php safegou.php index.php application/
```
这样可加密 `index.php` 和 `application` 目录下的所有 php 文件，PHP 在运行它们时会自动解密！

