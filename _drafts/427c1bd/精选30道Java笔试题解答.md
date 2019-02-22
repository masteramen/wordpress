---
layout: post
title:  "精选30道Java笔试题解答"
title2:  "精选30道Java笔试题解答"
date:   2018-10-31 14:02:56  +0800
source:  "http://www.cnblogs.com/lanxuezaipiao/p/3371224.html"
fileName:  "427c1bd"
lang:  "zh_CN"
published: false

---
都是一些非常非常基础的题，是我最近参加各大IT公司笔试后靠记忆记下来的，经过整理献给与我一样参加各大IT校园招聘的同学们，纯考Java基础功底，老手们就不用进来了，免得笑话我们这些未出校门的孩纸们，但是IT公司就喜欢考这些基础的东西，所以为了能进大公司就~~~当复习期末考吧。花了不少时间整理，在整理过程中也学到了很多东西，请大家认真对待每一题~~~

下面都是我自己的答案非官方，仅供参考，如果有疑问或错误请一定要提出来，大家一起进步啦~~~

1. 下面哪些是Thread类的方法（）

A start()       B run()       C exit()       D getPriority()

答案：ABD

解析：看Java API docs吧：http://docs.oracle.com/javase/7/docs/api/，exit()是System类的方法，如System.exit(0)。

2. 下面关于java.lang.Exception类的说法正确的是（）

A 继承自Throwable      B Serialable      CD 不记得，反正不正确

答案：A

解析：Java异常的基类为java.lang.Throwable，java.lang.Error和java.lang.Exception继承 Throwable，RuntimeException和其它的Exception等继承Exception，具体的RuntimeException继承RuntimeException。 

扩展：错误和异常的区别(Error vs Exception) 

1) **java.lang.Error**: Throwable的子类，用于标记严重错误。**合理的应用程序不应该去try/catch这种错误。绝大多数的错误都是非正常的，就根本不该出现的。
****java.lang.Exception**: Throwable的子类，用于指示一种合理的程序想去catch的条件。**即它仅仅是一种程序运行条件，而非严重错误，并且鼓励用户程序去catch它。**

2)  Error和RuntimeException 及其子类都是未检查的异常（unchecked exceptions），而所有其他的Exception类都是检查了的异常（checked exceptions）.
**checked exceptions: **通常是从一个可以恢复的程序中抛出来的，并且最好能够从这种异常中使用程序恢复。比如FileNotFoundException, ParseException等。检查了的异常发生在编译阶段，必须要使用try…catch（或者throws）否则编译不通过。
**unchecked exceptions: **通常是如果一切正常的话本不该发生的异常，但是的确发生了。发生在运行期，具有不确定性，主要是由于程序的逻辑问题所引起的。比如ArrayIndexOutOfBoundException, ClassCastException等。从语言本身的角度讲，程序不该去catch这类异常，虽然能够从诸如RuntimeException这样的异常中catch并恢复，但是并不鼓励终端程序员这么做，因为完全没要必要。因为这类错误本身就是bug，应该被修复，出现此类错误时程序就应该立即停止执行。 因此，面对Errors和unchecked exceptions应该让程序自动终止执行，程序员不该做诸如try/catch这样的事情，而是应该查明原因，修改代码逻辑。

RuntimeException：RuntimeException体系包括错误的类型转换、数组越界访问和试图访问空指针等等。

处理RuntimeException的原则是：如果出现 RuntimeException，那么一定是程序员的错误。例如，可以通过检查数组下标和数组边界来避免数组越界访问异常。其他（IOException等等）checked异常一般是外部错误，例如试图从文件尾后读取数据等，这并不是程序本身的错误，而是在应用环境中出现的外部错误。 

3. 下面程序的运行结果是（）

    String str1 = "hello";
     String str2 = "he" + new String("llo");
     System.err.println(str1 == str2);

答案：false

解析：因为str2中的llo是新申请的内存块，而==判断的是对象的地址而非值，所以不一样。如果是String str2 = str1，那么就是true了。

4. 下列说法正确的有（）

A． class中的constructor不可省略

B． constructor必须与class同名，但方法不能与class同名

C． constructor在一个对象被new时执行

D．一个class只能定义一个constructor

答案：C 

