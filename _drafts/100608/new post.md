---
layout: post
title: "new post"
title2: "new post"
date: 2018-11-06 06:56:41  +0800
source: ""
fileName: "100608"
lang: "zh_CN"
published: false
---

## How configuration meta data is provided to the spring container

- XML-Based configuration: In Spring Framework,the dependencies and the service needed by beans are specified in configuration files which are in XML format. These configuration files usually contains a lot of bean definitions and application specific configuration options. They generally start with a bean tag.

- Annotation-Based configuration: Instead of using XML to describe a bean wiring, you can configuration the bean into the component class itself by using annotations on the relavant class,method,or field declaration. By default anotation wiring is not turnned on in the Spring container. So , you nneed to enable it in your Spring configuration file before using it.

ctrl+E

Restoration
`
