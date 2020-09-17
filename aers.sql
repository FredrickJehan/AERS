-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2020 at 04:45 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aers`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_initial` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `is_employee` int(11) NOT NULL,
  `author_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `user_id`, `publication_id`, `first_name`, `middle_initial`, `last_name`, `is_employee`, `author_type`) VALUES
(101, 5, 69, 'Tuan', 'C.', 'Lai', 1, 'Main'),
(102, 5, 69, 'Trung', 'Y.', 'Bui', 1, 'Extra'),
(103, 5, 69, 'Nedim', 'L.', 'Lipka', 1, 'Extra'),
(104, 5, 70, 'Xiaowei', 'A.', 'Chu', 1, 'Main'),
(105, 5, 70, 'Jeff', 'J.', 'LeFevre', 1, 'Extra'),
(106, 5, 70, 'Aldrin', 'A.', 'Montana', 1, 'Extra'),
(107, 5, 71, 'Charles', 'A.', 'Welch', 1, 'Main'),
(108, 5, 71, 'Allision', 'A', 'Lahnala', 1, 'Extra'),
(109, 5, 71, 'Vernica', 'V.', 'Rosas', 1, 'Extra'),
(110, 5, 72, 'Carl', 'W.', 'Ernest', 1, 'Main'),
(200, 5, 88, 'Kyle', 'C.', 'Nolan', 1, 'Main'),
(201, 5, 89, 'Kyle', 'A.', 'Nolan ', 1, 'Main');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `completed`
--

CREATE TABLE `completed` (
  `completed_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `completed_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `completed`
--

INSERT INTO `completed` (`completed_id`, `publication_id`, `title`, `year`, `institution`, `location`, `url`, `completed_type`) VALUES
(69, 70, 'Mapping Datasets to Object Storage System', 2013, 'University of California', 'Santa Cruz', 'https://arxiv.org/abs/2007.01789', 'Thesis / Dissertation'),
(70, 89, 'Chinese.ART: A Multimodal Content-Based Analysis and Retrieval System for Buddha Statues', 2019, 'Institute for Datability Science, Osaka University', 'Bagumbayan, Naga City', '', 'Thesis / Dissertation');

-- --------------------------------------------------------

--
-- Table structure for table `creative_works`
--

CREATE TABLE `creative_works` (
  `cw_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `type_cw` varchar(255) NOT NULL,
  `month_year` date NOT NULL,
  `title_work` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `place_performance` varchar(255) NOT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `artwork_exhibited` varchar(255) DEFAULT NULL,
  `duration_performance` varchar(255) DEFAULT NULL,
  `commission_agency` varchar(255) DEFAULT NULL,
  `scope_audience` varchar(255) NOT NULL,
  `award_received` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `editor`
--

CREATE TABLE `editor` (
  `editor_id` int(11) NOT NULL,
  `published_id` int(11) NOT NULL,
  `editor_fn` varchar(255) NOT NULL,
  `editor_mi` varchar(255) NOT NULL,
  `editor_ln` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `feedback` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `user_id`, `publication_id`, `type`, `time`, `status`) VALUES
(7, 5, 72, 'Review', '2020-07-21 04:52:15', 'Read'),
(8, 5, 70, 'Review', '2020-07-21 04:52:24', 'Read'),
(9, 5, 89, 'Review', '2020-07-21 11:41:35', 'Read'),
(10, 5, 69, 'Review', '2020-09-16 01:16:48', 'Unread'),
(11, 5, 88, 'Review', '2020-09-16 01:16:52', 'Unread'),
(12, 5, 71, 'Review', '2020-09-16 01:16:57', 'Unread');

-- --------------------------------------------------------

--
-- Table structure for table `presented`
--

