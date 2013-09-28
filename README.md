speedjscss
==========



<dl class="dl-horizontal">
  <dt>关于 SpeedJSCSS</dt>
  <dd>SpeedJSCSS 是一个JS和CSS资源合并压缩脚本
  </dd>
  <dt>官方网站</dt>
  <dd>http://mingfunwong.com/speedjscss</dd>
  <dt>使用指南</dt>
  <dd>http://mingfunwong.com/speedjscss</dd>
</dl>

在一个页面中，每一个外部JS及CSS文件都会导致一个额外的HTTP请求。所以，如何合理的合并JS文件及CSS文件也是前端工程师应该考虑的。

SpeedJSCSS正是一款JS和CSS合并压缩工具，用于合并多个文件在一个响应报文中。SpeedJSCSS从JS和CSS文件中合并文件、剔除注释和没用的空格 ，它的特点就是能减少文件的数量和大小，从而加快下载速度，它能降低消除下载的成本。

![speedjscss](http://ww4.sinaimg.cn/mw690/b76ab3afgw1e8hoj8ns4qg20h30jgtav.gif)

## 使用指南 ##

请求参数需要用路径（_/?），例如：

	<link href="http://localhost/_/?style1.css" rel="stylesheet" type="text/css" />
	<script src="http://localhost/_/?script1.js" type="text/javascript"></script>

请求合并多个文件使用逗号（,），例如：

	<link href="http://localhost/_/?style1.css,style2.css,style3.css" rel="stylesheet" type="text/css" />

参数中使用数字表示文件版本，例如：

	<link href="http://localhost/_/?2013,style1.css,style2.css,style3.css" rel="stylesheet" type="text/css" />
	<link href="http://localhost/_/?style1.css,style2.css,style3.css,2013" rel="stylesheet" type="text/css" />

SpeedJSCSS可以在路径中使用CDN文件，例如：

	<link href="http://localhost/_/?http://demo.opencart.com/catalog/view/theme/default/stylesheet/stylesheet.css,http://demo.opencart.com/catalog/view/theme/default/stylesheet/slideshow.css" rel="stylesheet" type="text/css" />

## 下载地址 ##

https://github.com/mingfunwong/speedjscss/archive/master.zip

## 相关链接 ##

[http://www.oschina.net/p/speedjscss](http://www.oschina.net/p/speedjscss "http://www.oschina.net/p/speedjscss")