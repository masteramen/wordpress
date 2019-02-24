---
layout: post
title: "使用Docker一条命令就可以轻松安装LAMP环境"
date: 2019-02-24 08:09:57  +0800
source: ""
fileName: "012499"
lang: "zh_CN"
published: true
---

在没有 docker 之前，如果我们需要安装 LAMP 环境，是怎么安装的？
先找台机器或者虚拟机来安装 Linux，然后安装 Apache,MYSQL,PHP,安装过程一般都不会太顺利，总是会遇到这样或这样的问题，无论怎么样，其安装过程是非常痛苦的，时间的等待也比较长。

如果使用 Docker 这种应用容器来安装，用一条命令行就可以解决了，而且是跨平台，无论是使用 window 还是 Linux 还是 Mac, 都可以使用一条命令来安装，速度很快，网络快的话，几分钟就搞定来，真是省时省力。

例如可以通过下面的一条命令来安装 LAMP，当然前提是你先安装好 docker.

    docker run -d -p 80:80 -p 3306:3306 -v ～/www/:/var/www/html -v ～/mysql:/var/lib/mysql --name mylamp tutum/lamp
