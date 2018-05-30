/*
Navicat MySQL Data Transfer

Source Server         : 192.168.1.150
Source Server Version : 50556
Source Host           : 192.168.1.150:3306
Source Database       : jjgz

Target Server Type    : MYSQL
Target Server Version : 50556
File Encoding         : 65001

Date: 2018-05-30 23:43:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `mibine_department`
-- ----------------------------
DROP TABLE IF EXISTS `mibine_department`;
CREATE TABLE `mibine_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mibine_department
-- ----------------------------
INSERT INTO `mibine_department` VALUES ('1', '研发部', '2018-05-28 21:21:21', '2018-05-28 21:21:25');
INSERT INTO `mibine_department` VALUES ('2', '行政部', '2018-05-28 21:21:42', '2018-05-28 21:21:45');

-- ----------------------------
-- Table structure for `mibine_employee`
-- ----------------------------
DROP TABLE IF EXISTS `mibine_employee`;
CREATE TABLE `mibine_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL COMMENT '员工名',
  `sex` tinyint(4) DEFAULT NULL COMMENT '0:男；1:女',
  `department_id` int(11) DEFAULT NULL COMMENT '所在部门ID',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mibine_employee
-- ----------------------------
INSERT INTO `mibine_employee` VALUES ('3', 'mibine', '0', '1', '2018-05-27 07:40:21', '2018-05-29 23:25:27');
INSERT INTO `mibine_employee` VALUES ('10', '小月儿', '1', '1', '2018-05-29 21:48:23', '2018-05-29 23:14:07');
INSERT INTO `mibine_employee` VALUES ('16', '小熊', '0', '1', '2018-05-29 23:03:18', '2018-05-29 23:14:31');
INSERT INTO `mibine_employee` VALUES ('17', '关雎', '0', '1', '2018-05-29 23:16:47', '2018-05-29 23:16:47');

-- ----------------------------
-- Table structure for `mibine_order`
-- ----------------------------
DROP TABLE IF EXISTS `mibine_order`;
CREATE TABLE `mibine_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '订单名称',
  `max_num` int(11) DEFAULT NULL COMMENT '订单最大警报数',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mibine_order
-- ----------------------------
INSERT INTO `mibine_order` VALUES ('3', 'ST7890', '1000', '2018-05-23 13:50:57', '2018-05-30 22:17:06');
INSERT INTO `mibine_order` VALUES ('4', 'KT4340', '300', '2018-05-30 00:00:14', '2018-05-30 22:16:59');
INSERT INTO `mibine_order` VALUES ('5', 'TG3449', '3000', '2018-05-30 22:17:27', '2018-05-30 22:17:27');

-- ----------------------------
-- Table structure for `mibine_order_detail`
-- ----------------------------
DROP TABLE IF EXISTS `mibine_order_detail`;
CREATE TABLE `mibine_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL COMMENT '订单号id',
  `order_num` int(11) DEFAULT NULL COMMENT '工序号',
  `name` varchar(255) DEFAULT NULL COMMENT '工序名称',
  `price` decimal(18,0) DEFAULT NULL COMMENT '工序单价',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mibine_order_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `mibine_user`
-- ----------------------------
DROP TABLE IF EXISTS `mibine_user`;
CREATE TABLE `mibine_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '登陆账号',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `nickname` varchar(255) DEFAULT NULL COMMENT '昵称',
  `create_time` datetime DEFAULT NULL COMMENT '添加时间',
  `update_time` datetime DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL COMMENT '所在部门Id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mibine_user
-- ----------------------------
INSERT INTO `mibine_user` VALUES ('1', null, null, '李剑斌', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
INSERT INTO `mibine_user` VALUES ('2', null, null, '李剑斌', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
