-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql103.infinityfree.com
-- Generation Time: Oct 19, 2025 at 03:25 AM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_39925056_tourismmap`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `last_login`) VALUES
(1, 'admin', 'admin', '2025-10-19 07:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read','replied') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `first_name`, `last_name`, `email`, `phone`, `subject`, `message`, `status`, `created_at`, `updated_at`, `ip_address`, `user_agent`) VALUES
(7, 'kev', 'tolentino', 'kevinsenpai18@gmail.com', '+63 9495 427966', 'destinations', 'ge nga', 'replied', '2025-09-19 16:01:40', '2025-09-19 16:03:13', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),
(8, 'asdasd', 'asd', 'kevintolentino1821@gmail.com', '123', 'booking', 'ae', 'read', '2025-09-19 16:05:19', '2025-09-19 16:05:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),
(15, 'autin', 'ulep', 'austinjan12@gmail.com', '09876544213', 'destinations', 'bakit walng walking street ? nigg3R?????', 'read', '2025-09-20 15:32:35', '2025-09-21 12:29:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),
(24, 'LeBron', 'James', 'imdagoat@gmail.com', '09186662500', 'support', 'cmon man, that’s too easy!', 'replied', '2025-09-22 12:52:40', '2025-09-22 12:54:52', '49.151.163.140', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1'),
(26, 'toms', 'tolenitno', 'tolentinotoms@gmail.com', '098765654321', 'partnership', 'sugal', 'replied', '2025-09-29 14:48:32', '2025-10-11 02:33:43', '49.151.171.50', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36'),
(27, '69', '420', 'dotcom@femail.com', '09123456789', 'support', 'sup mf, reviewing your joint. hmu.', 'read', '2025-10-08 10:39:54', '2025-10-09 08:51:04', '49.151.164.233', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Safari/605.1.15');

-- --------------------------------------------------------

--
-- Table structure for table `message_replies`
--

CREATE TABLE `message_replies` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `reply_subject` varchar(255) NOT NULL,
  `reply_message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `spot_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `spot_id`, `rating`, `comment`, `created_at`) VALUES
(38, 21, 131, 5, '', '2025-10-15 09:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `spot_images`
--

CREATE TABLE `spot_images` (
  `id` int(11) NOT NULL,
  `spot_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `owner_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spot_images`
--

INSERT INTO `spot_images` (`id`, `spot_id`, `image_path`, `owner_name`) VALUES
(363, 119, 'images/uploads/68d9361fd2be2_pexels_alexisricardoalaurin_17049547.jpg', 'Alexis Ricardo Alaurin'),
(364, 119, 'images/uploads/68d9361fd36a1_pexels_alexisricardoalaurin_30494367.jpg', 'Alexis Ricardo Alaurin'),
(365, 119, 'images/uploads/68d9361fd3d92_pexels_ernestbusalpa_30569589.jpg', 'Busalpa Ernest'),
(366, 119, 'images/uploads/68d9361fd4473_pexels_hancel_darroca_2956607_30712361.jpg', 'Hancel Darrocan'),
(367, 119, 'images/uploads/68d9361fd4ca5_pexels_mic_oller_2959176_4496894.jpg', 'Mic Oller'),
(368, 120, 'images/uploads/68d940326d67c_calvo_building.jpg', 'Alexis Ricardo Alaurin'),
(369, 120, 'images/uploads/68d940326ddeb_el_hogar.jpg', 'Kenny Tai'),
(370, 120, 'images/uploads/68d940326e59a_first_united.jpg', 'Kenny Tai'),
(371, 120, 'images/uploads/68d940327d948_natividad.jpg', 'Kenny Tai'),
(372, 120, 'images/uploads/68d94032a2334_pexels_alexisricardoalaurin_10551260.jpg', 'Kenny Tai'),
(373, 120, 'images/uploads/68d94032ae385_regina_building.jpg', 'Kenny Tai'),
(374, 120, 'images/uploads/68d94032c93f5_roman_santos_building.jpg', 'Kenny Tai'),
(375, 121, 'images/uploads/68da1542a519c_pexels_alexisricardoalaurin_18048428.jpg', 'Alexis Ricardo Alaurin'),
(376, 121, 'images/uploads/68da1542a58d1_pexels_imgrldescmsofficial_7039842.jpg', 'Gerald Escamos'),
(377, 121, 'images/uploads/68da1542a5d0d_pexels_matthew_yu_694036202_18433202.jpg', 'Matthew Yu'),
(378, 121, 'images/uploads/68da1542a62c5_pexels_wanxianren_5858469.jpg', 'Wilson Ren'),
(379, 122, 'images/uploads/68da1d277c957_pexels_kimymoto_25785221.jpg', 'Kimy Moto'),
(380, 122, 'images/uploads/68da1d277cde8_pexels_ram_brodett_50261687_19970794.jpg', 'Ram Brodett'),
(381, 123, 'images/uploads/68da254b90278_2018_03_07_10_21_02_904373346794.jpg', 'Promdi Girl'),
(382, 123, 'images/uploads/68da254b9060d_AlexanderAtipen.jpg', 'Alexander Atipen'),
(383, 123, 'images/uploads/68da254b90a37_Kaparkan.jpg', 'Alexander Atipen'),
(384, 123, 'images/uploads/68da254b90de5_MissTere.jpg', 'Miss Tere'),
(385, 123, 'images/uploads/68da254b91282_MissTere01.jpg', 'Miss Tere'),
(386, 124, 'images/uploads/68da2a1e2fb77_84602739_849522205474279_1650277046741368832_n.jpg', 'Abra Province'),
(387, 124, 'images/uploads/68da2a1e30670_86453949_849522258807607_7049404301952679936_n.jpg', 'Abra Province'),
(389, 125, 'images/uploads/68da338562e5f_Screenshot_2025_09_29_at_3_18_32___PM.png', 'Tubo Abra LGU'),
(390, 126, 'images/uploads/68da519925cae_pexels_mico_medel_2152072219_33656044.jpg', 'Gian Sepillo'),
(391, 126, 'images/uploads/68da519926435_pexels_supertineangeles_4175000.jpg', 'Mico Medel'),
(392, 126, 'images/uploads/68da5199268de_pexels_thegiansepillo_1595943_3894576.jpg', 'Tine Angeles'),
(393, 127, 'images/uploads/68da55b195cf9_Batad_Rice_Terraces_after_the_rain.JPG', 'Cid Jacobo'),
(394, 127, 'images/uploads/68da55b1961bf_Batad_Rice_Terraces__Ifugao_Province__Philippines.jpg', 'Seventide'),
(395, 127, 'images/uploads/68da55b1965b9_Batad__Banaue_Rice_Terraces_with_Homes_Cira_2000.jpg', 'Arleveditor'),
(396, 128, 'images/uploads/68da5b2609947_Screenshot_2025_09_29_at_6_08_21___PM.png', 'Unknown'),
(397, 128, 'images/uploads/68da5b26614d0_Screenshot_2025_09_29_at_6_08_54___PM.png', 'Unknown'),
(398, 128, 'images/uploads/68da5b26da735_Screenshot_2025_09_29_at_6_09_23___PM.png', 'Unknown'),
(399, 128, 'images/uploads/68da5b275f257_Screenshot_2025_09_29_at_6_09_44___PM.png', 'Unknown'),
(400, 129, 'images/uploads/68da5f4f5e430_LegendHarry.jpg', 'LegendHarry'),
(401, 129, 'images/uploads/68da5f4f5ec21_Magawe06.jpg', 'Magawe06'),
(402, 129, 'images/uploads/68da5f4f5f25c_nili1401.jpg', 'Nili1401'),
(408, 131, 'images/uploads/68e94ae41f6e6_bfab1f_8041be58184245cf8aaf470aef0e117b_mv2.webp', '@imkeentotravel'),
(409, 132, 'images/uploads/68eaad9c39959_Barasoain_Church_altar.jpg', 'Tagaaplaya'),
(410, 132, 'images/uploads/68eaad9c3a47b_Barasoain_Church_interior_2023_12_16.jpg', 'LMP 2001'),
(411, 132, 'images/uploads/68eaad9c3ab06_Barasoain_Church_2023.jpg', 'Rabosajr'),
(412, 133, 'images/uploads/68eb5b9ec8904_1346746827J0iLrxAx.jpg', 'Shinji Ikari'),
(413, 133, 'images/uploads/68eb5b9ec908f_Biak_na_BatoNationalParkjf6178_07.JPG', 'Ramon F Velasquez'),
(414, 133, 'images/uploads/68eb5b9ec9689_Travel_Guide_to_Biak_Na_Bato_National_Park_Philippines_Mt__Manalmon_04.jpg', 'Two Monkeys Travel Group'),
(415, 133, 'images/uploads/68eb5b9ec9e91_Travel_Guide_to_Biak_Na_Bato_National_Park_Philippines_Mt__Manalmon_05.jpg', 'Two Monkeys Travel Group'),
(416, 134, 'images/uploads/68eb62685caf7_pexels_neil_clark_ongchangco_2154700388_33356235.jpg', 'Neil Clark Ongchangco'),
(417, 134, 'images/uploads/68eb62685cf42_pexels_vernalyn_943927.jpg', 'Verna'),
(418, 134, 'images/uploads/68eb62685d3d3_snapins_ai_3012267636089473895_1.jpg', '@doc_dlp'),
(419, 135, 'images/uploads/68eb686feae7d_DSC_0543.jpg', 'Ilocos Norte Tourism Office'),
(420, 135, 'images/uploads/68eb686feb606_IMG_7637.jpg', 'The Bern Traveler'),
(421, 135, 'images/uploads/68eb686febd03_Sandboarding.jpg', 'Ilocos Norte Tourism Office'),
(422, 136, 'images/uploads/68eb6fd916816_4_2.jpg', 'niel'),
(423, 136, 'images/uploads/68eb6fd916e45_8.jpg', 'niel');

