---
layout: post
title:  "不用配置，不同项目使用不同Git账号的方法"
date:   2019-03-04 06:42:03  +0800
source:  ""
fileName:  "020429"
lang:  "zh_CN"
published: true
categories: []
tags: [git]

---

最近碰到一个问题，在同一台机上，有不同的项目需要要push到不同的github 账户下面，要想切换到另外一个，只能就修改下全局的user.name，user.email，但是这样每次切换都很麻烦，甚至很容易搞错。

那么有没有办法可以同时使用多个账号而又不互相影响？

方法当然是有的，就是使用docker.

![](2019-03-04-15-51-04.png)

clone:
```
docker run -ti --rm -v ${HOME}:/root -v $(pwd):/git alpine/git clone https://github.com/cctranslate/cctranslate.github.io.git
```

push:
```
docker run -ti --rm -v ${HOME}:/root -v $(pwd):/git alpine/git push
```

在*nix 环境下，还可以建立命令别名，少打些字:
```
alias git="docker run -ti --rm -v $(pwd):/git -v $HOME/.ssh:/root/.ssh alpine/git"
```

缺点是每次都需要输入用户名和密码，但比较起来，还算方便的。
