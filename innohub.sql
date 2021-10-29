-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2021 at 01:24 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `innohub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `role` enum('Admin','Sub-Admin') NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `modules` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `role`, `name`, `email`, `password`, `phone`, `profile_pic`, `remember_token`, `modules`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'vishal tomar', 'vishal.tomar@braintechnosys.com', '$2y$10$FODuDHGfoHCqr5PVABD.Ye9QwwY0lBg2NY7Brx6KHj1atmsoLmHT.', NULL, '1584425355.png', '4SNq3BuFG0PMS4YdihPZklQHQFXzsWr3W3Nq1iaPxWXehrQ1l5PfY9PAzxRv', NULL, NULL, '2020-03-17 13:12:14'),
(9, 'Sub-Admin', 'vishal chaudhary', 'vishal.tomar1@braintechnosys.com', '$2y$10$N.qCwL8bc7o7QjFiLTz/aeiSSVKaLynh36Da7mAvI2vePF5UQcMli', '8218057996', NULL, NULL, 'all$admin.countries.index|admin.countries.create|admin.countries.changeStatus|admin.countries.edit|admin.countries.destroy|admin.countries.store|admin.countries.update$admin.banners.index|admin.banners.create|admin.banners.edit|admin.banners.changeStatus|admin.banners.destroy|admin.banners.store|admin.banners.update|admin.banners.show|admin.banners.getStates$admin.advertisements.index|admin.advertisements.create|admin.advertisements.edit|admin.advertisements.changeStatus|admin.advertisements.destroy|admin.advertisements.store|admin.advertisements.update|admin.advertisements.clientAjaxLogoImageUpload|admin.advertisements.clientRemoveImage$admin.categories.index|admin.categories.create|admin.categories.edit|admin.categories.store|admin.categories.update|admin.categories.topCategory|admin.categories.changeStatus|admin.categories.changeFooterStatus|admin.categories.destroy|admin.categories.csv|admin.categories.postAjaxImg$admin.sub_categories.index|admin.sub_categories.create|admin.sub_categories.edit|admin.sub_categories.store|admin.sub_categories.update|admin.sub_categories.topCategory|admin.sub_categories.changeStatus|admin.sub_categories.destroy|admin.sub_categories.csv|admin.ajax.subcategory$admin.products.index|admin.products.create|admin.products.changeStatus|admin.products.edit|admin.products.changeOfferStatus|admin.products.trendingSale|admin.products.displayPrice|admin.products.destroy|admin.products.normal-csv|admin.products.image-csv|admin.products.store|admin.products.update|admin.products.productAjaxImageUpload|admin.products.productRemoveImage|admin.products.export_one|admin.products.analytics.csv|admin.products.get_images|admin.products.image.reorder|admin.products.marked_featured$admin.all-requests|admin.review-ratings|admin.product-request|admin.all-request|admin.product-request.change-status|admin.product-request.message|admin.product-request.sent-message|admin.all-requests.csv|admin.invite-for-review$admin.users.index|admin.users.create|admin.users.edit|admin.users.changeStatus|admin.users.destroy|admin.users.store|admin.users.update|admin.users.show|admin.users.getStates|admin.users.reset_link|admin.users.message|admin.users.sent-message|admin.users.csv$admin.appointment.booking-detail|admin.appointment.index|admin.appointment.all-appointments|admin.appointment.changeStatus|admin.appointment.destroy|admin.appointment.cancel-appointment|admin.appointment.reschedule-appointment|admin.appointment.csv|admin.appointment.store|admin.appointment.create|admin.appointment.edit|admin.appointment.update|admin.appointment.show$admin.message.index|admin.message.message|admin.message-reply$admin.client_categories.index|admin.client_categories.create|admin.client_categories.edit|admin.client_categories.store|admin.client_categories.update|admin.client_categories.topCategory|admin.client_categories.changeStatus|admin.client_categories.destroy|admin.client_categories.csv$admin.clients.index|admin.clients.create|admin.clients.edit|admin.clients.store|admin.clients.update|admin.clients.changeStatus|admin.clients.changeOfferStatus|admin.clients.destroy|admin.clients.clientAjaxImageUpload|admin.clients.clientAjaxLogoImageUpload|admin.clients.clientRemoveImage|admin.clients.clientRemoveLogoImage|admin.clients.analytics.csv|admin.clients.csv|admin.clients.export_one$admin.cms.contact-detail-edit|admin.cms.index|admin.privacy_policies.index|admin.term_conditions.index|admin.cms.create|admin.cms.edit|admin.cms.store|admin.cms.update|admin.cms.destroy|admin.cms.changeStatus|admin.cms.contact-detail-edit|admin.cms.contact-detail-update|admin.privacy_policies.edit|admin.privacy_policies.create|admin.privacy_policies.store|admin.privacy_policies.update|admin.privacy_policies.topCategory|admin.privacy_policies.changeStatus|admin.privacy_policies.destroy|admin.term_conditions.edit|admin.term_conditions.create|admin.term_conditions.store|admin.term_conditions.update|admin.term_conditions.topCategory|admin.term_conditions.changeStatus|admin.term_conditions.destroy$admin.faqs.index|admin.faqs.create|admin.faqs.edit|admin.faqs.store|admin.faqs.update|admin.faqs.topCategory|admin.faqs.changeStatus|admin.faqs.destroy$admin.admins.index|admin.admins.create|admin.admins.changeStatus|admin.admins.edit|admin.admins.destroy|admin.admins.store|admin.admins.update$admin.email-template.index|admin.email-template.edit|admin.email-template.update$admin.settings.socialLinks|admin.settings.siteSettings|admin.settings.index|admin.settings.updateSiteSettings|admin.settings.updateSocialLinks', '2020-05-04 13:34:44', '2020-06-02 19:30:15'),
(10, 'Sub-Admin', 'Fahad Al Jufairi', 'fahadaljufairie@yahoo.com', '$2y$10$V4D5DdlZf4ma4HI8P62tmuXkYOI6jYuLBy5bUStScwXDJbacRW6EK', '5507 2442', NULL, 'hmNT83x6gohbNBLWYEpYG7Iv9ARmBCtGzoJFKcauVOuWI7dDjrBmeAHaUqkF', 'all$admin.countries.index|admin.countries.create|admin.countries.changeStatus|admin.countries.edit|admin.countries.destroy|admin.countries.store|admin.countries.update|admin.countries.csv$admin.banners.index|admin.banners.create|admin.banners.edit|admin.banners.changeStatus|admin.banners.destroy|admin.banners.store|admin.banners.update|admin.banners.show|admin.banners.getStates$admin.advertisements.index|admin.advertisements.create|admin.advertisements.edit|admin.advertisements.changeStatus|admin.advertisements.destroy|admin.advertisements.store|admin.advertisements.update|admin.advertisements.clientAjaxLogoImageUpload|admin.advertisements.clientRemoveImage$admin.vendors.index|admin.vendors.create|admin.vendors.edit|admin.vendors.store|admin.vendors.update|admin.vendors.changeStatus|admin.vendors.changeOfferStatus|admin.vendors.destroy|admin.vendors.clientAjaxImageUpload|admin.vendors.clientAjaxLogoImageUpload|admin.vendors.clientRemoveImage|admin.vendors.clientRemoveLogoImage|admin.vendors.export.csv|admin.vendors.csv|admin.vendors.export_one$admin.categories.index|admin.categories.create|admin.categories.edit|admin.categories.store|admin.categories.update|admin.categories.topCategory|admin.categories.changeStatus|admin.categories.changeFooterStatus|admin.categories.destroy|admin.categories.csv|admin.category.postAjaxImg$admin.sub_categories.index|admin.sub_categories.create|admin.sub_categories.edit|admin.sub_categories.store|admin.sub_categories.update|admin.sub_categories.topCategory|admin.sub_categories.changeStatus|admin.sub_categories.destroy|admin.sub_categories.csv|admin.ajax.subcategory$admin.products.index|admin.products.create|admin.products.changeStatus|admin.products.changeProductDisplayStatus|admin.products.edit|admin.products.changeOfferStatus|admin.products.trendingSale|admin.products.displayPrice|admin.products.destroy|admin.products.normal-csv|admin.products.image-csv|admin.products.store|admin.products.update|admin.products.productAjaxImageUpload|admin.products.productRemoveImage|admin.products.export_one|admin.products.analytics.csv|admin.products.get_images|admin.products.image.reorder|admin.products.marked_featured|admin.ajax.get_product_code|admin.products.index.status|admin.products.display_discount|admin.products-status.normal-csv|admin.products-status.image-csv|admin.products-status.analytics.csv$admin.all-requests|admin.review-ratings|admin.product-request|admin.all-request|admin.product-request.change-status|admin.product-request.message|admin.product-request.sent-message|admin.all-requests.csv|admin.invite-for-review$admin.users.index|admin.users.create|admin.users.edit|admin.users.changeStatus|admin.users.destroy|admin.users.store|admin.users.update|admin.users.show|admin.users.getStates|admin.users.reset_link|admin.users.message|admin.users.sent-message|admin.users.csv$admin.appointment.booking-detail|admin.appointment.index|admin.appointment.all-appointments|admin.appointment.changeStatus|admin.appointment.destroy|admin.appointment.cancel-appointment|admin.appointment.reschedule-appointment|admin.appointment.csv|admin.appointment.store|admin.appointment.create|admin.appointment.edit|admin.appointment.update|admin.appointment.show$admin.message.index|admin.message.message|admin.message-reply$admin.client_categories.index|admin.client_categories.create|admin.client_categories.edit|admin.client_categories.store|admin.client_categories.update|admin.client_categories.topCategory|admin.client_categories.changeStatus|admin.client_categories.destroy|admin.client_categories.csv$admin.clients.index|admin.clients.create|admin.clients.edit|admin.clients.store|admin.clients.update|admin.clients.changeStatus|admin.clients.changeOfferStatus|admin.clients.destroy|admin.clients.clientAjaxImageUpload|admin.clients.clientAjaxLogoImageUpload|admin.clients.clientRemoveImage|admin.clients.clientRemoveLogoImage|admin.clients.analytics.csv|admin.clients.csv|admin.clients.export_one$admin.cms.contact-detail-edit|admin.cms.index|admin.privacy_policies.index|admin.term_conditions.index|admin.cms.create|admin.cms.edit|admin.cms.store|admin.cms.update|admin.cms.destroy|admin.cms.changeStatus|admin.cms.contact-detail-edit|admin.cms.contact-detail-update|admin.privacy_policies.edit|admin.privacy_policies.create|admin.privacy_policies.store|admin.privacy_policies.update|admin.privacy_policies.topCategory|admin.privacy_policies.changeStatus|admin.privacy_policies.destroy|admin.term_conditions.edit|admin.term_conditions.create|admin.term_conditions.store|admin.term_conditions.update|admin.term_conditions.topCategory|admin.term_conditions.changeStatus|admin.term_conditions.destroy$admin.faqs.index|admin.faqs.create|admin.faqs.edit|admin.faqs.store|admin.faqs.update|admin.faqs.topCategory|admin.faqs.changeStatus|admin.faqs.destroy$admin.admins.index|admin.admins.create|admin.admins.changeStatus|admin.admins.edit|admin.admins.destroy|admin.admins.store|admin.admins.update$admin.email-template.index|admin.email-template.edit|admin.email-template.update$admin.settings.socialLinks|admin.settings.siteSettings|admin.settings.index|admin.settings.updateSiteSettings|admin.settings.updateSocialLinks', '2020-05-07 01:28:53', '2020-07-18 13:10:37'),
(11, 'Sub-Admin', 'Anas Karaki', 'anaskaraki@hotmail.com', '$2y$10$6.2I1Uyv6ZGQzyvPV3w7ievfmez8tyztn7DCjFxl3v6VMrChi5TvW', '5070 2550', NULL, NULL, 'all$admin.countries.index|admin.countries.create|admin.countries.changeStatus|admin.countries.edit|admin.countries.destroy|admin.countries.store|admin.countries.update|admin.countries.csv$admin.banners.index|admin.banners.create|admin.banners.edit|admin.banners.changeStatus|admin.banners.destroy|admin.banners.store|admin.banners.update|admin.banners.show|admin.banners.getStates$admin.advertisements.index|admin.advertisements.create|admin.advertisements.edit|admin.advertisements.changeStatus|admin.advertisements.destroy|admin.advertisements.store|admin.advertisements.update|admin.advertisements.clientAjaxLogoImageUpload|admin.advertisements.clientRemoveImage$admin.vendors.index|admin.vendors.create|admin.vendors.edit|admin.vendors.store|admin.vendors.update|admin.vendors.changeStatus|admin.vendors.changeOfferStatus|admin.vendors.destroy|admin.vendors.clientAjaxImageUpload|admin.vendors.clientAjaxLogoImageUpload|admin.vendors.clientRemoveImage|admin.vendors.clientRemoveLogoImage|admin.vendors.export.csv|admin.vendors.csv|admin.vendors.export_one$admin.categories.index|admin.categories.create|admin.categories.edit|admin.categories.store|admin.categories.update|admin.categories.topCategory|admin.categories.changeStatus|admin.categories.changeFooterStatus|admin.categories.destroy|admin.categories.csv|admin.category.postAjaxImg$admin.sub_categories.index|admin.sub_categories.create|admin.sub_categories.edit|admin.sub_categories.store|admin.sub_categories.update|admin.sub_categories.topCategory|admin.sub_categories.changeStatus|admin.sub_categories.destroy|admin.sub_categories.csv|admin.ajax.subcategory$admin.products.index|admin.products.create|admin.products.changeStatus|admin.products.changeProductDisplayStatus|admin.products.edit|admin.products.changeOfferStatus|admin.products.trendingSale|admin.products.displayPrice|admin.products.destroy|admin.products.normal-csv|admin.products.image-csv|admin.products.store|admin.products.update|admin.products.productAjaxImageUpload|admin.products.productRemoveImage|admin.products.export_one|admin.products.analytics.csv|admin.products.get_images|admin.products.image.reorder|admin.products.marked_featured|admin.ajax.get_product_code|admin.products.index.status|admin.products.display_discount|admin.products-status.normal-csv|admin.products-status.image-csv|admin.products-status.analytics.csv$admin.all-requests|admin.review-ratings|admin.product-request|admin.all-request|admin.product-request.change-status|admin.product-request.message|admin.product-request.sent-message|admin.all-requests.csv|admin.invite-for-review$admin.users.index|admin.users.create|admin.users.edit|admin.users.changeStatus|admin.users.destroy|admin.users.store|admin.users.update|admin.users.show|admin.users.getStates|admin.users.reset_link|admin.users.message|admin.users.sent-message|admin.users.csv$admin.appointment.booking-detail|admin.appointment.index|admin.appointment.all-appointments|admin.appointment.changeStatus|admin.appointment.destroy|admin.appointment.cancel-appointment|admin.appointment.reschedule-appointment|admin.appointment.csv|admin.appointment.store|admin.appointment.create|admin.appointment.edit|admin.appointment.update|admin.appointment.show$admin.message.index|admin.message.message|admin.message-reply$admin.client_categories.index|admin.client_categories.create|admin.client_categories.edit|admin.client_categories.store|admin.client_categories.update|admin.client_categories.topCategory|admin.client_categories.changeStatus|admin.client_categories.destroy|admin.client_categories.csv$admin.clients.index|admin.clients.create|admin.clients.edit|admin.clients.store|admin.clients.update|admin.clients.changeStatus|admin.clients.changeOfferStatus|admin.clients.destroy|admin.clients.clientAjaxImageUpload|admin.clients.clientAjaxLogoImageUpload|admin.clients.clientRemoveImage|admin.clients.clientRemoveLogoImage|admin.clients.analytics.csv|admin.clients.csv|admin.clients.export_one$admin.cms.contact-detail-edit|admin.cms.index|admin.privacy_policies.index|admin.term_conditions.index|admin.cms.create|admin.cms.edit|admin.cms.store|admin.cms.update|admin.cms.destroy|admin.cms.changeStatus|admin.cms.contact-detail-edit|admin.cms.contact-detail-update|admin.privacy_policies.edit|admin.privacy_policies.create|admin.privacy_policies.store|admin.privacy_policies.update|admin.privacy_policies.topCategory|admin.privacy_policies.changeStatus|admin.privacy_policies.destroy|admin.term_conditions.edit|admin.term_conditions.create|admin.term_conditions.store|admin.term_conditions.update|admin.term_conditions.topCategory|admin.term_conditions.changeStatus|admin.term_conditions.destroy$admin.faqs.index|admin.faqs.create|admin.faqs.edit|admin.faqs.store|admin.faqs.update|admin.faqs.topCategory|admin.faqs.changeStatus|admin.faqs.destroy$admin.admins.index|admin.admins.create|admin.admins.changeStatus|admin.admins.edit|admin.admins.destroy|admin.admins.store|admin.admins.update$admin.email-template.index|admin.email-template.edit|admin.email-template.update$admin.settings.socialLinks|admin.settings.siteSettings|admin.settings.index|admin.settings.updateSiteSettings|admin.settings.updateSocialLinks', '2020-05-07 01:30:12', '2020-07-18 13:10:26'),
(12, 'Sub-Admin', 'Ayman Karaki', 'aymankaraki@hotmail.com', '$2y$10$LxYsFD3eNtQDcO8yVMqVHeia7ELm3sMRa9vqmfXZIvrF4u6vv9lEK', '3323 6636', NULL, 'wnzA1QoXMzJX9xtL84VAkWexcVQTsTl4K7DEkmTBDTOU9LNoGSCFnz2Uv7gh', 'all$admin.countries.index|admin.countries.create|admin.countries.changeStatus|admin.countries.edit|admin.countries.destroy|admin.countries.store|admin.countries.update|admin.countries.csv$admin.banners.index|admin.banners.create|admin.banners.edit|admin.banners.changeStatus|admin.banners.destroy|admin.banners.store|admin.banners.update|admin.banners.show|admin.banners.getStates$admin.advertisements.index|admin.advertisements.create|admin.advertisements.edit|admin.advertisements.changeStatus|admin.advertisements.destroy|admin.advertisements.store|admin.advertisements.update|admin.advertisements.clientAjaxLogoImageUpload|admin.advertisements.clientRemoveImage$admin.vendors.index|admin.vendors.create|admin.vendors.edit|admin.vendors.store|admin.vendors.update|admin.vendors.changeStatus|admin.vendors.changeOfferStatus|admin.vendors.destroy|admin.vendors.clientAjaxImageUpload|admin.vendors.clientAjaxLogoImageUpload|admin.vendors.clientRemoveImage|admin.vendors.clientRemoveLogoImage|admin.vendors.export.csv|admin.vendors.csv|admin.vendors.export_one$admin.categories.index|admin.categories.create|admin.categories.edit|admin.categories.store|admin.categories.update|admin.categories.topCategory|admin.categories.changeStatus|admin.categories.changeFooterStatus|admin.categories.destroy|admin.categories.csv|admin.categories.postAjaxImg$admin.sub_categories.index|admin.sub_categories.create|admin.sub_categories.edit|admin.sub_categories.store|admin.sub_categories.update|admin.sub_categories.topCategory|admin.sub_categories.changeStatus|admin.sub_categories.destroy|admin.sub_categories.csv|admin.ajax.subcategory$admin.products.index|admin.products.create|admin.products.changeStatus|admin.products.changeProductDisplayStatus|admin.products.edit|admin.products.changeOfferStatus|admin.products.trendingSale|admin.products.displayPrice|admin.products.destroy|admin.products.normal-csv|admin.products.image-csv|admin.products.store|admin.products.update|admin.products.productAjaxImageUpload|admin.products.productRemoveImage|admin.products.export_one|admin.products.analytics.csv|admin.products.get_images|admin.products.image.reorder|admin.products.marked_featured|admin.ajax.get_product_code|admin.products.index.status|admin.products.display_discount|admin.products-status.normal-csv|admin.products-status.image-csv|admin.products-status.analytics.csv$admin.all-requests|admin.review-ratings|admin.product-request|admin.all-request|admin.product-request.change-status|admin.product-request.message|admin.product-request.sent-message|admin.all-requests.csv|admin.invite-for-review$admin.users.index|admin.users.create|admin.users.edit|admin.users.changeStatus|admin.users.destroy|admin.users.store|admin.users.update|admin.users.show|admin.users.getStates|admin.users.reset_link|admin.users.message|admin.users.sent-message|admin.users.csv$admin.appointment.booking-detail|admin.appointment.index|admin.appointment.all-appointments|admin.appointment.changeStatus|admin.appointment.destroy|admin.appointment.cancel-appointment|admin.appointment.reschedule-appointment|admin.appointment.csv|admin.appointment.store|admin.appointment.create|admin.appointment.edit|admin.appointment.update|admin.appointment.show$admin.message.index|admin.message.message|admin.message-reply$admin.client_categories.index|admin.client_categories.create|admin.client_categories.edit|admin.client_categories.store|admin.client_categories.update|admin.client_categories.topCategory|admin.client_categories.changeStatus|admin.client_categories.destroy|admin.client_categories.csv$admin.clients.index|admin.clients.create|admin.clients.edit|admin.clients.store|admin.clients.update|admin.clients.changeStatus|admin.clients.changeOfferStatus|admin.clients.destroy|admin.clients.clientAjaxImageUpload|admin.clients.clientAjaxLogoImageUpload|admin.clients.clientRemoveImage|admin.clients.clientRemoveLogoImage|admin.clients.analytics.csv|admin.clients.csv|admin.clients.export_one$admin.cms.contact-detail-edit|admin.cms.index|admin.privacy_policies.index|admin.term_conditions.index|admin.cms.create|admin.cms.edit|admin.cms.store|admin.cms.update|admin.cms.destroy|admin.cms.changeStatus|admin.cms.contact-detail-edit|admin.cms.contact-detail-update|admin.privacy_policies.edit|admin.privacy_policies.create|admin.privacy_policies.store|admin.privacy_policies.update|admin.privacy_policies.topCategory|admin.privacy_policies.changeStatus|admin.privacy_policies.destroy|admin.term_conditions.edit|admin.term_conditions.create|admin.term_conditions.store|admin.term_conditions.update|admin.term_conditions.topCategory|admin.term_conditions.changeStatus|admin.term_conditions.destroy$admin.faqs.index|admin.faqs.create|admin.faqs.edit|admin.faqs.store|admin.faqs.update|admin.faqs.topCategory|admin.faqs.changeStatus|admin.faqs.destroy$admin.admins.index|admin.admins.create|admin.admins.changeStatus|admin.admins.edit|admin.admins.destroy|admin.admins.store|admin.admins.update$admin.email-template.index|admin.email-template.edit|admin.email-template.update$admin.settings.socialLinks|admin.settings.siteSettings|admin.settings.index|admin.settings.updateSiteSettings|admin.settings.updateSocialLinks', '2020-07-13 11:03:26', '2020-07-14 22:35:25'),
(14, 'Sub-Admin', 'AK', 'anas@sab-q.com', '$2y$10$FLVrxkNpI3N9qSqyJ6.kbe/2m557R9oc2mVi4NzxaWhcWV0tDCtdm', '50702550', NULL, NULL, 'all$admin.countries.index|admin.countries.create|admin.countries.changeStatus|admin.countries.edit|admin.countries.destroy|admin.countries.store|admin.countries.update|admin.countries.csv$admin.banners.index|admin.banners.create|admin.banners.edit|admin.banners.changeStatus|admin.banners.destroy|admin.banners.store|admin.banners.update|admin.banners.show|admin.banners.getStates$admin.advertisements.index|admin.advertisements.create|admin.advertisements.edit|admin.advertisements.changeStatus|admin.advertisements.destroy|admin.advertisements.store|admin.advertisements.update|admin.advertisements.clientAjaxLogoImageUpload|admin.advertisements.clientRemoveImage$admin.vendors.index|admin.vendors.create|admin.vendors.edit|admin.vendors.store|admin.vendors.update|admin.vendors.changeStatus|admin.vendors.changeOfferStatus|admin.vendors.destroy|admin.vendors.clientAjaxImageUpload|admin.vendors.clientAjaxLogoImageUpload|admin.vendors.clientRemoveImage|admin.vendors.clientRemoveLogoImage|admin.vendors.export.csv|admin.vendors.csv|admin.vendors.export_one$admin.categories.index|admin.categories.create|admin.categories.edit|admin.categories.store|admin.categories.update|admin.categories.topCategory|admin.categories.changeStatus|admin.categories.changeFooterStatus|admin.categories.destroy|admin.categories.csv|admin.category.postAjaxImg$admin.sub_categories.index|admin.sub_categories.create|admin.sub_categories.edit|admin.sub_categories.store|admin.sub_categories.update|admin.sub_categories.topCategory|admin.sub_categories.changeStatus|admin.sub_categories.destroy|admin.sub_categories.csv|admin.ajax.subcategory$admin.products.index|admin.products.create|admin.products.changeStatus|admin.products.changeProductDisplayStatus|admin.products.edit|admin.products.changeOfferStatus|admin.products.trendingSale|admin.products.displayPrice|admin.products.destroy|admin.products.normal-csv|admin.products.image-csv|admin.products.store|admin.products.update|admin.products.productAjaxImageUpload|admin.products.productRemoveImage|admin.products.export_one|admin.products.analytics.csv|admin.products.get_images|admin.products.image.reorder|admin.products.marked_featured|admin.ajax.get_product_code|admin.products.index.status|admin.products.display_discount|admin.products-status.normal-csv|admin.products-status.image-csv|admin.products-status.analytics.csv$admin.all-requests|admin.review-ratings|admin.product-request|admin.all-request|admin.product-request.change-status|admin.product-request.message|admin.product-request.sent-message|admin.all-requests.csv|admin.invite-for-review$admin.users.index|admin.users.create|admin.users.edit|admin.users.changeStatus|admin.users.destroy|admin.users.store|admin.users.update|admin.users.show|admin.users.getStates|admin.users.reset_link|admin.users.message|admin.users.sent-message|admin.users.csv$admin.appointment.booking-detail|admin.appointment.index|admin.appointment.all-appointments|admin.appointment.changeStatus|admin.appointment.destroy|admin.appointment.cancel-appointment|admin.appointment.reschedule-appointment|admin.appointment.csv|admin.appointment.store|admin.appointment.create|admin.appointment.edit|admin.appointment.update|admin.appointment.show$admin.message.index|admin.message.message|admin.message-reply$admin.client_categories.index|admin.client_categories.create|admin.client_categories.edit|admin.client_categories.store|admin.client_categories.update|admin.client_categories.topCategory|admin.client_categories.changeStatus|admin.client_categories.destroy|admin.client_categories.csv$admin.clients.index|admin.clients.create|admin.clients.edit|admin.clients.store|admin.clients.update|admin.clients.changeStatus|clients.changeFeatured|admin.clients.changeOfferStatus|admin.clients.destroy|admin.clients.clientAjaxImageUpload|admin.clients.clientAjaxLogoImageUpload|admin.clients.clientRemoveImage|admin.clients.clientRemoveLogoImage|admin.clients.analytics.csv|admin.clients.csv|admin.clients.export_one$admin.cms.contact-detail-edit|admin.cms.index|admin.privacy_policies.index|admin.term_conditions.index|admin.cms.create|admin.cms.edit|admin.cms.store|admin.cms.update|admin.cms.destroy|admin.cms.changeStatus|admin.cms.contact-detail-edit|admin.cms.contact-detail-update|admin.privacy_policies.edit|admin.privacy_policies.create|admin.privacy_policies.store|admin.privacy_policies.update|admin.privacy_policies.topCategory|admin.privacy_policies.changeStatus|admin.privacy_policies.destroy|admin.term_conditions.edit|admin.term_conditions.create|admin.term_conditions.store|admin.term_conditions.update|admin.term_conditions.topCategory|admin.term_conditions.changeStatus|admin.term_conditions.destroy$admin.faqs.index|admin.faqs.create|admin.faqs.edit|admin.faqs.store|admin.faqs.update|admin.faqs.topCategory|admin.faqs.changeStatus|admin.faqs.destroy$admin.admins.index|admin.admins.create|admin.admins.changeStatus|admin.admins.edit|admin.admins.destroy|admin.admins.store|admin.admins.update$admin.email-template.index|admin.email-template.edit|admin.email-template.update$admin.settings.socialLinks|admin.settings.siteSettings|admin.settings.index|admin.settings.updateSiteSettings|admin.settings.updateSocialLinks', '2020-09-26 23:49:42', '2020-09-26 23:49:42'),
(15, 'Sub-Admin', 'Mahmoud Alaila', 'alaila@sab-q.com', '$2y$10$rBbDLXoyreQWEWXG1O1d6uK97TOQlCfGEfcYSZpybyXsV.CJOQPDu', '50606636', NULL, 'c5qkBn3PsdLoUy8oim5LgQRgCTHJUZj2Bp5bsow9RrlxSYOoyGgcnjsyUlaO', 'admin.countries.index|admin.countries.create|admin.countries.changeStatus|admin.countries.edit|admin.countries.store|admin.countries.update|admin.countries.csv$admin.banners.index|admin.banners.create|admin.banners.edit|admin.banners.changeStatus|admin.banners.store|admin.banners.update$admin.advertisements.index||admin.advertisements.create|admin.advertisements.edit|admin.advertisements.changeStatus|admin.advertisements.store|admin.advertisements.update|admin.advertisements.clientAjaxLogoImageUpload|admin.advertisements.clientRemoveImage$admin.vendors.index|admin.vendors.create|admin.vendors.edit|admin.vendors.store|admin.vendors.update|admin.vendors.changeStatus|admin.vendors.changeOfferStatus|admin.vendors.clientAjaxImageUpload|admin.vendors.clientAjaxLogoImageUpload|admin.vendors.clientRemoveImage|admin.vendors.clientRemoveLogoImage|admin.vendors.export.csv|admin.vendors.csv|admin.vendors.export_one$admin.categories.index||admin.categories.create|admin.categories.edit|admin.categories.store|admin.categories.update|admin.categories.topCategory|admin.categories.changeStatus|admin.categories.changeFooterStatus|admin.categories.csv|admin.category.postAjaxImg$admin.sub_categories.index|admin.sub_categories.create|admin.sub_categories.edit|admin.sub_categories.store|admin.sub_categories.update|admin.sub_categories.topCategory|admin.sub_categories.changeStatus|admin.sub_categories.csv|admin.ajax.subcategory$admin.products.index|admin.products.create|admin.products.changeStatus|admin.products.edit|admin.products.changeOfferStatus|admin.products.changeProductDisplayStatus|admin.products.trendingSale|admin.products.displayPrice|admin.products.normal-csv|admin.products.image-csv|admin.products.store|admin.products.update|admin.products.productAjaxImageUpload|admin.products.productRemoveImage|admin.products.export_one|admin.products.analytics.csv|admin.products.get_images|admin.products.image.reorder|admin.products.marked_featured|admin.ajax.get_product_code|admin.products.index.status|admin.products.display_discount|admin.products-status.normal-csv|admin.products-status.image-csv|admin.products-status.analytics.csv$admin.all-requests|admin.review-ratings$admin.users.index|admin.users.csv$admin.message.index$admin.client_categories.index|admin.client_categories.create|admin.client_categories.edit|admin.client_categories.store|admin.client_categories.update|admin.client_categories.topCategory|admin.client_categories.changeStatus|admin.client_categories.csv$admin.clients.index|admin.clients.create|admin.clients.edit|admin.clients.store|admin.clients.update|admin.clients.changeStatus|clients.changeFeatured|admin.clients.changeOfferStatus|admin.clients.clientAjaxImageUpload|admin.clients.clientAjaxLogoImageUpload|admin.clients.clientRemoveImage|admin.clients.clientRemoveLogoImage|admin.clients.analytics.csv|admin.clients.csv|admin.clients.export_one', '2020-12-13 13:15:54', '2020-12-13 13:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_password_resets`
--