解析：这里可能会有误区，其实普通的类方法是可以和类名同名的，和构造方法唯一的区分就是，构造方法没有返回值。

5. 具体选项不记得，但用到的知识如下：

String []a = new String[10];

则：a[0]~a[9] = null

a.length = 10

如果是int []a = new int[10];

则：a[0]~a[9] = 0

a.length = 10

6. 下面程序的运行结果：（）

        publicstaticvoid main(String args[]) {
             Thread t = new Thread() {
     
                 publicvoid run() {
                     pong();
                 }
             };
     
             t.run();
             System.out.print("ping");
     
         }
     
         staticvoid pong() {
     
             System.out.print("pong");
     
         }

A pingpong        B pongping       C pingpong和pongping都有可能       D 都不输出

答案：B

解析：这里考的是Thread类中start()和run()方法的区别了。start()用来启动一个线程，当调用start方法后，系统才会开启一个新的线程，进而调用run()方法来执行任务，而单独的调用run()就跟调用普通方法是一样的，已经失去线程的特性了。因此在启动一个线程的时候一定要使用start()而不是run()。

7. 下列属于关系型数据库的是（）

A. Oracle    B MySql    C IMS     D MongoDB

答案：AB

解答：IMS（Information Management System ）数据库是IBM公司开发的两种数据库类型之一; 

一种是关系数据库，典型代表产品：DB2；

另一种则是层次数据库，代表产品：IMS层次数据库。

非关系型数据库有MongoDB、memcachedb、Redis等。

8. GC线程是否为守护线程？（）

答案：是

解析：线程分为守护线程和非守护线程（即用户线程）。

只要当前JVM实例中尚存在任何一个非守护线程没有结束，守护线程就全部工作；只有当最后一个非守护线程结束时，守护线程随着JVM一同结束工作。

**守护线程最典型的应用就是 GC (垃圾回收器)**

9. volatile关键字是否能保证线程安全？（）

答案：不能

解析：volatile关键字用在多线程同步中，可保证读取的可见性，JVM只是保证从主内存加载到线程工作内存的值是最新的读取值，而非cache中。但多个线程对

volatile的写操作，无法保证线程安全。例如假如线程1，线程2 在进行read,load 操作中，发现主内存中count的值都是5，那么都会加载这个最新的值，在线程1堆count进行修改之后，会write到主内存中，主内存中的count变量就会变为6；线程2由于已经进行read,load操作，在进行运算之后，也会更新主内存count的变量值为6；导致两个线程及时用volatile关键字修改之后，还是会存在并发的情况。

10. 下列说法正确的是（）

A LinkedList继承自List

B AbstractSet继承自Set

C HashSet继承自AbstractSet

D WeakMap继承自HashMap

答案：AC

解析：下面是一张下载的Java中的集合类型的继承关系图，一目了然。

