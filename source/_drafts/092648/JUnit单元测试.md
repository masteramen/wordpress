---
layout: post
title: "JUnit单元测试"
title2: "new post"
date: 2018-10-26 08:17:17  +0800
source: ""
fileName: "092648"
lang: "zh_CN"
published: false
---

单元测试就是编写测试代码的准确性。
JUnit 是 Java 单元测试框架
###JUnit4 通过注解的方式来识别测试方法：

- @BeforeClass 全局只会执行一次，而且是第一个执行
- @Before 在测试方法运行之前运行
- @Test 测试方法
- @After 在测试方法运行之后
- @AfterClass
- @Ignore

### JUnit 测试方法的流程

1. 首先 @BeforeClass 方法先执行一次
2. @Before
3. @Test
4. @After
5. @AfterClass

### TDD

TDD: Test-Driven-Development,测试驱动开发模式,旨在强调开发功能代码之前，先编写测试代码。

参考：
[http://linbinghe.com/2017/3698e116.html](http://linbinghe.com/2017/3698e116.html)

https://www.cnblogs.com/dadifeihong/p/6958337.html
