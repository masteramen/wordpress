---
layout: post
title:  "Spring boot 使用Spring Data JPA"
date:   2019-03-04 02:26:00  +0800
source:  ""
fileName:  "020458"
lang:  "zh_CN"
published: false

---

## 介绍
Spring Data JPA是Spring Data大家族系列的一部分，基于Hibernate开发的一个JPA持久化框架，简化数据（关系型&非关系型）访问，使构建使用数据访问技术的Spring应用程序变得更加容易。

在相当长的一段时间内，实现应用程序的数据访问层一直很麻烦，必须编写太多样板代码来执行简单查询以及执行分页，审计等。Spring Data JPA旨在通过减少实际需要的工作量来显着改善数据访问层的实现。作为开发人员编写抽象接口并定义相关操作即可，包括自定义查找器方法，Spring在运行期间的时候创建代理实例自动提供实现。

使用Spring-data-jpa进行开发的过程中，常用的功能，我们几乎不需要写一条sql语句，当然spring-data-jpa也提供自己写sql的方式。

## 如何使用

1. 添加  spring-boot-starter-data-jpa 依赖。

```
<?xml version="1.0" encoding="UTF-8"?>
<project xmlns="http://maven.apache.org/POM/4.0.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://maven.apache.org/POM/4.0.0 http://maven.apache.org/xsd/maven-4.0.0.xsd">
	<modelVersion>4.0.0</modelVersion>
	<parent>
		<groupId>org.springframework.boot</groupId>
		<artifactId>spring-boot-starter-parent</artifactId>
		<version>2.1.3.RELEASE</version>
		<relativePath/> <!-- lookup parent from repository -->
	</parent>
	<groupId>com.example</groupId>
	<artifactId>demo</artifactId>
	<version>0.0.1-SNAPSHOT</version>
	<name>demo</name>
	<description>Demo project for Spring Boot data jpa</description>

	<properties>
		<java.version>1.8</java.version>
	</properties>

	<dependencies>
		<dependency>
			<groupId>org.springframework.boot</groupId>
			<artifactId>spring-boot-starter-data-jpa</artifactId>
		</dependency>

		<dependency>
			<groupId>com.h2database</groupId>
			<artifactId>h2</artifactId>
			<scope>runtime</scope>
		</dependency>
		<dependency>
			<groupId>org.springframework.boot</groupId>
			<artifactId>spring-boot-starter-test</artifactId>
			<scope>test</scope>
		</dependency>
	</dependencies>

	<build>
		<plugins>
			<plugin>
				<groupId>org.springframework.boot</groupId>
				<artifactId>spring-boot-maven-plugin</artifactId>
			</plugin>
		</plugins>
	</build>

</project>

```
2. 定义数据实体类。

- 审计
@CreatedBy, @LastModifiedBy,@CreatedDate 和@LastModifiedDate，分别代表创建和修改实体类的对象和时间。

使用Java配置
@Configuration
@EnableJpaAuditing

Query注解

在实体类上添加@EntityListeners(AuditingEntityListener)注解

3. 定义Repository接口。

- CrudRepository
- PagingAndSortingRepository

