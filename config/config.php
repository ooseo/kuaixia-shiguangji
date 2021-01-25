<?php
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

return $config;