![](http://my.csdn.net/uploads/201205/13/1336921705_7500.jpg)

11. 存在使i + 1 < i的数吗（）

答案：存在

解析：如果i为int型，那么当i为int能表示的最大整数时，i+1就溢出变成负数了，此时不就<i了吗。

扩展：存在使i > j || i <= j不成立的数吗（）

答案：存在

解析：比如Double.NaN或Float.NaN，感谢@[BuilderQiu](http://home.cnblogs.com/u/306742/)网友指出。

12. 0.6332的数据类型是（）

A float     B double     C Float      D Double

答案：B

解析：默认为double型，如果为float型需要加上f显示说明，即0.6332f

13. 下面哪个流类属于面向字符的输入流(  )

A  BufferedWriter           B  FileInputStream          C  ObjectInputStream          D  InputStreamReader

 答案：D

 解析：Java的IO操作中有面向字节(Byte)和面向字符(Character)两种方式。
面向字节的操作为以8位为单位对二进制的数据进行操作，对数据不进行转换，这些类都是InputStream和OutputStream的子类。
面向字符的操作为以字符为单位对数据进行操作，在读的时候将二进制数据转为字符，在写的时候将字符转为二进制数据，这些类都是Reader和Writer的子类。

总结：以InputStream（输入）/OutputStream（输出）为后缀的是字节流；

          以Reader（输入）/Writer（输出）为后缀的是字符流。

扩展：Java流类图结构，一目了然，解决大部分选择题：

![](https://pic002.cnblogs.com/images/2012/384764/2012031413373126.jpg)

14. Java接口的修饰符可以为（）

A private     B protected     C final       D abstract

答案：CD

解析：接口很重要，为了说明情况，这里稍微啰嗦点：

（1）接口用于描述系统对外提供的所有服务,因此接口中的成员常量和方法都必须是公开(public)类型的,确保外部使用者能访问它们；

（2）接口仅仅描述系统能做什么,但不指明如何去做,所以接口中的方法都是抽象(abstract)方法；

（3）接口不涉及和任何具体实例相关的细节,因此接口没有构造方法,不能被实例化,没有实例变量，只有静态（static）变量；

（4）接口的中的变量是所有实现类共有的，既然共有，肯定是不变的东西，因为变化的东西也不能够算共有。所以变量是不可变(final)类型，也就是常量了。

（5） 接口中不可以定义变量？如果接口可以定义变量，但是接口中的方法又都是抽象的，在接口中无法通过行为来修改属性。有的人会说了，没有关系，可以通过 实现接口的对象的行为来修改接口中的属性。这当然没有问题，但是考虑这样的情况。如果接口 A 中有一个public 访问权限的静态变量 a。按照 Java 的语义，我们可以不通过实现接口的对象来访问变量 a，通过 A.a = xxx; 就可以改变接口中的变量 a 的值了。正如抽象类中是可以这样做的，那么实现接口 A 的所有对象也都会自动拥有这一改变后的 a 的值了，也就是说一个地方改变了 a，所有这些对象中 a 的值也都跟着变了。这和抽象类有什么区别呢，怎么体现接口更高的抽象级别呢，怎么体现接口提供的统一的协议呢，那还要接口这种抽象来做什么呢？所以接口中 不能出现变量，如果有变量，就和接口提供的统一的抽象这种思想是抵触的。所以接口中的属性必然是常量，只能读不能改，这样才能为实现接口的对象提供一个统 一的属性。

通俗的讲，你认为是要变化的东西，就放在你自己的实现中，不能放在接口中去，接口只是对一类事物的属性和行为更高层次的抽象。对修改关闭，对扩展（不同的实现 implements）开放，接口是对开闭原则的一种体现。

所以：

接口的方法默认是public abstract；

接口中不可以定义变量即只能定义常量(加上final修饰就会变成常量)。所以接口的属性默认是public static final 常量，且必须赋初值。

注意：final和abstract不能同时出现。

15. 不通过构造函数也能创建对象吗（）

A 是     B 否

答案：A

解析：Java创建对象的几种方式（重要）：

(1) 用new语句创建对象，这是最常见的创建对象的方法。
(2) 运用反射手段,调用java.lang.Class或者java.lang.reflect.Constructor类的newInstance()实例方法。
(3) 调用对象的clone()方法。
(4) 运用反序列化手段，调用java.io.ObjectInputStream对象的 readObject()方法。

(1)和(2)都会明确的显式的调用构造函数 ；(3)是在内存上对已有对象的影印，所以不会调用构造函数 ；(4)是从文件中还原类的对象，也不会调用构造函数。

16. ArrayList list = new ArrayList(20);中的list扩充几次（）

A 0     B 1     C 2      D 3

答案：A

解析：这里有点迷惑人，大家都知道默认ArrayList的长度是10个，所以如果你要往list里添加20个元素肯定要扩充一次（扩充为原来的1.5倍），但是这里显示指明了需要多少空间，所以就一次性为你分配这么多空间，也就是不需要扩充了。

17. 下面哪些是对称加密算法（）

A DES   B AES   C DSA   D RSA

答案：AB

解析：常用的对称加密算法有：DES、3DES、RC2、RC4、AES

常用的非对称加密算法有：RSA、DSA、ECC

使用单向散列函数的加密算法：MD5、SHA

18.新建一个流对象，下面哪个选项的代码是错误的？（）

A）new BufferedWriter(new FileWriter("a.txt"));

B）new BufferedReader(new FileInputStream("a.dat"));

C）new GZIPOutputStream(new FileOutputStream("a.zip"));

D）new ObjectInputStream(new FileInputStream("a.dat"));

答案：B

解析：请记得13题的那个图吗？Reader只能用FileReader进行实例化。

19. 下面程序能正常运行吗（）

    publicclass NULL {
     
         publicstaticvoid haha(){
             System.out.println("haha");
         }
         publicstaticvoid main(String[] args) {
             ((NULL)null).haha();
         }
     
     }

答案：能正常运行

解析：输出为haha，因为null值可以强制转换为任何java类类型,(String)null也是合法的。但null强制转换后是无效对象，其返回值还是为null，而static方法的调用是和类名绑定的，不借助对象进行访问所以能正确输出。反过来，没有static修饰就只能用对象进行访问，使用null调用对象肯定会报空指针错了。这里和C++很类似。这里感谢@[Florian](http://home.cnblogs.com/u/405877/)网友解答。

20. 下面程序的运行结果是什么（）

    class HelloA {
     
         public HelloA() {
             System.out.println("HelloA");
         }
         
         { System.out.println("I'm A class"); }
         
         static { System.out.println("static A"); }
     
     }
     
     publicclass HelloB extends HelloA {
         public HelloB() {
             System.out.println("HelloB");
         }
         
         { System.out.println("I'm B class"); }
         
         static { System.out.println("static B"); }
         
         publicstaticvoid main(String[] args) { 
     　　　　 new HelloB(); 
     　　 }
     
     }

答案：

    static A
     static B
     I'm A class
     HelloA
     I'm B class
     HelloB

解析：说实话我觉得这题很好，考查静态语句块、构造语句块（就是只有大括号的那块）以及构造函数的执行顺序。

对象的初始化顺序：（1）类加载之后，按从上到下（从父类到子类）执行被static修饰的语句；（2）当static语句执行完之后,再执行main方法；（3）如果有语句new了自身的对象，将从上到下执行构造代码块、构造器（两者可以说绑定在一起）。

下面稍微修改下上面的代码，以便更清晰的说明情况：

此时输出结果为：

    static A
     static B
     -------main start-------
     I'm A class
     HelloA
     I'm B class
     HelloB
     I'm A class
     HelloA
     I'm B class
     HelloB
     -------main end-------

21. getCustomerInfo()方法如下，try中可以捕获三种类型的异常，如果在该方法运行中产生了一个IOException，将会输出什么结果（）

        publicvoid getCustomerInfo() {
     
             try {
     
                 // do something that may cause an Exception
             } catch (java.io.FileNotFoundException ex) {
     
                 System.out.print("FileNotFoundException!");
     
             } catch (java.io.IOException ex) {
     
                 System.out.print("IOException!");
     
             } catch (java.lang.Exception ex) {
     
                 System.out.print("Exception!");
     
             }
     
         }

A IOException!

BIOException!Exception!

CFileNotFoundException!IOException!

DFileNotFoundException!IOException!Exception!

答案：A

解析：考察多个catch语句块的执行顺序。当用多个catch语句时，catch语句块在次序上有先后之分。从最前面的catch语句块依次先后进行异常类型匹配，这样如果父异常在子异常类之前，那么首先匹配的将是父异常类，子异常类将不会获得匹配的机会，也即子异常类型所在的catch语句块将是不可到达的语句。所以，一般将父类异常类即Exception老大放在catch语句块的最后一个。

22. 下面代码的运行结果为：（）

    import java.io.*;
     import java.util.*;
     
     publicclass foo{
     
         publicstaticvoid main (String[] args){
     
             String s;
     
             System.out.println("s=" + s);
     
         }
     
     }

A 代码得到编译，并输出“s=”

B 代码得到编译，并输出“s=null”

C 由于String s没有初始化，代码不能编译通过
D 代码得到编译，但捕获到 NullPointException异常

答案：C

解析：开始以为会输出null什么的，运行后才发现Java中所有定义的基本类型或对象都必须初始化才能输出值。

23.  System.out.println("5" + 2);的输出结果应该是（）。

A 52                   B7                     C2                     D5

答案：A

解析：没啥好说的，Java会自动将2转换为字符串。

24. 指出下列程序运行的结果 （）

    publicclass Example {
     
         String str = new String("good");
     
         char[] ch = { 'a', 'b', 'c' };
     
         publicstaticvoid main(String args[]) {
     
             Example ex = new Example();
     
             ex.change(ex.str, ex.ch);
     
             System.out.print(ex.str + " and ");
     
             System.out.print(ex.ch);
     
         }
     
         publicvoid change(String str, char ch[]) {
     
             str = "test ok";
     
             ch[0] = 'g';
     
         }
     }

A、 good and abc

B、 good and gbc

C、 test ok and abc
D、 test ok and gbc 

答案：B

解析：大家可能以为Java中String和数组都是对象所以肯定是对象引用，然后就会选D，其实这是个很大的误区：**因为在java里没有引用传递，只有值传递**

这个值指的是实参的地址的拷贝，得到这个拷贝地址后，你可以通过它修改这个地址的内容（引用不变），因为此时这个内容的地址和原地址是同一地址，

但是你不能改变这个地址本身使其重新引用其它的对象，也就是值传递，可能说的不是很清楚，下面给出一个完整的能说明情况的例子吧：

![](https://images.cnblogs.com/OutliningIndicators/ContractedBlock.gif)![](https://images.cnblogs.com/OutliningIndicators/ExpandedBlockStart.gif)

    package test;
     
     /**
      * @description Java中没有引用传递只有值传递
      * 
      * @author Alexia
      * @date 2013-10-16
      * 
      */class Person {
     
         private String name;
     
         private String sex;
     
         public Person(String x, String y) {
             this.name = x;
             this.sex = y;
         }
     
         // 重写toString()方法，方便输出public String toString() {
     
             return name + " " + sex;
         }
     
         // 交换对象引用publicstaticvoid swapObject(Person p1, Person p2) {
             Person tmp = p1;
             p1 = p2;
             p2 = tmp;
         }
     
         // 交换基本类型publicstaticvoid swapInt(int a, int b) {
             int tmp = a;
             a = b;
             b = tmp;
         }
     
         // 交换对象数组publicstaticvoid swapObjectArray(Person[] p1, Person[] p2) {
             Person[] tmp = p1;
             p1 = p2;
             p2 = tmp;
         }
     
         // 交换基本类型数组publicstaticvoid swapIntArray(int[] x, int[] y) {
             int[] tmp = x;
             x = y;
             y = tmp;
         }
     
         // 改变对象数组中的内容publicstaticvoid changeObjectArray(Person[] p1, Person[] p2) {
             Person tmp = p1[1];
             p1[1] = p2[1];
             p2[1] = tmp;
             
             // 再将p1[1]修改
             Person p = new Person("wjl", "male");
             p1[1] = p;
         }
     
         // 改变基本类型数组中的内容publicstaticvoid changeIntArray(int[] x, int[] y) {
             int tmp = x[1];
             x[1] = y[1];
             y[1] = tmp;
     
             x[1] = 5;
         }
     }
     
     publicclass ByValueTest {
     
         publicstaticvoid main(String[] args) {
     
             // 建立并构造两个对象
             Person p1 = new Person("Alexia", "female");
             Person p2 = new Person("Edward", "male");
     
             System.out.println("对象交换前：p1 = " + p1.toString());
             System.out.println("对象交换前：p2 = " + p2.toString());
             
             // 交换p1对象和p2对象        Person.swapObject(p1, p2);
             // 从交换结果中看出，实际对象并未交换
             System.out.println("\n对象交换后：p1 = " + p1.toString());
             System.out.println("对象交换后：p2 = " + p2.toString());
     
             // 建立两个对象数组
             Person[] arraya = new Person[2];
             Person[] arrayb = new Person[2];
     
             // 分别构造数组对象
             arraya[0] = new Person("Alexia", "female");
             arraya[1] = new Person("Edward", "male");
             arrayb[0] = new Person("jmwang", "female");
             arrayb[1] = new Person("hwu", "male");
     
             System.out.println('\n' + "对象数组交换前：arraya[0] = "
                     + arraya[0].toString() + ", arraya[1] = "
                     + arraya[1].toString());
             System.out.println("对象数组交换前：arrayb[0] = "
                     + arrayb[0].toString() + ", arrayb[1] = "
                     + arrayb[1].toString());
             
             // 交换这两个对象数组        Person.swapObjectArray(arraya, arrayb);
             System.out.println('\n' + "对象数组交换后：arraya[0] = "
                     + arraya[0].toString() + ", arraya[1] = "
                     + arraya[1].toString());
             System.out.println("对象数组交换后：arrayb[0] = "
                     + arrayb[0].toString() + ", arrayb[1] = "
                     + arrayb[1].toString());
     
             // 建立两个普通数组int[] a = newint[2];
             int[] b = newint[2];
     
             // 给数组个元素赋值for (int i = 0; i < a.length; i++) {
                 a[i] = i;
                 b[i] = i + 1;
             }
     
             System.out.println('\n' + "基本类型数组交换前：a[0] = " + a[0] + ", a[1] = " + a[1]);
             System.out.println("基本类型数组交换前：b[0] = " + b[0] + ", b[1] = " + b[1]);
     
             // 交换两个基本类型数组        Person.swapIntArray(a, b);
             System.out.println('\n' + "基本类型数组交换后：a[0] = " + a[0] + ", a[1] = " + a[1]);
             System.out.println("基本类型数组交换后：b[0] = " + b[0] + ", b[1] = " + b[1]);
             
             // 改变对象数组的内容        Person.changeObjectArray(arraya, arrayb);
             System.out.println('\n' + "对象数组内容交换并改变后：arraya[1] = " + arraya[1].toString());
             System.out.println("对象数组内容交换并改变后：arrayb[1] = " + arrayb[1].toString());
             
             // 改变基本类型数组的内容        Person.changeIntArray(a, b);
             System.out.println('\n' + "基本类型数组内容交换并改变后：a[1] = " + a[1]);
             System.out.println("基本类型数组内容交换并改变后：b[1] = " + b[1]);
         }
     }

