INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,fieldTips,fieldSort) VALUES ('0', '¸ßµÂµØÍ¼key', 'gaodeKey', 'text','',12);
update wst_sys_configs set valueRange='1,2' where fieldCode='distributDeal';
update wst_sys_configs set fieldValue=2 where fieldCode='distributDeal' and fieldValue=0;