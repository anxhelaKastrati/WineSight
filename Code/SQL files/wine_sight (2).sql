-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2019 at 09:43 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wine_sight`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_history`
--

CREATE TABLE `admin_history` (
  `id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_history`
--

INSERT INTO `admin_history` (`id`, `action`, `desc`, `time`, `admin_id`, `admin_name`) VALUES
(5, 'approve_employee', '19', 1559168300, 7, 'ebasha'),
(6, 'approve_employee', '19', 1559412733, 7, 'ebasha'),
(7, 'remove_employee', '18', 1559412847, 7, 'ebasha'),
(8, 'remove_employee', '2', 1559468723, 8, 'ehoxha'),
(9, 'remove_employee', '18', 1559468728, 8, 'ehoxha'),
(10, 'remove_employee', '19', 1559468732, 8, 'ehoxha'),
(11, 'remove_employee', '18', 1559468737, 8, 'ehoxha'),
(12, 'remove_employee', '18', 1559468749, 8, 'ehoxha'),
(13, 'remove_employee', '18', 1559468750, 8, 'ehoxha'),
(14, 'remove_employee', '18', 1559468844, 8, 'ehoxha'),
(15, 'approve_employee', '3', 1559470258, 7, 'ebasha'),
(16, 'approve_employee', '23', 1559471049, 7, 'ebasha'),
(17, 'approve_employee', '29', 1559476383, 7, 'ebasha'),
(18, 'approve_employee', '28', 1559476609, 7, 'ebasha'),
(19, 'approve_employee', '26', 1559476612, 7, 'ebasha'),
(20, 'remove_employee', '27', 1559477139, 7, 'ebasha'),
(21, 'remove_employee', '24', 1559477178, 7, 'ebasha'),
(22, 'remove_employee', '25', 1559477240, 7, 'ebasha'),
(23, 'remove_employee', '28', 1559477787, 7, 'ebasha');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `name`, `amount`, `category`, `status`, `date`) VALUES
(1, 'prods', 3480, 'Product', 'paid', 1559387656),
(2, 'prods', 3480, 'Product', 'paid', 1559387671),
(3, 'Invoice dsd', 4060, 'Product', 'paid', 1559387687),
(4, 'Invoice Namesd', 870, 'Product', 'paid', 1559387707),
(5, 'Invoice Namesd', 2030, 'Product', 'paid', 1559387901),
(6, 'Invoice Name', 0, 'Product', 'paid', 1559413187),
(7, 'prods', 580, 'Product', 'paid', 1559469903),
(8, 'prods', 580, 'Product', 'paid', 1559469906),
(9, 'prods', 580, 'Product', 'paid', 1559470136),
(10, 'Payment', 290, 'Product', 'paid', 1559476571),
(11, 'Payment', 290, 'Product', 'paid', 1559476578),
(12, 'products', 870, 'Product', 'paid', 1559490990);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `for_type` varchar(255) NOT NULL,
  `by_type` varchar(255) NOT NULL,
  `by_name` varchar(255) NOT NULL,
  `by_user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `for_type`, `by_type`, `by_name`, `by_user_id`, `status`, `subject`) VALUES
(1, 'a', 'a', 'a', 0, 'unseen', 'a'),
(2, '', '', '', 0, 'unseen', ''),
(3, 'admin', 'hr', 'ehoxha', 0, 'seen', 'employee_added'),
(4, 'admin', 'hr', 'ehoxha', 0, 'seen', 'employee_added'),
(5, 'admin', 'hr', 'ehoxha', 0, 'unseen', 'employee_added'),
(6, 'admin', 'hr', 'ehoxha', 0, 'unseen', 'employee_added'),
(7, 'hr', 'admin', 'ebasha', 0, 'seen', 'employee_appproved'),
(8, 'admin', 'sales_director', 'bbegaj', 0, 'unseen', 'supplier_added'),
(9, 'sales_director', 'admin', 'bbegaj', 0, 'seen', 'order_created'),
(10, 'sales_director', 'admin', 'bbegaj', 0, 'unseen', 'order_created'),
(11, 'admin', 'financier', 'arama', 0, 'unseen', 'order_created'),
(12, 'admin', 'financier', 'arama', 0, 'unseen', 'order_created'),
(13, 'hr', 'admin', 'ebasha', 0, 'unseen', 'employee_appproved'),
(14, 'hr', 'admin', 'ebasha', 0, 'unseen', 'employee_appproved'),
(15, 'admin', 'sales_director', 'bbegaj', 0, 'unseen', 'product_added'),
(16, 'admin', 'sales_director', 'bbegaj', 0, 'unseen', 'product_added'),
(17, 'admin', 'sales_director', 'bbegaj', 0, 'unseen', 'product_added'),
(18, 'admin', 'sales_director', 'bbegaj', 0, 'unseen', 'product_added'),
(19, 'admin', 'specialist', 'ahoxha', 0, 'unseen', 'report_uploaded'),
(20, 'admin', 'hr', 'ehoxha', 0, 'unseen', 'supplier_added'),
(21, 'admin', 'hr', 'ehoxha', 0, 'unseen', 'supplier_added'),
(22, 'admin', 'hr', 'ehoxha', 0, 'unseen', 'supplier_added'),
(23, 'admin', 'hr', 'ehoxha', 0, 'unseen', 'supplier_added'),
(24, 'admin', 'hr', 'ehoxha', 0, 'unseen', 'employee_edit'),
(25, 'admin', 'hr', 'ehoxha', 0, 'unseen', 'employee_removed'),
(26, 'admin', 'financier', 'arama', 0, 'unseen', 'order_created'),
(27, 'sales_director', 'admin', 'bbegaj', 0, 'unseen', 'order_created'),
(28, 'sales_director', 'admin', 'bbegaj', 0, 'unseen', 'order_created'),
(29, 'admin', 'specialist', 'lbercaka', 0, 'seen', 'report_uploaded');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_name`, `product_description`, `quantity`, `price`, `amount`, `status`, `user_id`, `user_name`, `product_id`) VALUES
(686, 'name', 'desc', 2, 290, 580, 'pending', 4, 'bbegaj', 1),
(687, 'name', 'desc', 1, 290, 290, 'pending', 4, 'bbegaj', 2),
(688, 'name', 'desc', 1, 290, 290, 'pending', 4, 'bbegaj', 4),
(689, 'name', 'desc', 1, 290, 290, 'pending', 4, 'bbegaj', 6),
(690, 'name', 'desc', 2, 290, 580, 'pending', 4, 'bbegaj', 1),
(691, 'name', 'desc', 1, 290, 290, 'pending', 4, 'bbegaj', 2),
(692, 'name', 'desc', 2, 290, 580, 'pending', 4, 'bbegaj', 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `description`, `status`, `quantity`, `supplier_id`) VALUES
(1, 'name', 290, 'wine', 'desc', 'available', 100, 3),
(2, 'name', 290, 'wine', 'desc', 'available', 100, 3),
(3, 'name', 290, 'wine', 'desc', 'available', 100, 3),
(4, 'name', 290, 'wine', 'desc', 'available', 100, 3),
(5, 'name', 290, 'wine', 'desc', 'available', 100, 3),
(6, 'name', 290, 'wine', 'desc', 'available', 100, 3),
(7, 'name', 290, 'wine', 'desc', 'available', 100, 3),
(8, 'name', 290, 'wine', 'desc', 'available', 100, 3),
(9, 'name', 290, 'wine', 'desc', 'available', 100, 3),
(10, 'name', 290, 'wine', 'desc', 'available', 100, 3),
(11, 'name', 290, 'wine', 'desc', 'available', 100, 3),
(12, 'name', 290, 'wine', 'desc', 'available', 100, 3),
(13, 'name', 290, 'wine', 'desc', 'available', 100, 3),
(14, 'name', 88, 'car', 'desc', 'available', 8, 1),
(15, 'name', 88, 'car', 'desc', 'available', 8, 1),
(16, 'name', 88, 'ca', 'desc', 'available', 3, 1),
(17, 'name', 88, 'ca', 'desc', 'available', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `report` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `report`, `time`, `user_name`, `title`) VALUES
(1, '5', 'reportwr', 1559388060, 'lbercaka', 'titlewr?'),
(2, '5', 'reportwr', 1559388112, 'lbercaka', 'titlewr?'),
(3, '5', 'wr', 1559388119, 'lbercaka', 'titlewr'),
(4, '5', 'wr', 1559388175, 'lbercaka', 'titlewr'),
(5, '5', 'wr', 1559388181, 'lbercaka', 'titlewr'),
(6, '6', 'report', 1559413804, 'ehalili', 'title'),
(7, '27', 'report', 1559476980, 'ahoxha', 'title'),
(8, '5', 'ssdsdsds', 1559491140, 'lbercaka', 'tituil');