View Code 

程序有些啰嗦，但能反映问题，该程序运行结果为：

    对象交换前：p1 = Alexia female
     对象交换前：p2 = Edward male
     
     对象交换后：p1 = Alexia female
     对象交换后：p2 = Edward male
     
     对象数组交换前：arraya[0] = Alexia female, arraya[1] = Edward male
     对象数组交换前：arrayb[0] = jmwang female, arrayb[1] = hwu male
     
     对象数组交换后：arraya[0] = Alexia female, arraya[1] = Edward male
     对象数组交换后：arrayb[0] = jmwang female, arrayb[1] = hwu male
     
     基本类型数组交换前：a[0] = 0, a[1] = 1
     基本类型数组交换前：b[0] = 1, b[1] = 2
     
     基本类型数组交换后：a[0] = 0, a[1] = 1
     基本类型数组交换后：b[0] = 1, b[1] = 2
     
     对象数组内容交换并改变后：arraya[1] = wjl male
     对象数组内容交换并改变后：arrayb[1] = Edward male
     
     基本类型数组内容交换并改变后：a[1] = 5
     基本类型数组内容交换并改变后：b[1] = 1

**说明：不管是对象、基本类型还是对象数组、基本类型数组，在函数中都不能改变其实际地址但能改变其中的内容。**

