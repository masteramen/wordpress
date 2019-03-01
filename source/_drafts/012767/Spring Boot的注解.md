---
layout: post
title:  "Spring Boot的注解"
date:   2019-02-27 06:47:17  +0800
source:  ""
fileName:  "012767"
lang:  "zh_CN"
published: false

---

- @SpringBootApplication
- @EnableAutoConfiguration

启用 Spring 应用程序上下文的自动配置，试图猜测和配置您可能需要的bean。自动配置类通常采用基于你的 classpath 和已经定义的 beans 对象进行应用。

被 @EnableAutoConfiguration 注解的类所在的包有特定的意义，并且作为默认配置使用。例如，当扫描 @Entity类的时候它将本使用。通常推荐将 @EnableAutoConfiguration 配置在 root 包下，这样所有的子包、类都可以被查找到。

- @ComponentScan

@Configuration注解的类配置组件扫描指令。同时提供与 Spring XML’s 元素并行的支持。

无论是 basePackageClasses() 或是 basePackages() （或其 alias 值）都可以定义指定的包进行扫描。如果指定的包没有被定义，则将从声明该注解的类所在的包进行扫描。

@ComponentScan 注解会自动扫描指定包下的全部标有 @Component注解 的类，并注册成bean，当然包括 @Component 下的子注解@Service、@Repository、@Controller。@ComponentScan 注解没有类似 、的属性。

- @RestController
- @Controller
- @Configuration 是一个类级注释，指示对象是一个bean定义的源。@Configuration 类通过 @bean 注解的公共方法声明bean。
- @Bean 注释是用来表示一个方法实例化，配置和初始化是由 Spring IoC 容器管理的一个新的对象。

@Configuration 一般与 @Bean 注解配合使用，用 @Configuration 注解类等价与 XML 中配置 beans，用 @Bean 注解方法等价于 XML 中配置 bean。举例说明：