INSERT INTO `admin_password_resets` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(35, 'megha@gmail.com', '$2y$10$IHK1Ps2EEYJIkMbEIUMaa..MDcN6.RyGiH.FeDoRgFl6zRn91zKbG', '2020-04-27 17:54:59', NULL),
(36, 'hemant28@email.com', '$2y$10$btIs00DoXkh.0LKcGofpqOYaYNepQPsKjWa1wCpkecxVDv1pdBJ5m', '2020-04-29 23:43:39', NULL),
(38, 'muntazir@braintechnosys.com', '$2y$10$6mkBkxmThX0nPlXF.S37BeSdW8jtxtBWSfoCKZIxJZ8ijImhVIOBO', '2020-04-30 15:41:48', NULL),
(43, 'hemant11@email.com', '$2y$10$srl.15rCTYSFuObM7JsPA.Vm/9GyrJND00Ts5gIRlSyaAxbVqcY4m', '2020-04-30 20:24:03', NULL),
(44, 'kushal@braintechnosys.com', '$2y$10$8mMdsfDIa1PJygTpexIsHOyxJzifthB/9jt1lT.tSZRZ2qfbN8gym', '2020-05-25 11:56:25', NULL),
(47, 'vishal.tomar@braintechnosys.com', '$2y$10$bWfaI8zUTGPqyq9YrnQ5S.4Z4HMozAQRTU.qvKI6M3I/lTGj7XnZ2', '2020-07-10 10:36:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL,
  `image` varchar(254) NOT NULL,
  `image_thumbnail` varchar(254) NOT NULL,
  `url` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `image`, `image_thumbnail`, `url`, `status`, `created_at`, `updated_at`) VALUES