25. 要从文件"file.dat"中读出第10个字节到变量c中,下列哪个方法适合? （）

A FileInputStream in=new FileInputStream("file.dat"); in.skip(9); int c=in.read();

B FileInputStream in=new FileInputStream("file.dat"); in.skip(10); int c=in.read();

C FileInputStream in=new FileInputStream("file.dat"); int c=in.read();

D RandomAccessFile in=new RandomAccessFile("file.dat"); in.skip(9); int c=in.readByte();

答案：A?D?

解析：long skip(long n)作用是跳过n个字节不读，主要用在包装流中的，因为一般流（如FileInputStream）只能顺序一个一个的读不能跳跃读，但是包装流可以用skip方法跳跃读取。那么什么是包装流呢？各种字节节点流类，它们都只具有读写字节内容的方法，以FileInputStream与FileOutputStream为例，它们只能在文件中读取或者向文件中写入字节，在实际应用中我们往往需要在文件中读取或者写入各种类型的数据，就必须先将其他类型的数据转换成字节数组后写入文件，或者从文件中读取到的字节数组转换成其他数据类型，想想都很麻烦！！因此想通过FileOutputStream将一个浮点小数写入到文件中或将一个整数写入到文件时是非常困难的。这时就需要包装类DataInputStream/DataOutputStream，它提供了往各种输入输出流对象中读入或写入各种类型的数据的方法。

