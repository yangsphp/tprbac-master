-- --------------------
-- Records of tp_admin
-- --------------------
insert into `tp_admin` (`id`,`username`,`password`,`salt`,`date_entered`,`login_entered`,`last_login_entered`,`login_ip`,`role_id`,`status`,`times`) values ('1','admin','ef0fdc8b1d6c53a971dbe905e4393018','ABCDE','2019-08-20 13:07:38','2020-04-09 20:21:48','2020-04-03 21:05:07','0.0.0.0','1','1','12');
insert into `tp_admin` (`id`,`username`,`password`,`salt`,`date_entered`,`login_entered`,`last_login_entered`,`login_ip`,`role_id`,`status`,`times`) values ('2','yangs','70edc7ddfeb0084679f1d73a646f9478','El2XS','2019-09-23 13:37:29','2020-03-27 19:45:20','2020-03-27 15:15:19','0.0.0.0','2','1','6');
-- --------------------
-- Records of tp_admin_log
-- --------------------
-- --------------------
-- Records of tp_auth
-- --------------------
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('150','权限管理','0','','','0','1','1','2020-03-26 15:03:05');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('151','角色管理','150','','role/index','0','1','1','2020-03-26 15:03:49');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('152','菜单管理','150','','menu/index','0','1','1','2020-03-26 15:04:13');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('153','管理员管理','150','','admin/index','0','1','1','2020-03-26 15:04:36');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('154','数据管理','0','','','0','1','1','2020-03-26 15:05:36');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('155','数据表管理','154','','database/index','0','1','1','2020-03-26 15:07:00');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('156','添加管理员','153','','admin/add','0','1','0','2020-03-27 10:24:31');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('157','编辑管理员','153','','admin/edit','0','1','0','2020-03-27 10:25:17');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('158','管理员列表','153','','admin/lst','0','1','0','2020-03-27 12:34:47');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('159','添加菜单','152','','menu/add','0','1','0','2020-03-27 12:40:42');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('160','编辑菜单','152','','menu/edit','0','1','0','2020-03-27 12:41:08');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('161','菜单列表','152','','menu/lst','0','1','0','2020-03-27 12:43:01');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('162','删除管理员','153','','admin/delete_op','0','1','0','2020-03-27 12:44:53');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('163','删除菜单','152','','menu/delete_op','0','1','0','2020-03-27 19:41:33');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('164','角色列表','151','','role/lst','0','1','0','2020-03-27 19:42:38');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('165','添加角色','151','','role/add','0','1','0','2020-03-27 19:43:02');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('166','删除角色','151','','role/delete_op','0','1','0','2020-03-27 19:43:24');
insert into `tp_auth` (`id`,`name`,`parent_id`,`icon`,`url`,`sort`,`status`,`is_menu`,`date_entered`) values ('167','编辑角色','151','','role/edit','0','1','0','2020-03-27 19:44:22');
-- --------------------
-- Records of tp_back_up
-- --------------------
insert into `tp_back_up` (`id`,`user_id`,`name`,`table`,`path`,`size`,`date_entered`) values ('17','1','20200404143951.sql','tp_admin,tp_admin_log,tp_auth,tp_back_up,tp_role','/upload/db/20200404143951.sql','5.05KB','2020-04-04 14:39:51');
insert into `tp_back_up` (`id`,`user_id`,`name`,`table`,`path`,`size`,`date_entered`) values ('19','1','20200408202007.sql','tp_admin','/upload/db/20200408202007.sql','0.67KB','2020-04-08 20:20:07');
-- --------------------
-- Records of tp_role
-- --------------------
insert into `tp_role` (`id`,`name`,`is_deleted`,`note`,`auth`,`date_entered`,`update_entered`) values ('1','超级管理员','0','','','2019-08-19 10:42:56','2020-03-25 15:21:19');
insert into `tp_role` (`id`,`name`,`is_deleted`,`note`,`auth`,`date_entered`,`update_entered`) values ('2','管理员','0','','150,153,158,151,164,154,155','2019-09-23 10:21:57','2020-03-27 19:45:01');
insert into `tp_role` (`id`,`name`,`is_deleted`,`note`,`auth`,`date_entered`,`update_entered`) values ('3','test','0','haha','6,14,27,7,145','2020-01-11 10:39:57','2020-03-26 10:44:48');
insert into `tp_role` (`id`,`name`,`is_deleted`,`note`,`auth`,`date_entered`,`update_entered`) values ('6','test2','0','','1,3,21,22,23,4,20,19,18','2020-03-26 10:45:36','2020-03-26 10:45:43');
