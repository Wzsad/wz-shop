<?php
/**
 * 自定义辅助函数
 * 辅助函数需要生效必须加到自动加载中去,使用composer的自动加载。在composer.josn中找到autoload项添加
 * files自动加载文件---对应的文件相对路径与文件名。
 * 最后执行composer dumpautoload 重新生成自动加载函数
 * Q:composer的自动加载是怎么实现的 原理是怎样的
 */

// 此方法讲当前请求的路由名称转换成css类名称作用是允许我们针对某个页面做页面样式定制
function route_class()
{
	return str_replace('.', '-', Route::currentRouteName());
}