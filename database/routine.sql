-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2023 at 07:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diu`
--
CREATE DATABASE IF NOT EXISTS `diu` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `diu`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'opurbo@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `routine`
--

CREATE TABLE `routine` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `day` varchar(10) NOT NULL,
  `time` varchar(50) NOT NULL,
  `c_name` varchar(60) NOT NULL,
  `c_code` varchar(20) NOT NULL,
  `room` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `email` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  `img` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routine`
--
ALTER TABLE `routine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `routine`
--
ALTER TABLE `routine`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Dumping data for table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'database', 'diu', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"admin\",\"routine\",\"teacher\"],\"table_structure[]\":[\"admin\",\"routine\",\"teacher\"],\"table_data[]\":[\"admin\",\"routine\",\"teacher\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}'),
(2, 'root', 'database', 'routine', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"batch\",\"course\",\"department\",\"room\",\"semester\",\"teachercourses\",\"teachers\",\"timetable\"],\"table_structure[]\":[\"batch\",\"course\",\"department\",\"room\",\"semester\",\"teachercourses\",\"teachers\",\"timetable\"],\"table_data[]\":[\"batch\",\"course\",\"department\",\"room\",\"semester\",\"teachercourses\",\"teachers\",\"timetable\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}'),
(8, 'root', 'server', 'routine', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"db_select[]\":[\"diu\",\"phpmyadmin\",\"routine\",\"test\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@SERVER@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"yaml_structure_or_data\":\"data\",\"\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_drop_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_procedure_function\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"routine\",\"table\":\"course\"},{\"db\":\"routine\",\"table\":\"routine\"},{\"db\":\"routine\",\"table\":\"teachercourses\"},{\"db\":\"routine\",\"table\":\"semester\"},{\"db\":\"routine\",\"table\":\"batch\"},{\"db\":\"routine\",\"table\":\"department\"},{\"db\":\"routine\",\"table\":\"teachers\"},{\"db\":\"routine\",\"table\":\"room\"},{\"db\":\"routine\",\"table\":\"admins\"},{\"db\":\"routine\",\"table\":\"timeslot\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'routine', 'course', '{\"CREATE_TIME\":\"2023-08-03 19:56:44\"}', '2023-10-05 16:43:06'),
('root', 'routine', 'routine', '{\"CREATE_TIME\":\"2023-08-22 16:26:27\"}', '2023-10-05 17:07:45'),
('root', 'routine', 'teachers', '{\"sorted_col\":\"`teacher_id` ASC\"}', '2023-09-23 14:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2023-10-06 05:25:25', '{\"Console\\/Mode\":\"collapse\",\"NavigationWidth\":250}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `routine`
--
CREATE DATABASE IF NOT EXISTS `routine` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `routine`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `token`, `expiry`) VALUES
(1, 'opurbopaul3@gmail.com', '$2y$10$hiNubovHkG/9U2Dz9IuyLe.QdbqndRFfWCrR0emYLiLMEQb4J95PK', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batch_id` int(11) NOT NULL,
  `batch_number` varchar(10) NOT NULL,
  `department_id` int(11) NOT NULL,
  `batch_shift` enum('day','evening') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batch_id`, `batch_number`, `department_id`, `batch_shift`) VALUES
(1, 'D-50', 1, 'day'),
(2, 'D-51', 1, 'day'),
(3, 'D-52', 1, 'day'),
(4, 'D-54', 1, 'day'),
(5, 'D-55', 1, 'day'),
(6, 'D-56', 1, 'day'),
(7, 'E-50', 1, 'evening'),
(8, 'E-51', 1, 'evening'),
(9, 'E-52', 1, 'day'),
(15, 'D-57', 1, 'day'),
(16, 'D-58', 1, 'day'),
(17, 'D-59', 1, 'day'),
(18, 'D-60', 1, 'day');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `semester_id` int(11) DEFAULT NULL,
  `course_type` varchar(10) NOT NULL,
  `credits` float NOT NULL,
  `course_code` varchar(100) NOT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `semester_id`, `course_type`, `credits`, `course_code`, `department_id`) VALUES
(2, 'Structured Programming Languages', 1, 'theory', 3, '0613-101', 1),
(3, 'Structured Programming Languages Lab', 1, 'lab', 1, '0613-102', 1),
(4, 'Physics', 1, 'theory', 3, '0533-101', 1),
(5, 'Physics Lab', 1, 'lab', 1, '0533-102', 1),
(6, 'Engineering Economics', 1, 'theory', 3, '0311-101', 1),
(7, 'Communicative English', 1, 'theory', 3, '0231-101', 1),
(8, 'Engineering Drawing Lab', 1, 'lab', 1, '0211-102', 1),
(9, 'Linear Algebra and Coordinate Geometry', 1, 'theory', 3, '0541-101', 1),
(10, 'Data Structures', 2, 'theory', 3, '0613-103', 1),
(11, 'Data Structures Lab', 2, 'lab', 1, '0613-104', 1),
(12, 'Discrete Mathematics', 2, 'theory', 3, '0613-105', 1),
(13, 'Electrical Circuits', 2, 'theory', 3, '0713-101', 1),
(14, 'Bangladesh Studies', 2, 'theory', 3, '0222-101', 1),
(15, 'Financial and Managerial Accounting', 2, 'theory', 3, '0413-102', 1),
(16, 'Differential and Integral Calculus', 2, 'theory', 3, '0541-102', 1),
(17, 'Object-Oriented Programming Languages', 3, 'theory', 3, '0613-201', 1),
(18, 'Object-Oriented Programming Languages Lab', 3, 'lab', 1, '0613-202', 1),
(19, 'Computer Architecture', 3, 'theory', 3, '0613-203', 1),
(20, 'Electronic Devices and Circuit', 3, 'theory', 3, '0713-201', 1),
(21, 'Electronic Devices and Circuit Lab', 3, 'lab', 1, '0713-202', 1),
(22, 'Chemistry', 3, 'theory', 3, '0531-201', 1),
(23, 'Professional Ethics and Environmental Protection', 3, 'theory', 3, '0223-201', 1),
(24, 'Differential Equations and Vector Analysis', 3, 'theory', 3, '0541-201', 1),
(25, 'Algorithms', 4, 'theory', 3, '0613-205', 1),
(26, 'Algorithms Lab', 4, 'lab', 1, '0613-206', 1),
(27, 'Microprocessor and Assembly Language', 4, 'theory', 3, '0613-207', 1),
(28, 'Microprocessor and Assembly Language Lab', 4, 'lab', 1, '0613-208', 1),
(29, 'Compiler Design', 4, 'theory', 3, '0613-209', 1),
(30, 'Digital Logic Design', 4, 'theory', 3, '0713-203', 1),
(31, 'Digital Logic Design Lab', 4, 'lab', 1, '0713-204', 1),
(32, 'Business Strategy Management', 4, 'theory', 1.5, '0413-202', 1),
(33, 'Statistical Methods and Probability', 4, 'theory', 3, '0542-202', 1),
(34, 'Operating System', 5, 'theory', 3, '0613-301', 1),
(35, 'Operating System Lab', 5, 'lab', 1, '0613-302', 1),
(36, 'Data Communication', 5, 'theory', 3, '0612-302', 1),
(37, 'Software Engineering', 5, 'theory', 1.5, '0613-303', 1),
(38, 'Database Management System', 5, 'theory', 3, '0612-303', 1),
(39, 'Database Management Systems Lab', 5, 'lab', 1, '0612-304', 1),
(40, 'Information System Management', 5, 'theory', 1.5, '0612-301', 1),
(41, 'Complex Variables and Transforms', 5, 'theory', 3, '0541-301', 1),
(42, 'Computer Networking', 6, 'theory', 3, '0612-305', 1),
(43, 'Computer Networking Lab', 6, 'lab', 1, '0612-306', 1),
(44, 'Markup and Scripting Languages', 6, 'theory', 3, '0613-305', 1),
(45, 'Markup and Scripting Languages Lab', 6, 'lab', 1, '0613-306', 1),
(46, '	Software Development Management', 6, 'theory', 1.5, '0613-307', 1),
(47, 'Software Development Management Lab', 6, 'lab', 0.5, '0613-308', 1),
(48, 'Computer and Cyber security', 6, 'theory', 3, '0613-309', 1),
(49, 'System Configuration and Performance Evaluation Lab', 6, 'lab', 1, '0613-310', 1),
(50, 'Technical Writing and Presentation', 6, 'theory', 1, '0232-302', 1),
(51, 'Numerical Analysis', 6, 'theory', 1.5, '0541-302', 1),
(52, 'Artificial Intelligence', 7, 'theory', 3, '0613-401', 1),
(53, 'Artificial Intelligence Lab', 7, 'lab', 1, '0613-402', 1),
(54, 'Computer Graphics and Multimedia', 7, 'theory', 3, '0613-403', 1),
(55, 'Computer Graphics and Multimedia Lab', 7, 'lab', 1, '0613-404', 1),
(56, 'Software Testing and Quality Assurance', 7, 'theory', 1.5, '0613-405', 1),
(57, 'Software Testing and Quality Assurance Lab', 7, 'lab', 0.5, '0613-406', 1),
(58, 'Mobile Application and Development', 7, 'theory', 3, '0613-409', 1),
(59, 'Mobile Application and Development Lab', 7, 'lab', 1, '0613-410', 1),
(60, 'Software Integration and Maintenance', 7, 'theory', 3, '0613-412', 1),
(61, 'Capstone Project Design', 7, 'theory', 3, '0688-400', 1),
(62, 'Elective Course', 8, 'theory', 3, '0541/0413', 1),
(63, 'Elective Course', 8, 'theory', 3, '0541/0413', 1),
(64, 'Elective Course', 8, 'theory', 3, '0541/0413', 1),
(65, 'Elective Course', 8, 'theory', 3, '0541/0413', 1),
(66, 'Entrepreneurship: Innovation and Commercialization', 8, 'theory', 3, '0413-401', 1),
(67, 'Capstone Project Design', 8, 'theory', 3, '0688-400', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(1, 'CSE'),
(2, 'EEE'),
(3, 'Law'),
(4, 'Pharmacy'),
(5, 'Civil Engg'),
(6, 'Sociology'),
(7, 'Political Science'),
(8, 'Economic'),
(9, 'Business'),
(10, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_number` varchar(50) NOT NULL,
  `room_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_number`, `room_type`) VALUES