CREATE TABLE `presented` (
  `presented_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `title_presented` varchar(255) NOT NULL,
  `date_presentation` varchar(255) NOT NULL,
  `title_conference` varchar(255) NOT NULL,
  `place_conference` varchar(255) NOT NULL,
  `presented_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presented`
--

INSERT INTO `presented` (`presented_id`, `publication_id`, `title_presented`, `date_presentation`, `title_conference`, `place_conference`, `presented_type`) VALUES
(2, 69, 'ISA', '2020-07', 'Intelligent Shopping Assistant', 'University of Illinois', 'Conference Paper'),
(3, 71, 'Expressive Interviewing', '2020-07', 'A Conversational System for coping with COVID-19', 'University of micihgan', 'Conference Paper'),
(4, 88, 'ISA', '2020-07', 'Intelligent Shopping Assistant', 'University of Illinois', 'Conference Paper');

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE `publication` (
  `publication_id` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `abstract` varchar(3000) DEFAULT NULL,
  `num_views` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `publication_type` varchar(255) NOT NULL,
  `date_submission` varchar(255) NOT NULL,
  `submittor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publication`
--

INSERT INTO `publication` (`publication_id`, `file`, `abstract`, `num_views`, `status`, `feedback`, `publication_type`, `date_submission`, `submittor`) VALUES
(69, 'ISA-_An_Intelligent_Shopping_assistant.pdf', 'Despite the growth of e-commerce, brick-andmortar stores are still the preferred destinations for many people. In this paper, we\r\npresent ISA, a mobile-based intelligent shopping assistant that is designed to improve shopping experience in physical stores. ISA assists\r\nusers by leveraging advanced techniques in\r\ncomputer vision, speech processing, and natural language processing. An in-store user only\r\nneeds to take a picture or scan the barcode of\r\nthe product of interest, and then the user can\r\ntalk to the assistant about the product. The\r\nassistant can also guide the user through the\r\npurchase process or recommend other similar\r\nproducts to the user. We take a data-driven\r\napproach in building the engines of ISA’s natural language processing component, and the\r\nengines achieve good performance\r\n', 0, 'Approved', NULL, 'Presented Research', 'Jul 21 2020', 5),
(70, 'Mapping_Datasets_to_object_storage_system_(3).pdf', 'Access libraries such as ROOT[1] and HDF5[2] allow users to interact with datasets using high level abstractions, like coordinate systems and\r\nassociated slicing operations. Unfortunately, the implementations of access libraries are based on outdated assumptions about storage systems interfaces and\r\nare generally unable to fully benefit from modern fast storage devices. For example, access libraries often implement buffering and data layout that assume\r\nthat large, single-threaded sequential access patterns are causing less overall latency than small parallel random access: while this is true for spinning media,\r\nit is not true for flash media. The situation is getting worse with rapidly evolving storage devices such as non-volatile memory and ever larger datasets. This\r\nproject explores distributed dataset mapping infrastructures that can integrate\r\nand scale out existing access libraries using Ceph’s extensible object model,\r\navoiding re-implementation or even modifications of these access libraries as\r\nmuch as possible. These programmable storage extensions coupled with our\r\ndistributed dataset mapping techniques enable: 1) access library operations to\r\nbe offloaded to storage system servers, 2) the independent evolution of access\r\nlibraries and storage systems and 3) fully leveraging of the existing load balancing, elasticity, and failure management of distributed storage systems like Ceph.\r\nThey also create more opportunities to conduct storage server-local optimizations specific to storage servers. For example, storage servers might include\r\nlocal key/value stores combined with chunk stores that require different optimizations than a local file system. As storage servers evolve to support new\r\nstorage devices like non-volatile memory, these server-local optimizations can\r\nbe implemented while minimizing disruptions to applications. We will report\r\nprogress on the means by which distributed dataset mapping can be abstracted\r\nover particular access libraries, including access libraries for ROOT data, and\r\nhow we address some of the challenges revolving around data partitioning and\r\ncomposability of access operations.', 0, 'Approved', NULL, 'Completed Research', 'Jul 21 2020', 5),
(71, 'Expresseive_Intervewing-A_conversation_system_for_coping_COVID_19.pdf', 'The ongoing COVID-19 pandemic has raised\r\nconcerns for many regarding personal and public health implications, financial security and\r\neconomic stability. Alongside many other\r\nunprecedented challenges, there are increasing concerns over social isolation and mental\r\nhealth. We introduce Expressive Interviewing–\r\nan interview-style conversational system that\r\ndraws on ideas from motivational interviewing and expressive writing. Expressive Interviewing seeks to encourage users to express\r\ntheir thoughts and feelings through writing by\r\nasking them questions about how COVID-19\r\nhas impacted their lives. We present relevant\r\naspects of the system’s design and implementation as well as quantitative and qualitative\r\nanalyses of user interactions with the system.\r\nIn addition, we conduct a comparative evaluation with a general purpose dialogue system\r\nfor mental health that shows our system potential in helping users to cope with COVID-19\r\nissues.', 0, 'Approved', NULL, 'Presented Research', 'Jul 21 2020', 5),
(72, 'book_textbook4.pdf', NULL, 0, 'Approved', NULL, 'Published Research', 'Jul 21 2020', 5),
(88, 'ISA-_An_Intelligent_Shopping_assistant.pdf', 'Despite the growth of e-commerce, brick-andmortar stores are still the preferred destinations for many people. In this paper, we\r\npresent ISA, a mobile-based intelligent shopping assistant that is designed to improve shopping experience in physical stores. ISA assists\r\nusers by leveraging advanced techniques in\r\ncomputer vision, speech processing, and natural language processing. An in-store user only\r\nneeds to take a picture or scan the barcode of\r\nthe product of interest, and then the user can\r\ntalk to the assistant about the product. The\r\nassistant can also guide the user through the\r\npurchase process or recommend other similar\r\nproducts to the user. We take a data-driven\r\napproach in building the engines of ISA’s natural language processing component, and the\r\nengines achieve good performance\r\n', 0, 'Approved', NULL, 'Presented Research', 'Jul 21 2020', 5),
(89, 'Thesis1.pdf', 'test', 0, 'Rejected', 'wrong pdf', 'Completed Research', 'Jul 21 2020', 5);

-- --------------------------------------------------------

--
-- Table structure for table `published`
--

CREATE TABLE `published` (
  `published_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `year_published` int(11) DEFAULT NULL,
  `title_article` varchar(255) DEFAULT NULL,
  `title_journal` varchar(255) DEFAULT NULL,
  `vol_num` int(11) DEFAULT NULL,
  `issue_num` int(11) DEFAULT NULL,
  `page_num` varchar(255) DEFAULT NULL,
  `indexing_database` varchar(255) DEFAULT NULL,
  `peer_review` varchar(255) DEFAULT NULL,
  `title_book` varchar(255) DEFAULT NULL,
  `title_chapter` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `place_of_publication` varchar(255) DEFAULT NULL,
  `place_of_conference` varchar(255) DEFAULT NULL,
  `published_type` varchar(255) NOT NULL,
  `title_conference` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `published`
--

INSERT INTO `published` (`published_id`, `publication_id`, `year_published`, `title_article`, `title_journal`, `vol_num`, `issue_num`, `page_num`, `indexing_database`, `peer_review`, `title_book`, `title_chapter`, `publisher`, `place_of_publication`, `place_of_conference`, `published_type`, `title_conference`, `url`) VALUES
(15, 72, 2004, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Following Muhammad: Rethinking Islam in the Contemporary World', NULL, 'The University of North Carolina Press', 'London', NULL, 'Book / Textbook', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `contact_number` int(11) DEFAULT NULL,
  `user_type` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `department`, `contact_number`, `user_type`) VALUES
(1, 'knolan', 'Kyle Jhon', 'A.', 'Nolan', 'knolan@gbox.adnu.edu.ph', 'nolan', 'Department of Media Studies', 0, 'Admin'),
(2, 'ryimperial', 'Ryan Christian', 'Y.', 'Imperial', 'ryimperial@gbox.adnu.edu.ph', 'imperial', 'Department of Psychology', 0, 'Researcher'),
(5, 'admin', 'Kyle', 'A.', 'Nolan', 'admin@gbox.adnu.edu.ph', 'admin', 'Department of Computer Science', 0, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`),
  ADD KEY `publication_id` (`publication_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `publication_id` (`publication_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `completed`
--
ALTER TABLE `completed`
  ADD PRIMARY KEY (`completed_id`),
  ADD KEY `publication_id` (`publication_id`);

--
-- Indexes for table `creative_works`
--
ALTER TABLE `creative_works`
  ADD PRIMARY KEY (`cw_id`),
  ADD KEY `publication_id` (`publication_id`);

--
-- Indexes for table `editor`
--
ALTER TABLE `editor`
  ADD PRIMARY KEY (`editor_id`),
  ADD KEY `published_id` (`published_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `publication_id` (`publication_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `notification_ibfk_1` (`user_id`),
  ADD KEY `notification_ibfk_2` (`publication_id`);

--
-- Indexes for table `presented`
--
ALTER TABLE `presented`
  ADD PRIMARY KEY (`presented_id`),
  ADD KEY `publication_id` (`publication_id`);

--
-- Indexes for table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`publication_id`),
  ADD KEY `submittor` (`submittor`);

--
-- Indexes for table `published`
--
ALTER TABLE `published`
  ADD PRIMARY KEY (`published_id`),
  ADD KEY `publication_id` (`publication_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `completed`
--
ALTER TABLE `completed`
  MODIFY `completed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `creative_works`
--
ALTER TABLE `creative_works`
  MODIFY `cw_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `editor`
--
ALTER TABLE `editor`
  MODIFY `editor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `presented`
--
ALTER TABLE `presented`
  MODIFY `presented_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `publication`
--
ALTER TABLE `publication`
  MODIFY `publication_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `published`
--
ALTER TABLE `published`
  MODIFY `published_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  ADD CONSTRAINT `author_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `completed`
--
ALTER TABLE `completed`
  ADD CONSTRAINT `completed_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`);

--
-- Constraints for table `creative_works`
--
ALTER TABLE `creative_works`
  ADD CONSTRAINT `creative_works_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`);

--
-- Constraints for table `editor`
--
ALTER TABLE `editor`
  ADD CONSTRAINT `editor_ibfk_1` FOREIGN KEY (`published_id`) REFERENCES `published` (`published_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`);

--
-- Constraints for table `presented`
--
ALTER TABLE `presented`
  ADD CONSTRAINT `presented_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
