---
layout: post
title:  "数据库隔离级别---MySQL的默认隔离级别就是Repeatable,Oracle默认Read committed，最高级别Serializable"
title2:  "数据库隔离级别---MySQL的默认隔离级别就是Repeatable,Oracle默认Read committed，最高级别Serializable"
date:   2018-11-02 06:30:21  +0800
source:  "https://blog.csdn.net/baidu_37107022/article/details/77481670"
fileName:  "df0e0ff"
lang:  "zh_CN"
published: false

---
[数据库](http://lib.csdn.net/base/mysql "MySQL知识库")事务的隔离级别有4个，由低到高依次为Read uncommitted、Read committed、Repeatable read、Serializable，这四个级别可以逐个解决脏读、不可重复读、幻读这几类问题。

√: 可能出现    ×: 不会出现

<table border="1" cellpadding="2" cellspacing="0" width="90%"><tbody><tr><td></td><td><span>脏读</span></td><td><span>不可重复读</span></td><td><span>幻读</span></td></tr><tr><td><span>Read uncommitted</span></td><td><span>√</span></td><td><span>√</span></td><td><span>√</span></td></tr><tr><td><span>Read committed--<span>Sql Server , Oracle</span></span></td><td><span>×</span></td><td><span>√</span></td><td><span>√</span></td></tr><tr><td><span>Repeatable read--<a title="undefined" href="http://lib.csdn.net/base/14" rel="nofollow">MySQL</a></span></td><td><span>×</span></td><td><span>×</span></td><td><span>√</span></td></tr><tr><td><span>Serializable</span></td><td><span>×</span></td><td><span>×</span></td><td><span>×</span></td></tr></tbody></table>

注意：我们讨论隔离级别的场景，主要是在多个事务并发的情况下，因此，接下来的讲解都围绕事务并发。

##### Read uncommitted 读未提交

公司发工资了，领导把5000元打到singo的账号上，但是该事务并未提交，而singo正好去查看账户，发现工资已经到账，是5000元整，非常高兴。可是不幸的是，领导发现发给singo的工资金额不对，是2000元，于是迅速回滚了事务，修改金额后，将事务提交，最后singo实际的工资只有2000元，singo空欢喜一场。

出现上述情况，即我们所说的脏读，两个并发的事务，“事务A：领导给singo发工资”、“事务B：singo查询工资账户”，事务B读取了事务A尚未提交的数据。

当隔离级别设置为Read uncommitted时，就可能出现脏读，如何避免脏读，请看下一个隔离级别。

##### Read committed 读提交

singo拿着工资卡去消费，系统读取到卡里确实有2000元，而此时她的老婆也正好在网上转账，把singo工资卡的2000元转到另一账户，并在singo之前提交了事务，当singo扣款时，系统检查到singo的工资卡已经没有钱，扣款失败，singo十分纳闷，明明卡里有钱，为何......

出现上述情况，即我们所说的不可重复读，两个并发的事务，“事务A：singo消费”、“事务B：singo的老婆网上转账”，事务A事先读取了数据，事务B紧接了更新了数据，并提交了事务，而事务A再次读取该数据时，数据已经发生了改变。

当隔离级别设置为Read committed时，避免了脏读，但是可能会造成不可重复读。

大多数数据库的默认级别就是Read committed，比如Sql Server , [Oracle](http://lib.csdn.net/base/oracle "Oracle知识库")。如何解决不可重复读这一问题，请看下一个隔离级别。

##### Repeatable read 重复读

当隔离级别设置为Repeatable read时，可以避免不可重复读。当singo拿着工资卡去消费时，一旦系统开始读取工资卡信息（即事务开始），singo的老婆就不可能对该记录进行修改，也就是singo的老婆不能在此时转账。

虽然Repeatable read避免了不可重复读，但还有可能出现幻读。

singo的老婆工作在银行部门，她时常通过银行内部系统查看singo的信用卡消费记录。有一天，她正在查询到singo当月信用卡的总消费金额（select sum(amount) from transaction where month = 本月）为80元，而singo此时正好在外面胡吃海塞后在收银台买单，消费1000元，即新增了一条1000元的消费记录（insert transaction ... ），并提交了事务，随后singo的老婆将singo当月信用卡消费的明细打印到A4纸上，却发现消费总额为1080元，singo的老婆很诧异，以为出现了幻觉，幻读就这样产生了。

注：[MySQL](http://lib.csdn.net/base/14 "undefined")的默认隔离级别就是Repeatable read。

##### Serializable 序列化

Serializable是最高的事务隔离级别，同时代价也花费最高，性能很低，一般很少使用，在该级别下，事务顺序执行，不仅可以避免脏读、不可重复读，还避免了幻像读。

.........

READ UNCOMMITTED
----------------

READ UNCOMMITTED是限制性最弱的隔离级别，因为该级别忽略其他事务放置的锁。使用READ UNCOMMITTED级别执行的事务，可以读取尚未由其他事务提交的修改后的数据值，这些行为称为“脏”读。这是因为**在Read Uncommitted级别下，读取数据不需要加S锁，这样就不会跟被修改的数据上的X锁冲突**。比如，事务1修改一行，事务2在事务1提交之前读取了这一行。如果事务1回滚，事务2就读取了一行没有提交的数据，这样的数据我们认为是不存在的。

READ COMMITTED
--------------

READ COMMITTED(Nonrepeatable reads)是SQL Server默认的隔离级别。该级别通过指定语句不能读取其他事务已修改但是尚未提交的数据值，禁止执行脏读。在当前事务中的各个语句执行之间，其他事务仍可以修改、插入或删除数据，从而产生无法重复的读操作，或“影子”数据。比如，事务1读取了一行，事务2修改或者删除这一行并且提交。如果事务1想再一次读取这一行，它将获得修改后的数据或者发现这一样已经被删除，因此事务的第二次读取结果与第一次读取结果不同，因此也叫不可重复读。

### 实验1

query1：事务1

\--step1:创建实验数据 

select \* into Employee from AdventureWorks.HumanResources.Employee 

alter table Employee add constraint pk\_Employee\_EmployeeID primary key(EmployeeID) 

\--step2:设置隔离级别,这是数据库的默认隔离界别 

SET TRANSACTION ISOLATION LEVEL READ COMMITTED 

\--step3:开启第一个事务 

BEGIN TRAN tran1 

    --step4:执行select操作,查看VacationHours,对查找的记录加S锁，在语句执行完以后自动释放S锁 

    SELECT EmployeeID, VacationHours 

        FROM Employee  

        WHERE EmployeeID = 4; 

    --step5:查看当前加锁情况,没有发现在Employee表上面有锁,这是因为当前的隔离界别是READ COMMITTED 

    --在执行完step2以后马上释放了S锁. 

    SELECT request\_session\_id, resource\_type, resource\_associated\_entity\_id, 

        request\_status, request\_mode, resource\_description 

        FROM sys.dm\_tran\_locks

查看锁的情况如下图所示，我们发现在只有在数据库级别的S锁，而没有在表级别或者更低级别的锁，这是因为**在Read Committed级别下，S锁在语句执行完以后就被释放**。

query2：事务2

\--step6:开启第二个事务 

BEGIN TRAN tran2; 

    --step7:修改VacationHours,需要获得排它锁X,在VacationHours上没有有S锁 

    UPDATE Employee  

        SET VacationHours = VacationHours - 8   

        WHERE EmployeeID = 4; 

    --step8:查看当前加锁情况 

    SELECT request\_session\_id, resource\_type, resource\_associated\_entity\_id, 

        request\_status, request\_mode, resource\_description 

        FROM sys.dm\_tran\_locks

在开启另外一个update事务以后，我们再去查看当前的锁状况，如下图所示，我们发现在表(**Object**)级别上加了IX锁，在这张表所在的**Page**上也加了IX锁，因为表加了聚集索引，所以在叶子结点上加了X锁，这个锁的类型是**KEY**。

然后我们回到事务1当中再次执行查询语句，我们会发现查询被阻塞，我们新建一个查询query3来查看这个时候的锁状况，其查询结果如下，我们可以发现查询操作需要在KEY级别上申请S锁，在Page和表(Object)上面申请IS锁，但是因为Key上面原先有了X锁，与当前读操作申请的S锁冲突，所以这一步处于**WAIT**状态。

如果此时提交事务2的update操作，那么事务1的select操作不再被阻塞，得到查询结果，但是我们发现此时得到的查询结果与第一次得到的查询结果不同，这也是为什么将read committed称为不可重复读，因为同一个事物内的两次相同的查询操作的结果可能不同。

REPEATABLE READ
---------------

REPEATABLE READ是比READ COMMITTED限制性更强的隔离级别。该级别包括READ COMMITTED，并且另外指定了在当前事务提交之前，其他任何事务均不可以修改或删除当前事务已读取的数据。并发性低于 READ COMMITTED，因为已读数据的共享锁在整个事务期间持有，而不是在每个语句结束时释放。比如，事务1读取了一行，事务2想修改或者删除这一行并且提交，但是因为事务1尚未提交，数据行中有事务1的锁，事务2无法进行更新操作，因此事务2阻塞。如果这时候事务1想再一次读取这一行，它读取结果与第一次读取结果相同，因此叫可重复读。

### 实验2

query1：事务1

\--step1:创建实验数据 

select \* into Employee from AdventureWorks.HumanResources.Employee 

alter table Employee add constraint pk\_Employee\_EmployeeID primary key(EmployeeID) 

\--step2:设置隔离级别 

SET TRANSACTION ISOLATION LEVEL REPEATABLE READ 

\--step3:开启第一个事务 

BEGIN TRAN tran1 

    --step4:执行select操作,查看VacationHours 

    SELECT EmployeeID, VacationHours 

        FROM Employee  

        WHERE EmployeeID = 4; 

    --step5:查看当前加锁情况,发现在Employee表上面有S锁,这是因为当前的隔离界别是REPEATABLE READ 

    --S锁只有在事务执行完以后才会被释放. 

    SELECT request\_session\_id, resource\_type, resource\_associated\_entity\_id, 

        request\_status, request\_mode, resource\_description 

        FROM sys.dm\_tran\_locks

查询锁状态的结果如下图所示，我们发现在KEY上面加了S锁，在Page和Object上面加了IS锁，这是因为**在Repeatable Read级别下S锁要在事务执行完以后才会被释放**。

 query2：事务2

\--step6:开启第二个事务 

BEGIN TRAN tran2; 

    --step7:修改VacationHours,需要获得排他锁X,在VacationHours上有S锁，出现冲突，所以update操作被阻塞 

    UPDATE Employee  

        SET VacationHours = VacationHours - 8   

        WHERE EmployeeID = 4;

执行上述update操作的时候发现该操作被阻塞，这是因为update操作要加排它锁X，而因为原先的查询操作的S锁没有释放，所以两者冲突。我们新建一个查询3执行查询锁状态操作，发现结果如下图所示，我们可以发现是**WAIT**发生在对KEY加X锁的操作上面。

此时再次执行查询1中的select操作，我们发现查询结果跟第一次相同，所以这个叫做可重复读操作。但是可重复读操作并不是特定指两次读取的数据一模一样，Repeatable Read存在的一个问题是幻读，就是第二次读取的数据返回的条目数比第一次返回的条目数更多。

比如在Repeatable Read隔离级别下，事务1第一次执行查询select id from users where id>1 and id <10，返回的结果是2，4，6，8。这个时候事务1没有提交，那么对2，4，6，8上面依然保持有S锁。此时事务2执行一次插入操作insert into user(id) valuse(3)，插入成功。此时再次执行事务1中的查询，那么返回结果就是2，3，4，6，8。这里的3就是因为幻读而出现的。因此可以得出结论：**REPEATABLE READ隔离级别保证了在相同的查询条件下，同一个事务中的两个查询，第二次读取的内容肯定包换第一次读到的内容。**

SERIALIZABLE 
-------------

SERIALIZABLE 是限制性最强的隔离级别，因为该级别**锁定整个范围的键**，并一直持有锁，直到事务完成。该级别包括REPEATABLE READ，并增加了在事务完成之前，其他事务不能向事务已读取的范围**插入新行**的限制。比如，事务1读取了一系列满足搜索条件的行。事务2在执行SQL statement产生一行或者多行满足事务1搜索条件的行时会冲突，则事务2回滚。这时事务1再次读取了一系列满足相同搜索条件的行，第二次读取的结果和第一次读取的结果相同。

重复读与幻读
------

重复读是为了保证在一个事务中，相同查询条件下读取的数据值不发生改变，但是不能保证下次同样条件查询，结果记录数不会增加。

幻读就是为了解决这个问题而存在的，他将这个查询范围都加锁了，所以就不能再往这个范围内插入数据，这就是SERIALIZABLE 隔离级别做的事情。

隔离级别与锁的关系
---------

1.  在Read Uncommitted级别下，读操作不加S锁；
2.  在Read Committed级别下，读操作需要加S锁，但是在语句执行完以后释放S锁；
3.  在Repeatable Read级别下，读操作需要加S锁，但是在事务提交之前并不释放S锁，也就是必须等待事务执行完毕以后才释放S锁。
4.  在Serialize级别下，会在Repeatable Read级别的基础上，添加一个范围锁。保证一个事务内的两次查询结果完全一样，而不会出现第一次查询结果是第二次查询结果的子集。