DataInputStream/DataOutputStream并没有对应到任何具体的流设备，一定要给它传递一个对应具体流设备的输入或输出流对象，完成类似 DataInputStream/DataOutputStream功能的类就是一个包装类，也叫过滤流类或处理流类。它对InputOutStream/OutputStream流类进行了包装，使编程人员使用起来更方便。其中DataInputStream包装类的构造函数语法：public DataInputStream(InputStream in)。包装类也可以包装另外一个包装类。

首先BC肯定 是错的，那A正确吗？按上面的解析应该也不对，但我试了下，发现A也是正确的，与网上解析的资料有些出入，下面是我的code：

![](https://images.cnblogs.com/OutliningIndicators/ContractedBlock.gif)![](https://images.cnblogs.com/OutliningIndicators/ExpandedBlockStart.gif)

    import java.io.FileInputStream;
     import java.io.FileOutputStream;
     import java.io.IOException;
     
     publicclass FileStreamTest {
     
         publicstaticvoid main(String[] args) throws IOException {
             // TODO Auto-generated method stub
             FileOutputStream out = new FileOutputStream("file.dat");
     
             byte[] b = { 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 };
             out.write(b);
             out.close();
             
             FileInputStream in = new FileInputStream("file.dat");
             in.skip(9); // 跳过前面的9个字节int c = in.read();
             System.out.println(c);  // 输出为10        in.close();
         }
     
     }

View Code 

那么D呢，RandomAccessFile是IO包的类，但是其自成一派，从Object直接继承而来。可以对文件进行读取和写入。支持文件的随机访问，即可以随机读取文件中的某个位置内容，这么说RandomAccessFile肯定可以达到题目的要求，但是选项有些错误，比如RandomAccessFile的初始化是两个参数而非一个参数，采用的跳跃读取方法是skipBytes()而非skip()，即正确的写法是：

    RandomAccessFile in = new RandomAccessFile("file.dat", "r");
     in.skipBytes(9);
     int c = in.readByte();

这样也能读到第十个字节，也就是A和D都能读到第十个字节，那么到底该选哪个呢？A和D有啥不同吗？求大神解答~~~

26. 下列哪种异常是检查型异常，需要在编写程序时声明 （）

ANullPointerException        BClassCastException      CFileNotFoundException       D IndexOutOfBoundsException 

答案：C

解析：看第2题的解析。

27. 下面的方法，当输入为2的时候返回值是多少?（）

        publicstaticint getValue(int i) {
             int result = 0;
             switch (i) {
             case 1:
                 result = result + i;
             case 2:
                 result = result + i * 2;
             case 3:
                 result = result + i * 3;
             }
             return result;
         }

A0                    B2                    C4                     D10

答案：D

解析：注意这里case后面没有加break，所以从case 2开始一直往下运行。

28. 选项中哪一行代码可以替换题目中//add code here而不产生编译错误？（）

    publicabstractclass MyClass {
    publicint constInt = 5;
          //add code herepublicvoid method() {
          }
     }

