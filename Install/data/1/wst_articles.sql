SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_articles`
-- ----------------------------
DROP TABLE IF EXISTS `wst_articles`;
CREATE TABLE `wst_articles` (
  `articleId` int(11) NOT NULL AUTO_INCREMENT,
  `catId` int(11) NOT NULL,
  `articleTitle` varchar(200) NOT NULL,
  `articleImg` varchar(150) NOT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `articleContent` text NOT NULL,
  `articleKey` varchar(255) DEFAULT NULL,
  `staffId` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`articleId`),
  KEY `catId` (`catId`,`isShow`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_articles
-- ----------------------------
INSERT INTO `wst_articles` VALUES ('1', '1', 'wstmall正式上线', '', '1', '热烈庆祝wstmall正式上线 &amp;nbsp;帐户自助服务', 'wstmall', '1', '2015-03-14 16:48:58'),
('2', '2', '帐户自助服务', '', '1', '&amp;nbsp;帐户自助服务&amp;nbsp;帐户自助服务', '帐户自助服务', '1', '2015-04-09 21:37:30'),
('3', '3', '支付方式', '', '1', '支付方式&amp;nbsp;支付方式&amp;nbsp;支付方式&lt;br /&gt;', '支付方式', '1', '2015-04-09 21:37:56'),
('4', '4', '运费说明', '', '1', '运费说明 这里是运费说明', '运费说明', '1', '2015-04-09 21:38:12'),
('5', '5', '退换货原则和流程', '', '1', '&lt;p&gt;\n	&amp;nbsp; &amp;nbsp; &amp;nbsp; 退换货原则和流程 &amp;nbsp;\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;退换货原则和流程\n&lt;/p&gt;\n&lt;p&gt;\n	&amp;nbsp; &amp;nbsp; &amp;nbsp; 退换货原则和流程\n&lt;/p&gt;', '退换货原则和流程', '1', '2015-04-09 21:38:45'),
('6', '6', '帐号&amp;密码问题', '', '1', '&lt;u&gt;111111111111111&amp;nbsp;&lt;/u&gt;', '帐号&amp;密码问题', '1', '2015-04-09 21:39:06');
