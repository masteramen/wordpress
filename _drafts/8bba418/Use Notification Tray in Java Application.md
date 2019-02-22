---
layout: post
title: "Use Notification Tray in Java Application"
title2: "Use Notification Tray in Java Application"
date: 2018-11-16 05:34:22  +0800
source: "http://geekonjava.blogspot.com/2014/07/use-notification-tray-in-java.html"
fileName: "8bba418"
lang: "en"
published: false
---

Hello friends we're see the notification tray of software at bottom right side. And at-least one time you'll also think how it work and can i make it for me.

Today i am teaching you how to use notification tray in java application.

Since Java SE 6, we can add an icon for our applications in the system tray area of the operating system.

[![](//3.bp.blogspot.com/-sMpUQuWtT7A/U8jFim_ImgI/AAAAAAAAAus/w23MgI9_HBw/s1600/notification.png)](//3.bp.blogspot.com/-sMpUQuWtT7A/U8jFim_ImgI/AAAAAAAAAus/w23MgI9_HBw/s1600/notification.png)

The following example is a basic implementation of SystemTray class.

import java.awt.\*; import java.awt.TrayIcon.MessageType; import javax.swing.ImageIcon; public class TrayNotification { public static void main(String\[\] args) throws AWTException { TrayNotification td = new TrayNotification(); td.displayTray(); } public void displayTray() throws AWTException{ //Obtain only one instance of the SystemTray object SystemTray tray = SystemTray.getSystemTray(); //Creating a tray icon ImageIcon icon = new ImageIcon(getClass().getResource("**notify.jpg**")); Image image = icon.getImage(); //System.out.println(image); TrayIcon trayIcon = new TrayIcon(image, "Tray Demo"); //Let the system resizes the image if needed trayIcon.setImageAutoSize(true); //Set tooltip text for the tray icon trayIcon.setToolTip("System tray icon demo"); tray.add(trayIcon); trayIcon.displayMessage("Hello, World", "This is demo from GeekOnJava", MessageType.INFO); } }

You can use any image which you want to show at bottom. Here **notify.jpg**

is a image file which place at where .class file exist.

Run and enjoy hopefully it work well for you.

https://stackoverflow.com/questions/21181758/how-to-show-an-alert-message-using-swt
https://github.com/lcaron/opal

http://www.blogjava.net/liaojiyong/archive/2007/01/12/93457.html

https://stackoverflow.com/questions/1970876/system-tray-menu-extras-icon-in-mac-os-using-java

https://github.com/jcgay/send-notification

http://git.eclipse.org/c/platform/eclipse.platform.swt.git/tree/examples/org.eclipse.swt.snippets/src/org/eclipse/swt/snippets/Snippet143.java

https://superuser.com/questions/666184/mac-run-java-program-at-launch

https://stackoverflow.com/questions/9680603/how-to-registerinstall-as-service-java-application-with-jsvc-wrapper-on-macos
