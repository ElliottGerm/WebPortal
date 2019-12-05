CREATE DATABASE  IF NOT EXISTS `webportal_db_seed` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `webportal_db_seed`;
-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2019 at 11:13 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webportal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `postId` int(11) NOT NULL,
  `eid` varchar(45) DEFAULT NULL,
  `commentBody` text DEFAULT NULL,
  `postDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`postId`, `eid`, `commentBody`, `postDate`) VALUES
(0, 'BillyG', 'I invented windows so i dont need no help', '12/04/19 10:53 pm'),
(1, 'C137', 'Im the smartest guy in the uniiveeeersee!!\r\n*buuuuuurp*\r\n\r\nCheck out my code. \r\n\r\n# first neural network with keras tutorial\r\nfrom numpy import loadtxt\r\nfrom keras.models import Sequential\r\nfrom keras.layers import Dense\r\n# load the dataset\r\ndataset = loadtxt(\'pima-indians-diabetes.csv\', delimiter=\',\')\r\n# split into input (X) and output (y) variables\r\nX = dataset[:,0:8]\r\ny = dataset[:,8]\r\n# define the keras model\r\nmodel = Sequential()\r\nmodel.add(Dense(12, input_dim=8, activation=\'relu\'))\r\nmodel.add(Dense(8, activation=\'relu\'))\r\nmodel.add(Dense(1, activation=\'sigmoid\'))\r\n# compile the keras model\r\nmodel.compile(loss=\'binary_crossentropy\', optimizer=\'adam\', metrics=[\'accuracy\'])\r\n# fit the keras model on the dataset\r\nmodel.fit(X, y, epochs=150, batch_size=10)\r\n# evaluate the keras model\r\n_, accuracy = model.evaluate(X, y)\r\nprint(\'Accuracy: %.2f\' % (accuracy*100))', '12/04/19 11:30 pm'),
(2, 'C137', 'Get schwifty yall. Wubalubadubdub!!!', '12/04/19 11:30 pm'),
(3, 'batman', 'Batman learned how to reverse numbers in C. Check it. \r\n\r\n#include <stdio.h>\r\nint main() {\r\n    int n, rev = 0, remainder;\r\n    printf(\"Enter an integer: \");\r\n    scanf(\"%d\", &n);\r\n    while (n != 0) {\r\n        remainder = n % 10;\r\n        rev = rev * 10 + remainder;\r\n        n /= 10;\r\n    }\r\n    printf(\"Reversed number = %d\", rev);\r\n    return 0;\r\n}', '12/04/19 11:35 pm'),
(4, 'SpiderMan', 'I learned a lot about web development. \r\nHAHA get it \"Web\" development.\r\n', '12/05/19 1:14 am'),
(5, 'SpiderMan', 'I learned some java \r\n\r\n    public static String toBinary(int base10Num){\r\n        boolean isNeg = base10Num < 0;\r\n        base10Num = Math.abs(base10Num);        \r\n        String result = \"\";\r\n        \r\n        while(base10Num > 1){\r\n            result = (base10Num % 2) + result;\r\n            base10Num /= 2;\r\n        }\r\n        assert base10Num == 0 || base10Num == 1 : \"value is not <= 1: \" + base10Num;\r\n        \r\n        result = base10Num + result;\r\n        assert all0sAnd1s(result);\r\n        \r\n        if( isNeg )\r\n            result = \"-\" + result;\r\n        return result;\r\n    }', '12/05/19 1:15 am');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventid` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start` varchar(45) DEFAULT NULL,
  `end` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventid`, `title`, `start`, `end`, `color`) VALUES
