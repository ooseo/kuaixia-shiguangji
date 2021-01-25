## 介绍

- 批量检测域名是否能注册
- 批量检测域名外链和历史快照

## 特点

- CLI运行模式
- 配置很科学，速度杠杠的
- 兼容 Linux、macOS，暂不支持 Windows 系统
- 要求 PHP >= 7.0 & PHP <= 7.2
- 要求服务器必须翻墙或海外服务器

## 安装

#### 在 centos 7.2 上演示，已安装宝塔面板（nginx 1.16.0 + php-7.2)
- 安装 PHP 解密扩展 [safegou](https://github.com/ooseo/safegou)
- 获取代码
```bash
mkdir -p /www/wwwroot/shell
cd /www/wwwroot/shell
git clone https://github.com/ooseo/kuaixia-shiguangji.git
```
- 删除 PHP 禁用函数
```
exec
```
- 根据实际情况修改代码配置
```php
// 代理配置 请使用自动网关国外代理 ， 暂时可以不用配置
$config['proxy']['status'] = false;
$config['proxy']['user'] = 'ngls';
$config['proxy']['pass'] = 'ngls2020';
$config['proxy']['ip'] = '47.90.32.133';
$config['proxy']['port'] = '3333';

// redis 配置
$config['redis']['host'] = '127.0.0.1';
$config['redis']['port'] = 6379;
$config['redis']['password'] = '';
$config['redis']['select_db'] = 0;

// 系统配置
$config['system']['auth_token'] = "51bc01ef851c31e68acc8c28c23f86bb";  // 授权令牌
$config['system']['is_debug'] = true; // 开启调试模式
$config['system']['domains_max'] = 30;  // 可注册域名文件中存放域名的最大数量
$config['system']['data_path'] = '/data/domains'; // 生成可注册域名文件目录
$config['system']['result_path'] = '/data/result'; // 生成有快照记录文件目录
$config['system']['source_path'] = '/data/source'; // 存放待处理域名的目录

// 时光机配置
$config['history']['is_high'] = true; // 开启并发
$config['history']['title_num'] = 5;  // 导出标题数量
$config['history']['title_max'] = 15; // 最多查询快照数量
$config['history']['filter_keyword'] = true;  // 页面内容关键词过滤
$config['history']['export_filter_data'] = false;  // 是否导出被过滤的数据
$config['history']['lately_date'] = "20170101";  // 最近快照日期

// 检查域名注册配置
$config['check']['is_high'] = true;  // 开启并发
$config['check']['high_num'] = 10;   // 并发数量
$config['check']['allow_suffix'] = ['com','cn','net','cc'];   // 允许的域名后缀
```

- `deny.txt` 为需要过滤的关键词，可以自行完善
- 需要检查的域名文件放在 `data/source/` 目录下，文件名任意

## 运行
```bash
# 检查域名是否注册
php /www/wwwroot/shell/kuaixia-shiguangji/run.php --action=check

# 检查域名历史快照
php /www/wwwroot/shell/kuaixia-shiguangji/run.php --action=shiguangji
```
![计划任务配置](http://img.zhupi.net/images/WechatIMG12.png)

## 注意
由于网络请求太多造成 TCP 有大量的 TIME_WAIT，导致程序卡死
```
netstat -an | awk '/^tcp/ {++y[$NF]} END {for(w in y) print w, y[w]}'
```
优化方案，修改内核参数 `vim /etc/sysctl.conf` 添加：
```
net.ipv4.tcp_syncookies = 1
net.ipv4.tcp_tw_reuse = 1
net.ipv4.tcp_tw_recycle = 1
net.ipv4.tcp_fin_timeout = 30
```
![配置文件](http://img.zhupi.net/images/WechatIMG13.png)
保存后运行 `/sbin/sysctl -p ` 后生效
