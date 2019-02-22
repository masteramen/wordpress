---
layout: post
title: "Spring装配Bean之Java代码装配bean"
title2: "Spring装配Bean之Java代码装配bean"
date: 2018-11-01 07:35:10  +0800
source: "https://www.cnblogs.com/wxw16/p/7704471.html"
fileName: "40e1e93"
lang: "zh_CN"
published: false
---

尽管通过组件扫描和自动装配实现 Spring 的自动化配置很方便也推荐，但是有时候自动配置的方式实现不了，就需要明确显式的配置 Spring。比如说，想要将第三方库中的组件装配到自己的应用中，这样的情况下，是没办法在它的类上添加 @Compnent 和 @Autowired 注解的。
在这种情况下，需要使用显式装配的方式。

显式装配可以分为 Java 和 XML 两种方式，其中使用 Java 的方式，可以做到类型安全并且重构友好，跟应用所写的 Java 代码一样。虽然 JavaConfig 和其他的 java 代码没有区别，但是在概念上是不同的。所以 JavaConfig 不应该出现业务逻辑的代码，建议放在单独的包中，做隔离。

## 创建配置类

    package soundsystem;
    import org.springframework.context.annotation.Configuration;  @Configuration public class CDPlayerConfig {    }

创建 javaConfig 类的关键在于为其添加 @Configuration 注解，@Configuration 注解表明这个类是一个配置类，该类应该包含 Spring 上下文中如何创建 bean 的细节。

## 声明简单的 bean

在 JavaConfig 中声明 bean，需要编写一个方法，该方法会创建所需类型的实例，然后这个方法添加 @Bean 注解。

    @Bean public CompactDisc sgtPeppers() {
        return new SgtPeppers();
    }

@Bean 注解会告诉 Spring 这个方法会返回一个对象，该对象要注册为 Spring 应用上下文中的 bean。
默认情况下，bean 的 ID 与带有 @Bean 注解的方法名是一样的，在上面的例子中，bean 的 ID 将会是 sgtPeppers。如果想设置不同的 ID，那么可以重命名该方法，也可以通过 name 属性指定一个不通的名字：

    @Bean(name="lonelyHeartsClubBand")
    public CompactDisc sgtPeppers() {
        return new SgtPeppers();
    }

## JavaConfig 实现注入

前面声明的 CompactDisc 很简单，因为没有其他依赖。但现在，我们需要声明 CDPlayer bean，它依赖于 CompactDisc。
在 javaConfig 中装配 bean 的最简单方式就是引用创建 bean 的方法。

    @Bean public CDPlayer cdPlayer() {
        return new CDPlayer(sgtPeppers());
    }

注意：看起来，CompactDisc 是通过调用 sgtPeppers()得到的，但情况并非完全如此。因为 sgtPeppers()方法添加了 @Bean 注解，Spring 会拦截所有对它的调用，并确保直接返回该方法创建的 bean，而不是每次都进行实际的调用。
假如引入另外一个 CDPlayer bean，他和之前的那个 bean 完全一样：

    @Bean public CDPlayer cdPlayer() {
        return new CDPlayer(sgtPeppers());
    }

    @Bean public CDPlayer anotherCDPlayer() {
        return new CDPlayer(sgtPeppers());
    }

如果 sgtPeppers()的调用是实际的方法调用，那么每个 CDPlayer 实例都会有一个特有的 SgtPeppers 实例。如果是实际的 CD 播放器和 CD 光盘的话，很 ok，物理上没办法共用一张 CD 光盘在两个 CD 播放器上。
但是，在软件中，我们完全是可以将同一个 SgtPeppers 实例注入到任意数量的其它的 bean 中。默认情况下，Spring 的 bean 都是单例的，我们并没有必要为第二个 CDPlayer bean 创建完全相同的 SgtPeppers 实例。
根本的问题在于，通过调用方法的方式来引入 bean 有点困惑，还有另外一种方式：

    @Bean
    public CDPlayer cdPlayer(CompactDisc compactDisc) {
        return new CDPlayer(compactDisc);
    }

通过这种方式引入其它的 bean 通常是最佳的方式，因为 Spring 并不会要求将 CompactDisc 声明放在同一个配置文件中，甚至不一定是 JavaConfig 中，可以将配置分布在 XML、多个配置类以及自动扫描装配的 bean 中。
另外，这里的 CDPlayer 的构造器实现了 DI 功能，但是我们完全可以根据需求实例化 CDPlayer，比如想通过 Setter 方法注入 CompactDisc 的话，可以这样：

    @Bean
    public CDPlayer cdPlayer(CompactDisc compactDisc) {
        CDPlayer cdPlayer = new CDPlayer(compactDisc);
        cdPlayer.setCompactDisc = compactDisc;
        return cdPlayer;
    }

出处：http://www.cnblogs.com/wxw16/p/7704471.html
