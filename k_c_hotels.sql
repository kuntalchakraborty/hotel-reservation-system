-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2024 at 10:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `k_c_hotels`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(7, '2024_12_23_200335_create_room_types_table', 2),
(8, '2024_12_23_200414_create_rooms_table', 2),
(9, '2024_12_24_201732_create_room_images_table', 2),
(11, '2024_12_24_225955_create_reservations_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `number_of_guests` int(11) NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `status` enum('pending','approved','canceled','') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `room_id`, `check_in`, `check_out`, `number_of_guests`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(2, 6, 8, '2024-12-31', '2025-01-02', 2, 4000.00, 'pending', '2024-12-29 14:43:06', '2024-12-30 12:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_type_id` bigint(20) UNSIGNED NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `bed_count` int(11) NOT NULL DEFAULT 1,
  `bed_type` varchar(255) DEFAULT NULL,
  `floor_number` int(11) NOT NULL DEFAULT 1,
  `room_status` enum('available','occupied') NOT NULL DEFAULT 'available',
  `available_from` timestamp NULL DEFAULT NULL,
  `available_until` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_type_id`, `room_number`, `price`, `available`, `bed_count`, `bed_type`, `floor_number`, `room_status`, `available_from`, `available_until`, `created_at`, `updated_at`) VALUES
