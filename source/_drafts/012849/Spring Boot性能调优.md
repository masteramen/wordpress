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

*组件自动扫描带来的问题*

通常情况下，在使用 Springboot 框架进行开发的时候，我们会在入口 main 方法上添加 @SpringBootApplication 注解,但这样也会给应用带来一些副作用。使用这个注解后，会触发自动配置（ auto-configuration 3 ）和 组件扫描 （ component scanning ），这跟使用 @Configuration、@EnableAutoConfiguration 和 @ComponentScan 三个注解的作用是一样的。这样做给开发带来方便的同时，也会有三方面的影响：