---
layout: post
title:  "new post"
date:   2019-02-28 03:53:24  +0800
source:  ""
fileName:  "012899"
lang:  "zh_CN"
published: false

---

单体应用：小作坊企业，没有分部门。
微服务：比如公司的组织架构就好像把企业按服务不同，拆分成不同的部门，比如生产部只负责生成,人事部门只做招聘，销售部只负责销售，市场部只负责市场调研，公关部只负责危机公关，行政部门;企业发展了，还会增加新的不同(横向扩展);各个部门之间就无法避免的发生跨部门协作（服务器调用）;但是你怎么知道有这样一个部门可以做这个事情呢，就要依赖行政部门（注册中心），新成立的部门要在行政哪里做一个备案（服务注册），然后公布一下，让其他部门知道了（服务发布）
集群：就好像一个店忙不过来，就开了很多分店，就算关掉一个店，其他店照常服务。