(8, '5ea2eeb50288b.png', '5ea2eeb4b115d.png', NULL, 'Active', '2020-04-24 13:51:19', '2020-10-14 12:05:11'),
(9, '5ea2ef598dc5c.png', '5ea2ef594ff98.png', NULL, 'Active', '2020-04-24 13:53:46', '2020-10-14 12:05:16'),
(10, '5ea2efa24cedd.png', '5ea2efa220e8e.png', 'http://sab-q.com', 'Active', '2020-04-24 13:55:01', '2020-10-14 12:03:40'),
(11, '5eac629f62eb1.JPG', '5eac629f27df2.JPG', NULL, 'Inactive', '2020-05-01 17:56:07', '2020-07-17 16:59:12'),
(12, '5eb556c586f0e.jpg', '5eb556c4dab51.jpg', 'http://google.com', 'Inactive', '2020-05-08 12:56:11', '2020-07-17 16:59:13'),
(13, '5ec3d53f6ddd0.jpg', '5ec3d53f4781c.jpg', 'http://www.google.com', 'Inactive', '2020-05-19 12:47:37', '2020-07-17 16:59:16'),
(14, '5ec3d598609e1.jpg', '5ec3d59844e32.jpg', 'http://dev.onlineprojectprogress.com/sabq/furniture', 'Inactive', '2020-05-19 12:49:06', '2020-07-17 16:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_position` tinytext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Top,Middle,Bottom',
  `have_button` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_url` varchar(254) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_position`, `have_button`, `button_url`, `status`, `created_at`, `updated_at`) VALUES
