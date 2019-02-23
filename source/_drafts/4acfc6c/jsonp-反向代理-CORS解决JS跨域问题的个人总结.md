---
layout: post
title: "jsonp-反向代理-CORS解决JS跨域问题的个人总结"
title2: "jsonp-反向代理-CORS解决JS跨域问题的个人总结"
date: 2018-10-31 05:47:38  +0800
source: "https://segmentfault.com/a/1190000012967320"
fileName: "4acfc6c"
lang: "zh_CN"
published: false
---

> 网上说了很多很多，但是看完之后还是很混乱，所以我自己重新总结一下。

解决 js 跨域问题一共有 8 种方法，

1. jsonp（只支持 get）
2. 反向代理
3. CORS
4. document.domain + iframe 跨域
5. window.name + iframe 跨域
6. window.postMessage
7. location.hash + iframe
8. web sockets

各个方法都有各自的优缺点，但是目前前端开发方面比较常用的是 jsonp，反向代理，CORS：

-

CORS 是跨源资源分享（Cross-Origin Resource Sharing）的缩写。它是 W3C 标准，是跨源 AJAX 请求的根本解决方法。优点是正统，符合标准，缺点是：

-

JSONP 优点是对旧式浏览器支持较好，缺点是：

- 但是只支持 get 请求。
- 有安全问题(请求代码中可能存在安全隐患)。
- 要确定 jsonp 请求是否失败并不容易

-

反向代理都能够兼容以上的确定，但是仅仅作为前端开发模式的时候使用，在正式上线环境较少用到。

- 因为开发环境的域名跟线上环境不一样才需要这样处理。
- 如果线上环境太复杂，本身也是多域（后面说到的同源策略问题，多子域，或者多端口问题），那么需要采用 jsonp 或者 CORS 来处理。

> 这里主要说明这三种方式。其他方式暂不说明。

## 一、什么是跨域问题

跨域问题一般只出现在前端开发中使用 javascript 进行网络请求的时候，浏览器为了安全访问网络请求的数据而进行的限制。

提示的错误大致如下：

    No 'Access-Control-Allow-Origin' header is present on the requested resource. Origin 'http://XXXXXX' is therefore not allowed access.

