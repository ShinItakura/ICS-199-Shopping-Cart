-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2018 at 10:08 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(20) NOT NULL,
  `p_name` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `image` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `price` double(5,2) DEFAULT NULL,
  `description` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `shape` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `material` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `color` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `axles` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `manufacturer` varchar(30) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `p_name`, `image`, `price`, `description`, `shape`, `material`, `color`, `axles`, `manufacturer`) VALUES
(1002, 'Yomega Fireball', '1002.png', 9.12, 'The Original Transaxle yoyo Maximized Spin Time Through Technological Innovation. The Yomega Fireball is no ordinary yoyo! Its fame and longtime popularity is due to the fact that it delivers super long spins that make it easy for kids of all ages to perform the classic tricks. It is the perfect cho', 'Modified', 'Plastic', 'blue', 'Transaxle ', 'Yomega'),
(1003, 'Yomega Brain ', '1003.png', 10.57, 'The YoYo with a Brain Includes Auto Return Technology.The Original Auto Return Yo-Yo Makes it easy to learn and play. For the beginning player, the Yomega Brain takes the frustration out of learning the basics. Easy to throw and play, the Brainknows when to come back automatically! Yomega\'s auto ret', 'Modified', 'Plastic', 'green', 'Fixed ', 'Yomega'),
(1004, 'Yoyo Yellow Merlin ', '1004.png', 12.99, 'From beginner to pro the yellow Merlin is perfect to easily perform string tricks like the Trapeze, Split the Atom,  Braintwister, or the Double or Nothing. ', 'Butterfly', 'Plastic', 'yellow', 'Ball Bearing ', 'Yoyo King'),
(1005, 'King Black Everloop', '1005.png', 11.99, 'From beginner to pro the Everloop is perfect to easily perform yoyo tricks like the Trapeze, Split the Atom, Braintwister, or theDouble or Nothing. But itis particularly suited for looping style (2A) tricks like Time Warp, Around the World, Pinwheel, Hop the Fence, Loop the Loop and especially for t', 'Modified', 'Plastic', 'red', 'Ball Bearing ', 'Yoyo King'),
(1006, 'Magic yoyo N6 ', '1006.png', 15.99, 'Magic yoyo n6 gold- Solid Anodized color unrespnsive yoyo Shinning finish,silver rim professional yoyoKK Bearing,Style String Trick (1A, 3A, 5A)Butterfly body shape metal yoyo, great for finger spin, long time yoyo spin', 'Butterfly', 'Metal', 'gold', 'Ball Bearing ', 'Yoyo Magic'),
(1007, 'YOYO Professional', '1007.png', 12.99, 'YOYO is composed of high quality aluminum alloy for durable performance that allows stable and balanced high speed routines ', 'Butterfly', 'Metal', 'black', 'Ball Bearing ', 'Yoyo'),
(1008, 'Duncan Imperial ', '1008.png', 6.29, 'The Duncan Imperial is the world\'s best selling Yo-Yo! The Imperial was first introduced in 1954 and is based on the shape of Duncan wooden tournament \"77\" model. ', 'Imperial', 'Plastic', 'green', 'Fixed ', 'Duncan'),
(1009, 'V6 Locus ', '1009.png', 12.99, 'Excellent Responsive yoyo for beginners and learners, Super easy to Use.Made of top-quality 6061 aluminium, Metal yoyos, Silicone response system, Durable.', 'Butterfly', 'Metal', 'blue', 'Ball Bearing ', 'Magicyoyo'),
(1010, 'Offstring Flight', '1010.png', 24.99, 'HIGH PERFORMANCE YOYO - plastic or metal sleeve is placed over the axle and enables long smooth spins. Using the aerodynamic design principles, reducing the drag coefficient in the rotation process, the rotation is executed with more perfect performance', 'Butterfly', 'Plastic', 'blue', 'Transaxle ', 'Offstring'),
(1011, 'Magicyoyo Purple  ', '1011.png', 14.99, 'The Purple Line is a collaboration effort between iYo and Magic YoYo, and the result is fantastic! The Purple Line has been around for a while now, but we\'ve only just stocked it here.', 'Butterfly', 'Metal', 'black', 'Ball Bearing ', 'Magicyoyo'),
(1012, 'Yomega Power Brain XP', '1012.png', 16.99, 'Smart Switch: enables the player to choose between automatic return and manual function with the flick of a switch Great Beginner and Intermediate Yoyo: Perfect for beginners, kids, collectors, or anyone looking to purchase a great stress reliever.', 'Imperial', 'Plastic', 'blue', 'Ball Bearing ', 'Yomega'),
(1013, 'MAGICYOYO Silencer ', '1013.png', 17.98, 'Yoyo body and it\'s Weight rings are all made of Alloy 6061, and you\'ll shocked with the stability and its\' ultra-smooth performance Comes with STAINLESS center bearing, will NEVER RUST', 'Butterfly', 'Metal', 'black', 'Ball Bearing ', 'Magicyoyo'),
(1014, 'Beboo Ball Green', '1014.png', 12.99, 'THE COOL STYLE YOYO - YOYO is the newest Design unresponsive yoyos, with high speed stable spin and Perfect Symmetry to Make it Turning Longer Time.you\'ll shocked with the stability and its\' ultra-smooth performance', 'Butterfly', 'Metal', 'green', 'Ball Bearing ', 'Beboo '),
(1015, 'Yomega Spectrum', '1015.png', 12.99, 'MULTI-COLORED LEDs: With every flick of the wrist, the spinning yoyo activates the LED lights! Now you can play dawn to dusk!', 'Modified', 'Plastic', 'blue', 'Transaxle ', 'Yomega'),
(1017, 'Kascimu Aluminium', '1017.png', 12.99, 'Kascimu Yoyos materials are used High quality aluminum alloy.High Precision Bearing: Best balance and Super long spin times will give you the best fun of the yoyo.Diversification Yo Yo Play: Suitable for 1 A 3 A 5A play, the latest and unique design can bring you more than 2 play method without wire', 'Butterfly', 'Metal', 'blue', 'Ball Bearing ', 'Kascimu'),
(1018, 'YOSTAR S-01', '1018.png', 15.99, 'YOSTAR yoyos with professional team, have our own factories, all the products have been professional audit, quality guaranteed, and for each product before shipment we will strict audit experience, your satisfaction is our motivation and pursuit. ', 'Butterfly', 'Metal', 'blue', 'Ball Bearing ', 'YOSTAR'),
(1019, 'Magic Yoyo Ball V6', '1019.png', 12.99, 'MAGICYOYO BALL -The V6 Locas-Black,Bearing size: 6.35*12.7*3.175mm Responsive yoyo,Excellent yoyo for beginners,Super easy to Use FOR KIDS Toys Made of top-quality 6061 aluminium, Metal yoyos,Durabl', 'Butterfly', 'Metal', 'black', 'Ball Bearing ', 'Magic Yoyo'),
(1020, 'YoYoFactory Velocity', '1020.png', 19.99, 'HIGH PERFORMANCE YOYO - plastic or metal sleeve is placed over the axle and enables long smooth spins. Using the aerodynamic design principles, reducing the drag coefficient in the rotation process, the rotation is executed with more perfect performance', 'Butterfly', 'Plastic', 'black', 'Ball Bearing ', 'YoYoFactory'),
(1021, 'Beboo God of Death', '1021.png', 12.99, 'Made of aluminum, laser etched yoyo designed for advanced play. Combining a highly recommment bearing, a weighted perimeter for long spins, and a wide gap profile for advanced and intermediated string play.', 'Butterfly', 'Metal', 'black', 'Ball Bearing ', 'ELENKER'),
(1022, 'Yomega Raider', '1022.png', 9.58, 'YOMEGA RAIDER ? The Yomega Raider is the choice of champions for advanced players throughout the world. With a precision roller bearing system, the Raider provides the perfect balance in response, speed, and spin time. It is no wonder that it is the personal choice for so many advanced players in wo', 'Modified', 'Plastic', 'red', 'Fixed ', 'Yomega '),
(1023, 'Raider Blue and Clear', '1023.png', 14.99, 'The Yomega Raider is one of the premier yo-yos in the advanced players\' world. With a precise bearing system, the Raider is engineered to provide the ultimate balance in response, speed, and spin time. It is the personal choice of both world and national champions', 'Modified', 'Plastic', 'blue', 'Ball Bearing ', 'Raider '),
(1024, 'Duncan Super Tournament', '1024.png', 14.99, 'From the Manufacturer; MOD Spacers can be installed in most Duncan Hardcore yo-yos changing the shape, profile and response system in minutes. Originally developed for the Pro Z yo-yo, MOD Spacers also fit in yo-yos like Freehand, FH Zero, Bumblebee and more.', 'Modified', 'Wood', 'brown', 'Fixed ', 'Duncan'),
(1025, 'Spintastics Tornado', '1025.png', 11.99, 'Ball bearing professional yoyo with long spin times. Diameter: 56mm Thickness: 27mm Weight: 60 gramsResponsive yoyo that sleeps. Wakes up when you tug the string like a traditional yoyo. Designed by World Yoyo Champion Dale Oliver.', 'Modified', 'Plastic', 'red', 'Ball Bearing ', 'Spintastics ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1026;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