(13, 'Middle', '0', '', 'Inactive', '2020-04-17 12:11:09', '2020-07-15 22:09:37'),
(14, 'Bottom', '0', '', 'Active', '2020-04-17 12:12:08', '2020-06-29 21:50:39'),
(25, 'Top', '0', '', 'Active', '2020-07-15 22:05:57', '2020-12-15 16:17:13'),
(26, 'Top', '0', '', 'Active', '2020-07-15 22:06:45', '2020-07-17 20:58:07'),
(27, 'Top', '0', '', 'Active', '2020-07-15 22:07:33', '2020-07-17 20:58:07'),
(28, 'Middle', '0', NULL, 'Active', '2020-07-15 22:08:49', '2020-07-17 20:58:08'),
(29, 'Middle', '0', NULL, 'Active', '2020-07-15 22:09:13', '2020-07-17 20:58:09'),
(30, 'Middle', '0', NULL, 'Active', '2020-07-15 22:09:29', '2020-07-17 20:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `category_order` int(11) NOT NULL DEFAULT 0,
  `category_icon` varchar(255) DEFAULT NULL,
  `category_icon_thumbnail` varchar(255) DEFAULT NULL,
  `status` text NOT NULL COMMENT '''Active'',''Inactive''',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `category_order`, `category_icon`, `category_icon_thumbnail`, `status`, `created_at`, `updated_at`) VALUES
