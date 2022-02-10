-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-02-10 12:40:42
-- サーバのバージョン： 10.4.22-MariaDB
-- PHP のバージョン: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `fx_db10_07`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `terms_table`
--

CREATE TABLE `terms_table` (
  `terms_id` int(11) NOT NULL,
  `trend_no` varchar(1) NOT NULL,
  `kizyun` varchar(1) NOT NULL,
  `volatility` varchar(1) NOT NULL,
  `ma_val` int(11) NOT NULL,
  `mtf_val` int(11) NOT NULL,
  `pips_val` int(11) NOT NULL,
  `strong` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `terms_table`
--

INSERT INTO `terms_table` (`terms_id`, `trend_no`, `kizyun`, `volatility`, `ma_val`, `mtf_val`, `pips_val`, `strong`) VALUES
(1, '1', '1', '0', 20, 0, 10, NULL),
(2, '2', '2', '1', 0, 1, 0, '1');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `terms_table`
--
ALTER TABLE `terms_table`
  ADD PRIMARY KEY (`terms_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `terms_table`
--
ALTER TABLE `terms_table`
  MODIFY `terms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
