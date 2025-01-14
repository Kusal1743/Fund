-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2025 at 05:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cofund`
--

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL,
  `fundraiser_id` varchar(20) DEFAULT NULL,
  `donor_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `donation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `fundraiser_id`, `donor_id`, `amount`, `donation_date`, `status`) VALUES
(1, 'FR001', 1, 100.00, '2023-10-01 04:30:00', 'completed'),
(2, 'FR002', 2, 200.00, '2023-10-02 05:30:00', 'completed'),
(3, 'FR003', 3, 50.00, '2023-10-03 06:30:00', 'completed'),
(4, 'FR004', 4, 150.00, '2023-10-04 04:00:00', 'completed'),
(5, 'FR005', 5, 75.00, '2023-10-05 08:45:00', 'completed'),
(6, 'FR006', 6, 120.00, '2023-10-06 11:15:00', 'completed'),
(7, 'FR007', 7, 60.00, '2023-10-07 02:30:00', 'completed'),
(8, 'FR008', 8, 300.00, '2023-10-08 08:00:00', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `fundraisers`
--

CREATE TABLE `fundraisers` (
  `fundraiser_id` varchar(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `goal` decimal(10,2) NOT NULL,
  `current_amount` decimal(10,2) DEFAULT 0.00,
  `location` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fundraisers`
--

