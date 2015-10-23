SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_brands`
-- ----------------------------
DROP TABLE IF EXISTS `wst_brands`;
CREATE TABLE `wst_brands` (
  `brandId` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(100) NOT NULL,
  `brandIco` varchar(150) NOT NULL,
  `brandDesc` text,
  `createTime` datetime NOT NULL,
  `brandFlag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`brandId`),
  KEY `brandFlag` (`brandFlag`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_brands
-- ----------------------------
INSERT INTO `wst_brands` VALUES ('7', '大大', 'Upload/brands/2015-05/554c248588e1a_thumb.gif', '大大', '2015-05-08 10:50:51', '1'),
 ('8', '德芙', 'Upload/brands/2015-05/554c24a0efdb9_thumb.jpg', '德芙', '2015-05-08 10:51:18', '1'),
 ('9', '金帝', 'Upload/brands/2015-05/554c24beef656_thumb.jpg', '金帝', '2015-05-08 10:51:47', '1'),
 ('10', '乐天', 'Upload/brands/2015-05/554c24cfc96fa_thumb.gif', '乐天', '2015-05-08 10:52:07', '1'),
 ('11', '好丽友', 'Upload/brands/2015-05/554c24e361a8e_thumb.gif', '好丽友', '2015-05-08 10:52:27', '1'),
 ('12', '金莎', 'Upload/brands/2015-05/554c24fc5e3f8_thumb.jpg', '金莎', '2015-05-08 10:52:48', '1'),
 ('13', '苏果', 'Upload/brands/2015-05/554c25d2b3b6b_thumb.jpg', '苏果', '2015-05-08 10:56:21', '1'),
 ('14', '城市果篮', 'Upload/brands/2015-05/554c25eb1c3ac_thumb.jpg', '城市果篮', '2015-05-08 10:56:45', '1'),
 ('15', '花果子', 'Upload/brands/2015-05/554c25ff28841_thumb.jpg', '&lt;b&gt;花果子&lt;/b&gt;', '2015-05-08 10:57:09', '1'),
 ('16', '福果园', 'Upload/brands/2015-05/554c261f575b7_thumb.jpg', '福果园', '2015-05-08 10:57:46', '1'),
 ('17', '香芒山', 'Upload/brands/2015-05/554c266dcce62_thumb.jpg', '香芒山', '2015-05-08 10:58:56', '1'),
 ('18', 'berry', 'Upload/brands/2015-05/554c267f44c8a_thumb.jpg', 'berry', '2015-05-08 10:59:18', '1'),
 ('19', '吉农沃尔特', 'Upload/brands/2015-05/556ad93feae62_thumb.png', '&lt;span style=&quot;color:#637160;font-family:宋体;font-size:16px;line-height:22px;background-color:#E53333;&quot;&gt;田间超市不错，很吸引人的眼球。&lt;/span&gt;', '2015-05-31 17:51:28', '1'),
 ('20', '鑫明有机', 'Upload/brands/2015-05/556adab7189d1_thumb.png', '鑫明有机食物', '2015-05-31 17:56:24', '1'),
 ('21', '一号农场', 'Upload/brands/2015-05/556adcacbfb6b_thumb.png', '一号农场一号农场一号农场', '2015-05-31 18:04:32', '1'),
 ('22', '万家鲜', 'Upload/brands/2015-05/556adf780f49d_thumb.png', '万家鲜万家鲜万家鲜', '2015-05-31 18:16:28', '1'),
 ('23', '新雅食品', 'Upload/brands/2015-05/556b08187ff38_thumb.png', '新雅食品新雅食品新雅食品新雅食品', '2015-05-31 21:09:46', '1'),
 ('24', '乐多菜园', 'Upload/brands/2015-05/556b099de97fe_thumb.png', '乐多菜园乐多乐多菜园', '2015-05-31 21:16:18', '1'),
 ('25', '乐宜美', 'Upload/brands/2015-06/556bb2e72aae5_thumb.png', '乐宜美乐宜美乐宜美', '2015-06-01 09:18:35', '1'),
 ('26', '好雅', 'Upload/brands/2015-06/556bb59a21690_thumb.png', '&lt;h1 style=&quot;font-size:16px;font-family:\'microsoft yahei\';background-color:#FFFFFF;&quot;&gt;\n	好雅 专做真空收纳袋压缩袋整理密封袋\n&lt;/h1&gt;', '2015-06-01 09:30:04', '1'),
 ('27', '厨之选', 'Upload/brands/2015-06/556bcffbb51c6_thumb.png', '厨之选厨之选厨之选厨之选', '2015-06-01 11:22:40', '1'),
 ('28', '新天力', 'Upload/brands/2015-06/556bd070c5596_thumb.png', '新天力厨房品牌', '2015-06-01 11:24:41', '1'),
 ('29', '雀巢咖啡', 'Upload/brands/2015-06/556be76dc0ded_thumb.jpg', '雀巢咖啡雀巢咖啡雀巢咖啡', '2015-06-01 13:02:46', '1'),
 ('30', '伊利奶粉', 'Upload/brands/2015-06/556c13f105821_thumb.jpg', '&lt;p&gt;\n	伊利奶粉。。。\n&lt;/p&gt;', '2015-06-01 16:12:42', '1'),
 ('31', '红牛', 'Upload/brands/2015-06/556c16e6cb44a_thumb.jpg', '红牛功能饮料', '2015-06-01 16:25:16', '1'),
 ('32', '佳得乐', 'Upload/brands/2015-06/556c176b0e6b7_thumb.jpg', '佳得乐饮料品牌', '2015-06-01 16:27:30', '1'),
 ('33', '美年达', 'Upload/brands/2015-06/556c1839c8fd5_thumb.jpg', '美年达碳酸饮料', '2015-06-01 16:30:59', '1'),
 ('34', '芬达', 'Upload/brands/2015-06/556c18a77133d_thumb.jpg', '芬达碳酸饮料', '2015-06-01 16:32:49', '1'),
 ('35', '康师傅', 'Upload/brands/2015-06/556c19392c43e_thumb.jpg', '康师傅康师傅康师傅康师傅', '2015-06-01 16:35:09', '1'),
 ('36', '美汁源', 'Upload/brands/2015-06/556c1aa14e0a8_thumb.jpg', '&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;美汁源&lt;span style=&quot;color:#333333;line-height:28px;font-family:Tahoma, &amp;quot;microsoft yahei&amp;quot;;font-size:20px;font-style:normal;background-color:#FFFFFF;&quot;&gt;美汁源&lt;span style=&quot;color:#333333;line-height:28px;font-family:Tahoma, &amp;quot;microsoft yahei&amp;quot;;font-size:20px;font-style:normal;background-color:#FFFFFF;&quot;&gt;美汁源&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;美汁源&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;', '2015-06-01 16:41:09', '1'),
 ('37', '太古方糖', 'Upload/brands/2015-06/556c1cfe9f650_thumb.jpg', '&lt;p&gt;\n	太古方糖。。。\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;', '2015-06-01 16:51:19', '1'),
 ('38', '麦斯威尔咖啡', 'Upload/brands/2015-06/556c1ded1236d_thumb.jpg', '&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;麦斯威尔咖啡品牌&lt;/span&gt;', '2015-06-01 16:55:15', '1'),
 ('39', '可比可拿铁咖啡', 'Upload/brands/2015-06/556c1e8a688dd_thumb.jpg', '&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;可比可拿铁咖啡&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;可比可拿铁咖啡&lt;/span&gt;&lt;/span&gt;', '2015-06-01 16:57:51', '1'),
 ('40', '摩卡咖啡', 'Upload/brands/2015-06/556c2089222b5_thumb.jpg', '摩卡咖啡摩卡咖啡', '2015-06-01 17:06:19', '1'),
 ('41', '福临门', 'Upload/brands/2015-06/556c261fe8586_thumb.jpg', '福临门', '2015-06-01 17:30:10', '1'),
 ('42', '鲁花花生油', 'Upload/brands/2015-06/556c278226813_thumb.jpg', '鲁花花生油鲁花花生油鲁花花生油鲁花花生油', '2015-06-01 17:36:03', '1'),
 ('43', '多力5珍宝', 'Upload/brands/2015-06/556c281dc1f4f_thumb.jpg', '&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	多力5珍宝多力5珍宝\n&lt;/p&gt;', '2015-06-01 17:38:44', '1'),
 ('44', '金龙鱼', 'Upload/brands/2015-06/556c29f537cab_thumb.jpg', '金龙鱼金龙鱼金龙鱼', '2015-06-01 17:46:31', '1'),
 ('45', '真真老老粽子', 'Upload/brands/2015-06/556c2ce99cb6d_thumb.jpg', '真真老老粽子真真老老粽子真真老老粽子', '2015-06-01 17:59:12', '1'),
 ('46', '五芳斋', 'Upload/brands/2015-06/556c2d94bb27c_thumb.jpg', '五芳斋 粽子', '2015-06-01 18:02:04', '1'),
 ('47', '银鹭', 'Upload/brands/2015-06/556c2e693b534_thumb.png', '&lt;span style=&quot;color:#333333;background-color:#FFFFFF;&quot;&gt;银鹭 椰果 八宝粥 &lt;/span&gt;', '2015-06-01 18:05:36', '1'),
 ('48', 'Walch/威露士', 'Upload/brands/2015-06/556c51eb10b5f_thumb.png', 'Walch/威露士Walch/威露士Walch/威露士', '2015-06-01 20:37:02', '1'),
 ('49', '妍妍', 'Upload/brands/2015-06/556c52f9d84f3_thumb.png', '妍妍女性用品', '2015-06-01 20:41:31', '1'),
 ('50', '巴黎小站', 'Upload/brands/2015-06/556c541eca2cb_thumb.png', '&lt;p&gt;\n	巴黎小站\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;', '2015-06-01 20:46:51', '1'),
 ('51', '施巴', 'Upload/brands/2015-06/556c5611a70a8_thumb.png', '施巴施巴', '2015-06-01 20:54:46', '1'),
 ('52', 'Free', 'Upload/brands/2015-06/556c56c98fe30_thumb.png', '&amp;nbsp;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Free&amp;nbsp;\n&lt;/h1&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Free\n&lt;/h1&gt;', '2015-06-01 20:57:53', '1'),
 ('53', '西尼', 'Upload/brands/2015-06/556c586531e87_thumb.png', '西尼西尼', '2015-06-01 21:04:50', '1'),
 ('54', 'beely', 'Upload/brands/2015-06/556c5ce375bad_thumb.png', 'beely&amp;nbsp; beely', '2015-06-01 21:23:53', '1'),
 ('55', 'Veet/薇婷', 'Upload/brands/2015-06/556c5d7ac1a74_thumb.png', '&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Veet/薇婷\n&lt;/h1&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Veet/薇婷\n&lt;/h1&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Veet/薇婷\n&lt;/h1&gt;', '2015-06-01 21:26:24', '1'),
 ('56', '番茄派', 'Upload/brands/2015-06/556c5f1996e13_thumb.png', '&lt;p&gt;\n	番茄派\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	番茄派\n&lt;/h1&gt;', '2015-06-01 21:33:22', '1'),
 ('57', '欧丽丝', 'Upload/brands/2015-06/556c5fdce2461_thumb.png', '&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	欧丽丝\n&lt;/h1&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	欧丽丝\n&lt;/h1&gt;', '2015-06-01 21:36:30', '1'),
 ('58', 'STENDERS施丹兰', 'Upload/brands/2015-06/556c6040c9bd0_thumb.png', '&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	STENDERS施丹兰\n&lt;/h1&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	STENDERS施丹兰\n&lt;/h1&gt;', '2015-06-01 21:38:12', '1'),
 ('59', 'Rewiwax蕾沃斯', 'Upload/brands/2015-06/556c60d90746b_thumb.png', '&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Rewiwax蕾沃斯\n&lt;/h1&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Rewiwax蕾沃斯\n&lt;/h1&gt;\n&lt;h1 style=&quot;color:#000000;text-indent:0px;background-color:#FFFFFF;&quot;&gt;\n	Rewiwax蕾沃斯\n&lt;/h1&gt;', '2015-06-01 21:40:44', '1');
