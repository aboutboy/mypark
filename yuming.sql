# Host: localhost  (Version: 5.5.53)
# Date: 2020-06-15 10:12:46
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "cp_domain"
#

CREATE TABLE `cp_domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cid` int(3) NOT NULL COMMENT '分类ID',
  `rid` int(3) DEFAULT NULL COMMENT '注册商ID',
  `uid` int(11) unsigned DEFAULT '0',
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `domain` varchar(255) DEFAULT NULL COMMENT '域名',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `logo` varchar(255) DEFAULT NULL COMMENT 'LOGO',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键词',
  `description` text COMMENT '描述',
  `regtime` int(11) DEFAULT NULL COMMENT '注册时间',
  `stoptime` int(11) DEFAULT NULL COMMENT '到期时间',
  `url` varchar(255) DEFAULT NULL COMMENT '跳转',
  `data` text COMMENT '数据',
  `status` int(1) DEFAULT NULL COMMENT '状态',
  `price` int(11) unsigned DEFAULT '0',
  `email` varchar(64) DEFAULT '',
  `qq` varchar(20) DEFAULT '',
  `tel` varchar(32) DEFAULT '',
  `mobile` varchar(32) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `domain` (`domain`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='域名表';

#
# Data for table "cp_domain"
#

INSERT INTO `cp_domain` VALUES (1,1,5,0,'大米先生','damixs.com','大米先生','','大米,大米先生,dami','此域名非常适合作为大米先生的域名',1591793156,1655231321,'','czo0Mjoi54m55Lu35LyY5oOg5Lit77yM6KaB55qE6LW257Sn6IGU57O744CC44CCIjs=',1,3421,'cnwinla@gmail.com','1307857445','343434','232323'),(2,1,4,1,'一起看小说','yqkxs.com','一起看小说','','一起看小说,一起看','一起看小说',1591793537,0,'','czo0NToi5p2l5ZCn77yM5LiA6LW355yL5bCP6K+077yM572R5Z2A77yaeXFreHMuY29tIjs=',1,0,NULL,NULL,NULL,NULL),(3,2,2,2,'我们的小说','wmdxs.com','我们的小说','','我们的小说,wmdxs','我们的小说网wmdxs.com',1591793806,0,'','czo5OiJ3bWR4cy5jb20iOw==',1,0,NULL,NULL,NULL,NULL),(4,1,4,4,'目录小说','muluxs.com','muluxs','','muluxs,目录小说','目录小说网，域名好记',1592141080,1592141080,'','czozMDoi5LiN6ZSZ55qE5Z+f5ZCN77yM6Z2e5bi45bmy5YeAIjs=',1,50000,'91haoma@gmail.com','1307857445','0755-23435434','13983332221');

#
# Structure for table "cp_domain_class"
#

CREATE TABLE `cp_domain_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `tid` int(11) NOT NULL COMMENT '上级ID',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `info` text NOT NULL COMMENT '介绍',
  `status` int(2) NOT NULL COMMENT '状态',
  `sort` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='域名分类';

#
# Data for table "cp_domain_class"
#

INSERT INTO `cp_domain_class` VALUES (1,0,'拼音域名','',1,1),(2,0,'单词域名','',1,2),(3,0,'数字域名','',1,3),(4,0,'三杂域名','',1,4),(5,0,'四杂域名','',1,5);

#
# Structure for table "cp_domain_registrar"
#

CREATE TABLE `cp_domain_registrar` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `info` text NOT NULL COMMENT '介绍',
  `status` int(2) NOT NULL COMMENT '状态',
  `sort` int(3) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='域名注册商';

#
# Data for table "cp_domain_registrar"
#

INSERT INTO `cp_domain_registrar` VALUES (1,'阿里云','包括原万网',1,1),(2,'22.cn','爱名网',1,2),(3,'趣域网','',1,3),(4,'Godaddy','godaddy.com',1,1),(5,'Namesilo','namesilo.com',1,2);

#
# Structure for table "cp_user"
#

CREATE TABLE `cp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) NOT NULL DEFAULT '',
  `regtime` int(11) unsigned NOT NULL DEFAULT '0',
  `lasttime` int(11) unsigned NOT NULL DEFAULT '0',
  `regip` varchar(20) NOT NULL DEFAULT '0',
  `lastip` varchar(20) NOT NULL DEFAULT '0',
  `email` varchar(64) DEFAULT '',
  `profile` varchar(255) DEFAULT '',
  `statistic` varchar(1023) DEFAULT '',
  `enable` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "cp_user"
#

INSERT INTO `cp_user` VALUES (0,'abc','21232f297a57a5a743894a0e4a801fc3',0,1592150005,'0','127.0.0.1','cnwinla@gmail.com','我真的很不爽','<script>\nvar _hmt = _hmt || [];\n(function() {\n  var hm = document.createElement(\"script\");\n  hm.src = \"https://hm.baidu.com/hm.js?6d2f50d2c7b260e93f9744e1f200e46c\";\n  var s = document.getElementsByTagName(\"script\")[0]; \n  s.parentNode.insertBefore(hm, s);\n})();\n</script>',1),(1,'abcd','21232f297a57a5a743894a0e4a801fc3',0,1592149848,'0','1270','','','',1),(2,'user','21232f297a57a5a743894a0e4a801fc3',0,1592151977,'0','127.0.0.1','yeesys@gmail.com','草泥马共产党','',1),(3,'do','21232f297a57a5a743894a0e4a801fc3',0,0,'0','0','','','',1),(4,'doit','21232f297a57a5a743894a0e4a801fc3',0,0,'0','0','','','',1);
