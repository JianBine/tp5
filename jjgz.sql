/*
Navicat MySQL Data Transfer

Source Server         : 192.168.1.150
Source Server Version : 50556
Source Host           : 192.168.1.150:3306
Source Database       : jjgz

Target Server Type    : MYSQL
Target Server Version : 50556
File Encoding         : 65001

Date: 2018-05-23 22:50:56
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mibine_order
-- ----------------------------
INSERT INTO `mibine_order` VALUES ('3', 'ST7890', '1000', '2018-05-23 13:50:57', '2018-05-23 13:50:57');

-- ----------------------------
-- Table structure for `mibine_order_detail`
-- ----------------------------
DROP TABLE IF EXISTS `mibine_order_detail`;
CREATE TABLE `mibine_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL COMMENT '订单号id',
  `produre_name` varchar(255) DEFAULT NULL COMMENT '工序名称',
  `produre_price` decimal(18,0) DEFAULT NULL COMMENT '工序单价',
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