(62, 'uvaishs', 'uvaishs', 112, '600eaaa94aed6.jpg', '600eaaa9178df.jpg', 'Active', '2021-01-25 11:22:07', '2021-01-25 11:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `client_category_id` int(11) NOT NULL,
  `email` varchar(254) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `country_code` varchar(50) DEFAULT NULL,
  `dial_code` varchar(50) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `url_name` varchar(250) NOT NULL,
  `logo` varchar(254) DEFAULT NULL,
  `logo_thumbnail` varchar(254) NOT NULL,
  `status` varchar(25) DEFAULT 'Active' COMMENT 'Active, Inactive',
  `is_featured` enum('Active','Inactive') DEFAULT 'Inactive',
  `address` varchar(254) DEFAULT NULL,
  `country` varchar(254) DEFAULT NULL,
  `latitude` decimal(10,4) DEFAULT NULL,
  `longitude` decimal(10,4) DEFAULT NULL,
  `video_url` text DEFAULT NULL,
  `video_id` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_category_id`, `email`, `phone`, `country_code`, `dial_code`, `website`, `url_name`, `logo`, `logo_thumbnail`, `status`, `is_featured`, `address`, `country`, `latitude`, `longitude`, `video_url`, `video_id`, `created_at`, `updated_at`) VALUES
(58, 16, 'aymankaraki@hotmail.com', '3323 6636', 'qa', '974', 'ww.google.com', '58', '5f2170bc63b09.png', '5f2170bc4df61.png', 'Active', 'Active', 'Doha, Qatar', 'Qatar', '25.2854', '51.5310', 'https://www.youtube.com/embed/7448Xphqs0I?autoplay=1&enablejsapi=1', '7448Xphqs0I', '2020-07-14 16:40:37', '2020-09-15 11:16:04'),
(59, 15, 'ayman.h.karaki@gmail.com', '3323 6636', 'qa', '974', 'www.marcabella.com.tr/', 'graymatter', '5f2170b0e44d9.jpg', '5f2170b0c3830.jpg', 'Active', 'Active', 'Palermo, Province of Palermo, Italy', 'Italy', '38.1157', '13.3615', '', 'gzaiCR-o5Hk', '2020-07-16 13:03:38', '2020-10-11 09:06:16'),
(60, 17, 'aymankaraki@hotmail.com', '3323 6636', 'qa', '974', 'www.micraofis.com', 'jamil', '5f217110836e0.jpg', '5f2171106efe0.jpg', 'Inactive', 'Active', 'qatar uni', 'Qatar', '25.3850', '51.4422', '', '', '2020-07-26 10:34:35', '2020-09-28 06:30:11'),
(61, 15, 'info@berkemobilya.com.tr', '0541 470 73 00', 'tr', '90', 'https://www.berkemobilya.com.tr/', 'berke', '5f718cfb06cf4.jpeg', '5f718cfaee4fd.jpeg', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-09-28 07:12:09', '2020-09-28 07:13:04'),
(62, 17, 'info@monoblok.net', '(0212) 244 22 14', 'tr', '90', 'http://monoblok.net/', 'monoblok', '5f71943988213.jpg', '5f7194396d2ea.jpg', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-09-28 07:43:15', '2020-09-28 07:43:57'),
(63, 17, 'info@siamoore.com', '(0216) 688 55 10', 'tr', '90', 'https://siamoore.com/', 'SiaMoore', '5f7196a6310e2.jpg', '5f7196a61bc3d.jpg', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-09-28 07:53:53', '2020-09-28 07:54:16'),
(64, 17, 'info@brass.com.tr', '(0216) 418 18 40', 'tr', '90', 'http://brass.com.tr/', 'brass', '5f71989e3553c.jpg', '5f71989e284e0.jpg', 'Active', 'Active', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-09-28 08:02:27', '2020-09-28 14:09:36'),
(65, 17, 'info@hipicon.com', '(0216) 380 08 28', 'tr', '90', 'https://www.hipicon.com/', 'NORMMADE', '5f719b0274bbb.jpg', '5f719b026779f.jpg', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-09-28 08:12:33', '2020-09-28 08:12:51'),
(66, 17, 'info@grandhouse.com.tr', '(0212) 282 33 19', 'tr', '90', 'http://www.grandhouse.com.tr/index.php', 'Grandhouse', '5f719d2910e86.jpg', '5f719d2903c81.jpg', 'Active', 'Active', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-09-28 08:21:19', '2020-09-28 14:09:35'),
(67, 16, 'mohammadabedhadi@gmail.com', '0535 221 66 03', 'tr', '90', 'https://mohammad_abdulhadi.houzz.com/', 'MHD', '5f719fc21fd6f.jpg', '5f719fc210374.jpg', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-09-28 08:32:52', '2020-09-28 08:33:08'),
(68, 16, 'info@pakermimarlik.com', '(0212) 332 17 59', 'tr', '90', 'http://pakermimarlik.com/#!/', 'Paker', '5f71a1960c015.png', '5f71a195ef741.png', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-09-28 08:40:38', '2020-09-28 08:40:57'),
(69, 16, 'info@oralmimarlik.com', '0532 578 64 94', 'tr', '90', 'https://oralarchitecture.com/', 'Oral', '5f71a8825b21a.png', '5f71a8824d483.png', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-09-28 09:10:15', '2020-09-28 09:10:29'),
(70, 16, 'merhaba@mozilya.com', '(0212) 590 96 91', 'tr', '90', 'https://www.mozilya.com/', 'Mozilya', '5f71a9d899cfd.jpg', '5f71a9d88add0.jpg', 'Active', 'Active', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-09-28 09:15:56', '2020-09-28 14:09:33'),
(71, 17, 'info@derunarchitecture.com', '(0216) 465 20 76', 'tr', '90', 'https://www.derunarchitecture.com/', 'Derun', '5f72e82d9cb28.png', '5f72e82d80af7.png', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-09-29 07:54:07', '2020-09-29 07:54:23'),
(72, 17, 'nbatukan@gmail.com', '(0216) 539 03 54', 'tr', '90', 'http://www.arkitex.com.tr/index.html', 'Nilgun', '5f72ee5fe9fe8.jpeg', '5f72ee5fd82b2.jpeg', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-09-29 08:03:33', '2020-09-29 08:20:52'),
(73, 16, 'info@pebble-design.com', '(0212) 351 77 90', 'tr', '90', 'https://www.pebble-design.com/pebbledesign-en', 'Neslihan', '5f72ee7b3a59f.png', '5f72ee7b18d69.png', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-09-29 08:20:21', '2020-09-29 08:21:18'),
(74, 20, 'tulip_decor@yahoo.com', '6675 3968', 'qa', '974', 'https://www.instagram.com/tulip_decor1/', 'tulip', '5f8d716a13da1.png', '5f8d716a035c2.png', 'Active', 'Active', '25.2459,51.46602', 'Qatar', '25.2459', '51.4661', '', '', '2020-10-19 10:58:39', '2020-10-20 08:21:55'),
(75, 21, 'Mmw.doha@gamil.com', '5582 1109', 'qa', '974', 'https://www.instagram.com/mmw.doha55821109', 'MMaWorld', '5f8e9b07e6e18.png', '5f8e9b07d21f9.png', 'Active', 'Active', 'World Medical mattresses', 'Qatar', '25.2393', '51.4567', '', '', '2020-10-20 08:08:26', '2020-10-20 14:44:43'),
(76, 22, 'salesdepartment@bayan-qatar.com', '4460 4838', 'qa', '974', 'http://bayan-qatar.com/', 'Bayan', '5f9975445849a.png', '5f9975442cdf9.png', 'Active', 'Inactive', 'Salwa Rd, Doha, Qatar', 'Qatar', '25.2403', '51.4563', '', '', '2020-10-25 12:55:35', '2020-10-28 13:42:31'),
(77, 23, 'sasconet@qatar.net.qa', '4469 4747', 'qa', '974', 'http://sasco-group.qa/', 'sasco', '5f9577b69d221.png', '5f9577b68fe4f.png', 'Active', 'Inactive', 'Salwa Rd, Doha, Qatar', 'Qatar', '25.2403', '51.4563', '', '', '2020-10-25 13:03:02', '2020-12-15 11:55:54'),
(78, 24, 'j.masri@gulfceramic.com', '4468 4200', 'qa', '974', 'https://www.instagram.com/gulf.ceramic/', 'gulfceramic', '5f9977d59bc56.png', '5f9977d577628.png', 'Active', 'Inactive', 'Salwa Rd, Doha, Qatar', 'Qatar', '25.2403', '51.4563', '', '', '2020-10-25 13:38:41', '2020-10-28 13:53:29'),
(79, 18, 'info@bedroomstoreqa.com', '5009 9822', 'qa', '974', 'https://www.thebedroomstoreqa.com/', 'thebedroomstore', '5f9581dea5fcf.png', '5f9581de959ef.png', 'Active', 'Inactive', 'Salwa Rd, Doha, Qatar', 'Qatar', '25.2403', '51.4563', '', '', '2020-10-25 13:46:55', '2020-10-25 13:47:15'),
(80, 20, 'raselmahmud@gmail.com', '5561 3688', 'qa', '974', 'https://www.instagram.com/awnabifurniturecentr/', 'AWNABI10', '5f997972a4d88.png', '5f99797290458.png', 'Active', 'Inactive', 'Al Shafi St, Ar Rayyan, Qatar', 'Qatar', '25.3004', '51.4209', '', '', '2020-10-27 12:40:08', '2020-10-28 14:00:21'),
(81, 17, 'abctrading@gmail.com', '5089 9806', 'qa', '974', 'https://www.instagram.com/abctrading.me/', 'abctrading', '5f990d72d1e83.png', '5f990d72c0dcc.png', 'Active', 'Inactive', 'Doha, Qatar', 'Qatar', '25.2854', '51.5310', '', '', '2020-10-28 06:19:19', '2020-10-28 06:19:39'),
(82, 15, 'export@xdrive.com.tr', '(0212) 651 19 15', 'tr', '90', 'https://www.xdrive.com.tr/en/', 'XDriveClient', '5f99788f59610.png', '5f99788f4967b.png', 'Active', 'Inactive', 'Turkey', 'Turkey', '38.9637', '35.2433', '', '', '2020-10-28 07:53:31', '2020-10-28 13:56:34'),
(83, 15, 'info@calitte.com', '0533 123 44 18', 'tr', '90', 'https://calitte.com/', 'Calitte', '5f9bd2cac25c9.png', '5f9bd2ca99e97.png', 'Active', 'Inactive', 'Turkey', 'Turkey', '38.9637', '35.2433', '', '', '2020-10-30 08:45:51', '2020-10-30 08:46:05'),
(84, 15, 'info@coloresmobilya.com', '0342 338 80 10', 'tr', '90', 'https://coloresmobilya.com/', 'Coloersclient', '5fa3aa20a3b6f.png', '5fa3aa208b233.png', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-11-05 07:30:18', '2020-11-05 07:30:58'),
(85, 15, 'info@sherwood.com.tr', '0850 305 2848', 'tr', '90', 'https://www.sherwood.com.tr/', 'Sherwoodclient', '5fa3c1a12f3fb.png', '5fa3c1a11ddb1.png', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-11-05 09:10:49', '2020-11-05 09:10:59'),
(86, 15, 'delivery@lazzoni.us', '(551) 255-5946', 'us', '1', 'https://www.lazzoni.com/en/', 'Lazzoni', '5fa3d23d551cb.png', '5fa3d23d4734f.png', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-11-05 10:21:38', '2020-11-05 10:21:51'),
(87, 15, 'info@fugamobilya.com', '0850 222 3842', 'tr', '90', 'https://www.fugamobilya.com/en/', 'Fugaclient', '5fa3e8901e2c6.png', '5fa3e88ff356d.png', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-11-05 11:56:54', '2020-11-05 11:57:07'),
(88, 15, 'info@luxurylinefurniture.com', '0552 987 12 12', 'tr', '90', 'https://www.luxurylinefurniture.com/', 'Luxuryline', '5fa8ec3812f29.jpg', '5fa8ec3803e17.jpg', 'Active', 'Inactive', 'İstanbul, Turkey', 'Turkey', '41.0082', '28.9784', '', '', '2020-11-09 07:13:45', '2020-11-09 07:14:02');

-- --------------------------------------------------------

--
-- Table structure for table `client_categories`
--

CREATE TABLE `client_categories` (
  `id` int(11) NOT NULL,
  `category_order` int(11) NOT NULL DEFAULT 0,
  `status` mediumtext NOT NULL COMMENT 'Active,Inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_categories`
--

INSERT INTO `client_categories` (`id`, `category_order`, `status`, `created_at`, `updated_at`) VALUES
(15, 0, 'Active', '2020-07-14 16:37:34', '2020-07-14 16:37:34'),
(16, 0, 'Active', '2020-07-14 18:59:34', '2020-07-14 18:59:34'),
(17, 1, 'Active', '2020-07-26 10:27:07', '2020-11-03 09:24:45'),
(18, 0, 'Active', '2020-09-28 06:33:02', '2020-09-28 06:33:02'),
(19, 0, 'Active', '2020-09-28 06:33:37', '2020-09-28 06:33:37'),
(20, 3, 'Active', '2020-10-19 09:50:08', '2020-11-03 09:24:35'),
(21, 0, 'Active', '2020-10-20 07:40:12', '2020-10-20 07:40:12'),
(22, 0, 'Active', '2020-10-25 12:50:35', '2020-10-25 12:50:35'),
(23, 0, 'Active', '2020-10-25 12:59:29', '2020-10-25 12:59:29'),
(24, 2, 'Active', '2020-10-25 13:31:50', '2020-11-03 09:24:24'),
(25, 7, 'Active', '2020-12-16 07:10:35', '2020-12-16 07:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'General',
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `page_name`, `page_type`, `status`, `created_at`, `updated_at`) VALUES
(17, 'Shipping', 'Service', 'Active', '2020-07-14 00:42:41', '2020-07-14 00:42:41'),
(18, 'About_Us', 'General', 'Active', '2020-07-17 21:10:33', '2020-07-17 21:10:33'),
(19, 'terms-and-condition', 'General', 'Active', '2020-07-18 02:19:11', '2020-07-18 02:19:11'),
(20, 'privacy-policy', 'General', 'Active', '2020-07-18 02:37:43', '2020-07-20 11:58:15'),
(21, 'faq', 'General', 'Active', '2020-07-18 02:41:24', '2020-07-20 11:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `cms_translations`
--

CREATE TABLE `cms_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cms_id` bigint(20) UNSIGNED NOT NULL,
  `locale` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_translations`
--

INSERT INTO `cms_translations` (`id`, `cms_id`, `locale`, `title`, `url`, `meta_keyword`, `meta_desc`, `content`) VALUES
(33, 17, 'en', 'Shipping from Turkey', 'shipping', 'hello Enter Meta keyword here', 'Hello Description here', '<p>Testing the CMS new page</p>'),
(34, 17, 'ar', 'خدمات الشحن من تركيا', 'shipping-ar', 'ميتا مفاتيح كلمات', 'وصف الصفحة', '<p>نقوم بالشحن من تركيا الى قطر</p>'),
(35, 18, 'en', 'About Us', 'AboutUs', 'About SAB Q', 'About SAB Q Descripto', '<p><span style=\"font-size:14px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">SAB Q (Services Across Borders - Qatar) is an online furniture marketplace established in 2020. We aim to make the shopping experience for furniture easy and convenient by providing customers with a wide range of services and options without visiting many shops.</span></span></p>\r\n\r\n<p><span style=\"font-size:14px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Our platforms provide a unique home furnishing and renovation experience via offering users the opportunity to shop online and gain access to local showrooms, factories and shops along with international suppliers. With our website and mobile apps (IOS and Android), customers can search for classic, modern, unique, and/or astonishing designs and furniture sets. We focus on including a wide range of local clients in Qatar like furniture manufacturers, showrooms, interior design offices, consulting offices, etc.</span></span></p>\r\n\r\n<p><strong><span style=\"font-size:14px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">At SAB Q, furnishing is easy for you.</span></span></strong></p>'),
(36, 18, 'ar', 'حول ساب كيو', 'aboutus-ar', 'حول ساب كيو', 'حول ساب كيو', '<p>تم اطلاق منصة ساب كيو عام 2020 حيث توفر سوق الكتروني للأثاث وكل ما يتعلق بخدمات البناء وتجديد الديكور. نسعى في شركة ساب كيو إلى تقديم تجربة مميزة من خلال ربط الزبائن مع العملاء من دون الحاجة للبحث بين محلات ومكاتب مختلفة.</p>\r\n\r\n<p>من خلال شبكة ساب كيو، نقوم بتوفير تجربة فريدة للتسوق من خلال عرض تشكيلة واسعة من المفروشات المنزلية والمكتبية، باللإضافة إلى خدمات التصميم الداخلي والخدمات الاستشارية والتنفيذية للبناء. يمكن للمستخدم التصفح من خلال موقعنا الالكتروني بالإضافة إلى تطبيقات الهواتف حيث نهدف إلى ربط المستخدم بأي متجر أو مكتب له علاقة بالأثاث او الخدمات الذي يبحث عنها. يقدم الموقع العديد من المنتجات المتوفرة في المعارض والمصانع القطرية المحلية، إلى جانب الموردين من الخارج، والتي تتضمن تشكيلة من الأثاث المميز والحديث إلى التصاميم الأنيقة والفاخرة.</p>\r\n\r\n<p>ساب كيو هو المكان لتأثيث البيت بسهولة وامان.</p>'),
(37, 19, 'en', 'Terms and Conditions', 'terms-and-condition', NULL, NULL, '<p>t</p>'),
(38, 19, 'ar', 'الشروط والأحكام', 'terms-and-condition-ar', 'الشروط والأحكام', 'الشروط والأحكام', '<p>t</p>'),
(39, 20, 'en', 'Privacy Policy', 'privacy-policy', NULL, NULL, '<p>a</p>'),
(40, 20, 'ar', 'سياسة الخصوصية', 'privacy-policy-ar', NULL, NULL, '<p>a</p>'),
(41, 21, 'en', 'FAQ', 'faq', NULL, NULL, '<p>a</p>'),
(42, 21, 'ar', 'الأسئلة المتداولة', 'faq-ar', NULL, NULL, '<p>a</p>');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `flag` varchar(191) DEFAULT NULL,
  `dial_code` char(5) NOT NULL,
  `currency_name` varchar(191) NOT NULL,
  `currency_symbol` varchar(20) NOT NULL,
  `currency_code` varchar(20) NOT NULL,
  `status` enum('Active','Inactive','Preliminary') NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `flag`, `dial_code`, `currency_name`, `currency_symbol`, `currency_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'IN', 'IN.png', '+91', 'Indian rupee', '$', 'IN', 'Inactive', NULL, '2020-07-18 03:50:41'),
(2, 'SE', 'SE.png', '+46', 'Swedish Krona', 'kr', 'SE', 'Inactive', NULL, '2020-07-18 03:50:11'),
(3, 'QR', NULL, '+974', 'Qatari Riyal', 'QA', 'QR', 'Active', '2020-04-01 15:21:32', '2020-07-18 03:49:58'),
(4, 'TR', NULL, '+90', 'Turkish Lira', '₺', 'TR', 'Active', '2020-04-03 16:40:08', '2020-07-18 03:49:31'),
(5, 'JO', NULL, '+962', 'Jordanin Dinar', 'JOD', 'JO', 'Active', '2020-04-03 16:43:24', '2020-07-18 03:49:53'),
(7, 'PS', NULL, '+972', 'New Israieli shequel', 'ILS', 'PS', 'Active', '2020-07-06 18:58:06', '2020-07-18 03:49:39'),
(8, 'US', NULL, '+1', 'USD', '$', 'US', 'Active', '2020-07-06 22:09:42', '2020-07-18 03:49:47');

-- --------------------------------------------------------

--
-- Table structure for table `country_translations`
--

CREATE TABLE `country_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` int(11) NOT NULL,
  `locale` varchar(10) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country_translations`
--

INSERT INTO `country_translations` (`id`, `country_id`, `locale`, `name`) VALUES
(1, 1, 'en', 'India'),
(2, 1, 'sv', 'Indien'),
(3, 2, 'en', 'Sweden'),
(4, 2, 'sv', 'Sverige1'),
(5, 3, 'en', 'Qatar'),
(6, 3, 'ar', 'قطر'),
(9, 4, 'en', 'Turkey'),
(10, 4, 'ar', 'تركيا'),
(11, 5, 'en', 'Jordan'),
(12, 5, 'ar', 'الأردن'),
(15, 7, 'en', 'Palestine'),
(16, 7, 'ar', 'فلسطين'),
(17, 8, 'en', 'United States'),
(18, 8, 'ar', 'الولايات المتحدة الأمريكية'),
(21, 2, 'ar', 'السويد'),
(22, 1, 'ar', 'الهند');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `page_name`, `created_at`, `updated_at`) VALUES
(1, 'appointment-reschedule', '2019-07-18 11:47:59', '2020-04-16 03:26:32'),
(2, 'appointment-cancel', '2019-07-18 11:47:59', '2020-04-16 02:20:33'),
(3, 'welcome-email', '2019-07-18 11:47:59', '2020-04-16 02:20:33'),
(4, 'update-password-confirm', '2019-07-18 11:47:59', '2020-04-16 02:20:33'),
(5, 'invite-for-review', '2019-07-18 23:17:59', '2020-04-16 13:50:33'),
(6, 'admin-message-alert', '2020-05-11 22:33:26', '2020-05-11 22:33:26'),
(7, 'customer-message-alert', '2020-05-12 00:13:18', '2020-05-12 00:13:18'),
(8, 'admin-order-request-alert', '2020-05-12 01:32:52', '2020-05-12 01:32:52'),
(9, 'contact-us-admin', '2020-05-12 04:04:47', '2020-05-12 04:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `email_template_translations`
--

CREATE TABLE `email_template_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email_template_id` bigint(20) UNSIGNED NOT NULL,
  `locale` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_template_translations`
--

INSERT INTO `email_template_translations` (`id`, `email_template_id`, `locale`, `title`, `content`) VALUES
(19, 1, 'en', 'Dear {user}  Your Appointment Has Been Rescheduled', '<p>Appointment Date: {appointment_date}</p>\r\n\r\n<p>From Time: {from_time}</p>\r\n\r\n<p>To Time: {to_time}</p>\r\n\r\n<p>Thanks,</p>\r\n\r\n<p>SAB Q Family</p>'),
(20, 1, 'ar', 'عزيزي {user}  ، تمت إعادة حجز الموعد', '<p>تاريخ الموعد:&nbsp;{appointment_date}</p>\r\n\r\n<p>من وقت:&nbsp;{from_time}</p>\r\n\r\n<p>إلى الوقت:&nbsp; {to_time}</p>\r\n\r\n<p>مع التحيات،</p>\r\n\r\n<p>عائلة ساب كيو</p>'),
(23, 2, 'en', 'Dear {user} Your Appointment Has Been Canceled', '<p>We would like to inform you that the following appointment has been canceled.</p>\r\n\r\n<p>Appointment Date: {appointment_date}&nbsp;</p>\r\n\r\n<p>From Time: {from_time}</p>\r\n\r\n<p>To Time: {to_time}</p>\r\n\r\n<p>Thanks,</p>\r\n\r\n<p>SAB Q Team</p>'),
(24, 2, 'ar', 'عزيزي {user} ، تم إلغاء موعدك.', '<p>نود أن نخبرك بأنه تم إلغاء&nbsp;الموعد التالي:</p>\r\n\r\n<p>تاريخ الموعد: {appointment_date}</p>\r\n\r\n<p>من وقت: {from_time}</p>\r\n\r\n<p>إلى الوقت: {to_time}</p>\r\n\r\n<p>مع التحيات،</p>\r\n\r\n<p>عائلة ساب كيو</p>'),
(25, 3, 'en', 'Dear {user} welcome to SABQ', '<p>Thank you for registering an account with us. SAB Q is an online furniture marketplace combining various Qatari and international brands in one place. This e-commerce platform will eliminate the hassle of going from a store to another when looking for furniture. We are please to have you and we are looking forward to receving any questions or concerns you have about any of the products and/or services we provide.</p>\r\n\r\n<p>At SAB Q, furnishing is easy for you.</p>\r\n\r\n<p>Thanks,</p>\r\n\r\n<p>SAB Q Team</p>'),
(26, 3, 'ar', 'عزيزي {user} أهلا وسهلا بك إلى ساب كيو.', '<p>نود أن نشكرك لتسجيل حساب على موقعنا. يوفر ساب كيو سوق الكتروني لمنتجات الأثاث المنزلي بكافة أشكالها. كما ونقوم بالترويج للمكاتب الهندسية والمعمارية في قطر ومشاركة بعض المنتجات المتوفرة في معارض الأثاث المحلية. هدفنا أن نقدم لك تجربة تسوق مميزة وسهلة للحصول على المنتجات التي تحبها. كما ونوفر عليك عبء التجول بين المعارض من خلال تقديم منتجاتها عبر موقعنا.&nbsp;</p>\r\n\r\n<p>تقدم منصة ساب كيو تجربة فريدة للتسوق.<br />\r\n<br />\r\nشكرا،<br />\r\nعائلة ساب كيو<br />\r\n<br />\r\n&nbsp;</p>'),
(27, 4, 'en', 'Dear {user} Password Updated Successfully', '<p><img alt=\"\" src=\"http://dev.onlineprojectprogress.com/sabq/storage/photos/footer-logo.png\" style=\"height:100px; width:100px\" /></p>\r\n\r\n<p>Your password has been successfully updated. Please use the new password to log in to your account on&nbsp;SAB Q&nbsp;website.</p>\r\n\r\n<p>Thanks</p>\r\n\r\n<p>SABQ Family</p>'),
(28, 4, 'ar', 'عزيزي {user} ، تم تحديث كلمة المرور بنجاح،', '<p>لقد تم تحديث كلمة المرور الخاصة بحسابك. الرجاء تسجيل الدخول باستخدام كلمة المرور الجديدة.</p>\r\n\r\n<p>مع تحياتنا،</p>\r\n\r\n<p>عائلة ساب كيو</p>'),
(29, 5, 'en', 'Dear {user}, SAB Q Invites you to Review a Product', '<p>Thank you for your interest in our products. Kindly follow the link below to provide a review.</p>\r\n\r\n<p>Thanks,</p>\r\n\r\n<p>SAB Q Family</p>'),
(30, 5, 'ar', 'عزيزي {user} ، ندعوك لتقييم منتج', '<p>شكرا لاهتمامك بأحد المنتجات المعروضة لدينا. الرجاء الدخول من الرابط المرفق للوصول الى صفحة التقييم.</p>\r\n\r\n<p>مع التحيات،</p>\r\n\r\n<p>عائلة ساب كيو</p>'),
(31, 6, 'en', 'Admin - Message Alert', '<pre>\r\n##Hi Admin New - You have a New Message.\r\n\r\nCustomer Name: {customer_name}\r\nCustomer Mobile: {customer_mobile}\r\nCustomer Email: {customer_email}\r\nMessage: {message}</pre>'),
(32, 6, 'ar', 'تنبيه - رسالة للمسؤول', '<pre>\r\n##مرحبا مدير، يوجد رسالة جديدة.\r\n\r\nاسم العميل: {customer_name}\r\nجوال العميل: {customer_mobile}\r\nالبريد الإلكتروني للعميل: {customer_email}\r\nمحتوى الرسالة: {message}</pre>'),
(33, 7, 'en', 'Hi {user_name} Admin sent you an message', '<p>Hi {user_name},</p>\r\n\r\n<p>Admn sent you a new message.Please login to SABQ to reply.</p>\r\n\r\n<p>Subject:{subject}</p>\r\n\r\n<p>Message:{admin_message}</p>'),
(34, 7, 'ar', 'مرحبًا {user_name} ، أرسل لك المشرف رسالة', '<pre>\r\nمرحبًا {user_name} ،\r\n\r\nأرسل لك Admn رسالة جديدة ، برجاء تسجيل الدخول إلى الموقع لقراءة الرسالة و الرد عليها.\r\n \r\nالموضوع: {subject}\r\n\r\nالرسالة: {admin_message}</pre>'),
(35, 8, 'en', 'Hi Admin, You Have New Product Request', '<pre>\r\nCustomer Name: {user_name}\r\nCustomer Mobile: {user_mobile}\r\nCustomer Email: {user_email}\r\nProduct Code: {product_code}\r\nQuantity: {product_quantity}</pre>'),
(36, 8, 'ar', 'مرحبا مدير، لديك طلب منتج جديد.', '<pre>\r\nاسم العميل: {user_name}\r\nجوال العميل: {user_mobile}\r\nالبريد الإلكتروني للعميل: {user_email}\r\nرمز المنتج: {product_code}\r\nالكمية: {product_quantity}</pre>'),
(37, 9, 'en', 'Contact Us |Query', '<p>A User has raised a query. Please find the details below</p>\r\n\r\n<p>Name : {user_name}</p>\r\n\r\n<p>Email: {user_email}</p>\r\n\r\n<p>Mobile: {user_mobile}</p>\r\n\r\n<p>Query: {query}</p>'),
(38, 9, 'ar', 'تواصل معنا | استعلام', '<pre>\r\nلقد أرسل مستخدم استعلام. يرجى الاطلاع على التفاصيل أدناه\r\n\r\nالاسم: {user_name}\r\n\r\nالبريد الإلكتروني: {user_email}\r\n\r\nالجوال: {user_mobile}\r\n\r\nاستعلام: {query}</pre>');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `status`, `created_at`, `updated_at`) VALUES
(23, 'Active', '2020-04-03 04:44:48', '2020-05-08 10:43:45');

