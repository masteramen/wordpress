---
layout: post
title: "REST 面试问题答案"
title2: "new post"
date: 2018-10-30 03:12:15  +0800
source: ""
fileName: "093002"
lang: "zh_CN"
published: true
---

### 什么是 REST?

REST 全称 REpresentation State Transfer（表现层状态转移）

### 关于资源

RESTful 架构有一些典型的设计误区，就是 URI 包含动词。因为”资源”表示一种实体，所以应该是名词，URI 不应该有动词，动词应该放在 HTTP 协议中。 上面设计的 API 的 URI 中都是名词。

### 什么是安全的 Rest 操作？

Restful API 的设计就是通过 HTTP 的方法来表示 CRUD 的相关操作。除了使用 GET 和 POST 方法外，还会用到其他 HTTP 方法，比如 PUT,DELETE,HEAD 等，通过不同的 HTTP 方法来表示不同的含义。

### Spring MVC Restful

- @RestController
- @RequestMapping
- @PathVariable
- @RequestBody
- @ResponseBody
- MockMvc

### JUnit and Mockito

### Spring-Data-JPA JPA Hiberanate

Spring Data JPA 是 Spring 基于 Hiberate 开发的一个 JPA 框架。

Spring Data 接口： CrudRepository

JPQL 查询语言：通过面向对象而非面向数据库的查询语言，别买程序的 SQL 语句紧密耦合。

JPA 仅仅是一种规范，也就是说 JPA 仅仅定义了一些接口。

### 什么是 Spring data jpa?

Spring data jpa 是 Spring 提供的一套简化 JPA 开发的框架，按照约定好的【方法命名规则】写 Dao 层接口，就可以在不写接口实现的情况下，实现对数据库的访问和操作。同时提供了很多除了 CRUD 之外的功能，比如分页，排序，复杂查询等等。

left join, 左连接：返回左表中的所有记录以及右表中的联接字段相等的记录。
right join， 右联接：返回右表中的所有记录以及左表的联接字段相等的记录
innert join,等值联接：只返回两个表中联接字段相等的记录。

## Hibernate

- HQL
- QBC
- Native SQL(不能夸平台)
- Transient, Persistent, Detached

### Spring 支持的事务隔离级别

- ISOLATION_DEFAULT : 使用数据库默认的隔离级别
- read uncommit;
- read commit;
- repeatable read;
- serializable

### Oracle 查询执行计划的三种方法

1. set autotrace on
2. explain plan for sql
3. sql developer 工具

### Spring Cloud

Spring Cloud 为开发人员提供了快速构建分布式系统中一些常见模式的工具，如

- 配置管理
- 服务发现与注册
- 断路器
- 智能代理
- 智能路由
- 负载均衡
- 一次性令牌
- 全局锁
- 领导选举
- 分布式会话
- 集群状态
- 分布式消息
- 微代理
- 控制总线

### SpringBoot 核心注解

- SpringBootConfiguration
- EnableAutoConfiguration
- SpringBootApplication

### Spring 有哪几种读取配置的方式

- @PropertySource
- @Value
- @Environment
- @ConfigurationProperties

### Logger

- java util logging
- log4j2
- logback
