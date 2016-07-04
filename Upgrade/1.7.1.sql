alter table wst_communitys add latitude char(30);
alter table wst_communitys add longitude char(30);
alter table wst_communitys add mapLevel int default 13;

ALTER TABLE `wst_cart` ADD INDEX userId ( `userId` );
ALTER TABLE `wst_cart` ADD INDEX userId_2 ( `userId`,`isCheck` );

UPDATE wst_goods set saleTime=createTime WHERE saleTime is null;