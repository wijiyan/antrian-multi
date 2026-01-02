/*
 Navicat Premium Data Transfer

 Source Server         : lokal
 Source Server Type    : MySQL
 Source Server Version : 100427 (10.4.27-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : antrian

 Target Server Type    : MySQL
 Target Server Version : 100427 (10.4.27-MariaDB)
 File Encoding         : 65001

 Date: 31/12/2025 11:52:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for antrian
-- ----------------------------
DROP TABLE IF EXISTS `antrian`;
CREATE TABLE `antrian`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomor` int NOT NULL,
  `status` enum('menunggu','dipanggil','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'menunggu',
  `created_at` datetime NULL DEFAULT current_timestamp,
  `tanggal` date NULL DEFAULT NULL,
  `loket` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of antrian
-- ----------------------------
INSERT INTO `antrian` VALUES (1, 1, 'dipanggil', '2025-12-31 11:50:53', '2025-12-31', '0000-00-00');

-- ----------------------------
-- Table structure for audio_queue
-- ----------------------------
DROP TABLE IF EXISTS `audio_queue`;
CREATE TABLE `audio_queue`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomor` int NULL DEFAULT NULL,
  `loket` int NULL DEFAULT NULL,
  `status` enum('menunggu','diputar') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'menunggu',
  `created_at` datetime NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of audio_queue
-- ----------------------------
INSERT INTO `audio_queue` VALUES (1, 1, 1, 'menunggu', '2025-12-31 11:50:56');

SET FOREIGN_KEY_CHECKS = 1;
