---
layout: post
title: "ssh指定目录调用命令"
date: 2019-02-23 14:34:43  +0800
source: ""
fileName: "012300"
lang: "zh_CN"
published: true
---

很多时候我们需要通过 ssh 调用服务器的某条命令后就退出，习惯地先 ssh 登陆到服务器，再执行相应的命令，再 exit 退出，其实我们可以通过 ssh 的 -t 选项就可以用一条命令，就能完成了，简单方便很多：

    ssh user@myserver -t "cd /dir ; /bin/bash"
