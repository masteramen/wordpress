---
layout: post
title:  "SpringCloud熔断器Hystrix"
date:   2019-02-25 08:13:36  +0800
source:  ""
fileName:  "012590"
lang:  "zh_CN"
published: false
categories: [SpringCloud]
---

## 概观
典型的分布式系统是由许多协作的服务组成的。

这些服务容易出现故障或延迟响应，如果服务失败，它可能会影响其他服务，并可能使系统的其他部分无法访问，最坏的情况下可能会导致雪崩。

当然，有一些解决方案可以帮助提高应用程序的弹性和容错能力 - 其中一个框架就是Hystrix。
Hystrix是netflix开源的一个容灾框架，解决当外部依赖故障时拖垮业务系统、甚至引起雪崩的问题。

Hystrix框架库通过提供容错和延迟容忍来帮助控制服务之间的交互。它通过隔离故障服务和停止故障的级联效应来提高系统的整体弹性。

在本系列文章中，我们将首先了解Hystrix在服务或系统出现故障时如何解决问题以及Hystrix在这些情况下可以完成的任务。

##简单的例子
Hystrix提供故障和延迟容忍的方式是隔离和包装对远程服务的调用。
在这个简单的例子中，我们在HystrixCommand的run()方法中包装一个调用：

    class CommandHelloWorld extends HystrixCommand<String> {
     
        private String name;
     
        CommandHelloWorld(String name) {
            super(HystrixCommandGroupKey.Factory.asKey("ExampleGroup"));
            this.name = name;
        }
     
        @Override
        protected String run() {
            return "Hello " + name + "!";
        }
    }

我们按如下方式执行调用：

    @Test
    public void givenInputBobAndDefaultSettings_whenCommandExecuted_thenReturnHelloBob(){
        assertThat(new CommandHelloWorld("Bob").execute(), equalTo("Hello Bob!"));
    }
   
## 断路器的作用
当一个服务调用另一个服务由于网络原因或者自身原因出现问题时,调用者就会等待被调用
者的响应,当更多的服务请求到这些资源时导致更多的请求等待,这样就会发生连锁效应（雪崩效应），断路器就是解决这一问题。
一定时间内 达到一定的次数无法调用 并且多次检测没有恢复的迹象 断路器完全打开，那
么下次请求就不会请求到该服务半开,短时间内 有恢复迹象 断路器会将部分请求发给该服务 当
能正常调用时 断路器关闭,当服务一直处于正常状态 能正常调用 断路器关闭

## 结论

Hystrix旨在：

1. 提供对通常通过网络访问的服务的故障和延迟的保护和控制
2. 停止因某些服务中断而导致的故障级联
3. 快速失败并迅速恢复
4. 尽可能优雅地降级
5. 对故障进行实时监控和指挥中心警报

<!-- https://www.baeldung.com/introduction-to-hystrix-- >
<!-- https://www.jianshu.com/p/138f92aa83dc -->
<!-- http://tech.lede.com/2017/06/14/rd/server/hystrix/ -->