INSERT INTO `fundraisers` (`fundraiser_id`, `user_id`, `title`, `description`, `goal`, `current_amount`, `location`, `start_date`, `end_date`, `created_at`, `status`) VALUES
('FR001', 1, 'Help Save the Forest', 'A campaign to save the Amazon rainforest.', 10000.00, 0.00, 'Amazon Rainforest', '2023-10-01', '2023-12-31', '2025-01-11 16:13:15', 'active'),
('FR002', 2, 'Build a School', 'A campaign to build a school in rural Africa.', 20000.00, 0.00, 'Rural Africa', '2023-11-01', '2024-01-31', '2025-01-11 16:13:15', 'active'),
('FR003', 3, 'Feed the Hungry', 'A campaign to provide meals for the homeless.', 5000.00, 0.00, 'New York City', '2023-10-15', '2023-12-15', '2025-01-11 16:13:15', 'active'),
('FR004', 4, 'Clean Water for All', 'A project to provide clean drinking water in developing countries.', 15000.00, 0.00, 'Various Locations', '2023-09-01', '2023-11-30', '2025-01-11 16:13:15', 'active'),
('FR005', 5, 'Support Local Artists', 'A fundraiser to support local artists and their projects.', 8000.00, 0.00, 'Los Angeles', '2023-10-10', '2023-12-10', '2025-01-11 16:13:15', 'active'),
('FR006', 6, 'Animal Rescue Mission', 'A campaign to rescue and rehabilitate abandoned animals.', 12000.00, 0.00, 'San Francisco', '2023-10-20', '2024-01-20', '2025-01-11 16:13:15', 'active'),
('FR007', 7, 'Books for Kids', 'A fundraiser to provide books for underprivileged children.', 6000.00, 0.00, 'Chicago', '2023-11-05', '2024-02-05', '2025-01-11 16:13:15', 'active'),
('FR008', 8, 'Disaster Relief Fund', 'A campaign to provide relief for disaster-stricken areas.', 25000.00, 0.00, 'Hurricane Affected Areas', '2023-10-25', '2024-01-15', '2025-01-11 16:13:15', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `fundraiser_images`
--

CREATE TABLE `fundraiser_images` (
  `image_id` int(11) NOT NULL,
  `fundraiser_id` varchar(20) DEFAULT NULL,
  `image_data` longblob NOT NULL,
  `image_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remember_tokens`
--

CREATE TABLE `remember_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expiry` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_method` varchar(50) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `social_facebook` varchar(255) DEFAULT NULL,
  `social_twitter` varchar(255) DEFAULT NULL,
  `social_linkedin` varchar(255) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `organization_role` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `email`, `password`, `auth_method`, `full_name`, `phone`, `country`, `city`, `address`, `bio`, `profile_image`, `social_facebook`, `social_twitter`, `social_linkedin`, `organization_name`, `organization_role`, `created_at`, `updated_at`) VALUES
(1, 'jane_smith', 'jane@example.com', 'jane123', 'email', 'Jane Smith', '123-456-7890', 'USA', 'New York', '123 Main St, Apt 4B', 'Environmental activist and nature lover.', 'jane_profile.jpg', 'facebook.com/janesmith', 'twitter.com/janesmith', 'linkedin.com/in/janesmith', 'Green Earth Org', 'Founder', '2025-01-11 16:12:55', '2025-01-11 16:12:55'),
(2, 'alex_wong', 'alex@example.com', 'alex123', 'google', 'Alex Wong', '234-567-8901', 'Canada', 'Toronto', '456 Elm St', 'Tech enthusiast and developer.', 'alex_profile.jpg', 'facebook.com/alexwong', 'twitter.com/alexwong', 'linkedin.com/in/alexwong', 'Tech Innovations', 'Software Engineer', '2025-01-11 16:12:55', '2025-01-11 16:12:55'),
(3, 'sara_jones', 'sara@example.com', 'sara123', 'google', 'Sara Jones', '345-678-9012', 'UK', 'London', '789 Pine St', 'Passionate about education and youth empowerment.', 'sara_profile.jpg', 'facebook.com/sarajones', 'twitter.com/sarajones', 'linkedin.com/in/sarajones', 'Youth Empowerment', 'Program Director', '2025-01-11 16:12:55', '2025-01-11 16:12:55'),
(4, 'mike_brown', 'mike@example.com', 'mike123', 'email', 'Mike Brown', '456-789-0123', 'Australia', 'Sydney', '321 Oak St', 'Fitness coach and health advocate.', 'mike_profile.jpg', 'facebook.com/mikebrown', 'twitter.com/mikebrown', 'linkedin.com/in/mikebrown', 'Fit Life', 'Head Coach', '2025-01-11 16:12:55', '2025-01-11 16:12:55'),
(5, 'lisa_white', 'lisa@example.com', 'lisa123', 'facebook', 'Lisa White', '567-890-1234', 'USA', 'Los Angeles', '654 Maple St', 'Art lover and community organizer.', 'lisa_profile.jpg', 'facebook.com/lisawhite', 'twitter.com/lisawhite', 'linkedin.com/in/lisawhite', 'Art for All', 'Community Manager', '2025-01-11 16:12:55', '2025-01-11 16:12:55'),
(6, 'tom_harris', 'tom@example.com', 'tom123', 'email', 'Tom Harris', '678-901-2345', 'USA', 'Chicago', '987 Cedar St', 'Advocate for mental health awareness.', 'tom_profile.jpg', 'facebook.com/tomharris', 'twitter.com/tomharris', 'linkedin.com/in/tomharris', 'Mental Health Matters', 'Advocate', '2025-01-11 16:12:55', '2025-01-11 16:12:55'),
(7, 'emily_clark', 'emily@example.com', 'emily123', 'google', 'Emily Clark', '789-012-3456', 'UK', 'Manchester', '135 Birch St', 'Writer and storyteller.', 'emily_profile.jpg', 'facebook.com/emilyclark', 'twitter.com/emilyclark', 'linkedin.com/in/emilyclark', 'Storytellers United', 'Content Writer', '2025-01-11 16:12:55', '2025-01-11 16:12:55'),
(8, 'david_lee', 'david@example.com', 'david123', 'facebook', 'David Lee', '890-123-4567', 'Canada', 'Vancouver', '246 Spruce St', 'Tech entrepreneur and mentor.', 'david_profile.jpg', 'facebook.com/davidlee', 'twitter.com/davidlee', 'linkedin.com/in/davidlee', 'Startup Hub', 'Co-Founder', '2025-01-11 16:12:55', '2025-01-11 16:12:55'),
(9, 'nina_kim', 'nina@example.com', 'nina123', 'email', 'Nina Kim', '901-234-5678', 'Australia', 'Melbourne', '357 Willow St', 'Passionate about sustainable living.', 'nina_profile.jpg', 'facebook.com/ninakim', 'twitter.com/ninakim', 'linkedin.com/in/ninakim', 'Eco Warriors', 'Sustainability Advocate', '2025-01-11 16:12:55', '2025-01-11 16:12:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `fundraiser_id` (`fundraiser_id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `fundraisers`
--
ALTER TABLE `fundraisers`
  ADD PRIMARY KEY (`fundraiser_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `fundraiser_images`
--
ALTER TABLE `fundraiser_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `fundraiser_id` (`fundraiser_id`);

--
-- Indexes for table `remember_tokens`
--
ALTER TABLE `remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fundraiser_images`
--
ALTER TABLE `fundraiser_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `remember_tokens`
--
ALTER TABLE `remember_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`fundraiser_id`) REFERENCES `fundraisers` (`fundraiser_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`donor_id`) REFERENCES `users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `fundraisers`
--
ALTER TABLE `fundraisers`
  ADD CONSTRAINT `fundraisers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `fundraiser_images`
--
ALTER TABLE `fundraiser_images`
  ADD CONSTRAINT `fundraiser_images_ibfk_1` FOREIGN KEY (`fundraiser_id`) REFERENCES `fundraisers` (`fundraiser_id`) ON DELETE CASCADE;

--
-- Constraints for table `remember_tokens`
--
ALTER TABLE `remember_tokens`
  ADD CONSTRAINT `remember_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