-- --------------------------------------------------------

--
-- Table structure for table `faq_translations`
--

CREATE TABLE `faq_translations` (
  `id` int(11) NOT NULL,
  `faq_id` int(11) NOT NULL,
  `locale` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(254) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faq_translations`
--

INSERT INTO `faq_translations` (`id`, `faq_id`, `locale`, `question`, `answer`) VALUES
(3, 23, 'en', 'Test', 'Answer'),
(4, 23, 'ar', 'testdrhgdf dfhfg xgdhfg cgfn fg cfn f', 'Answerdfhfghfghfghfghfg chggfh fdhfgh cfhfg');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policies`
--

CREATE TABLE `privacy_policies` (
  `id` int(11) NOT NULL,
  `status` varchar(254) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `privacy_policies`
--

INSERT INTO `privacy_policies` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Active', '2020-04-15 13:58:11', '2020-04-15 13:58:11'),
(5, 'Active', '2020-08-04 18:12:20', '2020-08-04 18:12:20'),
(6, 'Active', '2020-08-04 18:14:20', '2020-08-04 18:14:20'),
(7, 'Active', '2020-08-04 18:15:04', '2020-08-04 18:15:04'),
(8, 'Active', '2020-08-04 18:15:48', '2020-08-04 18:15:48'),
(9, 'Active', '2020-08-04 18:16:12', '2020-08-04 18:16:12'),
(10, 'Active', '2020-08-04 18:16:40', '2020-08-04 18:16:40'),
(11, 'Active', '2020-08-04 18:17:14', '2020-08-04 18:17:14'),
(12, 'Active', '2020-08-04 18:17:37', '2020-08-04 18:17:37'),
(13, 'Active', '2020-08-04 18:18:18', '2020-08-04 18:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `vendor_code` varchar(10) NOT NULL,
  `category_code` varchar(10) NOT NULL,
  `sub_category_code` varchar(10) NOT NULL,
  `code` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount_percent` decimal(10,2) DEFAULT NULL,
  `final_discount_price` decimal(10,2) DEFAULT NULL,
  `display_discount` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `show_price` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive' COMMENT '0:Not Display, 1:Display',
  `slug` varchar(255) DEFAULT NULL,
  `category_slug` varchar(255) DEFAULT NULL,
  `subcategory_id` int(10) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `trending_sale` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `best_offer` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `display_product_code` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `display_vendor` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `youtube_url` varchar(255) DEFAULT NULL,
  `video_id` varchar(50) DEFAULT NULL,
  `view_count` bigint(20) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `status` mediumtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `sub_category_id`, `slug`, `name`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(107, NULL, NULL, 'sub-categorys', 62, 'Active', '2021-01-25 12:07:12', '2021-01-25 12:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `term_conditions`
--

CREATE TABLE `term_conditions` (
  `id` int(11) NOT NULL,
  `status` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `term_conditions`
--

INSERT INTO `term_conditions` (`id`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Active', '2020-07-17 22:31:59', '2020-07-17 22:31:59'),
(13, 'Active', '2020-07-17 22:32:23', '2020-07-17 22:32:23'),
(14, 'Active', '2020-07-17 22:33:09', '2020-07-17 22:33:09'),
(15, 'Active', '2020-07-17 22:33:24', '2020-07-17 22:33:24'),
(16, 'Active', '2020-07-17 22:33:37', '2020-07-17 22:33:37'),
(17, 'Active', '2020-07-17 22:33:54', '2020-07-17 22:33:54'),
(18, 'Active', '2020-07-17 22:34:11', '2020-07-17 22:34:11'),
(19, 'Active', '2020-07-17 22:34:25', '2020-07-17 22:34:25'),
(20, 'Active', '2020-07-17 22:34:40', '2020-07-17 22:34:40'),
(21, 'Active', '2020-07-17 22:35:13', '2020-07-17 22:35:13'),
(22, 'Active', '2020-07-17 22:35:37', '2020-07-17 22:35:37'),
(23, 'Active', '2020-09-28 14:20:42', '2020-09-28 14:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(254) NOT NULL,
  `email` varchar(254) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `country_code` varchar(50) DEFAULT NULL,
  `dial_code` varchar(50) DEFAULT NULL,
  `website` varchar(254) DEFAULT NULL,
  `url_name` varchar(250) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `logo_thumbnail` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `comment` text DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `country_id`, `name`, `email`, `phone`, `country_code`, `dial_code`, `website`, `url_name`, `logo`, `logo_thumbnail`, `code`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(7, 4, 'Micra Ofis', 'info@micraofis.co', '0530 156 08 10', 'TR', '90', 'www.micraofis.com', '7', '5f0c13410ffed.png', '5f0c1340f1f95.png', '009', 'Vendor\'s Address:\r\n Masko Furniture Stores Site\r\nMasko 16A BLOCK NO: 10 - 16\r\nİkitelli - Başakşehir İSTANBUL\r\nTelephone:\r\n(0212) 675 25 72\r\nWhatsapp:\r\n0530 156 08 10', 'Active', '2020-07-13 07:57:04', '2020-09-21 18:52:04'),
(8, 4, 'Marca Bella', 'marcebella@marcabella.com', '(0212) 675 21 26', 'TR', '90', 'www.marcabella.com.tr/', '8', '5f0f5db322191.JPG', '5f0f5db2adec6.JPG', '005', 'Whatsapp:\r\n+90 212 675 2126', 'Active', '2020-07-14 16:31:01', '2020-09-21 18:52:19'),
(9, 4, 'Elve Luxury', 'info@elvemobilya.com.tr', '(0216) 527 73 43', 'TR', '90', 'https://elvemobilya.com/bedroom/', '9', '5f107e8a0292c.png', '5f107e89e5d68.png', '002', NULL, 'Active', '2020-07-16 16:22:04', '2020-07-17 23:49:31'),
(10, 4, 'Calitte', 'info@calitte.co', '+90 (533) 123 4418', 'TR', '90', 'https://calitte.com/', '10', '5f11bf2a69fc2.png', '5f11bf2a511e7.png', '004', 'Whatsapp: +90 (533) 123 4418\r\nTELEPHONE: +90 (212) 670 4419', 'Active', '2020-07-17 15:09:31', '2020-07-17 23:49:31'),
(11, 4, 'Berke', 'info@berkemobilya.com.tr', '0541 436 00 87', 'tr', '90', 'www.berkemobilya.com.tr', '11', '5f997a7ca5f2c.png', '5f997a7c8e476.png', '001', 'the telephone no: 0212 436 00 87 \r\nWhatsapp 1: 0541 683 59 37\r\nWhatsapp 2: 0541 436 00 87', 'Active', '2020-09-21 18:57:09', '2020-10-28 14:04:46'),
(13, 3, 'Medical Mattress Morld', 'Mmw.doha@gamil.com', '5582 1109', 'qa', '974', 'https://www.instagram.com/mmw.doha55821109/', 'MMworld', '5f8e96ff6b82d.png', '5f8e96ff56bc7.png', '001', 'Mostafa Nagy / WhatsApp: +974-55821109', 'Active', '2020-10-20 07:52:07', '2020-10-20 08:17:34'),
(14, 4, 'XDrive', 'export@xdrive.com.tr', '(0212) 651 19 15', 'tr', '90', 'https://www.xdrive.com.tr/en/', 'XDrive', '5f9979c956c75.png', '5f9979c945ee2.png', '010', 'Gamıng Chaırs', 'Active', '2020-10-28 07:09:24', '2020-10-28 14:01:47'),
(15, 4, 'colores Home furniture', 'info@coloresmobilya.com', '(0342) 338 80 10', 'tr', '90', 'https://coloresmobilya.com/', 'Coloers', '5fa3a9268a783.png', '5fa3a926769e8.png', '006', NULL, 'Active', '2020-11-05 07:26:39', '2020-11-05 07:26:39'),
(16, 4, 'Sherwood Furniture', '%20info@sherwood.com.tr', '0850 305 28 48', 'tr', '90', 'https://www.sherwood.com.tr/', 'sherwood', '5fa3c00a011c4.png', '5fa3c009e33f8.png', '007', NULL, 'Active', '2020-11-05 09:04:13', '2020-11-05 09:04:13'),
(17, 4, 'Lazzoni Furniture', 'delivery@lazzoni.us', '+1 (551) 255-5946', 'us', '1', 'https://www.lazzoni.com/en/', 'laz', '5fa3d13980d6e.png', '5fa3d13968793.png', '008', NULL, 'Active', '2020-11-05 10:17:31', '2020-11-05 10:17:31'),
(18, 4, 'Fuga Mobilya', 'info@fugamobilya.com', '0850 222 3842', 'tr', '90', 'https://www.fugamobilya.com/en/', 'FUga', '5fa3e77f3a1f0.png', '5fa3e77f1b9d8.png', '003', NULL, 'Active', '2020-11-05 11:53:50', '2020-11-05 11:53:50'),
(19, 4, 'Luxury Line furniture', 'info@luxurylinefurniture.com', '0552 987 12 12', 'tr', '90', 'https://www.luxurylinefurniture.com/', 'Line', '5fa8e9b880f11.jpg', '5fa8e9b8702e1.jpg', '011', NULL, 'Active', '2020-11-09 07:05:47', '2020-11-09 07:05:47'),
(20, 4, 'Kelebek Furniture', 'info@kelebek.com', '0850 800 1805', 'tr', '90', 'https://www.kelebek.com/tr', 'kel', '5fd9a80c403de.png', '5fd9a80be9fa6.png', '022', NULL, 'Active', '2020-12-16 06:26:23', '2020-12-16 06:31:20'),
(21, 4, 'Bebekonfor', 'info@bebekonfor.com', '(0232) 243 66 58', 'tr', '90', 'https://www.bebekonfor.com/', 'bebe', '5fe1f3d8a5be3.jpg', '5fe1f3d893b60.jpg', '113', 'Bebekonfor has been in the service sector with Furniture and Decoration since 1991, has entered the baby cradle sector with its new brand, Pink Baby Booties, Furniture & Textile, since 2008. Bebekonfor company, has won the appreciation of the customers with its colorful works, has been progressing with rapid steps in export since 2011 with its organic baby textile products.', 'Active', '2020-12-22 13:27:11', '2020-12-22 13:27:11'),
(22, 4, 'macitler', 'bilgi@macitler.com.tr', '08508000628', 'TR', '90', 'https://www.macitler.com.tr/', 'mac', '5ff2c8de70bc0.png', '5ff2c8de5c26d.png', '123', 'Macitler Furniture, is a Turkish company, which has made the main goal of creating satisfaction in its domestic and international customers, continues its investments in order to maintain and develop this line in the future.', 'Active', '2021-01-04 07:53:11', '2021-01-05 13:15:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_password_resets_email_index` (`email`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_categories`
--
ALTER TABLE `client_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_translations`
--
ALTER TABLE `cms_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cms_translations_cms_id_locale_unique` (`cms_id`,`locale`),
  ADD KEY `cms_translations_locale_index` (`locale`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_translations`
--
ALTER TABLE `country_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country_translations_country_id_locale_unique` (`country_id`,`locale`),
  ADD KEY `country_translations_locale_index` (`locale`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template_translations`
--
ALTER TABLE `email_template_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cms_translations_cms_id_locale_unique` (`email_template_id`,`locale`),
  ADD KEY `cms_translations_locale_index` (`locale`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_translations`
--
ALTER TABLE `faq_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faq_translations_faq_id_foreign` (`faq_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vendors_vendor_id` (`vendor_id`),
  ADD KEY `fk_sub_categories_sub_category_id` (`subcategory_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `term_conditions`
--
ALTER TABLE `term_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_countries_country_id` (`country_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `client_categories`
--
ALTER TABLE `client_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cms_translations`
--
ALTER TABLE `cms_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `country_translations`
--
ALTER TABLE `country_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `email_template_translations`
--
ALTER TABLE `email_template_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `faq_translations`
--
ALTER TABLE `faq_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=611;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `term_conditions`
--
ALTER TABLE `term_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cms_translations`
--
ALTER TABLE `cms_translations`
  ADD CONSTRAINT `cms_translations_cms_id_foreign` FOREIGN KEY (`cms_id`) REFERENCES `cms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `country_translations`
--
ALTER TABLE `country_translations`
  ADD CONSTRAINT `foriegnkey_countries_country_id` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faq_translations`
--
ALTER TABLE `faq_translations`
  ADD CONSTRAINT `faq_translations_faq_id_foreign` FOREIGN KEY (`faq_id`) REFERENCES `faqs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_sub_categories_sub_category_id` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_vendors_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `fk_countries_country_id` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