![clipboard.png](https://static.segmentfault.com/v-5bd68eac/global/img/squares.svg)

## 二、为什么会出现跨域问题

因为浏览器收到同源策略的限制，当前域名的 js 只能读取同域下的窗口属性。

### 2.1 同源策略

同源指的是三个源头同时相同：

举例来说，`http://www.example.com/dir/page.html`这个网址，

    协议是 http:// 域名是 www.example.com 端口是80   //它的同源情况如下： http://www.example.com/dir2/other.html：同源 http://example.com/dir/other.html：不同源（域名不同） http://v2.www.example.com/dir/other.html：不同源（域名不同） http://www.example.com:81/dir/other.html：不同源（端口不同）

同源策略限制了以下行为：

- Cookie、LocalStorage 和 IndexDB 无法读取
- DOM 和 JS 对象无法获取
- Ajax 请求发送不出去

> 大概可以知道跨域其实就是同源策略导致的，并且知道同源策略的原理。

详细的同源策略相关，可以参考[http://www.ruanyifeng.com/blog/2016/04/same-origin-policy.html](http://www.ruanyifeng.com/blog/2016/04/same-origin-policy.html)

## 三、解决跨域问题

### 3.1 反向代理方式

反向代理和正向代理的区别：

- 正向代理（Forward Proxy），通常都被简称为代理，就是在用户无法正常访问外部资源，比方说受到 GFW 的影响无法访问 twitter 的时候，我们可以通过代理的方式，让用户绕过防火墙，从而连接到目标网络或者服务。
- 反向代理（Reverse Proxy）是指以代理服务器来接受 Internet 上的连接请求，然后将请求转发给内部网络上的服务器，并将从服务器上得到的结果返回给 Internet 请求连接的客户端，此时，代理服务器对外就表现为一个服务器。

那么我们可以理解为反向代理

如何使用反向代理服务器来达到跨域问题解决：

- 前端 ajax 请求的是本地反向代理服务器
-

本地反向代理服务器接收到后：

- 修改请求的 http-header 信息，例如 referer，host，端口等
- 修改后将请求发送到实际的服务器

- 实际的服务器会以为是同源（参考同源策略）的请求而作出处理

现在前端开发一般使用 nodejs 来做本地反向代理服务器

    // 在 express 之后引入路由 var app = express();  var apiRoutes = express.Router();  app.use(bodyParser.urlencoded({extended:false}))  // 自定义 api 路由 apiRoutes.get("/lyric", function (req, res) {   var url = "https://c.y.qq.com/lyric/fcgi-bin/fcg_query_lyric_new.fcg";    axios.get(url, {     headers: { // 修改 header       referer: "https://c.y.qq.com/",       host: "c.y.qq.com"     },     params: req.query   }).then((response) => {     var ret = response.data     if (typeof ret === "string") {       var reg = /^\w+\(({[^()]+})\)$/;       var matches = ret.match(reg);       if (matches) {         ret = JSON.parse(matches[1])       }     }     res.json(ret)   }).catch((e) => {     console.log(e)   }) });  // 使用这个路由 app.use("/api", apiRoutes);

### 3.2 JSONP 方式

JSONP 有些文章会叫动态创建 script，因为他确实是动态写入 script 标签的内容从而达到跨域的效果：

- AJAX 无法跨域是受到“同源政策”的限制，但是带有 src 属性的标签（例如`<script>、<img>、<iframe>`）是不受该政策限制的，因此我们可以通过向页面中动态添加`<script>`标签来完成对跨域资源的访问，这也是 JSONP 方案最核心的原理，换句话理解，就是利用了【前端请求静态资源的时候不存在跨域问题】这个思路。
- JSONP（JSON with Padding）是数据格式 JSON 的一种“使用模式”。
- JSONP 只能用 get 方式。

实现 jsonp 的方式：

![clipboard.png](https://static.segmentfault.com/v-5bd68eac/global/img/squares.svg)

引用来自[https://segmentfault.com/a/1190000012469713](https://segmentfault.com/a/1190000012469713)的图

- 客户端和服务器端约定一个参数名是代表 jsonp 请求的，例如约定 callback 这个参数名。
- 然后服务器端准备好针对之前约定的 callback 参数请求的 javascript 文件，这个文件里面要有一个函数名，要跟客户端请求的时候的函数名要保持一致。（如下面例子：`ip.js`）
- 然后客户端注册一个本地运行的函数,并且函数的名字要跟去请求服务器进行 callback 回调的函数的名字要一致。（如下面例子：foo 函数跟请求时候`callback=foo`的名字是一致的）
- 然后客户端对服务器端进行 `jsonp 的方式`请求。
- 服务器端返回刚才配置好的 js 文件（`ip.js`）到客户端
-

客户端浏览器，解析 script 标签，并执行返回的 javascript 文件，此时数据作为参数，传入到了客户端预先定义好的 callback 函数里。

- 相当于本地执行注册好 foo 函数，然后获取了一个 foo 函数，并且这个获取的 foo 函数里面包含了传入的参数（例如 `foo({XXXXX})`）

这是一个实例 demo：

服务器端文件`ip.js`

    foo({   "ip": "8.8.8.8" });

客户端文件 `jsonp.html`

```html
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title></title>
    <script>
      // 动态插入 script 标签到 html 中
      function addScriptTag(src) {
        var script = document.createElement("script");
        script.setAttribute("type", "text/javascript");
        script.src = src;
        document.body.appendChild(script);
      } // 获取 jsonp 文件
      window.onload = function() {
        addScriptTag("http://example.com/ip?callback=foo");
      }; // 执行本地的 js 逻辑，这个要跟获取到的 jsonp 文件的函数要一致
      function foo(data) {
        console.log("Your public IP address is: " + data.ip);
      }
    </script>
  </head>
  <body></body>
</html>
```

### 3.3 CORS 方式

CORS 是一个 W3C 标准，全称是"跨域资源共享"（Cross-origin resource sharing）。它允许浏览器向跨源服务器，发出`XMLHttpRequest`请求，从而克服了 AJAX 只能同源使用的限制。

- CORS 需要浏览器和服务器同时支持。目前，所有浏览器都支持该功能，IE 浏览器不能低于 IE10。
- 整个 CORS 通信过程，都是浏览器自动完成，不需要用户参与。对于开发者来说，CORS 通信与同源的 AJAX 通信没有差别，代码完全一样。**浏览器一旦发现 AJAX 请求跨源，就会自动添加一些附加的头信息，有时还会多出一次附加的请求，但用户不会有感觉。**

> 因此，实现 CORS 通信的关键是服务器端。只要服务器端实现了 CORS 接口，就可以跨源通信。

#### 3.3.1 CORS 的请求分为两类：

只要同时满足以下两大条件，就属于简单请求。

（1) 请求方法是以下三种方法之一：

（2）HTTP 的头信息不超出以下几种字段：

- Accept
- Accept-Language
- Content-Language
- Last-Event-ID
- Content-Type：只限于三个值 application/x-www-form-urlencoded、multipart/form-data、text/plain

凡是不同时满足上面两个条件，就属于非简单请求。

#### 3.3.2 简单请求

如果是简单请求的话，会自动在头信息之中，添加一个 Origin 字段

    GET /cors HTTP/1.1 Origin: http://api.bob.com  Host: api.alice.com Accept-Language: en-US Connection: keep-alive User-Agent: Mozilla/5.0...

这个 Origin 对应服务器端的`Access-Control-Allow-Origin`设置，所以一般来说需要在服务器端加上这个`Access-Control-Allow-Origin 指定域名|*`

#### 3.3.3 非简单请求

如果是非简单请求的话，会在正式通信之前，增加一次 HTTP 查询请求，称为"预检"请求（preflight）。

浏览器先询问服务器，当前网页所在的域名是否在服务器的许可名单之中，以及可以使用哪些 HTTP 动词和头信息字段。只有得到肯定答复，浏览器才会发出正式的 XMLHttpRequest 请求，否则就报错。

> 需要注意这里是会发送 2 次请求，第一次是预检请求，第二次才是真正的请求！

**首先发出预检请求：**

    // 预检请求 OPTIONS /cors HTTP/1.1 Origin: http://api.bob.com Access-Control-Request-Method: PUT Access-Control-Request-Headers: X-Custom-Header Host: api.alice.com Accept-Language: en-US Connection: keep-alive User-Agent: Mozilla/5.0..

除了 Origin 字段，"预检"请求的头信息包括两个特殊字段。

（1）`Access-Control-Request-Method`

该字段是必须的，用来列出浏览器的 CORS 请求会用到哪些 HTTP 方法，上例是 PUT。

（2）`Access-Control-Request-Headers`

该字段是一个逗号分隔的字符串，指定浏览器 CORS 请求会额外发送的头信息字段，上例是 X-Custom-Header。

**然后服务器收到"预检"请求以后：**

检查了`Origin`、`Access-Control-Request-Method`和`Access-Control-Request-Headers`字段以后，确认允许跨源请求，就可以做出回应。

    // 预检请求的回应 HTTP/1.1 200 OK Date: Mon, 01 Dec 2008 01:15:39 GMT Server: Apache/2.0.61 (Unix) Access-Control-Allow-Origin: http://api.bob.com Access-Control-Allow-Methods: GET, POST, PUT Access-Control-Allow-Headers: X-Custom-Header Content-Type: text/html; charset=utf-8 Content-Encoding: gzip Content-Length: 0 Keep-Alive: timeout=2, max=100 Connection: Keep-Alive Content-Type: text/plain

**最后一旦服务器通过了"预检"请求：**

以后每次浏览器正常的 CORS 请求，就都跟简单请求一样，会有一个 Origin 头信息字段。服务器的回应，也都会有一个 Access-Control-Allow-Origin 头信息字段。

    // 以后的请求，就像拿到了通行证之后，就不需要再做预检请求了。 PUT /cors HTTP/1.1 Origin: http://api.bob.com Host: api.alice.com X-Custom-Header: value Accept-Language: en-US Connection: keep-alive User-Agent: Mozilla/5.0...

详情参考这里[http://www.ruanyifeng.com/blog/2016/04/cors.html](http://www.ruanyifeng.com/blog/2016/04/cors.html)

---

参考文档：
