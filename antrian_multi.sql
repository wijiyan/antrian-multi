/*
 Navicat Premium Data Transfer

 Source Server         : lokal
 Source Server Type    : MySQL
 Source Server Version : 100427 (10.4.27-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : antrian_multi

 Target Server Type    : MySQL
 Target Server Version : 100427 (10.4.27-MariaDB)
 File Encoding         : 65001

 Date: 02/01/2026 19:06:39
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
  `kode` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `statuss` enum('menunggu','dipanggil','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'menunggu',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of antrian
-- ----------------------------
INSERT INTO `antrian` VALUES (1, 1, 'dipanggil', '2025-12-31 11:50:53', '2025-12-31', '0000-00-00', NULL, 'menunggu');
INSERT INTO `antrian` VALUES (2, 1, 'dipanggil', '2026-01-02 14:03:46', '2026-01-02', '0000-00-00', NULL, 'menunggu');
INSERT INTO `antrian` VALUES (3, 2, 'dipanggil', '2026-01-02 14:06:09', '2026-01-02', '0000-00-00', NULL, 'menunggu');
INSERT INTO `antrian` VALUES (4, 3, 'menunggu', '2026-01-02 14:10:57', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (5, 4, 'menunggu', '2026-01-02 14:10:59', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (6, 5, 'menunggu', '2026-01-02 14:11:03', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (7, 6, 'menunggu', '2026-01-02 14:11:45', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (8, 7, 'menunggu', '2026-01-02 14:12:06', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (9, 8, 'menunggu', '2026-01-02 14:12:41', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (10, 9, 'menunggu', '2026-01-02 14:12:43', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (11, 10, 'menunggu', '2026-01-02 14:12:44', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (12, 11, 'menunggu', '2026-01-02 14:12:46', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (13, 12, 'menunggu', '2026-01-02 14:12:47', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (14, 13, 'menunggu', '2026-01-02 14:12:48', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (15, 14, 'menunggu', '2026-01-02 14:12:49', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (16, 15, 'menunggu', '2026-01-02 14:13:27', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (17, 16, 'menunggu', '2026-01-02 14:14:15', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (18, 17, 'menunggu', '2026-01-02 14:15:03', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (19, 18, 'menunggu', '2026-01-02 14:15:32', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (20, 19, 'menunggu', '2026-01-02 14:15:34', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (21, 20, 'menunggu', '2026-01-02 14:15:36', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (22, 21, 'menunggu', '2026-01-02 14:18:17', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (23, 22, 'menunggu', '2026-01-02 14:22:00', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (24, 23, 'menunggu', '2026-01-02 14:22:38', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (25, 24, 'menunggu', '2026-01-02 14:22:40', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (26, 25, 'menunggu', '2026-01-02 14:22:41', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (27, 26, 'menunggu', '2026-01-02 14:23:47', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (28, 27, 'menunggu', '2026-01-02 14:23:52', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (29, 28, 'menunggu', '2026-01-02 14:44:08', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (30, 29, 'menunggu', '2026-01-02 14:44:38', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (31, 30, 'menunggu', '2026-01-02 14:45:00', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (32, 31, 'menunggu', '2026-01-02 14:45:07', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (33, 32, 'menunggu', '2026-01-02 14:45:21', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (34, 33, 'menunggu', '2026-01-02 14:50:01', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (35, 34, 'menunggu', '2026-01-02 15:07:34', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (36, 35, 'menunggu', '2026-01-02 15:07:56', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (37, 36, 'menunggu', '2026-01-02 15:10:58', '2026-01-02', NULL, NULL, 'menunggu');
INSERT INTO `antrian` VALUES (38, 1, 'dipanggil', '2026-01-02 15:55:33', '2026-01-02', '0000-00-00', 'A', 'menunggu');
INSERT INTO `antrian` VALUES (39, 1, 'dipanggil', '2026-01-02 15:55:49', '2026-01-02', '0000-00-00', 'B', 'menunggu');
INSERT INTO `antrian` VALUES (40, 1, 'dipanggil', '2026-01-02 15:56:00', '2026-01-02', '0000-00-00', 'C', 'menunggu');
INSERT INTO `antrian` VALUES (41, 2, 'dipanggil', '2026-01-02 16:01:36', '2026-01-02', '0000-00-00', 'A', 'menunggu');
INSERT INTO `antrian` VALUES (42, 2, 'dipanggil', '2026-01-02 16:04:14', '2026-01-02', '0000-00-00', 'B', 'menunggu');
INSERT INTO `antrian` VALUES (43, 3, 'dipanggil', '2026-01-02 16:21:52', '2026-01-02', '0000-00-00', 'A', 'menunggu');
INSERT INTO `antrian` VALUES (44, 3, 'dipanggil', '2026-01-02 16:31:09', '2026-01-02', '0000-00-00', 'B', 'menunggu');

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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of audio_queue
-- ----------------------------
INSERT INTO `audio_queue` VALUES (1, 1, 1, 'diputar', '2025-12-31 11:50:56');
INSERT INTO `audio_queue` VALUES (2, 1, 1, 'menunggu', '2026-01-02 15:56:12');
INSERT INTO `audio_queue` VALUES (3, 1, 1, 'menunggu', '2026-01-02 15:56:16');
INSERT INTO `audio_queue` VALUES (4, 1, 1, 'menunggu', '2026-01-02 15:56:16');
INSERT INTO `audio_queue` VALUES (5, 1, 1, 'menunggu', '2026-01-02 15:56:17');
INSERT INTO `audio_queue` VALUES (6, 2, 1, 'menunggu', '2026-01-02 16:26:28');
INSERT INTO `audio_queue` VALUES (7, 2, 1, 'menunggu', '2026-01-02 16:26:30');
INSERT INTO `audio_queue` VALUES (8, 2, 1, 'menunggu', '2026-01-02 16:26:31');

SET FOREIGN_KEY_CHECKS = 1;
