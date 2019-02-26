---
layout: post
title:  "Spring Cloud 介绍"
date:   2019-02-26 03:46:40  +0800
source:  ""
fileName:  "012668"
lang:  "zh_CN"
published: true

---

# 关于Spring Cloud 
Spring Cloud为开发人员提供了快速构建分布式系统中一些常见模式的工具，例如：
- 配置管理
- 服务发现
- 断路器
- 智能路由
- 微代理
- 控制总线
- 一次性令牌
- 全局锁定
- 领导选举
- 分布式会话
- 集群状态
- ......

使用Spring Cloud 开发人员可以开箱即用的实现这些模式的服务和应用程序。这些应用和服务可以适用于任何分布式环境，包括开发人员自己的笔记本电脑，数据中心和各种托管平台。


Spring Cloud是用于构建健壮的云应用程序的框架，为迁移到分布式环境时遇到的许多常见问题提供解决方案来促进应用程序的开发。
使用微服务架构运行的应用程序旨在简化开发，部署和维护。应用程序的分解特性允许开发人员一次关注一个问题，可以在不影响系统其他部分的情况下引入改进。

另一方面，当我们采用微服务方法时，会出现不同的挑战：

- 外部化配置，以便灵活，不需要在更改时重建服务
- 服务发现
- 隐藏部署在不同主机上的服务的复杂性


# 功能特点
Spring Cloud专注于为典型用例提供良好的开箱即用体验，并为其他用户提供可扩展性机制。
- 分布式/版本化配置
- 服务注册和发现
- 路器
- 服务到服务的调用
- 负载均衡
- 断路器
- 全局锁定
- 领导选举和集群状态
- 分布式消息

Spring Cloud采用声明式的方法，通常只需更改类路径和/或注释即可获得许多功能。例如发现服务客户端的示例应用程序：

    @SpringBootApplication
    @EnableDiscoveryClient
    public class Application {
        public static void main(String[] args) {
            SpringApplication.run(Application.class, args);
        }
    }

Spring Cloud是由一个个独立项目组成的伞形项目，不同项目不同的发布节奏。