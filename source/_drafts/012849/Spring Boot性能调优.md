---
layout: post
title:  "Spring Boot性能调优"
date:   2019-02-28 08:58:11  +0800
source:  ""
fileName:  "012849"
lang:  "zh_CN"
published: false

---

Spring Boot是一个很好的工具，可以快速地引导和开发基于Spring Framework的应用程序。Spring Boot应用程序的vanilla版本毫无疑问地提供了高性能。但随着应用程序开始增长，其性能开始成为瓶颈。这是所有Web应用程序的正常场景。当添加不同的功能并且传入请求日益增加时，会观察到性能损失。我们将在本节中学习Spring Boot应用程序的性能优化技术。

*Undertow作为嵌入式服务器*
