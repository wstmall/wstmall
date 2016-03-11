SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_roles`
-- ----------------------------
DROP TABLE IF EXISTS `wst_roles`;
CREATE TABLE `wst_roles` (
  `roleId` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(30) NOT NULL,
  `grant` text,
  `createTime` datetime NOT NULL,
  `roleFlag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`roleId`),
  KEY `roleFlag` (`roleFlag`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_roles
-- ----------------------------
INSERT INTO `wst_roles` VALUES ('1', '商品管理员', 'spfl_00,spfl_01,spfl_02,spfl_03,ppgl_00,ppgl_01,ppgl_02,ppgl_03,splb_00,splb_04,splb_03,spsh_00,spsh_04,spsh_03,sppl_00,sppl_04,sppl_03', '2014-11-02 12:07:12', '1');
INSERT INTO `wst_roles` VALUES ('2', '门店管理员', 'dplb_00,dplb_01,dplb_02,dplb_03,dpsh_00,dpsh_04,dpsh_03', '2014-11-02 12:09:05', '1');
INSERT INTO `wst_roles` VALUES ('3', '系统管理员', 'spgl_00,spfl_00,spfl_01,spfl_02,spfl_03,ppgl_00,ppgl_01,ppgl_02,ppgl_03,splb_00,splb_04,spsh_00,spsh_04,sppl_00,sppl_04,sppl_03,ddgl_00,ddlb_00,ddts_00,ddts_04,tk_00,tk_04,bbtj_00,dttj_00,dpgl_00,dplb_00,dplb_01,dplb_02,dplb_03,dpsh_00,dqgl_00,dqlb_00,dqlb_01,dqlb_02,dqlb_03,sqlb_00,sqlb_01,sqlb_02,sqlb_03,wzgl_00,wzlb_00,wzlb_01,wzlb_02,wzlb_03,wzfl_00,wzfl_01,wzfl_02,wzfl_03,hygl_00,hydj_00,hydj_01,hydj_02,hydj_03,hylb_00,hylb_01,hylb_02,hylb_03,hyzh_00,hyzh_04,xtgl_00,jsgl_00,jsgl_01,jsgl_02,jsgl_03,zylb_00,zylb_01,zylb_02,zylb_03,dlrz_00,scsz_00,scxx_00,scxx_02,dhgl_00,dhgl_01,dhgl_02,dhgl_03,yqlj_00,yqlj_01,yqlj_02,yqlj_03,gggl_00,gggl_01,gggl_02,gggl_03,yhgl_00,yhgl_01,yhgl_02,yhgl_03,zfgl_00,zfgl_01,zfgl_02,zfgl_03', '2014-11-02 12:09:09', '1');
INSERT INTO `wst_roles` VALUES ('4', '客服', 'sppl_00,sppl_04,sppl_03', '2014-12-20 00:08:53', '1');
