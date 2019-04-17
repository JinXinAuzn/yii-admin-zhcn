/*
 Navicat Premium Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 50641
 Source Host           : 127.0.0.1:3306
 Source Schema         : yii2advanced

 Target Server Type    : MySQL
 Target Server Version : 50641
 File Encoding         : 65001

 Date: 16/09/2018 01:48:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment`  (
  `item_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`) USING BTREE,
  INDEX `auth_assignment_user_id_idx`(`user_id`) USING BTREE,
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('超级管理员', '1', 1535300884);

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `rule_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `data` blob NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE,
  INDEX `rule_name`(`rule_name`) USING BTREE,
  INDEX `idx-auth_item-type`(`type`) USING BTREE,
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('/*', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/*', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/assignment/*', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/assignment/assign', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/assignment/index', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/assignment/view', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/default/*', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/default/index', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/logs/*', 2, NULL, NULL, NULL, 1537033671, 1537033671);
INSERT INTO `auth_item` VALUES ('/admin/logs/index', 2, NULL, NULL, NULL, 1537033664, 1537033664);
INSERT INTO `auth_item` VALUES ('/admin/master/*', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/master/activate', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/master/captcha', 2, NULL, NULL, NULL, 1535680798, 1535680798);
INSERT INTO `auth_item` VALUES ('/admin/master/change-password', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/master/delete', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/master/index', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/master/login', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/master/logout', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/master/request-password-reset', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/master/reset-password', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/master/signup', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/master/view', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/menu/*', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/menu/create', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/menu/delete', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/menu/index', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/menu/update', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/menu/view', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/permission/*', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/permission/assign', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/permission/create', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/permission/delete', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/permission/index', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/permission/remove', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/permission/update', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/permission/view', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/role/*', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/role/assign', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/role/create', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/role/delete', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/role/index', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/role/remove', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/role/update', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/role/view', 2, NULL, NULL, NULL, 1535300590, 1535300590);
INSERT INTO `auth_item` VALUES ('/admin/route/*', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/route/assign', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/route/create', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/route/index', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/route/refresh', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/route/remove', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/rule/*', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/rule/create', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/rule/delete', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/rule/index', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/rule/update', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/admin/rule/view', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/debug/*', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/debug/default/*', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/debug/default/db-explain', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/debug/default/download-mail', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/debug/default/index', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/debug/default/toolbar', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/debug/default/view', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/debug/master/*', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/debug/master/reset-identity', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/debug/master/set-identity', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/debug/user/*', 2, NULL, NULL, NULL, 1536981672, 1536981672);
INSERT INTO `auth_item` VALUES ('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1536981672, 1536981672);
INSERT INTO `auth_item` VALUES ('/debug/user/set-identity', 2, NULL, NULL, NULL, 1536981672, 1536981672);
INSERT INTO `auth_item` VALUES ('/gii/*', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/gii/default/*', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/gii/default/action', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/gii/default/diff', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/gii/default/index', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/gii/default/preview', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('/gii/default/view', 2, NULL, NULL, NULL, 1535300591, 1535300591);
INSERT INTO `auth_item` VALUES ('admin', 2, '超级管理员', NULL, NULL, 1535300798, 1535300844);
INSERT INTO `auth_item` VALUES ('超级管理员', 1, '超级管理员', NULL, NULL, 1535300823, 1535300823);

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child`  (
  `parent` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`, `child`) USING BTREE,
  INDEX `child`(`child`) USING BTREE,
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('admin', '/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', 'admin');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` blob NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for logs
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自编号',
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '日志类型',
  `master_id` int(11) NOT NULL DEFAULT 1 COMMENT '操作人编号',
  `ip` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0.0.0.0' COMMENT '操作者ip',
  `route` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '路由',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` int(11) NULL DEFAULT 0 COMMENT '添加时间',
  `updated_at` int(11) NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for master
-- ----------------------------
DROP TABLE IF EXISTS `master`;
CREATE TABLE `master`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of master
-- ----------------------------
INSERT INTO `master` VALUES (1, 'admin', 'b4Jj789yYlrTB-NA8OPO_aOOCJNYWirK', '$2y$13$Qo9cAy.e277FBwxx4kPEquba2SLdVkVJerDYj192eyZ8t6d1me1SS', NULL, '690550322@QQ.com', 10, 1535300311, 1537031768);

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `parent` int(11) NULL DEFAULT NULL,
  `route` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT NULL,
  `data` blob NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parent`(`parent`) USING BTREE,
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, '权限管理', NULL, NULL, 99, 0x7B2269636F6E223A202266612D746163686F6D65746572222C202276697369626C65223A20747275657D);
INSERT INTO `menu` VALUES (2, '管理员列表', 1, '/admin/master/index', 1, NULL);
INSERT INTO `menu` VALUES (3, '分配列表', 1, '/admin/assignment/index', 2, NULL);
INSERT INTO `menu` VALUES (4, '角色列表', 1, '/admin/role/index', 3, NULL);
INSERT INTO `menu` VALUES (5, '权限列表', 1, '/admin/permission/index', 4, NULL);
INSERT INTO `menu` VALUES (6, '菜单列表', 1, '/admin/menu/index', 5, NULL);
INSERT INTO `menu` VALUES (7, '规则列表', 1, '/admin/rule/index', 6, NULL);
INSERT INTO `menu` VALUES (8, '路由列表', 1, '/admin/route/index', 7, NULL);
INSERT INTO `menu` VALUES (9, '操作日志', 1, '/admin/logs/index', 8, NULL);

SET FOREIGN_KEY_CHECKS = 1;
