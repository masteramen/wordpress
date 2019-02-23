---
layout: post
title:  "Junit+spring创建JNDI运行测试用例"
title2:  "Junit+spring创建JNDI运行测试用例"
date:   2018-10-30 09:23:16  +0800
source:  "https://www.ktanx.com/blog/p/4020"
fileName:  "29563b1"
lang:  "zh_CN"
published: false

---
项目中数据源采用JNDI的方式，因为JNDI由容器提供， 

 因此在跑Junit用例时，必须要先创建一个JNDI才行。 

 其实用spring创建jndi十分的简单，首先编写一个测试用的创建数据源信息的配置文件： 

    <?xml version="1.0" encoding="UTF-8"?>
     <beans:beans xmlns:beans="http://www.springframework.org/schema/beans"
                  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:context="http://www.springframework.org/schema/context"
                  xmlns:aop="http://www.springframework.org/schema/aop" xmlns:tx="http://www.springframework.org/schema/tx"
                  xsi:schemaLocation="http://www.springframework.org/schema/beans http://www.springframework.org/schema/beans/spring-beans-3.0.xsd
                                http://www.springframework.org/schema/context http://www.springframework.org/schema/context/spring-context-3.0.xsd
                                http://www.springframework.org/schema/aop http://www.springframework.org/schema/aop/spring-aop-3.0.xsd
                                http://www.springframework.org/schema/tx http://www.springframework.org/schema/tx/spring-tx-3.0.xsd">
         <beans:bean id="dataSource" class="org.springframework.jdbc.datasource.DriverManagerDataSource">
             <beans:property name="driverClassName" value="oracle.jdbc.OracleDriver" />
             <beans:property name="url" value="jdbc:oracle:thin:@localhost:1521/test" />
             <beans:property name="username" value="developer" />
             <beans:property name="password" value="developer" />
         </beans:bean>
     </beans:beans>
     

 然后直接在代码中加载创建就可以了，见代码： 

    @BeforeClass
     public static void beforeClass() throws  Exception{
         ClassPathXmlApplicationContext app =new ClassPathXmlApplicationContext("classpath:InitJndi.xml");
         DataSource ds =(DataSource) app.getBean("dataSource");
         SimpleNamingContextBuilder builder =new SimpleNamingContextBuilder();
         builder.bind("java:OracleDS", ds);
         builder.activate();
     }
     

 这样就成功创建了一个名为OracleDS的jndi，在跑Junit时就可以获取到了。 

 顺便附件上spring中获取jndi的配置： 

    <bean id="dataSource" class="org.springframework.jndi.JndiObjectFactoryBean">
         <property name="jndiName">
             <value>java:OracleDS</value>
         </property>
     </bean>