Apublic abstract void method(int a);

B constInt = constInt + 5;

C public int method();

D public abstract void anotherMethod() {}

答案：A

解析：考察抽象类的使用。

抽象类遵循的原则：

（1）abstract关键字只能修饰类和方法，不能修饰字段。

（2）抽象类不能被实例化（无法使用new关键字创建对象实例），只能被继承。

（3）抽象类可以包含属性，方法，构造方法，初始化块，内部类，枚举类，和普通类一样，普通方法一定要实现，变量可以初始化或不初始化但不能初始化后在抽象类中重新赋值或操作该变量（只能在子类中改变该变量）。

（4）抽象类中的抽象方法（加了abstract关键字的方法）不能实现。

（5）含有抽象方法的类必须定义成抽象类。

扩展：抽象类和接口的区别，做个总结吧：

（1）接口是公开的，里面不能有私有的方法或变量，是用于让别人使用的，而抽象类是可以有私有方法或私有变量的。

（2）abstract class 在 Java 语言中表示的是一种继承关系，一个类只能使用一次继承关系。但是，一个类却可以实现多个interface，实现多重继承。接口还有标识（里面没有任何方法，如Remote接口）和数据共享（里面的变量全是常量）的作用。

（3）在abstract class 中可以有自己的数据成员，也可以有非abstarct的成员方法，而在interface中，只能够有静态的不能被修改的数据成员（也就是必须是 static final的，不过在 interface中一般不定义数据成员），所有的成员方法默认都是 public abstract 类型的。

