---
layout: post
title: "Node.js的系统通知"
title2: "System Notifications with Node.js"
date: 2018-11-13 02:17:01  +0800
source: "https://davidwalsh.name/system-notifications-node"
fileName: "f5402e2"
lang: "en"
published: false
---

![Node Notifications](https://davidwalsh.name/demo/node-notifier.png)

Notifications can be a godsend or the bane of our existence these days.  Every app you install on your phone wants access to notifications, as do desktop apps, and now we have a [Web Notifications API](https://davidwalsh.name/notifications-api) along with a [Web Push API](https://developer.mozilla.org/en-US/docs/Web/API/Push_API),  just in case you don't already have enough notifications in your life.  Appointment reminders from Calendar are always welcome (I'd otherwise forget every event) but does Wacky Mini Golf really need to notify me that I haven't played in 4 days?  Probably not.
如今，通知可能是天赐之物或我们存在的祸根。您在手机上安装的每个应用都需要访问通知，桌面应用也是如此，现在我们有[Web Notifications API]（https://davidwalsh.name/notifications-api）和[Web Push API]（https ：//developer.mozilla.org/en-US/docs/Web/API/Push_API），以防万一你的生活中没有足够的通知。欢迎来自日历的预约提醒（否则我会忘记每一个活动）但是 Wacky Mini Golf 真的需要通知我我 4 天没玩过吗？可能不是。(zh_CN)

Anyways, I was thinking about notifications and how I could use them to remember stuff I needed to do at 1. How many interviewers did you meet?
2.Who are they?

3. What questions (general / technical) they asked for (grateful if you share more in detail with me)?
4. Did they share the role with you? (i.e.Duties or software using, grateful if you share more details with me)
5. How long did you meet them?
6. Are you interested in the role?
7. Did you answer then well? And what do you think your performance?
8. Did they discuss salary, work location, etc. with you?
9. If they give you offer, will you accept it?a certain time during the current day; i.e. remind myself to go eat lunch, go for a bike ride, or go pick my son up from school on the odd day.  Being a JavaScript nerd I decided to look into creating Mac notifications using Node.js and I quickly found my answer: [`node-notifier`](https://github.com/mikaelbr/node-notifier)!  Let's take a look!
   无论如何，我正在考虑通知以及如何使用它们来记住我在当天某个时间需要做的事情;即提醒自己去吃午饭，去骑自行车，或者在奇怪的一天从学校接我的儿子。作为一个 JavaScript 书呆子我决定使用 Node.js 创建 Mac 通知，我很快找到了答案：[`node-notifier`](https://github.com/mikaelbr/node-notifier）！让我们来看看！(zh_CN)

Create a Simple Notification
创建简单通知(zh_CN)

---

`node-notifier` works on both Mac and Windows PCs.  Notifications can range from very simple to advanced so let's first create a very simple notification:
`node-notifier`  适用于 Mac 和 Windows PC。通知可以从非常简单到高级，所以让我们首先创建一个非常简单的通知：(zh_CN)

const notifier = require('node-notifier');

// String
notifier.notify('Go empty the dishwasher!');
notifier.notify（'去洗碗机！'）;(zh_CN)

// Object
// 宾语(zh_CN)
notifier.notify({
'title': 'David Walsh Blog',
'标题'：'David Walsh 博客'，(zh_CN)
'subtitle': 'Daily Maintenance',
'副标题'：'每日维护'，(zh_CN)
'message': 'Go approve comments in moderation!',
'消息'：'批准审批评论！'，(zh_CN)
'icon': 'dwb-logo.png',
'contentImage': 'blog.png',
'sound': 'ding.mp3',
'声音'：'ding.mp3'，(zh_CN)
'wait': true
'等等'：是的(zh_CN)
});

You can provide `notifier` the basics like an `title`, `message`, and `icon`, then go further to add a content image, a sound, and even control the buttons that display in the notification.
你可以提供`notifier`  像一个基础知识`title`, `message`, 和`icon`, 然后进一步添加内容图像，声音，甚至控制通知中显示的按钮。(zh_CN)

Advanced Notifications
高级通知(zh_CN)

---

You can create advanced, feature-rich notifications with `node-notifier`, including the ability to reply, control the notification button labels, and more.  The following is a more advanced example:
您可以使用创建高级，功能丰富的通知`node-notifier`, 包括回复，控制通知按钮标签等功能。以下是一个更高级的示例：(zh_CN)

const NotificationCenter = require('node-notifier').NotificationCenter;

var notifier = new NotificationCenter({
withFallback: false, // Use Growl Fallback if <= 10.8
withFallback：false，//如果<= 10.8，则使用 Growl Fallback(zh_CN)
customPath: void 0 // Relative/Absolute path to binary if you want to use your own fork of terminal-notifier
customPath：void 0 //如果要使用自己的终端通知器分支，则为二进制的相对/绝对路径(zh_CN)
});

notifier.notify({
'title': void 0,
'subtitle': void 0,
'副标题'：void 0，(zh_CN)
'message': 'Click "reply" to send a message back!',
'消息'：'点击“回复”发回消息！'，(zh_CN)
'sound': false, // Case Sensitive string for location of sound file, or use one of macOS' native sounds (see below)
'sound'：false，//用于声音文件位置的敏感字符串，或使用 macOS 的原生声音之一（见下文）(zh_CN)
'icon': 'Terminal Icon', // Absolute Path to Triggering Icon
'icon'：'终端图标'，//触发图标的绝对路径(zh_CN)
'contentImage': void 0, // Absolute Path to Attached Image (Content Image)
'contentImage'：void 0，//附加图像的绝对路径（内容图像）(zh_CN)
'open': void 0, // URL to open on Click
'打开'：void 0，//在 Click 上打开的 URL(zh_CN)
'wait': false, // Wait for User Action against Notification or times out. Same as timeout = 5 seconds
'wait'：false，//等待针对通知的用户操作或超时。与超时= 5 秒相同(zh_CN)

// New in latest version. See \`example/macInput.js\` for usage
// 最新版本的新功能。见\`example/macInput.js\` 用法(zh_CN)
timeout: 5, // Takes precedence over wait if both are defined.
timeout：5，//如果两者都被定义，则优先于 wait。(zh_CN)
closeLabel: void 0, // String. Label for cancel button
closeLabel：void 0，// String。取消按钮的标签(zh_CN)
actions: void 0, // String | Array<String>. Action label or list of labels in case of dropdown
actions：void 0，// String |阵列<字符串>。下拉列表中的操作标签或标签列表(zh_CN)
dropdownLabel: void 0, // String. Label to be used if multiple actions
dropdownLabel：void 0，// String。如果有多个动作，则使用标签(zh_CN)
reply: false // Boolean. If notification should take input. Value passed as third argument in callback and event emitter.
回复：false //布尔值。如果通知应该输入。值作为回调和事件发射器中的第三个参数传递。(zh_CN)
}, function(error, response, metadata) {
}, 功能（错误，响应，元数据）{(zh_CN)
console.log(error, response, metadata);
console.log（错误，响应，元数据）;(zh_CN)
});

Here's a quick peak at the type of actions your notifications can make:
以下是您的通知可以执行的操作类型的快速高峰：(zh_CN)

![Notifier](https://davidwalsh.name/demo/notifier-example.gif)

Events
活动(zh_CN)

---

`node-notifier` is capable of sending `click` and `close` events -- handy for triggering specific actions depending on how the user interacts with the notification:
`node-notifier`  能够发送`click`  和`close`  事件 - 根据用户与通知的交互方式触发特定操作很方便：(zh_CN)

// Open the DWB website!
// 打开 DWB 网站！(zh_CN)
notifier.on('click', (obj, options) => {
const spawn = require('child_process').spawn;
const cmd = spawn('open', \['https://davidwalsh.name'\]);
});

notifier.on('close', (obj, options) => {});

The sample above allows me to click on the notification to launch my website; one could also use this to trigger other routines on their machine, of course, it simply depends on what the notification is for.
上面的示例允许我点击通知来启动我的网站;也可以使用它来触发其机器上的其他例程，当然，它只取决于通知的用途。(zh_CN)

You can get very detailed with your Notification objects and events per platform so be sure to check out the `node-notifier` API if you really want to dig deep.  Or if you're a sane person, maybe skip out on more notifications in your life!
您可以非常详细地了解每个平台的 Notification 对象和事件，因此请务必查看`node-notifier` API，如果你真的想深入挖掘。或者，如果你是一个理智的人，也许可以跳过你生活中的更多通知！(zh_CN)

.x-secondary-small { display: none; } @media only screen and (max-width: 600px) { .x-secondary { max-height: none; } .x-secondary-large { display: none; } .x-secondary-small { display: block; } }

https://github.com/KleoPetroff/global-keyboard.git