(14, '507', 'theory'),
(15, '502', 'theory'),
(16, '503', 'theory'),
(17, '504', 'theory'),
(18, '505', 'theory'),
(19, '506', 'theory'),
(20, '508', 'theory'),
(21, '509', 'theory'),
(27, 'Lab-1', 'lab'),
(28, 'Lab-2', 'lab'),
(29, 'Lab-3', 'lab'),
(30, 'Lab-4', 'lab'),
(31, 'Lab-5', 'lab');

-- --------------------------------------------------------

--
-- Table structure for table `routine`
--

CREATE TABLE `routine` (
  `routine_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `day` varchar(20) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `batch` varchar(50) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `session` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routine`
--

INSERT INTO `routine` (`routine_id`, `course_id`, `day`, `start_time`, `room_id`, `teacher_id`, `batch`, `semester`, `end_time`, `session`) VALUES
(238, 3, 'Wednesday', '12:21:00', 29, 13, '1', '1', '14:00:00', 'Fall'),
(239, 4, 'Saturday', '09:00:00', 16, 22, '1', '1', '10:15:00', 'Fall'),
(240, 4, 'Tuesday', '11:31:00', 16, 22, '1', '1', '12:45:00', 'Fall'),
(241, 5, 'Wednesday', '09:00:00', 29, 22, '1', '1', '10:40:00', 'Fall'),
(242, 6, 'Tuesday', '12:46:00', 16, 23, '1', '1', '14:00:00', 'Fall'),
(243, 6, 'Thursday', '10:16:00', 16, 23, '1', '1', '11:30:00', 'Fall'),
(244, 7, 'Thursday', '11:31:00', 16, 30, '1', '1', '12:45:00', 'Fall'),
(245, 8, 'Wednesday', '10:41:00', 29, 29, '1', '1', '12:20:00', 'Fall'),
(246, 9, 'Saturday', '10:16:00', 16, 34, '1', '1', '11:30:00', 'Fall'),
(247, 9, 'Tuesday', '10:16:00', 16, 34, '1', '1', '11:30:00', 'Fall'),
(249, 2, 'Friday', '14:00:00', 16, 17, '1', '1', '23:00:00', 'Fall'),
(250, 10, 'Saturday', '09:00:00', 15, 27, '2', '2', '10:15:00', 'Fall'),
(251, 11, 'Thursday', '09:00:00', 27, 27, '2', '2', '10:40:00', 'Fall'),
(252, 12, 'Saturday', '10:16:00', 15, 13, '2', '2', '11:30:00', 'Fall'),
(253, 13, 'Saturday', '11:31:00', 15, 22, '2', '2', '12:45:00', 'Fall'),
(254, 14, 'Monday', '09:00:00', 15, 26, '2', '2', '10:15:00', 'Fall'),
(255, 15, 'Monday', '10:16:00', 15, 18, '2', '2', '11:30:00', 'Fall'),
(256, 16, 'Monday', '11:31:00', 15, 34, '2', '2', '12:45:00', 'Fall'),
(257, 17, 'Wednesday', '09:00:00', 17, 37, '4', '3', '10:15:00', 'Spring'),
(258, 18, 'Wednesday', '10:41:00', 27, 37, '4', '3', '12:20:00', 'Spring'),
(259, 19, 'Saturday', '10:16:00', 17, 38, '4', '3', '11:30:00', 'Spring'),
(260, 20, 'Saturday', '11:31:00', 17, 13, '4', '3', '12:45:00', 'Spring'),
(261, 22, 'Sunday', '09:00:00', 17, 18, '4', '3', '10:15:00', 'Spring'),
(262, 23, 'Monday', '09:00:00', 17, 30, '4', '3', '10:15:00', 'Spring'),
(263, 24, 'Monday', '10:16:00', 17, 34, '4', '3', '11:30:00', 'Spring'),
(264, 21, 'Thursday', '12:21:00', 27, 13, '4', '3', '14:00:00', 'Spring'),
(265, 25, 'Sunday', '09:00:00', 18, 14, '5', '4', '10:15:00', 'Fall'),
(266, 26, 'Saturday', '09:00:00', 28, 14, '5', '4', '10:40:00', 'Fall'),
(267, 27, 'Sunday', '10:16:00', 18, 22, '5', '4', '11:30:00', 'Fall'),
(268, 29, 'Sunday', '11:31:00', 18, 18, '5', '4', '12:45:00', 'Fall'),
(269, 30, 'Tuesday', '09:00:00', 18, 13, '5', '4', '10:15:00', 'Fall'),
(270, 32, 'Tuesday', '10:16:00', 18, 23, '5', '4', '11:30:00', 'Fall'),
(271, 33, 'Tuesday', '12:46:00', 18, 28, '5', '4', '14:00:00', 'Fall'),
(272, 31, 'Sunday', '12:21:00', 28, 13, '5', '4', '14:00:00', 'Fall'),
(273, 28, 'Sunday', '10:41:00', 27, 30, '5', '4', '12:20:00', 'Fall'),
(274, 34, 'Saturday', '09:00:00', 19, 38, '3', '5', '10:15:00', 'Fall'),
(275, 35, 'Thursday', '09:00:00', 30, 38, '3', '5', '10:40:00', 'Fall'),
(276, 36, 'Saturday', '10:16:00', 19, 20, '3', '5', '11:30:00', 'Fall'),
(277, 37, 'Saturday', '11:31:00', 19, 20, '3', '5', '12:45:00', 'Fall'),
(278, 38, 'Sunday', '09:00:00', 19, 15, '3', '5', '10:15:00', 'Fall'),
(279, 39, 'Sunday', '10:41:00', 30, 15, '3', '5', '12:20:00', 'Fall'),
(280, 41, 'Tuesday', '11:31:00', 19, 29, '3', '5', '12:45:00', 'Fall'),
(281, 40, 'Thursday', '09:00:00', 14, 23, '3', '5', '10:15:00', 'Fall'),
(282, 42, 'Saturday', '09:00:00', 14, 37, '6', '6', '10:15:00', 'Fall'),
(283, 43, 'Saturday', '10:41:00', 30, 37, '6', '6', '12:20:00', 'Fall'),
(284, 44, 'Sunday', '09:00:00', 20, 38, '6', '6', '10:15:00', 'Fall'),
(285, 46, 'Saturday', '11:31:00', 20, 19, '6', '6', '12:45:00', 'Fall'),
(286, 47, 'Sunday', '12:21:00', 30, 19, '6', '6', '14:00:00', 'Fall'),
(287, 48, 'Tuesday', '10:16:00', 20, 27, '6', '6', '11:30:00', 'Fall'),
(288, 49, 'Thursday', '10:41:00', 29, 27, '6', '6', '12:20:00', 'Fall'),
(289, 50, 'Tuesday', '09:00:00', 20, 35, '6', '6', '10:15:00', 'Fall'),
(290, 51, 'Thursday', '09:00:00', 20, 36, '6', '6', '10:15:00', 'Fall'),
(291, 45, 'Sunday', '12:21:00', 27, 20, '6', '6', '14:00:00', 'Fall'),
(292, 52, 'Saturday', '10:16:00', 21, 27, '15', '7', '11:30:00', 'Fall'),
(293, 53, 'Monday', '09:00:00', 27, 27, '15', '7', '10:40:00', 'Fall'),
(294, 55, 'Monday', '10:41:00', 27, 41, '15', '7', '12:20:00', 'Fall'),
(295, 56, 'Tuesday', '09:00:00', 21, 15, '15', '7', '10:15:00', 'Fall'),
(296, 57, 'Monday', '12:21:00', 27, 15, '15', '7', '14:00:00', 'Fall'),
(297, 59, 'Thursday', '09:00:00', 27, 33, '15', '7', '10:40:00', 'Fall'),
(298, 60, 'Saturday', '12:46:00', 21, 18, '15', '7', '14:00:00', 'Fall'),
(299, 60, 'Tuesday', '10:16:00', 14, 18, '15', '7', '11:30:00', 'Fall'),
(300, 61, 'Tuesday', '11:31:00', 14, 15, '15', '7', '12:45:00', 'Fall'),
(301, 54, 'Saturday', '09:00:00', 21, 41, '15', '7', '10:15:00', 'Fall'),
(302, 56, 'Saturday', '11:31:00', 14, 15, '15', '7', '12:45:00', 'Fall'),
(303, 62, 'Saturday', '09:00:00', 20, 31, '16', '8', '10:15:00', 'Fall'),
(304, 63, 'Sunday', '10:16:00', 20, 31, '16', '8', '11:30:00', 'Fall'),
(305, 66, 'Sunday', '12:46:00', 14, 29, '16', '8', '14:00:00', 'Fall'),
(306, 67, 'Sunday', '11:31:00', 14, 27, '16', '8', '12:45:00', 'Fall'),
(307, 67, 'Wednesday', '09:00:00', 14, 27, '16', '8', '10:15:00', 'Fall'),
(308, 64, 'Saturday', '11:31:00', 20, 32, '16', '8', '12:45:00', 'Fall'),
(309, 63, 'Sunday', '14:00:00', 16, 31, '16', '8', '23:00:00', 'Fall'),
(310, 67, 'Friday', '09:00:00', 14, 37, '18', '8', '10:15:00', 'Fall'),
(311, 25, 'Monday', '12:46:00', 14, 14, '5', '4', '14:00:00', 'Fall'),
(312, 25, 'Wednesday', '11:31:00', 14, 14, '5', '4', '12:45:00', 'Fall'),
(313, 25, 'Friday', '11:31:00', 18, 14, '5', '4', '12:45:00', 'Fall'),
(314, 26, 'Tuesday', '09:00:00', 27, 14, '5', '4', '10:40:00', 'Fall'),
(315, 28, 'Friday', '09:00:00', 27, 22, '5', '4', '10:40:00', 'Fall');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `semester_name` varchar(50) NOT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester_name`, `department_id`) VALUES
(1, 'CSE-1', 1),
(2, 'CSE-2', 1),
(3, 'CSE-3', 1),
(4, 'CSE-4', 1),
(5, 'CSE-5', 1),
(6, 'CSE-6', 1),
(7, 'CSE-7', 1),
(8, 'CSE-8', 1),
(9, 'EEE-1', 2),
(10, 'EEE-2', 2),
(11, 'EEE-3', 2),
(12, 'EEE-4', 2),
(13, 'EEE-5', 2),
(14, 'EEE-6', 2),
(17, 'EEE-7', 2),
(18, 'EEE-8', 2);

-- --------------------------------------------------------

--
-- Table structure for table `teachercourses`
--

CREATE TABLE `teachercourses` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachercourses`
--

INSERT INTO `teachercourses` (`id`, `teacher_id`, `course_id`) VALUES
(182, 17, 2),
(183, 17, 3),
(184, 17, 13),
(185, 17, 20),
(186, 17, 21),
(187, 17, 34),
(188, 17, 35),
(189, 17, 41),
(190, 17, 42),
(191, 17, 43),
(192, 17, 49),
(193, 17, 62),
(194, 17, 63),
(195, 17, 64),
(196, 17, 65),
(200, 17, 66),
(201, 18, 12),
(202, 18, 13),
(203, 18, 15),
(204, 18, 19),
(205, 18, 22),
(206, 18, 29),
(207, 18, 34),
(208, 18, 35),
(209, 18, 38),
(210, 18, 39),
(211, 18, 50),
(212, 18, 60),
(213, 18, 62),
(214, 18, 63),
(215, 18, 64),
(216, 18, 65),
(220, 18, 66),
(221, 19, 4),
(222, 19, 5),
(223, 19, 20),
(224, 19, 21),
(225, 19, 41),
(226, 19, 46),
(227, 19, 47),
(228, 19, 48),
(229, 19, 50),
(230, 19, 58),
(231, 19, 59),
(232, 20, 4),
(233, 20, 5),
(234, 20, 20),
(235, 20, 21),
(236, 20, 36),
(237, 20, 37),
(238, 20, 44),
(239, 20, 45),
(240, 20, 50),
(273, 24, 2),
(274, 24, 3),
(275, 24, 6),
(276, 24, 10),
(277, 24, 11),
(278, 24, 13),
(279, 24, 40),
(280, 24, 41),
(281, 24, 54),
(282, 24, 55),
(283, 25, 6),
(284, 25, 13),
(285, 25, 15),
(286, 25, 19),
(287, 25, 40),
(288, 25, 41),
(289, 25, 50),
(290, 26, 4),
(291, 26, 5),
(292, 26, 14),
(293, 26, 15),
(294, 26, 16),
(295, 26, 41),
(296, 26, 66),
(499, 34, 9),
(500, 34, 16),
(501, 34, 24),
(502, 34, 34),
(503, 34, 35),
(504, 34, 58),
(505, 34, 59),
(520, 37, 17),
(521, 37, 18),
(522, 37, 37),
(523, 37, 42),
(524, 37, 43),
(525, 37, 44),
(526, 37, 45),
(527, 37, 46),
(528, 37, 47),
(529, 37, 48),
(530, 37, 49),
(531, 37, 61),
(532, 37, 67),
(534, 37, 61),
(535, 37, 67),
(537, 14, 2),
(538, 14, 3),
(539, 14, 10),
(540, 14, 11),
(541, 14, 17),
(542, 14, 18),
(543, 14, 25),
(544, 14, 26),
(545, 14, 30),
(546, 14, 31),
(547, 14, 34),
(548, 14, 35),
(583, 33, 9),
(584, 33, 16),
(585, 33, 24),
(586, 33, 58),
(587, 33, 59),
(588, 33, 61),
(589, 33, 67),
(591, 33, 62),
(592, 33, 63),
(593, 33, 64),
(594, 33, 65),
(598, 33, 62),
(599, 33, 63),
(600, 33, 64),
(601, 33, 65),
(605, 33, 62),
(606, 33, 63),
(607, 33, 64),
(608, 33, 65),
(612, 33, 62),
(613, 33, 63),
(614, 33, 64),
(615, 33, 65),
(619, 33, 66),
(620, 33, 61),
(621, 33, 67),
(623, 15, 2),
(624, 15, 3),
(625, 15, 10),
(626, 15, 11),
(627, 15, 38),
(628, 15, 39),
(629, 15, 56),
(630, 15, 57),
(631, 15, 58),
(632, 15, 59),
(633, 15, 61),
(634, 15, 67),
(636, 15, 61),
(637, 15, 67),
(639, 21, 4),
(640, 21, 5),
(641, 21, 6),
(642, 21, 8),
(643, 21, 9),
(644, 21, 12),
(645, 21, 15),
(646, 21, 16),
(647, 21, 24),
(648, 21, 30),
(649, 21, 31),
(650, 21, 33),
(651, 22, 4),
(652, 22, 5),
(653, 22, 13),
(654, 22, 17),
(655, 22, 18),
(656, 22, 19),
(657, 22, 25),
(658, 22, 26),
(659, 22, 27),
(660, 22, 28),
(661, 22, 29),
(662, 23, 6),
(663, 23, 8),
(664, 23, 15),
(665, 23, 22),
(666, 23, 30),
(667, 23, 31),
(668, 23, 32),
(669, 23, 33),
(670, 23, 40),
(671, 16, 2),
(672, 16, 3),
(673, 16, 6),
(674, 16, 8),
(675, 16, 10),
(676, 16, 11),
(677, 16, 12),
(678, 16, 22),
(679, 16, 29),
(680, 16, 32),
(681, 16, 34),
(682, 16, 35),
(683, 16, 54),
(684, 16, 55),
(685, 29, 8),
(686, 29, 10),
(687, 29, 11),
(688, 29, 15),
(689, 29, 32),
(690, 29, 41),
(691, 29, 54),
(692, 29, 55),
(693, 29, 62),
(694, 29, 63),
(695, 29, 64),
(696, 29, 65),
(700, 29, 62),
(701, 29, 63),
(702, 29, 64),
(703, 29, 65),
(707, 29, 62),
(708, 29, 63),
(709, 29, 64),
(710, 29, 65),
(714, 29, 62),
(715, 29, 63),
(716, 29, 64),
(717, 29, 65),
(721, 29, 66),
(825, 38, 19),
(826, 38, 23),
(827, 38, 25),
(828, 38, 26),
(829, 38, 33),
(830, 38, 34),
(831, 38, 35),
(832, 38, 36),
(833, 38, 44),
(834, 38, 45),
(863, 27, 10),
(864, 27, 11),
(865, 27, 27),
(866, 27, 28),
(867, 27, 48),
(868, 27, 49),
(869, 27, 50),
(870, 27, 52),
(871, 27, 53),
(872, 27, 56),
(873, 27, 57),
(874, 27, 61),
(875, 27, 67),
(877, 27, 61),
(878, 27, 67),
(880, 41, 19),
(881, 41, 36),
(882, 41, 44),
(883, 41, 45),
(884, 41, 52),
(885, 41, 53),
(886, 41, 54),
(887, 41, 55),
(888, 41, 61),
(889, 41, 67),
(891, 13, 2),
(892, 13, 3),
(893, 13, 12),
(894, 13, 20),
(895, 13, 21),
(896, 13, 30),
(897, 13, 31),
(898, 13, 36),
(899, 13, 37),
(900, 13, 38),
(901, 13, 39),
(902, 13, 40),
(903, 13, 42),
(904, 13, 43),
(905, 35, 9),
(906, 35, 16),
(907, 35, 33),
(908, 35, 41),
(909, 35, 44),
(910, 35, 45),
(911, 35, 50),
(912, 35, 52),
(913, 35, 53),
(914, 35, 61),
(915, 35, 67),
(917, 35, 61),
(918, 35, 67),
(920, 30, 7),
(921, 30, 8),
(922, 30, 14),
(923, 30, 23),
(924, 30, 27),
(925, 30, 28),
(926, 30, 32),
(927, 36, 17),
(928, 36, 18),
(929, 36, 22),
(930, 36, 23),
(931, 36, 25),
(932, 36, 26),
(933, 36, 29),
(934, 36, 30),
(935, 36, 34),
(936, 36, 35),
(937, 36, 51),
(938, 32, 9),
(939, 32, 16),
(940, 32, 41),
(941, 32, 50),
(942, 32, 54),
(943, 32, 55),
(944, 32, 60),
(945, 32, 62),
(946, 32, 63),
(947, 32, 64),
(948, 32, 65),
(952, 32, 62),
(953, 32, 63),
(954, 32, 64),
(955, 32, 65),
(959, 32, 62),
(960, 32, 63),
(961, 32, 64),
(962, 32, 65),
(966, 32, 62),
(967, 32, 63),
(968, 32, 64),
(969, 32, 65),
(973, 28, 7),
(974, 28, 23),
(975, 28, 32),
(976, 28, 33),
(977, 28, 48),
(978, 28, 51),
(979, 31, 9),
(980, 31, 40),
(981, 31, 42),
(982, 31, 43),
(983, 31, 49),
(984, 31, 50),
(985, 31, 56),
(986, 31, 57),
(987, 31, 60),
(988, 31, 62),
(989, 31, 63),
(990, 31, 64),
(991, 31, 65),
(995, 31, 62),
(996, 31, 63),
(997, 31, 64),
(998, 31, 65),
(1002, 31, 62),
(1003, 31, 63),
(1004, 31, 64),
(1005, 31, 65),
(1009, 31, 62),
(1010, 31, 63),
(1011, 31, 64),
(1012, 31, 65);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `department_id` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expiry` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `name`, `mobile`, `department_id`, `position`, `mail`, `picture`, `password`, `token`, `expiry`) VALUES
(13, 'Khandaker Mohammad Mohi Uddin', '018212345**', 1, 'Assistant Professor', 'user2@gmail.com', 'uploads/jialni.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(14, 'Md. Tahzib Ul Islam', '015512345**', 1, 'Associate Professor', 'user4@gmail.com', 'uploads/thazib.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(15, 'Md. Habibullah Belali', '013712345**', 1, 'Assistant Professor', 'user7@gmail.com', 'uploads/bilali.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(16, 'Mahmudul Hasan', '014812345**', 1, 'Lecturer', 'user11@gmail.com', 'uploads/hasan.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(17, 'Md. Aminul Islam', '011912345**', 1, 'Lecturer', 'user12@gmail.com', 'uploads/animul.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(18, 'Sahab Uddin Rana', '012012345**', 1, 'Lecturer', 'user13@gmail.com', 'uploads/rana.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(19, 'Md Rakib Hossain', '010112345**', 1, 'Lecturer', 'user14@gmail.com', 'uploads/rakib.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(20, 'Syed Jamiul Alam', '017212345**', 1, 'Lecturer', 'user15@gmail.com', 'uploads/jaimul.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(21, 'Md. Ashraful Islam', '018312345**', 1, 'Assistant Professor', 'user8@gmail.com', 'uploads/ashraful.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(22, 'MD. ZAHIDUL ISLAM', '019412345**', 1, 'Assistant Professor', 'user9@gmail.com', 'uploads/zahid.jpeg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(23, 'Sraboni Barua', '015612345**', 1, 'Assistant Professor', 'user10@gmail.com', 'uploads/sraboni.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(24, 'Md. Humaun Kabir', '016712345**', 1, 'Lecturer', 'user15@gmail.com', 'uploads/humaiun.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(25, 'Mohammad Asraful Hasnat', '013812345**', 1, 'Lecturer', 'user16@gmail.com', 'uploads/dum.png', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(26, 'Md. Abir Mahmud', '014912345**', 1, 'Lecturer', 'user17@gmail.com', 'uploads/dum.png', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(27, 'Md. Nur -a-Alam', '016612345**', 1, 'Lecturer', 'user5@gmail.com', 'uploads/361927014_1245435162800813_7322469978061923892_n-removebg-preview.png', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(28, 'Rashed Mahmud', '011112345**', 1, 'Lecturer', 'user18@gmail.com', 'uploads/rashed.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(29, 'Sayma Sultana', '019512345**', 1, 'Lecturer', 'user20@gmail.com', 'uploads/sayma.jpeg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(30, 'Sajia Akhter Airin', '017312345**', 1, 'Lecturer', 'user21@gmail.com', 'uploads/airin.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(31, 'Md. Tipu Sultan', '014912345**', 1, 'Lecturer', 'user22@gmail.com', 'uploads/tipu.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(32, 'Hemonta Kumar Barman', '019412394**', 1, 'Lecturer', 'user23@gmail.com', 'uploads/hemonto.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(33, 'Md. Sifuzzaman', '010312345**', 1, 'Associate Professor', 'user6@gmail.com', 'uploads/jaman.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(34, 'Dr. A.T.M. Mahbubur Rahman Sarker', '017112345**', 1, 'Dean', 'user1@gmail.com', 'uploads/dean.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(35, 'Md. Anisur Rahman Pramanik', '019412345**', 1, 'Associate Professor', 'user19@gmail.com', 'uploads/anisur.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(36, 'Md. Rezaul Islam', '019912345**', 1, 'Lecturer', 'user25@gmail.com', 'uploads/rezaul.jpeg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(37, 'Md. Abdul Based', '019312345**', 1, 'Professor', 'user3@gmail.com', 'uploads/based.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(38, 'MD. SHARIFUL ISLAM', '014812345**', 1, 'Lecturer', 'user26@gmail.com', 'uploads/shariful.jpg', '$2y$10$bPPPAH0w6yQb/RWHPpSPce2VZ84iglR7yfKNcclEEc47aIDZNPWUW', '', NULL),
(41, 'Mst. Jahanara Akhtar', '019000000**', 1, 'Professor', 'user35@gmail.com', 'uploads/jahanara.jpg', '$2y$10$UQYMFdlB.OkUl/ge50l/Q.6LhhC3AwkT4ti0R5XNmyznFU0bipn0a', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `timetable_id` int(11) NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `class_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`timetable_id`, `start_time`, `end_time`, `class_type`) VALUES
(1, '09:00:00', '10:15:00', 'theory'),
(2, '10:16:00', '11:30:00', 'theory'),
(3, '11:31:00', '12:45:00', 'theory'),
(4, '12:46:00', '14:00:00', 'theory'),
(5, '09:00:00', '10:40:00', 'lab'),
(6, '10:41:00', '12:20:00', 'lab'),
(7, '12:21:00', '14:00:00', 'lab'),
(43, '14:00:00', '23:00:00', 'theory');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email` (`email`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batch_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `routine`
--
ALTER TABLE `routine`
  ADD PRIMARY KEY (`routine_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `teachercourses`
