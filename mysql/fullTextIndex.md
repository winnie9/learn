### 全文索引 mysql 5.6 以后 支持中文


#### mysql 配置 [my.cnf]

启动触发字符长度

```
# vim /etc/my.cnf
[mysqld]
ngram_token_size=1 

```

```SQL

CREATE TABLE y_articles (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    title VARCHAR (200) NOT NULL default '',
    body TEXT,
    FULLTEXT (title, body) WITH PARSER ngram # 全文索引 创建方式 三 
) ENGINE = INNODB;

# 创建方式 一 

ALTER TABLE y_articles ADD FULLTEXT INDEX ft_index (title,body) WITH PARSER ngram;

# 创建方式 二 
CREATE FULLTEXT INDEX ft_index ON y_articles (title,body) WITH PARSER ngram;

SELECT * FROM y_articles
WHERE MATCH (title,body)
AGAINST ('中国 重庆' IN NATURAL LANGUAGE MODE);

// 不指定模式，默认使用自然语言模式
SELECT * FROM y_articles
WHERE MATCH (title,body)
AGAINST ('重庆');

```

```
MySQL 内置的修饰符，上面查询最小搜索长度时，搜索结果 ft_boolean_syntax 变量的值就是内置的修饰符，下面简单解释几个，更多修饰符的作用可以查手册

+ 必须包含该词

- 必须不包含该词

> 提高该词的相关性，查询的结果靠前

(*)星号 通配符，只能接在词后面

对于上面提到的问题，可以使用布尔全文索引查询来解决，使用下面的命令，a、aa、aaa、aaaa 就都被查询出来了。

select * y_articles where match(body) against('a*' in boolean mode);
```