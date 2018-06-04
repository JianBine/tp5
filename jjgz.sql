/*
Navicat MySQL Data Transfer

Source Server         : 192.168.1.150
Source Server Version : 50556
Source Host           : 192.168.1.150:3306
Source Database       : jjgz

Target Server Type    : MYSQL
Target Server Version : 50556
File Encoding         : 65001

Date: 2018-06-05 23:29:44
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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mibine_employee
-- ----------------------------
INSERT INTO `mibine_employee` VALUES ('3', 'mibine', '0', '1', '2018-05-27 07:40:21', '2018-05-29 23:25:27');
INSERT INTO `mibine_employee` VALUES ('10', '小月儿', '1', '2', '2018-05-29 21:48:23', '2018-05-29 23:14:07');
INSERT INTO `mibine_employee` VALUES ('16', '小熊', '0', '1', '2018-05-29 23:03:18', '2018-05-29 23:14:31');
INSERT INTO `mibine_employee` VALUES ('17', '关雎', '0', '1', '2018-05-29 23:16:47', '2018-05-29 23:16:47');
INSERT INTO `mibine_employee` VALUES ('18', '熊本穷', '0', '1', '2018-06-03 20:32:03', '2018-06-03 20:32:03');
INSERT INTO `mibine_employee` VALUES ('19', 'test1', '0', '1', '2018-06-03 20:35:05', '2018-06-03 20:35:05');
INSERT INTO `mibine_employee` VALUES ('20', 'tes2', '0', '1', '2018-06-03 20:35:09', '2018-06-03 20:35:09');
INSERT INTO `mibine_employee` VALUES ('21', 'tes3', '0', '1', '2018-06-03 20:35:12', '2018-06-03 20:35:12');
INSERT INTO `mibine_employee` VALUES ('22', 'test4', '0', '1', '2018-06-03 20:35:17', '2018-06-03 20:35:17');
INSERT INTO `mibine_employee` VALUES ('23', 'test6', '0', '1', '2018-06-03 20:35:21', '2018-06-03 20:35:21');
INSERT INTO `mibine_employee` VALUES ('24', 'test7', '0', '1', '2018-06-03 20:36:48', '2018-06-03 20:36:48');
INSERT INTO `mibine_employee` VALUES ('25', 'test8', '0', '1', '2018-06-03 20:36:54', '2018-06-03 20:36:54');
INSERT INTO `mibine_employee` VALUES ('26', 'admin', '0', '1', '2018-06-04 00:03:52', '2018-06-04 00:03:52');
INSERT INTO `mibine_employee` VALUES ('27', 'sss', '0', '1', '2018-06-04 00:04:07', '2018-06-04 00:04:07');
INSERT INTO `mibine_employee` VALUES ('28', 'admin', '0', '1', '2018-06-04 00:04:39', '2018-06-04 00:04:39');
INSERT INTO `mibine_employee` VALUES ('29', '2', '0', '1', '2018-06-04 00:05:05', '2018-06-04 00:05:05');
INSERT INTO `mibine_employee` VALUES ('30', 'z', '0', '1', '2018-06-04 00:06:17', '2018-06-04 00:06:17');
INSERT INTO `mibine_employee` VALUES ('31', '33', '0', '1', '2018-06-04 00:06:30', '2018-06-04 00:06:30');
INSERT INTO `mibine_employee` VALUES ('32', 'dd', '0', '1', '2018-06-04 00:06:46', '2018-06-04 00:06:46');
INSERT INTO `mibine_employee` VALUES ('33', 'dd', '0', '1', '2018-06-04 00:06:51', '2018-06-04 00:06:51');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mibine_order
-- ----------------------------
INSERT INTO `mibine_order` VALUES ('3', 'ST7890', '1000', '2018-05-23 13:50:57', '2018-05-30 22:17:06');
INSERT INTO `mibine_order` VALUES ('4', 'KT4340', '300', '2018-05-30 00:00:14', '2018-05-30 22:16:59');
INSERT INTO `mibine_order` VALUES ('5', 'TG3449', '3000', '2018-05-30 22:17:27', '2018-05-30 22:17:27');
INSERT INTO `mibine_order` VALUES ('8', 'My9501', '100', '2018-06-03 15:19:59', '2018-06-03 15:19:59');

-- ----------------------------
-- Table structure for `mibine_order_detail`
-- ----------------------------
DROP TABLE IF EXISTS `mibine_order_detail`;
CREATE TABLE `mibine_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL COMMENT '订单号id',
  `order_num` int(11) DEFAULT NULL COMMENT '工序号',
  `name` varchar(255) DEFAULT NULL COMMENT '工序名称',
  `price` decimal(18,2) DEFAULT NULL COMMENT '工序单价',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mibine_order_detail
-- ----------------------------
INSERT INTO `mibine_order_detail` VALUES ('3', '5', '112', '哈哈哈12', '112.00', '2018-05-31 21:22:00', '2018-05-31 21:43:47');
INSERT INTO `mibine_order_detail` VALUES ('4', '3', '1', '我是订单1', '0.50', '2018-05-31 14:31:06', '2018-06-03 14:42:10');
INSERT INTO `mibine_order_detail` VALUES ('5', '3', '2', '我是12', '1.00', '2018-06-03 14:33:55', '2018-06-03 14:33:55');
INSERT INTO `mibine_order_detail` VALUES ('6', '3', '2', '22', '1.00', '2018-06-03 14:36:56', '2018-06-03 14:36:56');
INSERT INTO `mibine_order_detail` VALUES ('7', '3', '3', '工序3', '0.56', '2018-06-03 14:40:24', '2018-06-03 14:40:24');
INSERT INTO `mibine_order_detail` VALUES ('8', '8', '1', '组装', '4.50', '2018-06-03 15:24:55', '2018-06-03 15:24:55');

-- ----------------------------
-- Table structure for `mibine_product`
-- ----------------------------
DROP TABLE IF EXISTS `mibine_product`;
CREATE TABLE `mibine_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL COMMENT '员工ID',
  `order_id` int(11) DEFAULT NULL COMMENT '订单ID',
  `order_detail_id` int(11) DEFAULT NULL COMMENT '订单详情ID',
  `number` int(11) DEFAULT NULL COMMENT '数量',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mibine_product
-- ----------------------------
INSERT INTO `mibine_product` VALUES ('5', '3', '3', '4', '322', '2018-05-31 14:31:24', '2018-05-31 14:31:24');
INSERT INTO `mibine_product` VALUES ('6', '10', '3', '4', '223', '2018-06-03 14:55:23', '2018-06-03 14:55:23');
INSERT INTO `mibine_product` VALUES ('7', '3', '8', '8', '22', '2018-06-03 15:30:25', '2018-06-03 15:55:23');
INSERT INTO `mibine_product` VALUES ('9', '3', '8', '8', '1', '2018-06-03 15:30:55', '2018-06-03 15:30:55');
INSERT INTO `mibine_product` VALUES ('11', '3', '8', '9', '50', '2018-06-03 15:34:50', '2018-06-03 15:34:50');
INSERT INTO `mibine_product` VALUES ('13', '3', '8', '8', '76', '2018-06-03 15:44:51', '2018-06-03 15:45:26');
INSERT INTO `mibine_product` VALUES ('14', '16', '5', '3', '12', '2018-06-03 20:32:26', '2018-06-03 20:32:26');
INSERT INTO `mibine_product` VALUES ('15', '17', '8', '8', '1', '2018-06-03 20:32:36', '2018-06-03 20:32:36');
INSERT INTO `mibine_product` VALUES ('16', '16', '5', '3', '12', '2018-06-03 20:32:50', '2018-06-03 20:32:50');
INSERT INTO `mibine_product` VALUES ('17', '19', '5', '3', '1', '2018-06-03 20:35:34', '2018-06-03 20:35:34');
INSERT INTO `mibine_product` VALUES ('18', '20', '5', '3', '2', '2018-06-03 20:35:41', '2018-06-03 20:35:41');
INSERT INTO `mibine_product` VALUES ('19', '21', '8', '9', '3', '2018-06-03 20:35:52', '2018-06-03 20:35:52');
INSERT INTO `mibine_product` VALUES ('20', '22', '3', '4', '1', '2018-06-03 20:36:03', '2018-06-03 20:36:03');
INSERT INTO `mibine_product` VALUES ('21', '3', '5', '3', '1', '2018-06-03 20:36:10', '2018-06-03 20:36:10');
INSERT INTO `mibine_product` VALUES ('22', '23', '3', '5', '32', '2018-06-03 20:36:25', '2018-06-03 20:36:25');
INSERT INTO `mibine_product` VALUES ('23', '3', '3', '4', '12', '2018-06-03 20:37:03', '2018-06-03 20:37:03');
INSERT INTO `mibine_product` VALUES ('24', '25', '3', '4', '1', '2018-06-03 20:37:12', '2018-06-03 20:37:12');
INSERT INTO `mibine_product` VALUES ('25', '24', '3', '4', '32', '2018-06-03 20:37:23', '2018-06-03 20:37:23');

-- ----------------------------
-- Table structure for `mibine_user`
-- ----------------------------
DROP TABLE IF EXISTS `mibine_user`;
CREATE TABLE `mibine_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL COMMENT '登陆账号',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `nickname` varchar(255) DEFAULT NULL COMMENT '昵称',
  `create_time` datetime DEFAULT NULL COMMENT '添加时间',
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mibine_user
-- ----------------------------
INSERT INTO `mibine_user` VALUES ('1', 'admin', 'a66abb5684c45962d887564f08346e8d', '管理员', '2018-06-05 23:07:34', '2018-06-05 23:07:38');
