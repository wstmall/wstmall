alter table wst_log_sms add smsCode varchar(20);
INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,fieldSort) VALUES ('0', '默认城市', 'defaultCity', 'other',5);

INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,fieldTips,fieldSort) VALUES ('0', '热搜索词', 'hotSearchs', 'text','以，号分隔',12);

alter table wst_shops add qqNo varchar(20);

update wst_orders set orderStatus=4 where orderStatus=5;
update wst_orders set orderStatus=-7 where orderStatus=-5;