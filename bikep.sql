-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2019 at 10:13 AM
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
-- Database: `bikep`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `userid` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`userid`, `password`) VALUES
('admin', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `bikes`
--

CREATE TABLE `bikes` (
  `bike_id` int(20) NOT NULL,
  `bike_name` varchar(50) NOT NULL,
  `bike_nameplate` varchar(50) NOT NULL,
  `bike_img` varchar(50) DEFAULT 'NA',
  `bikerc` varchar(50) NOT NULL,
  `bikedl` varchar(50) NOT NULL,
  `bikeinsure` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `price_per_day` float NOT NULL,
  `bike_availability` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bikes Data';

--
-- Dumping data for table `bikes`
--

INSERT INTO `bikes` (`bike_id`, `bike_name`, `bike_nameplate`, `bike_img`, `bikerc`, `bikedl`, `bikeinsure`, `price`, `price_per_day`, `bike_availability`) VALUES
(1, 'HondaNavi', 'KA-02-4564', 'assets/img/cars/01 HONDA navi Orange .jpg', 'assets/img/rc_book/Slide11.JPG', 'assets/img/dls/Slide1.JPG', 'assets/img/insure/Slide21.JPG', 12, 80, 'yes'),
(2, 'HondaAmaze', 'KA-02-0980', 'assets/img/cars/amaze.jpg', 'assets/img/rc_book/Slide12.JPG', 'assets/img/dls/Slide2.JPG', 'assets/img/insure/Slide22.JPG', 15, 100, 'yes'),
(3, 'Bajaj Pulsar', 'KA-03-2938', 'assets/img/cars/Bajaj Pulsar.jpg', 'assets/img/rc_book/Slide13.JPG', 'assets/img/dls/Slide3.JPG', 'assets/img/insure/Slide23.JPG', 10, 85, 'yes'),
(4, 'Maruthi Swift Dzire', 'KA-03-9898', 'assets/img/cars/dzire.jpg', 'assets/img/rc_book/Slide14.JPG', 'assets/img/dls/Slide4.JPG', 'assets/img/insure/Slide24.JPG', 15, 120, 'yes'),
(5, 'Ford Figo', 'KA-04-1253', 'assets/img/cars/figo.jpg', 'assets/img/rc_book/Slide15.JPG', 'assets/img/dls/Slide5.JPG', 'assets/img/insure/Slide25.JPG', 15, 100, 'yes'),
(6, 'Honda Hornet', 'KA-03-0987', 'assets/img/cars/blue-hornet.jpg', 'assets/img/rc_book/Slide16.JPG', 'assets/img/dls/Slide6.JPG', 'assets/img/insure/Slide26.JPG', 13, 130, 'yes'),
(7, 'Honda Activa', 'KA-02-9989', 'assets/img/cars/Honda Activa .jpg', 'assets/img/rc_book/Slide17.JPG', 'assets/img/dls/Slide7.JPG', 'assets/img/insure/Slide27.JPG', 13, 85, 'yes'),
(8, 'Innova', 'KA-03-0989', 'assets/img/cars/Innova.jpg', 'assets/img/rc_book/Slide18.JPG', 'assets/img/dls/Slide8.JPG', 'assets/img/insure/Slide28.JPG', 18, 150, 'yes'),
(10, 'Kia Seltos', 'ka-05-9876', 'assets/img/cars/kia_seltos.jpg', 'assets/img/rc_book/Slide19.JPG', 'assets/img/dls/Slide9.JPG', 'assets/img/insure/Slide29.JPG', 18, 200, 'yes'),
(11, 'Honda CB Shine', 'KA-03-7679', 'assets/img/cars/Honda CB Shine.jpg', 'assets/img/rc_book/Slide20.JPG', 'assets/img/dls/Slide10.JPG', 'assets/img/insure/Slide30.JPG', 14, 120, 'yes'),
(12, 'Yamaha', 'KA-50-8978', 'assets/img/cars/yamaha.jpg', 'assets/img/rc_book/RC 12.PNG', 'assets/img/dls/DL 12.PNG', 'assets/img/insure/I 12.PNG', 20, 100, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `bike_accessories`
--

CREATE TABLE `bike_accessories` (
  `access_id` int(20) NOT NULL,
  `access_name` varchar(40) NOT NULL,
  `access_price` varchar(10) NOT NULL,
  `about_access` varchar(50) NOT NULL,
  `access_for_mf` varchar(10) NOT NULL,
  `client_username` varchar(50) NOT NULL,
  `access_availability` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bike_accessories`
--

INSERT INTO `bike_accessories` (`access_id`, `access_name`, `access_price`, `about_access`, `access_for_mf`, `client_username`, `access_availability`) VALUES
(1, 'divakar', '9480253625', ' Exprienced', 'M', 'pk', 'yes'),
(2, 'manju', '9523658451', 'Experienced', 'M', 'pk', 'yes'),
(3, 'sai nikil', '9562541528', 'Experienced ', 'M', 'manja', 'yes'),
(4, 'Sai Kumar', '8254512546', 'Experienced', 'M', 'manja', 'yes'),
(5, 'Saimanju', '9562358458', ' Experienced', 'M', 'hari', 'yes'),
(6, 'saik', '7021542512', ' Experienced', 'M', 'hari', 'yes'),
(7, 'deep', '9852365215', 'Experienced', 'M', 'anirundh', 'yes'),
(8, 'deepak', '9562584515', 'Experienced', 'M', 'anirundh', 'yes'),
(9, 'monk', '7854215245', 'Experienced', 'M', 'vijay', 'yes'),
(10, 'deepak.m', '9856754128', 'Experienced', 'M', 'vijay', 'yes'),
(11, 'Saral', '9449887321', 'genuine', 'male', 'spk', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `clientbikes`
--

CREATE TABLE `clientbikes` (
  `bike_id` int(20) NOT NULL,
  `client_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clientbikes`
--

INSERT INTO `clientbikes` (`bike_id`, `client_username`) VALUES
(7, 'anirundh'),
(8, 'anirundh'),
(5, 'hari'),
(6, 'hari'),
(3, 'manja'),
(4, 'manja'),
(1, 'pk'),
(2, 'pk'),
(12, 'spk'),
(10, 'vijay'),
(11, 'vijay');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_username` varchar(50) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_phone` varchar(15) NOT NULL,
  `client_email` varchar(25) NOT NULL,
  `client_address` text CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `client_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_username`, `client_name`, `client_phone`, `client_email`, `client_address`, `client_password`) VALUES
('anirundh', 'anirundh', '7098987898', 'anirundh@gmail.com', 'kalyannagar', 'root'),
('hari', 'hari', '7098453567', 'hari@gmail.com', 'rajanukunte', 'root'),
('lalith', 'lalith', '7003045098', 'lalith@gmail.com', 'new bel road bangalore', 'root'),
('manja', 'manja', '9787675678', 'manja@gmail.com', 'ams layout bangalore', 'root'),
('pk', 'pk', '9898787898', 'pk@gmail.com', 'vidyaranyapuara', 'root'),
('spk', 'spk', '9449860981', 'spk@gmail.com', '2', 'spk@123'),
('vijay', 'vijay', '702200223', 'vijay131@gmail.com', 'doddabommasandra ', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `order_id` varchar(15) NOT NULL,
  `name` varchar(25) NOT NULL,
  `subject` varchar(25) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`order_id`, `name`, `subject`, `message`) VALUES
('574681272', 'pk', 'car is not working', 'fbffchfh\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_username` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_email` varchar(25) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `customer_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_username`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `customer_password`) VALUES
('diwakar', 'Diwakar', '9412578632', 'diwakar@gmail.com', 'Patna', 'root'),
('lalith', 'lalith', '7987261782', 'lalith@gmail.com', 'vidyaranyapura', 'root'),
('pk', 'pk', '9489678596', 'royaltreat2834@gmail.com', 'bangalore', 'root'),
('tsp', 'tsp', '9665464765', 'tsp@gmail.com', 'njl', 'tsp@123'),
('vijay', 'vijay', '9541257862', 'vijay121@gmail.com', 'Surat', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `name` varchar(20) NOT NULL,
  `e_mail` varchar(30) NOT NULL,
  `message` varchar(150) NOT NULL,
  `number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`name`, `e_mail`, `message`, `number`) VALUES
('Nikhil', 'nikhil@gmail.com', 'Hope this works.', NULL),
('pk', 'kalmath@gmail.com', 'ifa', '542536958'),
('pkj', 'pke@gmail.com', 'pujmnmm', '9480570'),
('ak', 'ak@gmail.com', 'abcde', '906661159'),
('prasanth', 'pra@gmail.com', 'adf', '8971356468'),
('prasanth', 'pra@gmail.com', 'adf', '8971356468');

-- --------------------------------------------------------

--
-- Table structure for table `rentedbikes`
--

CREATE TABLE `rentedbikes` (
  `id` int(100) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `bike_id` int(20) NOT NULL,
  `driver_id` int(20) NOT NULL,
  `booking_date` date NOT NULL,
  `rent_start_date` date NOT NULL,
  `rent_end_date` date NOT NULL,
  `bike_return_date` date DEFAULT NULL,
  `fare` double NOT NULL,
  `charge_type` varchar(25) NOT NULL DEFAULT 'days',
  `distance` double DEFAULT NULL,
  `no_of_days` int(50) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `return_status` enum('NR','R','C') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rentedbikes`
--

INSERT INTO `rentedbikes` (`id`, `customer_username`, `bike_id`, `driver_id`, `booking_date`, `rent_start_date`, `rent_end_date`, `bike_return_date`, `fare`, `charge_type`, `distance`, `no_of_days`, `total_amount`, `return_status`) VALUES
(1, 'pk', 1, 1, '2019-12-19', '2019-12-19', '2019-12-19', '2019-12-19', 12, 'km', NULL, NULL, NULL, 'C'),
(2, 'pk', 1, 1, '2019-12-19', '2019-12-19', '2019-12-19', '2019-12-19', 12, 'km', 12, 0, 144, 'R'),
(3, 'pk', 11, 9, '2019-12-19', '2019-12-19', '2019-12-19', '2019-12-19', 14, 'km', 10, 0, 140, 'R'),
(4, 'vijay', 4, 4, '2019-12-19', '2019-12-19', '2019-12-19', '2019-12-19', 120, 'days', NULL, 0, 0, 'R'),
(5, 'vijay', 4, 4, '2019-12-19', '2019-12-19', '2019-12-31', '2019-12-19', 120, 'days', NULL, 12, 1440, 'R'),
(6, 'vijay', 11, 9, '2019-12-19', '2019-12-19', '2019-12-19', '2019-12-19', 120, 'days', NULL, 0, 0, 'R'),
(7, 'tsp', 12, 11, '2019-12-19', '2019-12-19', '2019-12-19', '2019-12-19', 20, 'km', 10, 0, 200, 'R');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bikes`
--
ALTER TABLE `bikes`
  ADD PRIMARY KEY (`bike_id`),
  ADD UNIQUE KEY `car_nameplate` (`bike_nameplate`);

--
-- Indexes for table `bike_accessories`
--
ALTER TABLE `bike_accessories`
  ADD PRIMARY KEY (`access_id`),
  ADD KEY `client_username` (`client_username`);

--
-- Indexes for table `clientbikes`
--
ALTER TABLE `clientbikes`
  ADD PRIMARY KEY (`bike_id`),
  ADD KEY `client_username` (`client_username`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_username`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_username`);

--
-- Indexes for table `rentedbikes`
--
ALTER TABLE `rentedbikes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_username` (`customer_username`),
  ADD KEY `car_id` (`bike_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bikes`
--
ALTER TABLE `bikes`
  MODIFY `bike_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bike_accessories`
--
ALTER TABLE `bike_accessories`
  MODIFY `access_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rentedbikes`
--
ALTER TABLE `rentedbikes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bike_accessories`
--
ALTER TABLE `bike_accessories`
  ADD CONSTRAINT `bike_accessories_ibfk_1` FOREIGN KEY (`client_username`) REFERENCES `clients` (`client_username`);

--
-- Constraints for table `clientbikes`
--
ALTER TABLE `clientbikes`
  ADD CONSTRAINT `clientbikes_ibfk_1` FOREIGN KEY (`client_username`) REFERENCES `clients` (`client_username`),
  ADD CONSTRAINT `clientbikes_ibfk_2` FOREIGN KEY (`bike_id`) REFERENCES `bikes` (`bike_id`);

--
-- Constraints for table `rentedbikes`
--
ALTER TABLE `rentedbikes`
  ADD CONSTRAINT `rentedbikes_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customers` (`customer_username`),
  ADD CONSTRAINT `rentedbikes_ibfk_2` FOREIGN KEY (`bike_id`) REFERENCES `bikes` (`bike_id`),
  ADD CONSTRAINT `rentedbikes_ibfk_3` FOREIGN KEY (`driver_id`) REFERENCES `bike_accessories` (`access_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