-- --------------------------------------------------------

--
-- Table structure for table `seasonal_workers`
--

CREATE TABLE `seasonal_workers` (
  `id` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `bday` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `salary` int(11) NOT NULL,
  `last_login` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `academic_degree` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seasonal_workers`
--

INSERT INTO `seasonal_workers` (`id`, `uname`, `pass`, `name`, `surname`, `bday`, `email`, `phone`, `salary`, `last_login`, `date_created`, `academic_degree`, `gender`, `type`) VALUES
(1, 'y', 'y', 'y', 'y', 'y', 'y', 'y', 0, 1559161553, 1559161553, 'y', 'y', 0),
(2, 'i', 'i', 'i', 'i', 'i', 'i', 'i', 0, 1559162951, 1559162951, 'i', 'i', 0),
(3, 'bsmith', '123', 'Ben', 'Smith', '25 Gusht 1995', 'bsmith@gmail.com', '94247264', 3000, 1559468813, 1559468813, 'Bachelor of Informatics', 'Male', 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `surname`, `email`, `phone`, `status`) VALUES
(1, 'sup1', 'surname', 'sup1@gmaul.icom', '43434', 'approved'),
(2, 'sup2', 'sr', 'er@gm', 'e243', 'approved'),
(3, 'Agron', 'Hoxha', 'ahoxha@gmail.com', '068292424', 'not_approved'),
(4, 'Agim', 'Basha', 'abasha@gmail.com', '0692324242', 'not_approved'),
(12, 'Agim', 'Toptani', 'atoptani', '034343', 'not_approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `bday` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `salary` int(11) NOT NULL,
  `last_login` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `academic_degree` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `pass`, `name`, `surname`, `bday`, `email`, `phone`, `salary`, `last_login`, `date_created`, `academic_degree`, `gender`, `type`, `status`) VALUES
(3, 'arama', '123', 'Adelajda', 'Rami', '25 Jun 1997', 'arama@gmail.com', '069248247274', 4000, 864928484, 864928484, 'Bachelor of Business Informatics', 'Female', 'financier', 'approved'),
(4, 'bbegaj', '123', 'Borana', 'Begaj', '25 Aug 1997', 'bbegaj@gmail.com', '069248247274', 4444, 864928484, 864928484, 'Bachelor of Business Informatics', 'Female', 'sales_director', 'approved'),
(5, 'lbercaka', '123', 'Lorika', 'Bercaka', '25 Sep 1997', 'lbercaka@gmail.com', '069248247274', 4000, 864928484, 864928484, 'Bachelor of Business Informatics', 'Female', 'specialist', 'approved'),
(6, 'ehalili', '123', 'Erjon', 'Halili', '25 Dec 1997', 'ehalili@gmail.com', '069248247274', 4000, 864928484, 864928484, 'Bachelor of Business Informatics', 'Male', 'bod', 'approved'),
(7, 'ebasha', '123', 'Ema', 'Basha', '25 Jan 1997', 'ebasha@gmail.com', '069248247274', 4000, 864928484, 864928484, 'Bachelor of Business Informatics', 'Male', 'admin', 'approved'),
(8, 'ehoxha', '123', 'Era', 'Hoxha', '25 Jan 1997', 'ehoxha@gmail.com', '069248247274', 4000, 864928484, 864928484, 'Bachelor of Business Informatics', 'Female', 'hr', 'approved'),
(23, 'jsmith', '123', 'John', 'Smith', '25 June 1994', 'jsmith@gmail.com', '0343434', 2000, 1559470677, 1559470677, 'Bachelor of Informatics', 'Male', 'sales_director', 'approved'),
(26, 'axhoxha', '123', 'Andi', 'Hoxha', '25 Maj 1995', 'ahoxha@gmail.com', '033573', 2000, 1559475024, 1559475024, 'Bachelor of Informatics', 'Male', 'specialist', 'approved'),
(29, 'akrasniqi', '123', 'Alisa', 'Krasniqi', '25 Maj 1995', 'akrasniqi@gmail.com', '02424', 5555, 1559476358, 1559476358, 'Bachelor of Informatics', 'Female', 'sales_director', 'approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_history`
--
ALTER TABLE `admin_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seasonal_workers`
--
ALTER TABLE `seasonal_workers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_history`
--
ALTER TABLE `admin_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=693;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `seasonal_workers`
--
ALTER TABLE `seasonal_workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
