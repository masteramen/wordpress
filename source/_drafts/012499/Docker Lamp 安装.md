---
layout: post
title: "使用Dockerqing安装LAMP"
date: 2019-02-24 08:09:57  +0800
source: ""
fileName: "012499"
lang: "zh_CN"
published: false
---

使用

    docker run -d -p 80:80 -p 3306:3306 -v ～/www/:/var/www/html -v ～/mysql:/var/lib/mysql --name mylamp tutum/lamp