（4）abstract class和interface所反映出的设计理念不同。其实abstract class表示的是"is-a"关系，interface表示的是"has-a"关系。

（5）实现接口的一定要实现接口里定义的所有方法，而实现抽象类可以有选择地重写需要用到的方法，一般的应用里，最顶级的是接口，然后是抽象类实现接口，最后才到具体类实现。抽象类中可以有非抽象方法。接口中则不能有实现方法。

（6）接口中定义的变量默认是public static final 型，且必须给其初值，所以实现类中不能重新定义，也不能改变其值。抽象类中的变量默认是 friendly 型，其值可以在子类中重新定义，也可以在子类中重新赋值。

29. 阅读Shape和Circle两个类的定义。在序列化一个Circle的对象circle到文件时，下面哪个字段会被保存到文件中？ (  )

    class Shape {
     
            public String name;
     
     }
     
     class Circle extends Shape implements Serializable{
     
            privatefloat radius;
     
            transientint color;
     
            publicstatic String type = "Circle";
     
     }

Aname

B radius

C color

D type

答案：B

解析：这里有详细的解释：[http://www.cnblogs.com/lanxuezaipiao/p/3369962.html](http://www.cnblogs.com/lanxuezaipiao/p/3369962.html)

30.下面是People和Child类的定义和构造方法，每个构造方法都输出编号。在执行new Child("mike")的时候都有哪些构造方法被顺序调用？请选择输出结果 ( )

    class People {
         String name;
     
         public People() {
             System.out.print(1);
         }
     
         public People(String name) {
             System.out.print(2);
             this.name = name;
         }
     }
     
     class Child extends People {
         People father;
     
         public Child(String name) {
             System.out.print(3);
             this.name = name;
             father = new People(name + ":F");
         }
     
         public Child() {
             System.out.print(4);
         }
         
     }

A312              B 32               C 432              D 132

答案：D

解析：考察的又是父类与子类的构造函数调用次序。在Java中，子类的构造过程中必须调用其父类的构造函数，是因为有继承关系存在时，子类要把父类的内容继承下来。但如果父类有多个构造函数时，该如何选择调用呢？

第一个规则：子类的构造过程中，必须调用其父类的构造方法。一个类，如果我们不写构造方法，那么编译器会帮我们加上一个默认的构造方法（就是没有参数的构造方法），但是如果你自己写了构造方法，那么编译器就不会给你添加了，所以有时候当你new一个子类对象的时候，肯定调用了子类的构造方法，但是如果在子类构造方法中我们并没有显示的调用基类的构造方法，如：super();  这样就会调用父类没有参数的构造方法。    

第二个规则：如果子类的构造方法中既没有显示的调用基类构造方法，而基类中又没有无参的构造方法，则编译出错，所以，通常我们需要显示的：super(参数列表)，来调用父类有参数的构造函数，此时无参的构造函数就不会被调用。

**总之，一句话：子类没有显示调用父类构造函数，不管子类构造函数是否带参数都默认调用父类无参的构造函数，若父类没有则编译出错。**

**最后，给大家出个思考题：下面程序的运行结果是什么？**

    publicclass Dervied extends Base {
     
         private String name = "dervied";
     
         public Dervied() {
             tellName();
             printName();
         }
         
         publicvoid tellName() {
             System.out.println("Dervied tell name: " + name);
         }
         
         publicvoid printName() {
             System.out.println("Dervied print name: " + name);
         }
     
         publicstaticvoid main(String[] args){
             
             new Dervied();    
         }
     }
     
     class Base {
         
         private String name = "base";
     
         public Base() {
             tellName();
             printName();
         }
         
         publicvoid tellName() {
             System.out.println("Base tell name: " + name);
         }
         
         publicvoid printName() {
             System.out.println("Base print name: " + name);
         }
     }
