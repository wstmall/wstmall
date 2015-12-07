SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `wst_navs`;
CREATE TABLE `wst_navs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `navType` tinyint(4) NOT NULL DEFAULT '0',
  `areaId1` int(11) DEFAULT NULL,
  `areaId2` int(11) DEFAULT NULL,
  `navTitle` varchar(50) NOT NULL,
  `navUrl` varchar(100) NOT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `isOpen` tinyint(4) NOT NULL DEFAULT '0',
  `navSort` int(11) NOT NULL DEFAULT '0',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO `wst_navs` VALUES ('1', '0', '0', '0', '品牌街', 'index.php/Home/Brands/index.html', '1', '0', '2', '2015-07-12 20:08:22'),
('2', '0', '0', '0', '首页', 'index.php', '1', '0', '0', '2015-07-12 20:08:36'),
('3', '0', '0', '0', '店铺街', 'index.php/Home/Shops/toShopStreet.html', '1', '0', '3', '2015-07-12 20:10:00'),
('4', '0', '0', '0', '自营店铺', 'index.php/Home/Shops/toShopHome.html', '1', '0', '4', '2015-07-12 20:11:21'),
('5', '1', '0', '0', '关于我们', '#', '1', '0', '0', '2015-07-12 20:25:58'),
('7', '1', '0', '0', 'WST百科', '#', '1', '0', '0', '2015-07-12 23:02:39'),
('10', '1', '0', '0', '诚征英才', '#', '1', '0', '0', '2015-07-12 23:04:41'),
('8', '1', '0', '0', '帮助中心', '#', '1', '0', '0', '2015-07-12 23:03:43'),
('9', '1', '0', '0', '交易条款', '#', '1', '0', '0', '2015-07-12 23:03:55'),
('11', '1', '0', '0', '网站地图', '#', '1', '0', '0', '2015-07-12 23:04:51'),
('12', '1', '0', '0', '友情链接', '#', '1', '0', '0', '2015-07-12 23:05:08'),
('13', '1', '0', '0', '店铺管理', 'shop.php', '1', '0', '0', '2015-07-12 23:05:42');