--
ALTER TABLE `teachercourses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`timetable_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `routine`
--
ALTER TABLE `routine`
  MODIFY `routine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `teachercourses`
--
ALTER TABLE `teachercourses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1013;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `batch_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `routine`
--
ALTER TABLE `routine`
  ADD CONSTRAINT `routine_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `routine_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`),
  ADD CONSTRAINT `routine_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`);

--
-- Constraints for table `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `semester_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `teachercourses`
--
ALTER TABLE `teachercourses`
  ADD CONSTRAINT `teachercourses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `teachercourses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Table structure for table `batch_info`
--

CREATE TABLE `batch_info` (
  `id` int(11) NOT NULL,
  `batch` varchar(20) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `room_no` varchar(10) DEFAULT NULL,
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `batch_info`
--

INSERT INTO `batch_info` (`id`, `batch`, `semester`, `room_no`, `department`) VALUES
(5, '81', '2', '705', 'cse'),
(6, '55', '1', '504', 'cse'),
(7, '50', '12', '505', 'cse');

-- --------------------------------------------------------

--
-- Table structure for table `cse_50_12_room_505`
--

CREATE TABLE `cse_50_12_room_505` (
  `id` int(11) NOT NULL,
  `day` varchar(20) DEFAULT NULL,
  `time_range` varchar(50) DEFAULT NULL,
  `course_code` varchar(100) DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `teacher_name` varchar(100) DEFAULT NULL,
  `batch_info_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cse_50_12_room_505`
--

INSERT INTO `cse_50_12_room_505` (`id`, `day`, `time_range`, `course_code`, `course_name`, `teacher_name`, `batch_info_id`) VALUES
(1, 'Saturday', '9:00-10:15', 'MATH-101', 'Linear Algebra & Co-ordinate Geometry', 'Md. Ashraful Islam,Lecturer', 7),
(2, 'Saturday', '10:15-11:30', 'CSE-103', 'Structured Programming', 'Prof. Md. Abdul Based', 7),
(3, 'Saturday', '11:30-12:45', 'PHY-103', 'Physics-II', 'Md. Rakib Hossain,Lecturer', 7),
(4, 'Sunday', '9:00-10:15', 'PHY-103', 'Physics-II', 'Md. Rakib Hossain,Lecturer', 7),
(5, 'Sunday', '10:15-11:30', 'CSE-103', 'Structured Programming', 'Prof. Md. Abdul Based', 7),
(6, 'Sunday', '11:30-12:45', 'MATH-101', 'Linear Algebra & Co-ordinate Geometry', 'Md. Ashraful Islam,Lecturer', 7);

-- --------------------------------------------------------

--
-- Table structure for table `cse_55_1_room_504`
--

CREATE TABLE `cse_55_1_room_504` (
  `id` int(11) NOT NULL,
  `day` varchar(20) DEFAULT NULL,
  `time_range` varchar(50) DEFAULT NULL,
  `course_code` varchar(100) DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `teacher_name` varchar(100) DEFAULT NULL,
  `batch_info_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cse_55_1_room_504`
--

INSERT INTO `cse_55_1_room_504` (`id`, `day`, `time_range`, `course_code`, `course_name`, `teacher_name`, `batch_info_id`) VALUES
(1, 'Saturday', '9:00-10:15', 'MATH-101', 'Linear Algebra & Co-ordinate Geometry', 'Md. Ashraful Islam,Lecturer', 6),
(2, 'Saturday', '10:15-11:30', 'CSE-103', 'Structured Programming', 'Prof. Md. Abdul Based', 6),
(3, 'Saturday', '11:30-12:45', 'PHY-103', 'Physics-II', 'Md. Rakib Hossain,Lecturer', 6),
(4, 'Sunday', '9:00-10:15', 'PHY-103', 'Physics-II', 'Md. Rakib Hossain,Lecturer', 6),
(5, 'Sunday', '10:15-11:30', 'CSE-103', 'Structured Programming', 'Prof. Md. Abdul Based', 6),
(6, 'Sunday', '11:30-12:45', 'MATH-101', 'Linear Algebra & Co-ordinate Geometry', 'Md. Ashraful Islam,Lecturer', 6);

-- --------------------------------------------------------

--
-- Table structure for table `cse_81_2_room_705`
--

CREATE TABLE `cse_81_2_room_705` (
  `id` int(11) NOT NULL,
  `day` varchar(20) DEFAULT NULL,
  `time_range` varchar(50) DEFAULT NULL,
  `course_code` varchar(100) DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `teacher_name` varchar(100) DEFAULT NULL,
  `batch_info_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cse_81_2_room_705`
--

INSERT INTO `cse_81_2_room_705` (`id`, `day`, `time_range`, `course_code`, `course_name`, `teacher_name`, `batch_info_id`) VALUES
(1, 'Saturday', '9:00-10:15', 'MATH-101', 'Linear Algebra & Co-ordinate Geometry', 'Md. Ashraful Islam,Lecturer', 5),
(2, 'Saturday', '10:15-11:30', 'CSE-103', 'Structured Programming', 'Prof. Md. Abdul Based', 5),
(3, 'Saturday', '11:30-12:45', 'PHY-103', 'Physics-II', 'Md. Rakib Hossain,Lecturer', 5),
(4, 'Sunday', '9:00-10:15', 'PHY-103', 'Physics-II', 'Md. Rakib Hossain,Lecturer', 5),
(5, 'Sunday', '10:15-11:30', 'CSE-103', 'Structured Programming', 'Prof. Md. Abdul Based', 5),
(6, 'Sunday', '11:30-12:45', 'MATH-101', 'Linear Algebra & Co-ordinate Geometry', 'Md. Ashraful Islam,Lecturer', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch_info`
--
ALTER TABLE `batch_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cse_50_12_room_505`
--
ALTER TABLE `cse_50_12_room_505`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_info_id` (`batch_info_id`);

--
-- Indexes for table `cse_55_1_room_504`
--
ALTER TABLE `cse_55_1_room_504`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_info_id` (`batch_info_id`);

--
-- Indexes for table `cse_81_2_room_705`
--
ALTER TABLE `cse_81_2_room_705`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_info_id` (`batch_info_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch_info`
--
ALTER TABLE `batch_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cse_50_12_room_505`
--
ALTER TABLE `cse_50_12_room_505`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cse_55_1_room_504`
--
ALTER TABLE `cse_55_1_room_504`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cse_81_2_room_705`
--
ALTER TABLE `cse_81_2_room_705`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cse_50_12_room_505`
--
ALTER TABLE `cse_50_12_room_505`
  ADD CONSTRAINT `cse_50_12_room_505_ibfk_1` FOREIGN KEY (`batch_info_id`) REFERENCES `batch_info` (`id`);

--
-- Constraints for table `cse_55_1_room_504`
--
ALTER TABLE `cse_55_1_room_504`
  ADD CONSTRAINT `cse_55_1_room_504_ibfk_1` FOREIGN KEY (`batch_info_id`) REFERENCES `batch_info` (`id`);

--
-- Constraints for table `cse_81_2_room_705`
--
ALTER TABLE `cse_81_2_room_705`
  ADD CONSTRAINT `cse_81_2_room_705_ibfk_1` FOREIGN KEY (`batch_info_id`) REFERENCES `batch_info` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