(8, 2, '11', 2000.00, 1, 3, 'sdfdssdf', 22, 'available', '2025-01-02 18:30:00', '2024-12-30 18:30:00', '2024-12-28 15:40:30', '2024-12-29 14:43:06'),
(9, 3, '33', 2998.00, 1, 3, '2 king, 1 Queen', 2, 'available', NULL, NULL, '2024-12-28 15:52:55', '2024-12-28 15:52:55'),
(10, 4, '5', 4000.00, 1, 4, '4 King', 3, 'available', NULL, NULL, '2024-12-28 15:53:39', '2024-12-28 15:53:39'),
(11, 2, '2', 2000.00, 1, 2, 'King', 1, 'available', NULL, NULL, '2024-12-30 15:07:45', '2024-12-30 15:07:45');

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`id`, `room_id`, `image_path`, `created_at`, `updated_at`) VALUES
(28, 8, 'rooms/r8AYWUuviYeLqgNhHtwG8aVb9jT969MQNeZACAVr.jpg', '2024-12-28 15:40:30', '2024-12-28 15:40:30'),
(31, 9, 'rooms/4MIpQDksNoOwKcUEcBSuck8bkuXatLogJq0S65VU.jpg', '2024-12-28 15:52:55', '2024-12-28 15:52:55'),
(32, 9, 'rooms/PWLcW1IJJpNQeZU0T9mDUYuKw04tt3DimKlfWaBR.jpg', '2024-12-28 15:52:55', '2024-12-28 15:52:55'),
(33, 9, 'rooms/kIOYAzBOXvgLOdyvCcBUqXFnut01VtLdVcMHsvOK.jpg', '2024-12-28 15:52:55', '2024-12-28 15:52:55'),
(34, 9, 'rooms/aLLBddRwZcr1jLRitY5uJmC2Pt4nj9YEsD4mOM8E.jpg', '2024-12-28 15:52:55', '2024-12-28 15:52:55'),
(35, 9, 'rooms/WORg8LufFhSn4IV8jEbMnfWi1PWHZLHqtbSvprCC.jpg', '2024-12-28 15:52:55', '2024-12-28 15:52:55'),
(36, 9, 'rooms/x1pkUVYMKT92zeB6l85oLlAytQQr0EweoWy3I2kX.jpg', '2024-12-28 15:52:55', '2024-12-28 15:52:55'),
(37, 10, 'rooms/hXAzwKnejyAQICldJnO2MSw4HMTQb0gt7QpnAH85.jpg', '2024-12-28 15:53:39', '2024-12-28 15:53:39'),
(38, 10, 'rooms/xjOmXLUw2EtDhuMtxFq8xi0qNktf7Y02ogPlVHPJ.jpg', '2024-12-28 15:53:39', '2024-12-28 15:53:39'),
(39, 10, 'rooms/iOR3j14l0pTf2M8Pbo4mG6ByMb9USVEaSudQ9DmK.jpg', '2024-12-28 15:53:39', '2024-12-28 15:53:39'),
(42, 11, 'rooms/SUPOD0Qdf68KVqGCXbvxRUYcGgKYvD0TcO9Ou1sR.jpg', '2024-12-30 15:07:46', '2024-12-30 15:07:46'),
(43, 11, 'rooms/pEDv3PKO3jF7f1epNyIMUBo5H0bV0V1yFOgAEXdb.jpg', '2024-12-30 15:07:46', '2024-12-30 15:07:46'),
(44, 11, 'rooms/2mgH4cqQ05nLtC1gsG8FFbf4EJmWCfYNEXOb0NNf.jpg', '2024-12-30 15:07:46', '2024-12-30 15:07:46');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `max_occupancy` int(11) NOT NULL DEFAULT 2,
  `security` tinyint(1) NOT NULL DEFAULT 0,
  `air_conditioned` tinyint(1) NOT NULL DEFAULT 0,
  `free_wifi` tinyint(1) NOT NULL DEFAULT 0,
  `parking` tinyint(1) NOT NULL DEFAULT 0,
  `restaurant` tinyint(1) NOT NULL DEFAULT 0,
  `complimentary_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `hair_dryer` tinyint(1) NOT NULL DEFAULT 0,
  `mini_fridge` tinyint(1) NOT NULL DEFAULT 0,
  `room_service` tinyint(1) NOT NULL DEFAULT 0,
  `swimming_pool` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `description`, `max_occupancy`, `security`, `air_conditioned`, `free_wifi`, `parking`, `restaurant`, `complimentary_breakfast`, `hair_dryer`, `mini_fridge`, `room_service`, `swimming_pool`, `created_at`, `updated_at`) VALUES
(2, 'Basic AC Room', 'Basic ac room is a 110 sqft room with attached one washroom and queen size bed. This room has facilities like air conditioning, flat screen TV, electric kettle and fan. This room is ideal for 2 adults only.', 2, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2024-12-24 17:11:09', '2024-12-28 13:29:12'),
(3, 'Family Room', 'Family room is a 250 sqft room with one 6/7 king size bed and one 5/7 queen size bed and 01 washroom. The room has facilities like air conditioning, flat screen TV , electric kettle, fan and sofa. This room has pool and garden view window. Best ideal room for 2 adults and 2 children or 4 adults.', 6, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '2024-12-24 17:11:56', '2024-12-24 17:11:56'),
(4, 'Superior Room', 'The Superior Room is a 250 sq. ft. room elegantly furnished having one king sized bed, one attached bathroom and one balcony. The Room has facilities like Complimentary Toiletries & Sleepers, Electric Kettle, Flat Screen TV, Air Conditioning, Mini Fridge. It has a sitting area which can also be used for dine in.', 10, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0, '2024-12-24 17:12:44', '2024-12-24 17:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FaaWKQQmrlHmpx1mflY3i586yTeUHaKMknoFtdu8', 6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYkswWnZjSkdrR29Dd0VONnB1M1VwQm5ITkNOcU94VEcxTnhXOUtpaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvaG90ZWwtcmVzZXJ2YXRpb24tc3lzdGVtIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1735593319),
('gQOiJm1n3NDgvGiz5otz7WtCJDisBJP11Fp1fKMW', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUHlqeThXdUhJbDcxMUJSUHN6aHBNUENGVUZtaUN5RmtuTER5OEpvNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjE6Imh0dHA6Ly9sb2NhbGhvc3QvaG90ZWwtcmVzZXJ2YXRpb24tc3lzdGVtL2FkbWluL3Jvb21zLzExL2VkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1735591265);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `user_img` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `user_img`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', NULL, 'profile-img.jpg', NULL, '$2y$12$bntbGNMW4oVs.E0X7VoQluOHDpwMGMMjERq7vQX.Qxufn62ZbMMvS', 'admin', NULL, '2024-12-22 07:45:52', '2024-12-23 14:09:35'),
(6, 'Kuntal Chakraborty', 'kuntal21@gmail.com', '8436106002', 'profile_images/y326nzSlpZw5CVcgwzNYT5mIRluOZeLvv5Z3NQue.jpg', NULL, '$2y$12$k7ihVC9pnRYo/f.5N/sdW.rhJFY2wBUBcoZie3u7ZhWkYQacfHFza', 'user', NULL, '2024-12-29 12:27:29', '2024-12-30 11:55:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`),
  ADD KEY `reservations_room_id_foreign` (`room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rooms_room_number_unique` (`room_number`),
  ADD KEY `rooms_room_type_id_foreign` (`room_type_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_images_room_id_foreign` (`room_id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`);

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
