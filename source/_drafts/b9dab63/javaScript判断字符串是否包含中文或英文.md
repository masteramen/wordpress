---
layout: post
title: "javaScript判断字符串是否包含中文或英文"
title2: "javaScript判断字符串是否包含中文或英文"
date: 2018-11-10 13:50:01  +0800
source: "https://blog.csdn.net/foolishandstupid/article/details/45268637"
fileName: "b9dab63"
lang: "zh_CN"
published: false
---

转自：http://yuanliang4521-163-com.iteye.com/blog/1888601

第一种方法

```js
function isChina() {
  var obj = document.form1.txtName.value;
  if (/.*[\u4e00-\u9fa5]+.*$/.test(obj)) {
    alert("不能含有汉字！");
    return false;
  }
  return true;
}
```

第二种方法（包含中文则返回"true"，不包含中文则返回"false"）：

```js
function isChina(s) {
  var patrn = /[\u4E00-\u9FA5]|[\uFE30-\uFFA0]/gi;
  if (!patrn.exec(s)) {
    return false;
  } else {
    return true;
  }
}
```

第三种方法

```html
<script language="javascript">
  var str = "中国";
  if (escape(str).indexOf("%u") < 0) {
    alert("没有包含中文");
  } else {
    alert("包含中文");
  }
</script>
```