-- --------------------------------------------------------

--
-- Table structure for table `spot_info`
--

CREATE TABLE `spot_info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `overview` text DEFAULT NULL,
  `region` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `things_to_do` text DEFAULT NULL,
  `operating_hours` text DEFAULT NULL,
  `nearby_accommodations` text DEFAULT NULL,
  `nearby_restaurants` text DEFAULT NULL,
  `contact_information` text DEFAULT NULL,
  `official_links` text DEFAULT NULL,
  `transportation` text DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `safety_level` enum('safe','caution','dangerous') DEFAULT 'safe',
  `annual_visitors` int(11) DEFAULT 0,
  `featured` tinyint(1) DEFAULT 0,
  `local_languages` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spot_info`
--

INSERT INTO `spot_info` (`id`, `name`, `category`, `image`, `overview`, `region`, `province`, `municipality`, `things_to_do`, `operating_hours`, `nearby_accommodations`, `nearby_restaurants`, `contact_information`, `official_links`, `transportation`, `latitude`, `longitude`, `safety_level`, `annual_visitors`, `featured`, `local_languages`) VALUES
(119, 'Binondo Chinatown', 'Urban & Nightlife', NULL, 'Binondo is the oldest Chinatown in the world, established in 1594 by Spanish colonizers as a settlement for Catholic Chinese immigrants. Over centuries, it has become a lively cultural & commercial district in Manila mixing Chinese and Filipino traditions, historic churches, temples, traditional shops, food stalls, and narrow alleys lined with businesses that reflect both heritage and daily life.', 'NCR', 'Manila', 'Manila', 'Dining: Explore Chinese-Filipino cuisine through food crawls, hopia bakeries, and dumpling houses .\nShopping: Visit Ongpin Street for jewelry shops, herbal medicine stores, and feng shui supplies .\nCultural & Heritage Visits: Discover Binondo Church (Minor Basilica of St. Lorenzo Ruiz) for its architecture and religious significance .\nLeisure & Recreation: Walk along Ongpin and Escolta Streets to experience heritage buildings and vibrant local life.\nFestivals & Events: Celebrate Chinese New Year and other community festivities with parades and cultural performances .', 'General Hours: 8:00 AM – 9:00 PM\nNotes: Hours vary by shop, restaurant, and attraction; many establishments open earlier in the morning.', 'Hotel Lucky Chinatown: https://www.hotelluckychinatown.com\nPristine Hotel: https://pristine.manilahotelsweb.com/en/\nRedDoorz Plus @ Chinatown Binondo: https://www.reddoorz.com/en-ph/hotel/philippines/manila/binondo/296/reddoorz-plus-chinatown-binondo?check_in_date=10-10-2025&check_out_date=11-10-2025&rooms=1&sort_by=popular&order_by=desc&reddoorz_type=all&rank=11&source_page=listing&gad_source=1&gad_campaignid=22216058855&gbraid=0AAAAADLHh6FTI-az7F1u5KKWH3_E_CRKQ\nRamada by Wyndham Manila Central: https://www.wyndhamhotels.com/ramada/manila-philippines/ramada-manila-central/overview \nDela Chambre Hotel: https://delachambre.hotel-manila.com', 'Sincerity Cafe & Restaurant: https://www.facebook.com/sincerityrestaurant.main/\nPresident Grand Palace Restaurant: https://www.facebook.com/presidentgrandpalacerestaurant/\nWai Ying Fastfood: https://www.facebook.com/waiyingfastfoodbinondo/\nQuick Snack: https://www.facebook.com/QuikSnackPH/\nCafe Mezzanine: https://www.facebook.com/CafeMezzanine/\nThe Original Shanghai Fried Siopao: https://www.facebook.com/ShanghaiFriedSiopao/\nLam Dynasty Restaurant: https://www.facebook.com/Lam.Restaurant/', 'Manila Tourism and Cultural Affairs Bureau: +63 (2) 8527-7889 local 1114', 'https://manila.gov.ph/tourism/', 'Trains: Nearest station is Carriedo (LRT Line 1), approx. 15 minute walk.\nBuses: Served by city buses passing through Manila central districts.\nJeepneys: Numerous routes connect Binondo with Divisoria, Quiapo, and other nearby areas.\nTricycles / Pedicabs: Widely available for short trips within side streets.\nTaxis: Taxis and ride-hailing apps (Grab, Angkas) readily available, though traffic is heavy.\nPrivate Vehicle: Limited parking; area prone to congestion.\nOn Foot: Best explored by walking due to narrow streets and dense pedestrian activity.\nNotes: Heavy traffic is common; walking or light vehicles may be faster.', '14.60060400', '120.98153100', 'caution', 946943, 1, 'Filipino, English, Hokkien, Mandarin'),
(120, 'Escolta Street', 'Urban & Nightlife', NULL, 'Escolta Street is one of Manila’s oldest and most historically significant thoroughfares. Established in 1594, its name comes from the Spanish word escoltar (“to escort”), reflecting its early role as a path needing protection. Over time, Escolta grew into a premier commercial and architectural hub, famous for its elegant boutiques, department stores, theaters, and its role in the Manila-Acapulco galleon trade. \nIn its golden age (late 19th to mid-20th century), Escolta was the center of business in Manila, housing modern buildings (for the time), the Manila Stock Exchange, luxury amenities such as Manila’s first ice cream parlor, and being serviced by the electric tram line.\nSince about the 1960s, many businesses shifted to other districts (especially Makati), leading to a decline. But in recent years there has been revival efforts: heritage conservation, arts and creative spaces, festivals, cafés, and walking tours have been making Escolta vibrant again.', 'NCR', 'Manila', 'Manila', 'Heritage / Architecture Walks: Admire well-preserved buildings like the First United Building, Don Roman Santos Building, Burke Building, Calvo Building, and more.\nCultural / Creative Spaces: The street has seen revival via arts / creative communities: galleries, coworking spaces in old buildings, Bazaars, block parties (e.g. #SelfiEscolta). \nFood / Dining: Local eateries, cafés, small restaurants; some heritage food places and dessert shops. \nWalking / Photowalks: Because of its architecture, historic ambiance, choice for street/architecture photography. \nEvents / Festivals: Periodic block parties, art fairs, street-events to promote heritage awareness.', 'General Hours: 8:00 AM – 9:00 PM\nNotes: Many shops and creative spaces operate during typical business hours, with some cafés opening early and remaining open into the early evening, making daylight hours, particularly from morning to late afternoon. The best time to visit for appreciating the architecture, exploring open establishments, and enjoying a safe, pleasant walk, while evenings offer a quieter ambience with fewer shops open.', 'Ramada by Wyndham Manila Central: https://www.wyndhamhotels.com/ramada/manila-philippines/ramada-manila-central/overview\nRed Planet Manila Binondo: https://www.redplanethotels.com/hotel/binondo-manila \nHotel Lucky Chinatown: https://www.hotelluckychinatown.com/', 'Uno Seafood Wharf Palace: https://www.facebook.com/p/Uno-Seafood-Wharf-Palace-100063644786540/\nMutsarap Fried Chicken: https://www.facebook.com/mutsarap/\nNine to Six Grilled Food House: https://www.facebook.com/p/Nine-to-six-grilled-food-house-61552147795588/', 'Manila Tourism and Cultural Affairs Bureau: +63 (2) 8527-7889 local 1114', 'manila.gov.ph', 'Air Transport: Ninoy Aquino International Airport (NAIA) serves as the main gateway to Metro Manila. Escolta is approximately 12 km away and can be reached by taxi, private car, or ride-hailing services in around 30–40 minutes, depending on traffic.\nWater Transport: The Pasig River Ferry Service stops at Escolta Station, offering a scenic and practical route connecting Escolta to other districts such as Intramuros, Guadalupe, and Pasig City. Operating hours are typically from 6:00 AM – 6:00 PM (Monday to Saturday).\nTrains: The LRT-1 Line via Carriedo Station is the nearest rail access point, located a short walk from Sta. Cruz Church toward Escolta Street. The PNR Tutuban Station also connects to the area for travelers from southern Metro Manila.\nBuses: City buses and UV Express vans ply major roads leading to Sta. Cruz, Lawton, and Recto, where passengers can easily transfer to a jeepney or walk to Escolta.\nJeepneys: Frequent jeepneys run routes between Divisoria, Quiapo, Intramuros, and Sta. Cruz, passing near Escolta. Common drop-off points include Sta. Cruz Church and Jones Bridge.\nTaxis: Widely available throughout Manila. Travel time varies depending on traffic congestion, especially during rush hours.\nTricycles / Trikes: Available for short transfers between nearby streets and establishments but limited to smaller lanes.\nRide-Hailing Services: Grab and JoyRide / Angkas provide convenient, direct transport to Escolta and nearby areas.\nNotes: Due to limited parking and frequent congestion, walking remains the most efficient way to explore Escolta’s heritage buildings and nearby attractions.', '14.59778300', '120.97849500', 'caution', 946943, 0, 'Filipino, English, Hokkien, Mandarin'),
(121, 'Intramuros', 'Urban & Nightlife, Arts & Culture', NULL, 'Intramuros is the historic, walled district in the heart of Manila, founded by Spanish colonizers in 1571. The name means “within the walls.” Over centuries it has served as the center of colonial government, religion, education, and trade in the Spanish East Indies. It was heavily damaged during WWII, but many of its walls, churches, plazas, and colonial-era structures have since been restored. Today it\'s a major heritage tourism destination, combining walking tours, museums, religious sites, plazas, and events.', 'NCR', 'Manila', 'Manila', 'Cultural & Heritage Visits: Explore Fort Santiago, San Agustin Church (UNESCO World Heritage Site), Manila Cathedral, Casa Manila Museum, and the walls and bastions of Intramuros.\nMuseums & Education: Visit Bahay Tsinoy, the National Commission for Culture and the Arts Gallery, and Museo de Intramuros to learn about Philippine history and art.\nDining: Enjoy traditional and fusion cuisine at Barbara’s Heritage Restaurant, Ilustrado Restaurant, and Belfry Café overlooking historic landmarks.\nLeisure & Recreation: Experience a bamboo bike (Bambike) tour or walk through cobblestone streets to admire restored colonial-era buildings.\nFestivals & Events: Participate in cultural performances and religious processions during Holy Week, Intramuros Open House, and heritage month celebrations.', 'General Hours: 7:00 AM – 9:00 PM (estimated average operating period for most attractions)\nNotes: Some museums and attractions operate on individual schedules, often closing by 6:00 PM; restaurants and bars within the area remain open later, especially on weekends.', 'The Bayleaf Intramuros: https://www.thebayleaf.com.ph\nWhite Knight Hotel Intramuros: https://www.whiteknighthotelintramuros.com\nRedDoorz near SM Manila: https://www.reddoorz.com/en-ph/hotel/philippines/manila/reddoorz-near-sm-manila\nManila Hotel: https://www.manila-hotel.com.ph\nHotel Indah Manila: https://www.booking.com/hotel/ph/indah-manila.en-gb.html', 'Barbara’s Heritage Restaurant: https://www.facebook.com/BarbarasHeritageRestaurant\nIlustrado Restaurant: https://www.facebook.com/ilustradorestaurant\nBelfry Café: https://www.facebook.com/belfrycafeph\nLa Cathedral Café: https://www.facebook.com/lacathedralcafeph\nPatio de Conchita: https://www.facebook.com/patiodeconchitaintramuros\nRistorante Delle Mitre: https://www.facebook.com/ristorantedellemitre', 'https://intramuros.gov.ph', 'https://intramuros.gov.ph', 'Air Transport: Ninoy Aquino International Airport (NAIA) serves as the main domestic and international gateway to Metro Manila. It is approximately 10 km from Intramuros and accessible by taxi, private car, or ride-hailing services.\nWater Transport: The Pasig River Ferry Service stops at Plaza Mexico Station in Intramuros, providing scenic river travel between key Manila districts such as Escolta, Guadalupe, and Santa Ana. The Port of Manila (North Harbor) also serves inter-island ferries and RORO vessels connecting Luzon, Visayas, and Mindanao.\nTrains: The Light Rail Transit Line 1 (LRT-1) via Central Terminal Station serves Intramuros, while the Philippine National Railways (PNR) Tutuban Station connects to nearby districts such as Binondo, Paco, and Alabang.\nBuses: City buses traveling along Padre Burgos Avenue and Lawton provide connections between Intramuros, Ermita, Pasay, and Quezon City.\nJeepneys: Public jeepneys operate regular routes linking Intramuros to Quiapo, Divisoria, Binondo, and Taft Avenue.\nTaxis: Taxis are widely available throughout Manila and can directly access Intramuros via Padre Burgos Avenue and Bonifacio Drive.\nTricycles / Trikes: Tricycles operate on the outer perimeter and nearby areas such as the Manila City Hall and Lawton for short-distance travel.\nRide-Hailing Services: Grab (car) and JoyRide / Angkas (motorcycle) operate extensively around Intramuros for convenient point-to-point transport.\nNotes:Traffic around the walled city can be heavy during rush hours; walking or cycling remains one of the best ways to explore its heritage sites.', '14.59053300', '120.97605900', 'safe', 2200000, 0, 'Filipino, English'),
(122, 'Rizal Park', 'Urban & Nightlife, Arts & Culture', NULL, 'Rizal Park, also known as Luneta, is one of Manila’s largest and most iconic urban parks (~58 hectares), a landmark of national heritage.  It is the final resting place of national hero Dr. José Rizal, and hosts several monuments, gardens (e.g. Japanese Garden, Chinese Garden, Noli Me Tangere Garden), open-plaza spaces, and a large central musical/dancing fountain. It’s highly frequented by locals and tourists for recreation, walks, history, culture, and national ceremonies.', 'NCR', 'Manila', 'Manila', 'Cultural & Heritage Visits: Visit the Rizal Monument, Kilometer Zero, Quirino Grandstand, and the Independence Flagpole; explore historical markers that commemorate significant national events.\nMuseums & Education: Tour the National Museum of Fine Arts, National Museum of Natural History, and National Museum of Anthropology located around the park to learn about Filipino art, culture, and science.\nDining: Enjoy local and international cuisine at nearby restaurants such as Ilustrado, Ristorante Delle Mitre, and street food kiosks serving traditional Filipino snacks like taho and fish balls.\nLeisure & Recreation: Stroll along landscaped gardens, visit the Japanese and Chinese Gardens, watch the Musical Dancing Fountain show, or relax in shaded picnic areas.\nFestivals & Events: Attend national celebrations such as Independence Day, Rizal Day, and other cultural programs held at the Open-Air Auditorium and Quirino Grandstand.', 'General Hours: 5:00 AM – 10:00 PM\nNotes: Some attractions within the park, such as museums and gardens, may have separate operating schedules and minimal entrance fees.', 'The Manila Hotel: https://themanilahotel.com\nThe Bayleaf Intramuros: https://thebayleaf.com.ph\nCity Garden Suites Manila: https://citygardensuites.com\nManila Lotus Hotel: https://manilalotus.com\nRizal Park Hotel: https://www.rizalparkhotelmanila.com/\nLuneta Hotel: https://luneta-hotel.getmanilahotels.com/en/\nBayview Park Hotel Manila: https://bayviewparkhotel.com/', 'Ilustrado Restaurant — https://www.ilustradorestaurant.com.ph\nRistorante Delle Mitre: https://www.facebook.com/ristorantedellemitre\nBarbara’s Heritage Restaurant: https://barbarasrestaurantandevents.com\nLido Cocina Tsina: https://www.facebook.com/LidoCocinaTsina/\nGolden Fortune: https://goldenfortuneseafood.com/', 'www.npdc.gov.ph\n(02) 8880-4895', 'https://npdc.gov.ph', 'Air Transport: Ninoy Aquino International Airport (NAIA) is the main gateway for domestic and international flights to Metro Manila. Rizal Park is approximately 11 km away and accessible via taxi, private vehicle, or ride-hailing services.\nWater Transport: The Pasig River Ferry Service operates nearby stations at Lawton and Escolta, providing scenic connections from Pasig and Makati to central Manila districts close to Rizal Park.\nTrains: The LRT-1 line serves the United Nations Avenue Station, located within walking distance of the park, offering convenient access from Baclaran to Monumento.\nBuses: City buses along Taft Avenue, Roxas Boulevard, and Kalaw Avenue stop near Rizal Park, connecting to major Metro Manila routes.\nJeepneys: Jeepneys traveling along Taft Avenue, Kalaw Avenue, and Rizal Avenue provide accessible and affordable transport to the park area.\nTaxis: Widely available throughout Manila; recommended for direct access to park entrances.\nTricycles / Trikes: Motorized tricycles operate in nearby streets for short-distance transfers to park gates.\nRide-Hailing Services: Grab and JoyRide are available for efficient point-to-point travel within Metro Manila.\nNotes: Due to frequent road congestion, visiting during early morning or late afternoon is ideal for reduced travel time and comfortable park exploration.', '14.58342200', '120.98009300', 'caution', 5736180, 0, 'Filipino, English'),
(123, 'Kaparkan Falls', 'Nature & Wildlife, Hidden Wonders', NULL, 'Kaparkan Falls, also known as Mulawin Falls, is a multi-tiered waterfall in Barangay Caganayan, Tineg, Abra, known for its terraced limestone formations and crystal-clear spring pools. It is approximately 45 km from Bangued, the provincial capital, and is considered a hidden gem of Abra, offering a mix of natural beauty and adventure for visitors.', 'CAR', 'Abra', 'Tineg', 'Nature & Ecotourism: Trek through forest trails to reach Kaparkan Falls, swim in the natural limestone pools, and enjoy the scenic surroundings while appreciating the pristine ecosystem. \nCultural & Heritage Visits: Explore local barangays nearby to observe traditional crafts and rural life of Abra’s communities. \nLeisure & Recreation: Relax in nipa huts by the falls, have a picnic, and enjoy the tranquil sounds of cascading water.', 'General Hours: Weekends and holidays (due to local guides\' availability)\nVisitor Limits: Up to 100 visitors per batch, with a 3-hour time limit to ensure sustainability.', 'La Casa Taverner: https://abramazing.com/la-casa-taverner-san-juan/', '', 'lgu.tinegabra@gmail.com\n+63 995 344 6934\n+63 926 359 3623', 'https://www.lgutineg.com', 'Air Transport: The nearest major airport is Laoag International Airport in Ilocos Norte, approximately 150 km from Bangued, Abra. Domestic flights connect Laoag to Manila and other major Philippine cities. From Laoag, travelers may take a bus or van to Bangued and continue by land to reach Tineg.\nBuses: Inter-provincial buses and vans operate between Laoag, Bangued, and other northern Luzon destinations. Travelers may take a bus or van to Bangued, Abra, then transfer to local transport to reach Tineg.\nJeepneys: Jeepneys operate within Bangued and nearby towns but do not directly reach Tineg or Kaparkan Falls. Travelers may take jeepneys for short distances from Bangued to nearby barangays before trekking begins.\nTricycles / Trikes: Motorized tricycles are available within Bangued and nearby barangays for short-distance travel. Travelers can hire tricycles to reach jump-off points like Barangay Ba-i before trekking to Kaparkan Falls.\nNotes: The journey to Kaparkan Falls is challenging due to rugged terrain and limited transport infrastructure. It is highly recommended to hire a local guide or 4x4 transport from Barangay Ba-i for safe access. Walking and trekking remain essential to reach the falls themselves.', '17.59040000', '120.87500000', 'caution', 100, 1, 'Ilocano, Filipino'),
(124, 'Piwek Rock Formations', 'Nature & Wildlife, Adventure & Extreme Sports, Hidden Wonders', NULL, 'Piwek Rock Formations, located in Barangay Alaoa, Tineg, Abra, is a captivating natural attraction renowned for its gleaming white limestone cliffs and striking rock terraces along the Binongan River. These unique formations have been shaped over centuries through the slow deposition of minerals, resulting in a dramatic and photogenic landscape.\nThe site offers visitors an immersive experience in nature, combining opportunities for hiking, river trekking, and adventure activities such as cliff jumping. Although primarily celebrated for its geological features, Piwek is situated within the ancestral lands of the Tingguian people, an indigenous group whose cultural heritage and deep connection to the land add an additional layer of significance to the site. Visitors to Piwek Rock Formations can therefore appreciate both the awe-inspiring natural scenery and the rich cultural backdrop of Abra.', 'CAR', 'Abra', 'Tineg', 'Nature & Ecotourism: Embark on a scenic hike through rugged trails leading to the Piwek Rock Formations, offering panoramic views of the surrounding landscape. \nAdventure Sports: Experience the thrill of cliff jumping from heights of up to 11 meters into the cool, dark green waters of the Binongan River. \nRock Climbing: Challenge yourself with rock climbing over large boulders along the riverbanks, suitable for both beginners and seasoned climbers. \nPhotography: Capture the stunning contrast of the white limestone formations against the lush greenery and clear waters, perfect for landscape and nature photography. \nCultural Engagement: Interact with local guides and community members to learn about the history and significance of the site, as well as local traditions and practices.', 'Operating Hours: General Hours: 8:00 AM – 4:00 PM\nNotes: Visits to Piwek Rock Formations are best scheduled during the dry season (March to May) to ensure safer trekking conditions. It is advisable to hire local guides for navigation and safety. Advance arrangements are recommended, as access is limited and dependent on weather conditions.', 'La Casa Taverner: https://abramazing.com/la-casa-taverner-san-juan/', '', 'lgu.tinegabra@gmail.com\n+63 995 344 6934\n+63 926 359 3623', 'https://www.lgutineg.com/', 'Air Transport:\nThe nearest major airport is Laoag International Airport in Ilocos Norte, approximately 150 km from Bangued, Abra. From Laoag, travelers can take a bus or van to Bangued and then proceed to Tineg.\nBuses: Inter-provincial buses and vans operate between Laoag, Bangued, and other northern Luzon destinations. Travelers may take a bus or van to Bangued, Abra, then transfer to local transport to reach Tineg.\nJeepneys: Jeepneys operate within Bangued and nearby towns but do not directly reach Tineg or Piwek Rock Formations. Travelers may take jeepneys for short distances from Bangued to nearby barangays before trekking begins.\nTricycles / Trikes: Motorized tricycles are available within Bangued and nearby barangays for short-distance travel. Travelers can hire tricycles to reach jump-off points like Barangay Ba-i before trekking to Piwek Rock Formations.\nNotes: The journey to Piwek Rock Formations is challenging due to rugged terrain and limited transport infrastructure. It is highly recommended to hire a local guide or 4x4 transport from Barangay Ba-i for safe access. Walking and trekking remain essential to reach the formations themselves.', '17.54860000', '120.89890000', 'safe', 750, 0, 'Ilocano, Filipino'),
(125, 'Kili Falls & Hot Spring', 'Nature & Wildlife, Hidden Wonders', NULL, 'Kili Falls and Hot Spring, located in Barangay Kili, Tubo, Abra, is a captivating natural attraction known for its unique combination of a powerful waterfall and a natural hot spring. The falls cascade into a clear, cool river, creating a misty ambiance that adds to the site\'s allure. Adjacent to the falls, a natural hot spring flows into a man-made spa pool, offering visitors a relaxing experience amidst the rugged landscape. The journey to Kili involves traversing scenic rice terraces and crossing hanging bridges, providing a glimpse into the rural life of the Maeng Tribe. This destination is ideal for nature enthusiasts seeking both adventure and relaxation.', 'CAR', 'Abra', 'Tubo', 'Waterfall Exploration: Witness the powerful cascade of Kili Falls and enjoy a refreshing swim in its deep blue natural pool.\nHot Spring Soak: Relax in the man-made spa pool where warm water seeps from adjacent rocks, offering a natural sauna experience.\nTrekking & Hiking: Embark on scenic hikes through rice fields and over hanging bridges, similar to those found in Banaue, Ifugao, or Benguet.\nKayaking & Bamboo Rafting: Engage in water activities like kayaking and bamboo rafting along the Utip River, providing a unique perspective of the surrounding landscape.\nFishing: Try your hand at fishing in the nearby river, where locals often fish, adding to the authentic rural experience.', 'General Hours: Accessible year-round; best visited during the dry season (December to May) for optimal trail conditions.\nNotes: The area is remote, it\'s advisable to visit with a local guide.', '', '', 'dapayditubo@gmail.com\ninfo@tuboabra.gov.ph\n+63917-157-7101', 'https://www.tuboabra.gov.ph', 'Air Transport: The nearest major airport is Laoag International Airport, serving both domestic and limited international flights. The airport is approximately 200 km from Tubo and accessible by private car, bus, or ride-hailing services.\nBuses: Intercity buses operate from Manila and other major cities to Bangued, Abra. From Bangued, passengers may take jeepneys to Tubo.\nJeepneys: Public jeepneys connect Bangued to Tubo, serving local routes for commuters and travelers.\nTricycles / Trikes: Motorized tricycles are available for short-distance travel within Tubo and for trips to Barangay Kili from the town proper.\nNotes: Due to the remote location and rugged terrain, walking remains the most practical way to explore the immediate area around Kili Falls and Hot Spring.', '17.62340000', '120.84560000', 'safe', 1250, 0, 'Ilocano, Filipino'),
(126, 'Vigan Heritage Village', 'Urban & Nightlife, UNESCO Sites', NULL, 'Vigan Heritage Village, located in Vigan City, Ilocos Sur, is a UNESCO World Heritage Site inscribed in 1999. Recognized as the best-preserved example of a planned Spanish colonial town in Asia, Vigan showcases a unique blend of Filipino, Chinese, European, and Mexican architectural influences. The town\'s layout, featuring cobblestone streets and ancestral houses, reflects the cultural fusion that defines its heritage.', 'Region-1', 'Ilocos Sur', 'Vigan City', 'Cultural & Heritage Tourism: Visit ancestral homes, heritage museums (e.g., Crisologo Museum), churches (St. Paul’s Cathedral), and historical landmarks; participate in local festivals like the Vigan Longganisa Festival; attend workshops on pottery, weaving, and traditional crafts.\nNature & Ecotourism: Walking tours along cobblestone streets and riverbanks; nearby parks and plazas for relaxation.\nLeisure, Wellness & Entertainment: Strolling along Calle Crisologo, shopping for local crafts, visiting cafes and lounges.\nEvents, MICE & Cultural Festivals: Attend fairs, cultural shows, and local festivals.\nEducational / Learning Tourism: Guided tours on Spanish colonial history, heritage conservation, and local crafts.', 'General Hours: Most attractions are open daily 6:00 AM – 9:00 PM.\nNotes: Hours may vary during festivals or special events; it\'s advisable to check local listings for specific timings.', 'Cordillera Inn: https://www.facebook.com/cordillerainnvgncity/\nCiudad Fernandina Hotel: https://www.ciudadfernandinavigan.com.ph/\nLa Casa Blanca Hotel Vigan City: https://lacasablancadeviganhotel.com/index.php/en/\nWest Loch Park Hotel Vigan: https://ph.hotels.com/ho1264823648/west-loch-park-hotel-vigan-vigan-philippines/\nEscolta\'s Homey Lodge: https://www.facebook.com/escoltashomeyvigan1572/\nHotel Luna: https://hotelluna.ph/home', 'La Birrieria de Vigan: https://www.facebook.com/p/La-Birrieria-de-Vigan-100093358223074/\nCafe Evelyn: https://www.facebook.com/cafeevelynvigancity/\nAbuelita’s: https://www.facebook.com/abuelitasvigan/\nCantina Mercante: https://wanderlog.com/place/details/10840729/cantina-mercante', 'tourism@vigancity.gov.ph\n(077) 722-2740\n(077) 722-8772', 'https://vigancity.gov.ph/#', 'Air Transport: Laoag International Airport (~80 km north) is the closest airport, accessible via bus or private vehicle. Clark International Airport (~350 km south) and Ninoy Aquino International Airport (Manila) are alternatives for international arrivals.\nBuses: Public and tourist buses connect Vigan to Manila, Laoag, and nearby provinces. Local jeepneys provide short-distance travel within town.\nJeepneys: Operate along main streets connecting Vigan town proper to neighboring barangays.\nTaxis: Available for point-to-point travel within Vigan city.\nTricycles / Trikes: Operate extensively within the heritage village and nearby barangays; ideal for short trips and alley access.\nRide-Hailing Services: Grab is partially available within Vigan for point-to-point transport.\nNotes: The cobblestone streets are best explored on foot or by horse-drawn kalesa. Vehicles are restricted in some heritage zones to preserve the town’s historic character.', '17.56775400', '120.38760400', 'safe', 56665, 0, ''),
(127, 'Batad Rice Terraces', 'Nature & Wildlife, Adventure & Extreme Sports, UNESCO Sites, Wellness Retreats and Leisure', NULL, 'Batad Rice Terraces, located in the municipality of Banaue, Ifugao Province, are part of the UNESCO World Heritage-listed Rice Terraces of the Philippine Cordilleras. These terraces are renowned for their amphitheater-like shape and are considered one of the most picturesque and well-preserved rice terraces in the Philippines. The terraces are still actively cultivated by the indigenous Ifugao people, showcasing an ancient and sustainable agricultural system.', 'CAR', 'Ifugao', 'Banaue', 'Cultural & Heritage Tourism: Visit Ifugao ancestral homes and heritage sites, participate in local rituals and festivals, and attend workshops on traditional crafts and weaving.\nNature & Ecotourism: Trekking and hiking along rice terraces and nearby mountain trails, wildlife and birdwatching, and visiting waterfalls.\nLeisure, Wellness & Entertainment: Leisure walks through the terraces, enjoying scenic viewpoints, and experiencing local culinary specialties.\nEducational / Learning Tourism: Learn about indigenous agricultural practices, terrace irrigation systems, and participate in guided cultural tours.', 'Operating Hours: 6:00 AM – 5:00 PM daily\nNotes: Trekking is safest during daylight. Local homestays may accommodate early arrivals or late departures with prior arrangement.', 'Batad View Inn and Restaurant: https://www.facebook.com/p/Batad-View-Inn-and-Restaurant-100054591153052/\nBatad Pension and Restaurant: https://www.facebook.com/batadpensionph/', 'Batad View Inn and Restaurant: https://www.facebook.com/p/Batad-View-Inn-and-Restaurant-100054591153052/\nBatad Pension and Restaurant: https://www.facebook.com/batadpensionph/', 'https://www.facebook.com/BanaueMunicipalTourismOffice/', 'https://www.facebook.com/BanaueMunicipalTourismOffice/', 'Air Transport: The closest major airport is Loakan Airport (Baguio), approximately 160 km from Banaue, accessible via private vehicle or bus. Travelers may also fly into Manila’s Ninoy Aquino International Airport (NAIA) and take a 9–10 hour bus ride to Banaue.\nBuses: Daily buses and vans operate from Baguio and Manila to Banaue, with travel times of approximately 6–7 hours from Baguio and 9–10 hours from Manila.\nJeepneys / Vans: Local jeepneys or vans connect Banaue town proper to Batad village, usually 1–2 hours via mountainous roads.\nTricycles / Trikes: Motorized tricycles operate for short-distance travel within Batad village and from drop-off points along main roads to terrace trails.\nNotes: Due to rough mountain roads and narrow footpaths, walking remains the most efficient way to explore Batad Rice Terraces. Travelers should prepare for steep hikes and limited vehicle access.', '16.78330000', '121.06670000', 'safe', 42793, 0, 'Ifugao, Tuwali, Kalanguya, Ilocano, Filipino'),
(128, 'Nagacadan Rice Terraces', 'Nature & Wildlife, Adventure & Extreme Sports, UNESCO Sites, Wellness Retreats and Leisure', NULL, 'The Nagacadan Rice Terraces are a UNESCO World Heritage Site and one of the five clusters that make up the Rice Terraces of the Philippine Cordilleras. Located in Kiangan, Ifugao, these terraces are renowned for their amphitheater-like formation, carved into a scenic valley and flanking a picturesque river. The terraces are a testament to the Ifugao people\'s ingenuity, showcasing a harmonious blend of agricultural practices and cultural traditions that have been passed down through generations.', 'CAR', 'Ifugao', 'Kiangan', 'Cultural & Heritage Tourism: Visit ancestral homes and heritage sites in Kiangan, participate in local rituals and festivals, and attend workshops on weaving, handicrafts, and folklore.\nNature & Ecotourism: Trekking and hiking along rice terraces, birdwatching and wildlife observation, visiting nearby waterfalls, and nature trails.\nCruise & Nautical / Marine Tourism: Not applicable.\nLeisure, Wellness & Entertainment: Leisure walks and scenic viewpoints within the terraces, tasting local culinary specialties.\nEvents, MICE & Cultural Festivals: Participate in local festivals or rituals; small seasonal events may occur.\nEducational / Learning Tourism: Guided tours on traditional terrace irrigation systems and rice farming practices, environmental education.\nHealth & Wellness / Retirement Tourism: Relaxing stays in local inns with terrace views.\nSports, Adventure & Active Tourism: Hiking and mountain trekking along terraces and trails.', 'Operating Hours: 6:00 AM – 5:00 PM daily\nNotes: Trekking is safest during daylight. Local homestays may accommodate early arrivals or late departures with prior arrangement.', '', '', 'visitkiangan@outlook.com\n0920 467 1020', 'https://visitkiangan.wordpress.com', 'Air Transport: The closest major airport is Loakan Airport (Baguio), approximately 160 km from Kiangan, accessible via bus or private vehicle. Travelers may also fly into Manila’s Ninoy Aquino International Airport (NAIA) and take a 9–10 hour bus ride to Kiangan.\nBuses: Daily buses and vans operate from Baguio and Manila to Kiangan, with travel times of roughly 6–7 hours from Baguio and 9–10 hours from Manila.\nJeepneys / Vans: Local jeepneys or vans connect Kiangan town proper to Nagacadan terraces, usually a 30–60 minute ride along mountainous roads.\nTricycles / Trikes: Motorized tricycles operate within Kiangan town and short distances to terrace entry points.\nNotes: Due to narrow footpaths and steep mountain trails, walking remains the most efficient way to explore the terraces. Travelers should prepare for physical activity and limited vehicle access.', '16.75000000', '121.10000000', 'safe', 42793, 0, 'Ifugao, Tuwali, Kalanguya, Ilocano, Filipino'),
(129, 'Hungduan Rice Terraces', 'Nature & Wildlife, Adventure & Extreme Sports, UNESCO Sites, Wellness Retreats and Leisure', NULL, 'The Hungduan Rice Terraces, part of the UNESCO World Heritage-listed Rice Terraces of the Philippine Cordilleras, are located in Hungduan, Ifugao Province. These terraces are renowned for their scenic beauty and traditional Ifugao agricultural practices. The area offers a more tranquil and less commercialized experience compared to other terraces in the region.', 'CAR', 'Ifugao', 'Hungduan', 'Cultural & Heritage Tourism: Visit ancestral homes and heritage sites, participate in local rituals and festivals, and attend workshops on weaving, handicrafts, and folklore.\nNature & Ecotourism: Trekking and hiking along terraces and surrounding mountain trails, birdwatching and wildlife observation, visits to nearby waterfalls, and conservation walks.\nCruise & Nautical / Marine Tourism: Not applicable.\nLeisure, Wellness & Entertainment: Scenic walks, enjoying panoramic viewpoints, and tasting local culinary specialties.\nEvents, MICE & Cultural Festivals: Participation in local rituals or small cultural events, seasonal festivals.\nEducational / Learning Tourism: Guided tours on terrace irrigation systems, sustainable rice farming, and environmental education.\nHealth & Wellness / Retirement Tourism: Relaxing stays at local lodges or guesthouses with terrace views.\nSports, Adventure & Active Tourism: Hiking, trekking, and trail walking along terraces and surrounding mountains.', 'Operating Hours: 6:00 AM – 5:00 PM daily\nNotes: Trekking is safest during daylight. Local homestays may accommodate early arrivals or late departures with prior arrangement.', 'Native Village Inn: https://www.facebook.com/NativeVillageInn/', 'Native Village Inn: https://www.facebook.com/NativeVillageInn/', 'lguhungduanifugao@rocketmail.com\nhttps://www.facebook.com/localgovernmentunitofhungduan', 'https://hungduan.gov.ph', 'Air Transport: The closest airport is Loakan Airport (Baguio), approximately 180 km from Hungduan, accessible via bus or private vehicle. Travelers may also fly into Manila’s Ninoy Aquino International Airport (NAIA) and take a 10–11 hour bus ride to Hungduan.\nBuses: Daily buses and vans operate from Baguio and Manila to Hungduan, with travel times of roughly 6–7 hours from Baguio and 10–11 hours from Manila.\nJeepneys / Vans: Local jeepneys or vans connect Hungduan town proper to terrace access points, usually a 30–60 minute ride via mountainous roads.\nTricycles / Trikes: Motorized tricycles operate within Hungduan town and for short distances to terrace entry points.\nNotes: Due to narrow footpaths and steep mountain trails, walking remains the most efficient way to explore Hungduan Rice Terraces. Travelers should prepare for physical activity and limited vehicle access', '16.81670000', '121.05000000', 'safe', 42793, 0, 'Ifugao, Tuwali, Kalanguya, Ilocano, Filipino'),
(131, 'Hinugtan Beach', 'Beaches & Islands, Adventure & Extreme Sports, Wellness Retreats and Leisure, Hidden Wonders', NULL, 'Hinugtan Beach is a secluded white sand beach located in Buruanga, Aklan. It is known for its tranquil atmosphere, powdery sand, and clear turquoise waters, making it ideal for visitors seeking a peaceful coastal retreat. The area offers a glimpse of natural coastal beauty, with nearby mangroves, coral reefs, and scenic landscapes perfect for relaxation, nature appreciation, and light adventure activities.', 'Region-6', 'Aklan', 'Buruanga', 'Beach Activities: Swimming, sunbathing, and beach sports.\nNature & Ecotourism: Explore nearby mangroves and coral reefs; snorkeling and kayaking available.\nAdventure & Sports: Water-based activities like paddleboarding and light kayaking.\nLeisure & Relaxation: Relax in the serene environment and enjoy local seafood at nearby establishments.\nPhotography & Scenic Walks: Capture sunsets and coastal landscapes along the shore.', 'General Hours: Open daily; visitors can explore during daylight hours.\nNotes: Hours for specific accommodations and eateries vary; visitors are encouraged to check locally upon arrival.', 'Lorenza\'s Cottages:https://www.booking.com/hotel/ph/lorenzas-cottage.html?aid=304142&label=gen173nr-1FCAEoggI46AdIM1gEaJMCiAEBmAExuAEYyAEM2AEB6AEB-AECiAIBqAIEuALhyq6cBsACAdICJDRkNGNkMGVkLTRkYmYtNDQ1My1iNDcyLTI0NDRhMWI3MjI2NdgCBeACAQ&sid=020c516ebdc43e8c6d5f8040e0422e11&all_sr_blocks=906063401_361694812_2_0_0;checkin=2022-12-04;checkout=2022-12-07;dest_id=-2416994;dest_type=city;dist=0;group_adults=2;group_children=0;hapos=1;highlighted_blocks=906063401_361694812_2_0_0;hpos=1;matching_block_id=906063401_361694812_2_0_0;no_rooms=1;req_adults=2;req_children=0;room1=A%2CA;sb_price_type=total;sr_order=popularity;sr_pri_blocks=906063401_361694812_2_0_0__833085;srepoch=1670096339;srpvid=34098a28e54601a2;type=total;ucfs=1&chal_t=1760118517470&force_referer=#hotelTmpl\nWhite Beach Front and Cottages Hinugtan Resort: https://www.facebook.com/whitebeachfronthinugtanresort/\nTuburan Cove Beach Resort: https://tuburancove.com', 'Lorenza\'s Cottages: https://www.booking.com/hotel/ph/lorenzas-cottage.html?aid=304142&label=gen173nr-1FCAEoggI46AdIM1gEaJMCiAEBmAExuAEYyAEM2AEB6AEB-AECiAIBqAIEuALhyq6cBsACAdICJDRkNGNkMGVkLTRkYmYtNDQ1My1iNDcyLTI0NDRhMWI3MjI2NdgCBeACAQ&sid=020c516ebdc43e8c6d5f8040e0422e11&all_sr_blocks=906063401_361694812_2_0_0;checkin=2022-12-04;checkout=2022-12-07;dest_id=-2416994;dest_type=city;dist=0;group_adults=2;group_children=0;hapos=1;highlighted_blocks=906063401_361694812_2_0_0;hpos=1;matching_block_id=906063401_361694812_2_0_0;no_rooms=1;req_adults=2;req_children=0;room1=A%2CA;sb_price_type=total;sr_order=popularity;sr_pri_blocks=906063401_361694812_2_0_0__833085;srepoch=1670096339;srpvid=34098a28e54601a2;type=total;ucfs=1&chal_t=1760118517470&force_referer=#hotelTmpl\nWhite Beach Front and Cottages Hinugtan Resort: https://www.facebook.com/whitebeachfronthinugtanresort/\nTuburan Cove Beach Resort: https://tuburancove.com', 'buruanga.gov.ph@gmail.com', 'https://buruanga.gov.ph/tourism/natural-tourist-attractions/', 'Air Transport: Hinugtan Beach is accessible via Caticlan Airport (Godofredo P. Ramos Airport), about 12 km away, which handles domestic flights including routes from Manila, or via Kalibo International Airport, which serves both domestic and international flights with onward land transport to Caticlan.\nWater Transport: Visitors can reach Hinugtan Beach by small boat charters from Boracay or nearby coastal points, providing direct access to the beach.\nVan: Available from Caticlan to Buruanga; fares and schedules may vary.\nTricycle: Approximately ₱300–₱500; travel time around 30–45 minutes.', '11.86590700', '121.87786100', 'safe', 1500, 0, 'Aklanon, Malaynon, Hiligaynon, AtiKinaray-a, Onhan, Capiznon, Filipino, English'),
(132, 'Barasoain Church', 'Spiritual & Pilgrimage', NULL, 'Barasoain Church, officially known as Our Lady of Mount Carmel Parish, is a Roman Catholic church located in Malolos, Bulacan, Philippines. Established in 1859 and completed in 1888, it holds significant historical importance as the site of the First Philippine Congress and the inauguration of the First Philippine Republic in 1899. Often referred to as the \"Cradle of Democracy in the East,\" the church stands as a testament to the nation\'s fight for independence.', 'Region-3', 'Bulacan', 'Paombong', 'Cultural & Heritage Visits: Explore the church\'s rich history and architectural beauty. Visit the adjacent museums, including the 1899 Museum, to learn about the events that transpired during the Philippine Revolution. Engage in guided tours to gain deeper insights into the church\'s role in the nation\'s history.\nLeisure & Recreation: Participate in annual cultural events and celebrations held at the church, such as reenactments of historical events and religious processions, which immerse visitors in the vibrant traditions of Malolos. \nEducational / Learning Tourism: Attend workshops and lectures organized by the National Historical Commission of the Philippines (NHCP) to learn about the church\'s significance and the Malolos Constitution.', 'General Hours: Daily from 6:00 AM to 7:00 PM\nParish Office: Tuesdays to Sundays, 8:00 AM – 12:00 PM and 2:00 PM – 5:00 PM\nNHCP Museum: Tuesdays to Sundays, 8:00 AM – 4:00 PM\nNote: Operating hours may vary during holidays and special events.', '', 'Taverna by Bahay ni Tisa: https://www.facebook.com/TevernabyBNT/\nZarahemla: https://www.facebook.com/p/Zarahemla-Malolos-Branch-61561623192666/\nCentria Steak House: https://www.facebook.com/CentriaSteakHouse/\nHern\'s Ultimate Budbod: https://www.facebook.com/hernsultimatebudbodmalolosbranch/', 'Telephone Numbers: +63 (044) 794-4340 (Parish Office) / +63 (044) 794-1674 or +63 (044) 662-5725 (NHCP – Barasoain)\nEmail Address: contact@barasoainchurch.org (Parish Office) / barasoainmuseum@gmail.com (NHCP – Barasoain)', 'https://barasoainchurchofficial.wordpress.com/', 'Air Transport: There are no commercial airports in Malolos. The nearest major airport is Ninoy Aquino International Airport (NAIA) in Pasay City, approximately 60 km from Barasoain Church.\nBuses: City and provincial buses operate from Manila to Malolos via NLEX or MacArthur Highway.\nJeepneys: Public jeepneys serve routes within Malolos and nearby towns, offering affordable and accessible travel from main roads and terminals to the church.\nTricycles/Trikes: Tricycles are commonly used for short-distance travel within Malolos. Upon arriving at Malolos Crossing or nearby drop-off points, passengers can hire a tricycle to reach Barasoain Church.\nRide-Hailing Services: inDrive operates in Malolos, providing convenient point-to-point transport to and from Barasoain Church.\nNotes: Due to occasional traffic congestion, walking is recommended for exploring the central streets near Barasoain Church. Tricycles and ride-hailing services are ideal for connecting from bus stops, main roads, or nearby terminals.', '14.83565000', '120.78854100', 'caution', 123, 1, 'Filipino, English'),
(133, 'Biak-na-Bato National Park', 'Nature & Wildlife, Adventure & Extreme Sports', NULL, 'Biak-na-Bato National Park is a protected area in Bulacan, Philippines, known for both its natural beauty and historical significance. It was established in 1937 and served as the site of the Republic of Biak-na-Bato during the Philippine Revolution against Spanish colonial rule. The park features a rugged mountainous gorge, river systems, caves (including historic ones used by revolutionaries), waterfalls, and rich forest vegetation. It has many caves such as Aguinaldo Cave, Bat Cave (“Bahay Paniki”), and Tanggapan Cave, as well as natural features like Tilandong Falls and Madlum River. The place attracts ecotourists, hikers, history buffs, and weekend visitors from nearby Manila.', 'Region-3', 'Bulacan', 'San Miguel', 'Nature & Ecotourism: Trekking on trails to Mt. Manalmon, visiting caves such as Bayukbok, exploring forested areas, river crossings and gorge walks. Swimming or dipping in Madlum River; enjoying waterfalls like Tilandong Falls to cool off after hikes. \nCultural & Heritage Tourism: Visit historic caves such as Aguinaldo Cave, Hospital Cave, Tanggapan Cave, important during the Philippine Revolution, with markers and interpretation of the Biak-na-Bato Republic. \nSports, Adventure & Active Tourism: Cave exploration (spelunking), river trekking, scrambling/climbing rocky features and possibly hanging/brim bridges in certain parts; challenging terrain for hikers.\nEducational / Learning Tourism: Guided tours of natural history and ecology (flora, fauna, endemic species), conservation education, learning about geological formations, history of the revolution, possibly partnerships with universities.', 'General Hours: 8:00 AM to 5:00 PM daily \nNotes: Hours may be consistent year-round, but weather (rainy season) may affect accessibility especially to river crossings, cave entrances, and waterfalls. Guides are required for cave exploration. Entrance or guide fees may vary depending on number of caves visited.', 'LR Uphill Cabi: https://www.facebook.com/p/LR-Uphill-Cabin-61566335296193/\nParo-Paro Hill: https://www.facebook.com/paroparohill/\nMalapasan Hills Campsite: https://www.facebook.com/mapalasan/', 'Nihada Green Curve Cafe: https://www.facebook.com/NihadaGreenCurve/\nTila Pilon Hills Cafe by Kape Provincia: https://www.facebook.com/tilapiloncafe/', 'Protected Area Superintendent: pasu_r3_bnbnp@demo.com\nContact No. : (+63) 915-9915-739', 'https://fpe.ph/conservation_site/location_details/biak-na-bato-national-park\nhttps://nationalparksassociation.org/philippines-national-parks/biak-na-bato-national-park/', 'Air Transport: Nearest major airports are Ninoy Aquino International Airport (Manila) for domestic flights; users will need to travel by road from Manila (≈80 km northeast).\nBuses: Buses from Manila to San Miguel, Bulacan are available. After arrival, local transport needed (jeepney/tricycle) to the park entrance. \nJeepneys: Local jeepney routes serve San Miguel town proper; from drop-off points one may transfer via tricycle to reach the trailheads. \nTricycles / Trikes: Common for last-mile transport from San Miguel or village drop-offs to the park entrance or trail-heads; fares may be negotiated, often shared. \njustinvawter.com\nNotes: Be prepared for rough roads especially near barangays leading to trail starts; during rainy season some roads may become muddy or impassable. Going early in the morning helps avoid heat, traffic, and maximize daylight.', '15.11413500', '121.08255400', 'caution', 125000, 1, 'Filipino, English');
INSERT INTO `spot_info` (`id`, `name`, `category`, `image`, `overview`, `region`, `province`, `municipality`, `things_to_do`, `operating_hours`, `nearby_accommodations`, `nearby_restaurants`, `contact_information`, `official_links`, `transportation`, `latitude`, `longitude`, `safety_level`, `annual_visitors`, `featured`, `local_languages`) VALUES
(134, 'Burnham Park', 'Nature & Wildlife, Urban & Nightlife', NULL, 'Burnham Park is a historic urban park located at the heart of Baguio City, Philippines. Designed by American architect Daniel Hudson Burnham and established in 1925, it was part of the original plan for Baguio as a summer capital. The park covers about 32.84 hectares and features a man-made lagoon, formal gardens, open fields, playgrounds, and various recreational zones. It is a gathering place for locals and tourists alike for leisure, cultural events, exercise, and festivals (notably during Panagbenga). Its design reflects the City Beautiful movement and blends formal and informal landscaping.', 'CAR', 'Benguet', 'Baguio City', 'Nature & Ecotourism: Walking or jogging around the park paths, enjoying the lush gardens like Rose Garden, Orchidarium, Sunshine Park, Pine Trees of the World; enjoying fresh mountain air and greenery. \nLeisure, Wellness & Entertainment: Boat rides on Burnham Lagoon (paddleboats / swan boats), renting bicycles or chopper bikes/go-karts, skating in the skating rink, picnicking at picnic groves.\nCultural & Heritage Tourism: Visiting the Rose Garden with the bust of Daniel Burnham, the Avong Ibaloi Heritage Garden, Igorot Park; observing local events and festivals held in grandstand/open field (e.g. Panagbenga cultural shows) \nSports, Adventure & Active Tourism: Skating, playing sports (football, casual games) in open fields, exercise groups (zumba, walking) around the park; biking. \nEducational / Learning Tourism: Learning about flora (many trees, orchids), horticultural gardens, park history and city planning by Burnham, local culture of the Ibaloi people via heritage gardens.', 'General Hours: Open 24 hours daily \nNotes: However many of the service facilities (boat rentals, bike rentals, go-karts, skating rink, etc.) have limited operating hours (early morning to evening, e.g. ~6:00 AM to ~9:00-10:00 PM) depending on weather and daylight; some areas may close or have restricted access during heavy rain or special events.', 'G1 Lodge Design Hotel: https://g1lodge.com\nHotel Veniz Burnham: https://burnham.hotelveniz.com\nMetro Pines Inn: https://metropinesinn.luxhotels.club\nTravelite Express HOTEL: https://traveliteexpresshotel.com\nA Hotel Baguio: https://www.guestreservations.com/a-hotel-baguio/booking?utm_source=google&utm_medium=cpc&utm_campaign=990032393&gad_source=1&gad_campaignid=990032393&gbraid=0AAAAADiMQMbklJSjtjdDdhFpGkkEp1KLA', 'Café by the Ruins: https://www.facebook.com/cafebytheruinsph/\nCentral Park Restaurant: https://www.facebook.com/p/Central-Park-Restaurant-100063626202719/\nGOODTASTE RESTAURANT: https://www.facebook.com/gtrotekbaguiocity/\nJack\'s Baguio Restaurant: https://www.facebook.com/jackbaguiorestaurant.official/', 'Email: generalservicesofficebaguio@gmail.com\nContact No.: 620-1961/424-5148 or 0970-347-3419/0965-722-1185', 'https://new.baguio.gov.ph/tourist-spots/burnham-park\nhttps://new.baguio.gov.ph/burnham-park-office/about', 'Air Transport: Nearest major airport is Loakan Airport, Baguio (for small aircraft / domestic); most travelers fly into Manila or Clark and then travel by land to Baguio. \nBuses: There are numerous intercity buses from Manila, other Luzon provinces into Baguio’s bus terminals; from terminals one can take local transport or walk to Burnham Park. \nJeepneys: Local jeepney routes serve streets around the park (Session Road area, Kisad / Legarda), able to drop off near the park.\nTaxis: Readily available in Baguio City, can drop you close to the Burnham Park entrances; fares depend on distance and traffic, often metered.\nHailing Services: Grab is available in Baguio; other ride hail services may have limited availability or surge pricing during peak times. \nNotes: Parking inside or near the park is limited and difficult especially during weekends, holidays or evenings; using public transport or staying in nearby accommodation to walk is more practical. Weather in high elevation means mornings and evenings are cooler; afternoons may get damp or foggy; walking paths can be slippery when wet.', '16.41072100', '120.59469200', 'caution', 1310000, 0, 'Filipino, Ilocano, Kankanaey, Ibaloi'),
(135, 'Paoay Sand Dunes', 'Beaches & Islands, Adventure & Extreme Sports', NULL, 'Paoay Sand Dunes is a geological attraction in Ilocos Norte, Philippines, that spans roughly 88 square kilometers of wind-formed sand dunes. It is declared a national geological monument, lying in Barangay Suba in Paoay, expanding toward boundaries with Currimao and La Paz in Laoag City. The dunes are famous for adventure sports like 4×4 vehicle rides, ATV riding, and sandboarding, as well as for its dramatic landscapes used as backdrops in local and international films. Art installations such as mirror exhibits and solar-powered stone sculptures have been added to enhance visitor experiences. The best time to visit is during dry months (approximately December to May) when the terrain is safer and more photogenic.', 'Region-1', 'Ilocos Norte', 'Paoay', 'Sports, Adventure & Active Tourism: 4×4 Jeep or off-road rides—drive through sand ridges, steep slopes, sharp turns; these rides are often paired with photo stops and excitement. ATV (all terrain vehicle) rides—more relaxed and maneuverable way to explore dunes for those wanting less intense experience. Sandboarding—slide down sandy slopes using a board; suitable for beginners and more experienced alike. \nNature & Ecotourism: Watching sunrise or sunset over the sand dunes; scenic views and photography are highlights. \nCultural & Heritage Tourism: Visiting the art installations in the dunes (solar-powered stones, mirror exhibits) and learning about how the area has been used in films and local culture.', 'General Hours: 6:00 AM to 6:00 PM \nNotes: Best visited in dry season (December to May) when sand conditions are optimal; avoid midday when sun and heat are intense; some operators may adjust schedules due to weather or special events.', 'Pearl of the North: https://pearl-of-the-north.com/about-us/\nFort Ilocandia Resort Hotel: https://www.guestreservations.com/fort-ilocandia-resort-hotel/booking?utm_source=google&utm_medium=cpc&utm_campaign=22983735323&gad_source=1&gad_campaignid=22983735323&gbraid=0AAAAADiMQMYjOubKpzjbWP3lWVjsug8tg\nAmici Resort Hotel Laoag: https://www.agoda.com/amici-resort-hotel-laoag-h28723867/hotel/ilocos-norte-ph.html?cid=1844104&ds=lsDF7vDZSkSQ1DzM\nPlaza Del Norte Hotel And Convention Center: https://plaza-del-norte-laoag.hotel-rn.com', 'Frontera by Le Trésor: https://restaurantguru.com/Frontera-by-Le-Tresor-Laoag-City\nGui: https://www.facebook.com/p/Gui-61552936073598/\nOnda - Filipino Kitchen: https://www.facebook.com/ondafilipinokitchen/', 'Email: tourismilocosnorte@gmail.com\nContact No.: +63 (077) 772 1213/+63 908-810-8654 to 55', 'https://ilocosnorte.ph', 'Air Transport: Nearest airport is Laoag International Airport; from the airport, the sand dunes are about 20-30 minutes away by land transport. \nBuses: Intercity and provincial buses (e.g. from Manila to Laoag) go to Laoag City; from Laoag you take local transport to Paoay. \nJeepneys: Jeepney service exists between Laoag and Paoay, and local jeepneys/trikes may bring you toward barangay level or jump-off points. \nTricycles / Trikes: Common for last-mile travel from Laoag or Paoay proper to the dunes jump-off points; fares negotiable. \nNotes: Prepare for dusty, sandy roads; bring cash (many vendors may not accept card); wear sun protection, sturdy shoes; early morning or late afternoon is more comfortable; check weather forecast (avoid timing during rains or storms).', '18.05000000', '120.51670000', 'caution', 532000, 1, 'Ilocano, Filipino, English'),
(136, 'La Paz Sand Dunes', 'Beaches & Islands, Adventure & Extreme Sports', NULL, 'La Paz Sand Dunes is a large coastal sandy desert and beach area in Laoag City, Ilocos Norte, Philippines, covering approximately 85 square kilometers. It is declared a National Geological Monument and forms part of the Ilocos Norte Sand Dunes, stretching from Currimao to Pasuquin. The dunes offer dramatic undulating terrain that ranges from about 10 to 30 meters in height, with scenic views over the South China Sea. It’s popular for adventure tourism (4×4 rides, ATV, sandboarding) and for film shoots due to its striking scenery and proximity to Laoag. Best visited during dry months to avoid rain and maximize visibility and safety.', 'Region-1', 'Ilocos Norte', 'Laoag City', 'Sports, Adventure & Active Tourism: 4×4 off-road rides (“dune bashing”) across the dunes with steep slopes, sharp drops, and panoramic views. ATV rides (hourly rental) for those preferring more control and a different ride style. Sandboarding – sliding down sandy slopes either standing or sitting; good for both beginners and more experienced visitors. \r\nNature & Ecotourism: Enjoy scenic views of the coastline (West Philippine Sea), especially during sunrise or sunset; observe dunes morphology and coastal landscape. \r\nEvents, MICE & Cultural Festivals: Participate in or watch events such as the Laoag Sand Dunes Challenge (running events over dune terrain) which showcase sport tourism in the dunes setting.', 'General Hours: The area is open daily, with adventure-activity vendors operating approximately from 8:00 AM to 6:00 PM or until daylight allows. \r\n\r\nNotes: Activity availability depends on daylight and weather; rates may change; certain services (ATV, sandboarding, 4×4) may close earlier in low light or during rainy season. Visiting early morning or late afternoon is recommended to avoid heat and get better lighting.', 'Hotel del Mundo: https://www.facebook.com/hoteldelmundo/\r\nLa Elliana Hotel: https://www.booking.com/hotel/ph/la-elliana-amp-restaurant-inc.html\r\nSabel Travelers Inn: https://www.guestreservations.com/sabel-travelers-inn/booking?utm_source=google&utm_medium=cpc&utm_campaign=22108215963&gad_source=1&gad_campaignid=22108215963&gbraid=0AAAAADiMQMYfEY7vKYT7O-vw2cFcr2CGn\r\nTexicano HOTEL & RESTAURANT: https://www.agoda.com/texicano-hotel/hotel/ilocos-norte-ph.html?cid=1844104&ds=skM1jF9TmcJtM355', 'Texicano HOTEL & RESTAURANT: https://www.agoda.com/texicano-hotel/hotel/ilocos-norte-ph.html?cid=1844104&ds=skM1jF9TmcJtM355\r\nCardom’s Food House: https://www.facebook.com/p/Cardoms-Food-House-100086192217714/\r\nCasa Dela Rosa Bistro: Casa Dela Rosa Bistro', 'Email: tourismilocosnorte@gmail.com\r\nContact No.: +63 (077) 772 1213/+63 908-810-8654', 'https://ilocosnorte.ph', 'Air Transport: Nearest major airport is Laoag International Airport; from there, travel by road to Laoag City then onward by local transport to Barangay La Paz. \r\nBuses: Long-distance buses from Manila and other Luzon provinces arrive at Laoag City; once in Laoag, local transport needed to reach La Paz. \r\nJeepneys: Public jeepneys in Laoag can bring you toward Barangay La Paz; from drop-off you may need tricycle or hire of a 4×4 depending on the activity area. \r\nTricycles / Trikes: Common mode for last mile from Laoag city proper to La Paz Sand Dunes (approx 10-15 minute ride). Often possible to hire one from Laoag. \r\nNotes: Wear sun protection, bring water, dress in breathable clothing. Terrain is sandy and rough, so sturdy footwear helps. Roads near the dunes may be unpaved or sandy. During rainy season some parts may be muddy or access more difficult. Better to schedule activities in early morning or late afternoon to avoid heat and get better views.', '18.19440000', '120.59310000', 'caution', 532000, 1, 'Ilocano, Filipino, English');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(16, 'FortniteLover', '$2y$10$cI99pQUpyeaOHOn8W/Pu7OWpe3rVvJPIbI6n2ZiAKCz3R1xKUVKYq', 'austinjan12@gmail.com', '2025-09-22 12:55:50'),
(18, 'toms', '$2y$10$tKCERj1sjl0f4IQKNUSIuuS1lR4h4Yb0ue2KRLtvRjXrA9/RQnLWu', 'tolentinotoms@gmail.com', '2025-09-22 15:40:06'),
(21, 'Vince2025', '$2y$10$49ANS9tDyHvygJ25W6YC2e/8sADmKavlVZeOUX/IlPLZwTikuzhye', 'vincebernardo47@gmail.com', '2025-10-15 09:41:54'),
(30, 'kevin', '$2y$10$7yfvrHkvuHh8Mw/obIhkPu/QmdkRR3lVQuObvE3.pEPwwxTZpRIKu', 'kevinsenpai18@gmail.com', '2025-10-18 07:47:59'),
(31, 'leigh', '$2y$10$wdZ8zKvkwXiS4hqTCCWULenllVgZdW7ToOf1ry054sfD6ruh3ynfG', 'ashleycruzcalapan14@gmail.com', '2025-10-18 10:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `user_bookmarks`
--

CREATE TABLE `user_bookmarks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `spot_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_bookmarks`
--

INSERT INTO `user_bookmarks` (`id`, `user_id`, `spot_id`, `created_at`) VALUES
(56, 18, 129, '2025-09-29 13:10:07'),
(58, 18, 124, '2025-10-01 13:40:48'),
(63, 18, 122, '2025-10-10 07:06:48'),
(64, 18, 125, '2025-10-10 07:07:06'),
(65, 18, 128, '2025-10-10 07:07:30'),
(66, 18, 120, '2025-10-11 07:43:04'),
(67, 16, 122, '2025-10-12 09:16:13'),
(68, 16, 121, '2025-10-12 09:18:20'),
(70, 30, 133, '2025-10-18 07:49:10'),
(71, 31, 133, '2025-10-18 10:45:53'),
(72, 30, 120, '2025-10-18 17:44:28'),
(73, 30, 123, '2025-10-18 18:50:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_created_at` (`created_at`),
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `message_replies`
--
ALTER TABLE `message_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_message_id` (`message_id`),
  ADD KEY `idx_sent_at` (`sent_at`);

--
-- Indexes for table `spot_images`
--
ALTER TABLE `spot_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spot_id` (`spot_id`);

--
-- Indexes for table `spot_info`
--
ALTER TABLE `spot_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_bookmarks`
--
ALTER TABLE `user_bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_bookmark` (`user_id`,`spot_id`),
  ADD KEY `spot_id` (`spot_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `message_replies`
--
ALTER TABLE `message_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spot_images`
--
ALTER TABLE `spot_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=428;

--
-- AUTO_INCREMENT for table `spot_info`
--
ALTER TABLE `spot_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_bookmarks`
--
ALTER TABLE `user_bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message_replies`
--
ALTER TABLE `message_replies`
  ADD CONSTRAINT `message_replies_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `contact_messages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `spot_images`
--
ALTER TABLE `spot_images`
  ADD CONSTRAINT `spot_images_ibfk_1` FOREIGN KEY (`spot_id`) REFERENCES `spot_info` (`id`);

--
-- Constraints for table `user_bookmarks`
--
ALTER TABLE `user_bookmarks`
  ADD CONSTRAINT `user_bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_bookmarks_ibfk_2` FOREIGN KEY (`spot_id`) REFERENCES `spot_info` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