(0, 'emusk CS261', '2019-12-09T10:00:00', '2019-12-09T12:00:00', '#ff7f7f'),
(1, 'emusk CS261', '2019-12-11T10:00:00', '2019-12-11T12:00:00', '#ff7f7f'),
(2, 'emusk CS261', '2019-12-13T15:00:00', '2019-12-13T16:00:00', '#ff7f7f'),
(3, 'germanet CS361', '2019-12-10T09:00:00', '2019-12-10T10:00:00', ''),
(4, 'germanet CS361', '2019-12-12T14:00:00', '2019-12-12T15:00:00', ''),
(5, 'HalfMan CS345', '2019-12-09T15:00:00', '2019-12-09T16:00:00', '#b19cd9'),
(6, 'HalfMan CS345', '2019-12-11T15:00:00', '2019-12-11T16:00:00', '#b19cd9'),
(7, 'HalfMan CS345', '2019-12-13T12:00:00', '2019-12-13T15:00:00', '#b19cd9'),
(8, 'emusk CS139', '2019-12-16T11:00:00', '2019-12-16T19:00:00', '#ff7f7f');

-- --------------------------------------------------------

--
-- Table structure for table `existing_queue`
--

CREATE TABLE `existing_queue` (
  `eid` varchar(255) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `classnum` varchar(255) DEFAULT NULL,
  `queueTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `existing_queue`
--

INSERT INTO `existing_queue` (`eid`, `fname`, `lname`, `classnum`, `queueTime`) VALUES
('batman', 'Bruce', 'Wayne', 'CS149', '2019-12-05 03:48:59'),
('BillyG', 'Bill', 'Gates', 'CS261', '2019-12-05 23:08:44'),
('C137', 'Rick', 'Sanchez', 'CS149', '2019-12-05 16:57:42'),
('SpiderMan', 'Peter', 'Parker', 'CS159', '2019-12-05 14:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `scheduler_requests`
--

CREATE TABLE `scheduler_requests` (
  `id` int(11) NOT NULL,
  `eid` varchar(45) DEFAULT NULL,
  `mo_times` varchar(45) DEFAULT NULL,
  `tu_times` varchar(45) DEFAULT NULL,
  `we_times` varchar(45) DEFAULT NULL,
  `th_times` varchar(45) DEFAULT NULL,
  `fr_times` varchar(45) DEFAULT NULL,
  `sa_times` varchar(45) DEFAULT NULL,
  `su_times` varchar(45) DEFAULT NULL,
  `request_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scheduler_requests`
--

INSERT INTO `scheduler_requests` (`id`, `eid`, `mo_times`, `tu_times`, `we_times`, `th_times`, `fr_times`, `sa_times`, `su_times`, `request_date`) VALUES
(8, 'emusk', '10:00 AM to 12:00 PM', 'NULL', '10:00 AM to 12:00 PM', 'NULL', '3:00 PM to 4:00 PM', 'NULL', 'NULL', '2019-12-05 09:32:56'),
(9, 'germanet', 'NULL', '9:00 AM to 10:00 AM', 'NULL', 'NULL', '1:00 PM to 2:00 PM', 'NULL', 'NULL', '2019-12-05 09:37:45'),
(10, 'germanet', 'NULL', '9:00 AM to 10:00 AM', 'NULL', '2:00 PM to 3:00 PM', 'NULL', 'NULL', 'NULL', '2019-12-05 09:39:16'),
(11, 'HalfMan', '3:00 PM to 4:00 PM', 'NULL', '3:00 PM to 4:00 PM', 'NULL', '12:00 PM to 5:00 PM', 'NULL', 'NULL', '2019-12-05 10:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `signInLogger`
--

CREATE TABLE `signInLogger` (
  `signinId` int(11) NOT NULL,
  `eid` varchar(255) DEFAULT NULL,
  `signinTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signInLogger`
--

INSERT INTO `signInLogger` (`signinId`, `eid`, `signinTime`) VALUES
(4, 'batman', '2019-12-04 21:48:56'),
(5, 'BillyG', '2019-12-04 21:50:36'),
(6, 'BillyG', '2019-12-04 22:22:13'),
(7, 'C137', '2019-12-04 23:28:15'),
(8, 'hurstrc', '2019-12-04 23:32:47'),
(9, 'batman', '2019-12-04 23:34:53'),
(10, 'C137', '2019-12-04 23:35:51'),
(11, 'emusk', '2019-12-04 23:36:45'),
(12, 'SpiderMan', '2019-12-05 00:44:09'),
(13, 'BillyG', '2019-12-05 00:53:46'),
(14, 'SpiderMan', '2019-12-05 01:11:07'),
(15, 'BillyG', '2019-12-05 01:17:32'),
(16, 'C137', '2019-12-05 01:17:56'),
(17, 'SpiderMan', '2019-12-05 08:36:39'),
(18, 'BillyG', '2019-12-05 08:41:31'),
(19, 'C137', '2019-12-05 08:45:15'),
(20, 'germanet', '2019-12-05 09:34:39'),
(21, 'C137', '2019-12-05 10:15:00'),
(22, 'SpiderMan', '2019-12-05 10:15:33'),
(23, 'mayfiecs', '2019-12-05 10:55:17'),
(24, 'C137', '2019-12-05 10:57:38'),
(25, 'BillyG', '2019-12-05 10:57:47'),
(26, 'BillyG', '2019-12-05 11:40:59'),
(27, 'C137', '2019-12-05 17:08:26'),
(28, 'BillyG', '2019-12-05 17:08:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `eid` varchar(255) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`eid`, `fname`, `lname`, `password`, `email`, `role`) VALUES
('batman', 'Bruce', 'Wayne', '$2y$10$hFCx4l3TqQK5UwaDuqiWTeFp5RHONhRh3F.dAkSPu3r2PrQs7D0uG', 'bwayne@gmail.com', 3),
('BillyG', 'Bill', 'Gates', '$2y$10$omWWLzVNkUgRU0lJ7iD8jehGD2uHZMqBdfnf9hivZdOmdjIGAv1Aa', 'bgates@gmail.com', 3),
('C137', 'Rick', 'Sanchez', '$2y$10$fphJMev2ph89rXrtkCEsm.qxHXzJX9AK7j1PqHG4FUaZvv/V806pe', 'rsanchez@gmail.com', 3),
('emusk', 'Elon', 'Musk', '$2y$10$s8QMRLG2f29Xk8Qdqfz5ru.YBnSAfqDNJUv/o170fx8uDGv1ahHwq', 'emusk@gmail.com', 2),
('germanet', 'Elliott', 'Germanovich', '$2y$10$G0G00qnd10sYGVg02OaJYuUXzjWz3.LGux2xyh77qxQuwrOtGx1zi', 'etge@gmail.com', 2),
('HalfMan', 'Tyrion', 'Lannester', '$2y$10$tf6M8HZCoDGL/OYZUydQaO4RGRuGpg0zV2a7wbrHISjZKpcgB9Lzm', 'tlans@gmail.com', 2),
('hurstrc', 'Ryan', 'Hurst', '$2y$10$mYl0nPRTQZFujAUpeZ8Xp.JhLSdFwGgCfow2nx1PB0v1ZGAAfQKne', 'rhurst@gmail.com', 1),
('SpiderMan', 'Peter', 'Parker', '$2y$10$eFPqsFQ6Lk.c5/ByV2IS/uRrq4U38xtpdPTC207vJDi4ANRA.jrXa', 'spider@gmail.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`postId`),
  ADD UNIQUE KEY `postId_UNIQUE` (`postId`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `existing_queue`
--
ALTER TABLE `existing_queue`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `scheduler_requests`
--
ALTER TABLE `scheduler_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signInLogger`
--
ALTER TABLE `signInLogger`
  ADD PRIMARY KEY (`signinId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`eid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scheduler_requests`
--
ALTER TABLE `scheduler_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `signInLogger`
--
ALTER TABLE `signInLogger`
  MODIFY `signinId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
