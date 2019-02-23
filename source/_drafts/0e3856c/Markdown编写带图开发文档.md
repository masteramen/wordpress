---
layout: post
title:  "Markdown编写带图开发文档"
title2:  "Markdown编写带图开发文档"
date:   2018-11-01 04:08:54  +0800
source:  "https://www.jianshu.com/p/4c76d890aff1"
fileName:  "0e3856c"
lang:  "zh_CN"
published: false

---
使用mackdown编写开发文档时绕不过去的一道坎就是uml图，一图抵千言。怎么能高效有趣的搞定这件事情呢。答案是使用[plantUML](https://link.jianshu.com?t=http%3A%2F%2Fplantuml.com) 。plantuml除了可以绘制标准的uml图之外，还能绘制界面布局图、结构图、甘特图乃至于数学公式等。可谓“plantuml在手，天下我有”。

# 在Visual Code和Atom中使用

在Visual Code和Atom中使用的时候要安装一个插件 [Markdown Preview Enhanced](https://link.jianshu.com?t=https%3A%2F%2Fshd101wyy.github.io%2Fmarkdown-preview-enhanced%2F%23%2Fzh-cn%2F%3Fid%3Dmarkdown-preview-enhanced)然后就可以愉快的使用markdowm编写带图的开发文档了。

# 在pycharm中使用

要安装plantUml和Paste Images into Markdown 这两个插件。先使用plantuml画图，然后把图复制粘贴到markdown文档中。

在Mac下可以使用brew安装[pendoc](https://link.jianshu.com?t=http%3A%2F%2Fpandoc.org)和ImageMagick来输出word、pdf等格式。

    $ brew install Graphviz $ brew install ImageMagick $ brew install pandoc
