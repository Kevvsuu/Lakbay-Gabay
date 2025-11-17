-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql103.infinityfree.com
-- Generation Time: Sep 30, 2025 at 10:50 AM
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
(1, 'admin', 'admin', '2025-09-30 14:23:25');

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
(9, 'test', 'tetete', 'kevin@gmail.com', '1231232', 'support', '123123', 'read', '2025-09-19 16:07:38', '2025-09-19 16:07:49', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),
(12, 'kevin', 'tolentino', 'kevintolentino1821@gmail.com', '09495427966', 'destinations', 'testing nga if working', 'read', '2025-09-20 13:39:14', '2025-09-21 12:29:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),
(15, 'autin', 'ulep', 'austinjan12@gmail.com', '09876544213', 'destinations', 'bakit walng walking street ? nigg3R?????', 'read', '2025-09-20 15:32:35', '2025-09-21 12:29:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),
(23, 'ashley', 'calapan', 'ashleycruzcalapan14@gmail.com', '09495427966', 'support', 'laro us 700 days', 'replied', '2025-09-22 04:25:59', '2025-09-22 04:26:51', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36'),
(24, 'LeBron', 'James', 'imdagoat@gmail.com', '09186662500', 'support', 'cmon man, that’s too easy!', 'replied', '2025-09-22 12:52:40', '2025-09-22 12:54:52', '49.151.163.140', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1'),
(25, 'kevin', 'tolentino', 'kevinsenpai18@gmail.com', '0987654321', 'booking', 'walang palawan', 'replied', '2025-09-24 07:20:40', '2025-09-24 07:21:39', '49.151.171.50', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36'),
(26, 'toms', 'tolenitno', 'tolentinotoms@gmail.com', '098765654321', 'partnership', 'sugal', 'unread', '2025-09-29 14:48:32', '2025-09-29 14:48:32', '49.151.171.50', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36');

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
(388, 125, 'images/uploads/68da3385627df_EO3OS3wUcAEUepC.jpeg', 'Abra Province'),
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
(402, 129, 'images/uploads/68da5f4f5f25c_nili1401.jpg', 'Nili1401');

-- --------------------------------------------------------

--
-- Table structure for table `spot_info`
--

CREATE TABLE `spot_info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` enum('Beaches & Islands','Nature & Wildlife','Urban & Nightlife','Adventure & Extreme Sports','Arts & Culture','Festivals & Events','UNESCO Sites','Spiritual & Pilgrimage','Wellness, Retreats, and Leisure','Hidden Wonders') NOT NULL,
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
  `top_position` decimal(5,2) NOT NULL,
  `left_position` decimal(5,2) NOT NULL,
  `safety_level` enum('safe','caution','dangerous') DEFAULT 'safe',
  `annual_visitors` int(11) DEFAULT 0,
  `featured` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spot_info`
--

INSERT INTO `spot_info` (`id`, `name`, `category`, `image`, `overview`, `region`, `province`, `municipality`, `things_to_do`, `operating_hours`, `nearby_accommodations`, `nearby_restaurants`, `contact_information`, `official_links`, `transportation`, `top_position`, `left_position`, `safety_level`, `annual_visitors`, `featured`) VALUES
(119, 'Binondo Chinatown', 'Urban & Nightlife', NULL, 'Binondo is the oldest Chinatown in the world, established in 1594 by Spanish colonizers as a settlement for Catholic Chinese immigrants. Over centuries, it has become a lively cultural & commercial district in Manila mixing Chinese and Filipino traditions, historic churches, temples, traditional shops, food stalls, and narrow alleys lined with businesses that reflect both heritage and daily life.', 'NCR', 'Manila', 'Manila', 'Dining: Explore Chinese-Filipino cuisine through food crawls, hopia bakeries, and dumpling houses .\nShopping: Visit Ongpin Street for jewelry shops, herbal medicine stores, and feng shui supplies .\nCultural & Heritage Visits: Discover Binondo Church (Minor Basilica of St. Lorenzo Ruiz) for its architecture and religious significance .\nLeisure & Recreation: Walk along Ongpin and Escolta Streets to experience heritage buildings and vibrant local life.\nFestivals & Events: Celebrate Chinese New Year and other community festivities with parades and cultural performances .', 'General Hours: 8:00 AM 9:00 PM are\'s\nNotes: Hours vary by shop, restaurant, and attraction; many establishments open earlier in the morning.', 'Hotel Lucky Chinatown\nPristine Hotel \nRedDoorz Plus @ Chinatown Binondo\nRamada by Wyndham Manila Central\nKingsford Hotel Manila \nDela Chambre Hotel', 'Sincerity Cafe & Restaurant\nPresident Grand Palace Restaurant \nWai Ying Fastfood \nToHo Panciteria Antigua \nQuick Snack \nCafe Mezzanine \nThe Original Shanghai Fried Siopao\nLam Dynasty Restaurant', 'Manila Tourism and Cultural Affairs Bureau: +63 (2) 8527-7889 local 1114', 'https://manila.gov.ph/tourism/', 'Trains: Nearest station is Carriedo (LRT Line 1), approx. 15 minute walk.\nBuses: Served by city buses passing through Manila central districts.\nJeepneys: Numerous routes connect Binondo with Divisoria, Quiapo, and other nearby areas.\nTricycles / Pedicabs: Widely available for short trips within side streets.\nTaxis: Taxis and ride-hailing apps (Grab, Angkas) readily available, though traffic is heavy.\nPrivate Vehicle: Limited parking; area prone to congestion.\nOn Foot: Best explored by walking due to narrow streets and dense pedestrian activity.\nNotes: Heavy traffic is common; walking or light vehicles may be faster.', '38.53', '44.98', 'caution', 946943, 1),
(120, 'Escolta Street', 'Urban & Nightlife', NULL, 'Escolta Street, often called the “Queen of Manila’s Streets,” is one of the Philippines’ oldest and most historic thoroughfares, established in 1594. In its heyday (late 19th to mid-20th century), it was Manila’s premier commercial and financial district, where merchant shops, department stores, and iconic architecture flourished. Today, it is undergoing a heritage revival, with creative spaces, cultural tours, restoration of historic buildings (e.g. First United Building, Don Roman Santos Building, Comtrust Building) and public art projects helping reanimate its past glory.\\r\\n', 'NCR', 'Manila', 'Manila', 'Shopping: Browse heritage-shops, vintage boutiques, antique finds along Escolta.\\r\\n\\r\\nCultural & Heritage Visits: Visit historic buildings such as First United Building, Don Roman Santos Building, and see architectural styles (Art Deco, Beaux-Arts, Neoclassical). \\r\\n\\r\\nLeisure & Recreation: Join heritage walks or guided tours exploring public art, murals, and the revitalized street corridors. \\r\\n\\r\\nDining: Eat at local cafés or heritage restaurants/restaurants near Escolta. ', 'General Hours: 8:00 am - 9:00 pm\\r\\n\\r\\nNotes: Many historic/heritage shops open during daytime; evening hours depend on individual business.', 'Golden City Hotel\\r\\nRamada Manila Cathedral Hotel\\r\\nBinondo Suites Manila\\r\\nHotel Lucky Chinatown Binondo\\r\\nPristine Hotel', 'The Den \\r\\nFred\\\'s Revolucion \\r\\nPolland Bakery\\r\\nUNO Seafood Wharf \\r\\nThe Original Savory\\r\\nNew Po Heng Lumpia House\\r\\nHeavenly Grace', 'Manila Tourism and Cultural Affairs Bureau: +63 (2) 8527-7889 local 1114', 'manila.gov.ph', 'Trains: No major train line running directly along Escolta; nearest LRT station is Carriedo (LRT-1).\\r\\n\\r\\nBuses: Served by city buses along nearby main roads in Manila, routes depend on starting point.\\r\\n\\r\\nJeepneys: Jeepney routes connecting Binondo, Santa Cruz, Escolta, Quiapo etc. are common.\\r\\n\\r\\nTricycles / Pedicabs: Likely available for short walks / side streets, less common on major thoroughfares.\\r\\n\\r\\nTaxis: Metered taxis & ride-hailing services are available in the area.\\r\\n\\r\\nPrivate Vehicle: Access via major Manila streets; limited parking and traffic congestion expected.\\r\\n\\r\\nOn Foot: Highly walkable. Escolta is best experienced by walking to appreciate its façade, alleys, historic buildings.\\r\\n\\r\\nNotes: Traffic congestion, narrow sidewalks in some parts; safety of walking at night depends on lighting and activity level.\\r\\n', '38.68', '45.16', 'caution', 946943, 0),
(121, 'Intramuros', 'Arts & Culture', NULL, 'Intramuros (Latin for “within the walls”) is Manila’s historic walled city, founded in 1571 by Miguel López de Legazpi. It was the Spanish colonial capital and center of political, religious, and military power for centuries. Key sites inside include Fort Santiago, San Agustin Church, Manila Cathedral, and restored city walls and gates. After heavy destruction in World War II, Intramuros has been partially restored and is managed by the Intramuros Administration (established in 1979) to preserve its architecture, heritage, and street plan.', 'NCR', 'Manila', 'Manila', 'Cultural & Heritage Visits: explore Fort Santiago, San Agustin Church, Manila Cathedral.\\r\\n\\r\\nMuseums & Living History: visit Casa Manila to see Spanish colonial home lifestyle; see Centro de Turismo Intramuros. \\r\\n\\r\\nWalking & Photography: stroll along cobblestone streets, historic walls, plazas (such as Plaza Moriones, Plaza de España). \\r\\n\\r\\nDining & Café Hopping: enjoy heritage restaurants / bistros inside or near Intramuros.', 'General Hours: Most heritage sites and/or museums open ~9:00 AM to ~6:00 PM.', 'The Bayleaf Intramuros\\r\\nWhite Knight Hotel Intramuros\\r\\nRizal Park Hotel\\r\\nCasa Bocobo Hotel\\r\\nHotel H2O', 'Ilustrado Restaurant\\r\\nBarbara\\\'s Heritage Restaurant\\r\\nSky Deck View Bar\\r\\nLa Cathedral Cafe\\r\\nPatio de Conchita\\r\\nBatala Bar\\r\\nCafe Intramuros\\r\\nCasa Nueva Bistro Cafe', 'https://intramuros.gov.ph', 'https://intramuros.gov.ph', 'Trains: Nearest LRT is Line 1 (Central Station / Carriedo Station) depending on the side of Intramuros. (Exact station depends on entry point.)\\r\\n\\r\\nBuses: Various city buses run along Roxas Boulevard, Taft Avenue, and streets bordering Intramuros.\\r\\n\\r\\nJeepneys: Jeepney routes into/dropping passengers near the walls / entrance gates.\\r\\n\\r\\nTricycles / Pedicabs: Available for short distances inside or near minor streets; may be limited.\\r\\n\\r\\nTaxis: Metered taxis and ride-hailing apps (Grab, Angkas) are available closer to main roads.\\r\\n\\r\\nPrivate Vehicle: Access via Muralla, Victoria, etc.; parking limited and traffic generally heavy.\\r\\n\\r\\nOn Foot: Highly walkable; many attractions are concentrated within walking distance (cobbled streets, small alleys).', '38.55', '45.02', 'caution', 2200000, 0),
(122, 'Rizal Park', 'Arts & Culture', NULL, 'Rizal Park, also known as Luneta, is one of Manila’s largest and most iconic urban parks (~58 hectares), a landmark of national heritage.  It is the final resting place of national hero Dr. José Rizal, and hosts several monuments, gardens (e.g. Japanese Garden, Chinese Garden, Noli Me Tangere Garden), open-plaza spaces, and a large central musical/dancing fountain. It’s highly frequented by locals and tourists for recreation, walks, history, culture, and national ceremonies.', 'NCR', 'Manila', 'Manila', 'Cultural & Heritage Visits: see the Rizal Monument, Independence Flagpole, and historical statues and markers. \\r\\n\\r\\nGardens & Nature Walks: explore the Japanese Garden, Chinese Garden, Orchidarium & Butterfly Pavilion. \\r\\n\\r\\nLeisure & Recreation: enjoy picnic areas, open lawns (Burnham Green, Quirino Grandstand), children’s playground. \\r\\n\\r\\nEvents & Public Performances: concerts, light and sound presentations, cultural events at the Open-Air Auditorium.', 'General Hours: ~5:00 AM – 10:00 PM.\\r\\n\\r\\nNotes: Some sections may close earlier or be restricted during large events or maintenance.\\r\\n', 'Rizal Park Hotel\\r\\nThe Manila Hotel \\r\\nThe Bayleaf Intramuros \\r\\nRed Planet Manila Bay \\r\\nHotel H2O', 'Barbara’s Heritage Restaurant\\r\\nPurple Yam \\r\\nMax’s Restaurant\\r\\nRistorante Delle Mitre \\r\\n9 Spoons ', 'www.npdc.gov.ph\\r\\n(02) 8880-4895', 'https://npdc.gov.ph', 'Trains: Nearest light rail transit / stations include United Nations Avenue. \\r\\n\\r\\nBuses: City buses along Roxas Boulevard, Taft Avenue, Kalaw etc. serve the surrounding area.\\r\\n\\r\\nJeepneys: Jeepney routes terminate/drop off near park edges (Kalaw, UN Avenue, Padre Burgos etc.).\\r\\n\\r\\nTricycles / Pedicabs: Limited inside immediate park vicinity; more common in side streets outside.\\r\\n\\r\\nTaxis: Metered taxis and ride-hail services (Grab) are available with access to park entrances.\\r\\n\\r\\nPrivate Vehicle: Access via major surrounding roads; parking around the area can be limited and traffic heavy.\\r\\n\\r\\nOn Foot: Highly walkable within the park and nearby districts; good for early morning, evening strolls.\\r\\n\\r\\nNotes: Traffic congestion on surrounding roads.', '38.47', '45.12', 'caution', 5736180, 0),
(123, 'Kaparkan Falls', 'Hidden Wonders', NULL, 'Kaparkan Falls, also known as Mulawin Falls, is a multi-tiered waterfall in Barangay Caganayan, Tineg, Abra, known for its terraced limestone formations and crystal-clear spring pools. It is approximately 45 km from Bangued, the provincial capital, and is considered a hidden gem of Abra, offering a mix of natural beauty and adventure for visitors.', 'CAR', 'Abra', 'Tineg', 'Nature & Scenic Viewing: admire the multi-tiered waterfalls and limestone terraces.\\r\\n\\r\\nSwimming & Wading: enjoy the natural pools at different tiers of the falls.\\r\\n\\r\\nPhotography & Nature Trekking: capture the scenic vistas and explore surrounding trails.\\r\\n\\r\\nCultural Experience: interact with local guides and learn about Tineg’s rural community.', 'N/A', 'Kaparkan Falls Homestay \\r\\nBangued Hotel \\r\\nAbra River View Inn\\r\\nPiwek Rock Resort \\r\\nApao Rolling Hills Lodge', 'Local Carinderias', 'lgu.tinegabra@gmail.com\\r\\n+63 995 344 6934\\r\\n+63 926 359 3623', 'https://www.lgutineg.com', 'Trains: N/A\\r\\n\\r\\nBuses: Buses to Bangued, Abra, then jeepney or private transport to Tineg.\\r\\n\\r\\nJeepneys: Local jeepneys or 4x4 vehicle trips arranged via Bangued or Barangay Caganayan.\\r\\n\\r\\nTricycles / Pedicabs: Limited. Used locally in the barangay for short distances.\\r\\n\\r\\nTaxis: Limited. Primarily private vehicle hire from Bangued.\\r\\n\\r\\nPrivate Vehicle: 4x4 recommended due to rough terrain.\\r\\n\\r\\nOn Foot: Short hikes from drop-off points to the waterfall tiers.\\r\\n\\r\\nNotes: Terrain is rugged; only recommended for physically fit visitors; guided tours advised.', '20.45', '44.96', 'caution', 100, 0),
(124, 'Piwek Rock Formations', 'Nature & Wildlife', NULL, 'Piwek Rock Formations, located in Barangay Alaoa, Tineg, Abra, is a captivating natural attraction renowned for its gleaming white limestone cliffs and striking rock terraces along the Binongan River. These unique formations have been shaped over centuries through the slow deposition of minerals, resulting in a dramatic and photogenic landscape.\\r\\nThe site offers visitors an immersive experience in nature, combining opportunities for hiking, river trekking, and adventure activities such as cliff jumping. Although primarily celebrated for its geological features, Piwek is situated within the ancestral lands of the Tingguian people, an indigenous group whose cultural heritage and deep connection to the land add an additional layer of significance to the site. Visitors to Piwek Rock Formations can therefore appreciate both the awe-inspiring natural scenery and the rich cultural backdrop of Abra.', 'CAR', 'Abra', 'Tineg', 'Nature & Scenic Viewing: Admire the gleaming white limestone rock formations that wall the banks of the Tineg River. \\r\\n\\r\\nRiver Crossing: Experience a traditional bamboo raft crossing to reach the formations.\\r\\n\\r\\nHiking & Exploration: Choose between two trails—one challenging with rock climbing over large boulders, and another less steep for a more relaxed hike.\\r\\n\\r\\nCliff Jumping: For adrenaline seekers, engage in cliff jumping into the river from heights of up to 11 meters. ', 'General Hours: Typically accessible during daylight hours; exact hours may vary.\\r\\n\\r\\nNotes: Access requires coordination with local guides; weather conditions may affect accessibility.', 'Kaparkan Falls Homestay\\r\\nBangued Hotel\\r\\nAbra River View Inn\\r\\nPiwek Rock Resort', 'Local Carinderias', 'lgu.tinegabra@gmail.com\\r\\n+63 995 344 6934\\r\\n+63 926 359 3623', 'https://www.lgutineg.com/', 'Trains: N/A.\\r\\n\\r\\nBuses: Public buses to Bangued, Abra, then jeepney or private transport to Tineg.\\r\\n\\r\\nJeepneys: Local jeepneys or 4x4 vehicle trips arranged via Bangued or Barangay Alaoa.\\r\\n\\r\\nTricycles / Pedicabs: Limited. Used locally in the barangay for short distances.\\r\\n\\r\\nTaxis: Limited. Primarily private vehicle hire from Bangued.\\r\\n\\r\\nPrivate Vehicle: 4x4 recommended due to rough terrain.\\r\\n\\r\\nOn Foot: Short hikes from drop-off points to the rock formations.\\r\\n\\r\\nNotes: Terrain is rugged; only recommended for physically fit visitors and guided tours are advised.', '20.71', '44.93', 'caution', 750, 0),
(125, 'Kili Falls & Hot Spring', 'Nature & Wildlife', NULL, 'Kili Falls and Hot Spring, located in Barangay Kili, Tubo, Abra, is a captivating natural attraction known for its unique combination of a powerful waterfall and a natural hot spring. The falls cascade into a clear, cool river, creating a misty ambiance that adds to the site\\\'s allure. Adjacent to the falls, a natural hot spring flows into a man-made spa pool, offering visitors a relaxing experience amidst the rugged landscape. The journey to Kili involves traversing scenic rice terraces and crossing hanging bridges, providing a glimpse into the rural life of the Maeng Tribe. This destination is ideal for nature enthusiasts seeking both adventure and relaxation.', 'CAR', 'Abra', 'Tubo', 'Waterfall Exploration: Admire the powerful cascade of Kili Falls and enjoy swimming in its cool waters.\\r\\n\\r\\nHot Spring Bathing: Relax in the natural hot spring pool located near the falls, alternating between warm and cold water for a therapeutic experience.\\r\\n\\r\\nHiking & Scenic Walks: Trek through lush rice terraces and cross hanging bridges, immersing yourself in the natural beauty of the area.\\r\\n\\r\\nPhotography: Capture the stunning landscapes, including the falls, hot spring, and surrounding rice fields.', 'General Hours: Accessible year-round; best visited during the dry season (December to May) for optimal trail conditions.\\r\\n\\r\\nNotes: The area is remote, it\\\'s advisable to visit with a local guide.\\r\\n', 'Homestays in Kili Village\\r\\n\\r\\nCamping', 'Local Carinderias', 'dapayditubo@gmail.com\\r\\ninfo@tuboabra.gov.ph\\r\\n+63917-157-7101 ', 'https://www.tuboabra.gov.ph', 'Trains: N/A.\\r\\n\\r\\nBuses: From Manila, take a bus (Viron, Dominion, or Partas) to Bangued, Abra.\\r\\n\\r\\nJeepneys: From Bangued, take a jeepney to Brgy. Tiempo, Tubo.\\r\\n\\r\\nPrivate Vehicles: From Brgy. Tiempo, hire a motorcycle to Brgy. Kili.\\r\\n\\r\\nOn Foot: From Brgy. Kili, walk to the falls and hot spring (~20 minutes).\\r\\n\\r\\nNotes: The journey involves rough terrain; 4x4 vehicles are recommended.', '23.45', '44.63', 'caution', 1250, 0),
(126, 'Vigan Heritage Village ', 'UNESCO Sites', NULL, 'Vigan Heritage Village, located in Vigan City, Ilocos Sur, is a UNESCO World Heritage Site inscribed in 1999. Recognized as the best-preserved example of a planned Spanish colonial town in Asia, Vigan showcases a unique blend of Filipino, Chinese, European, and Mexican architectural influences. The town\\\'s layout, featuring cobblestone streets and ancestral houses, reflects the cultural fusion that defines its heritage. ', 'Region-1', 'Ilocos Sur', 'Vigan City', 'Cultural & Heritage Visits: Explore Calle Crisologo, a cobblestone street lined with ancestral houses and antique shops. Visit the Vigan Cathedral and the Syquia Mansion, the former residence of President Elpidio Quirino.\\r\\n\\r\\nTraditional Craft Demonstrations: Witness the making of burnay pottery and other local crafts, reflecting the town\\\'s artisanal heritage.\\r\\n\\r\\nLeisure & Recreation: Enjoy a kalesa (horse-drawn carriage) ride through the historic streets, offering a glimpse into the past.\\r\\n\\r\\nEvents & Festivals: Participate in the Vigan Longganisa Festival and other cultural events that celebrate local traditions and cuisine.', 'General Hours: Most attractions are open daily from 8:00 AM to 6:00 PM.\\r\\n\\r\\nNotes: Hours may vary during festivals or special events; it\\\'s advisable to check local listings for specific timings.', 'Hotel Luna\\r\\nVigan Plaza Hotel\\r\\nFersal Hotel Vigan\\r\\nHotel Felicidad\\r\\nLa Casa Blanca de Vigan Hotel', '1995 Studio Cafe\\r\\nCafe Uno\\r\\nKusina Felicitas\\r\\nCafe Leona\\r\\nLilong and Lilang Restaurant', 'tourism@vigancity.gov.ph\\r\\n(077) 722-2740\\r\\n(077) 722-8772', 'https://vigancity.gov.ph/#', 'Trains: N/A.\\r\\n\\r\\nBuses: Several bus lines operate routes to Vigan from major cities like Manila and Laoag. Notable bus companies include Partas Bus, Philippine Rabbit, and Dominion Bus Lines, which have terminals in Cubao, Quezon City.\\r\\n\\r\\nTricycles: Tricycles are the primary mode of transport within Vigan City. They are color-coded based on the municipality they serve:\\r\\nGreen: Vigan\\r\\nRed: Bantay\\r\\nYellow: Caoayan\\r\\nOrange: San Vicente\\r\\nBlue: Santa Catalina\\r\\n\\r\\nKalesa: The kalesa is a traditional horse-drawn carriage and a unique way to explore Vigan\\\'s historic streets. These are the only public transport allowed on Calle Crisologo. They offer a nostalgic experience and can be rented for short tours or longer trips to nearby attractions.\\r\\n\\r\\nJeepneys: Jeepneys operate within Vigan and to nearby towns. They are an affordable option for getting around and are especially useful for reaching destinations outside the city center.\\r\\n\\r\\nPrivate Vehicles: Visitors can rent private cars or vans for a more comfortable and personalized experience. This option is ideal for families or groups and allows flexibility in exploring Vigan and its surroundings.\\r\\n\\r\\nWalking: Vigan\\\'s compact size makes it pedestrian-friendly. Many attractions, including Calle Crisologo and the Vigan Cathedral, are within walking distance of each other, allowing visitors to immerse themselves in the city\\\'s charm at their own pace.', '21.79', '43.41', 'safe', 56665, 1),
(127, 'Batad Rice Terraces', 'UNESCO Sites', NULL, 'Batad Rice Terraces, located in the municipality of Banaue, Ifugao Province, are part of the UNESCO World Heritage-listed Rice Terraces of the Philippine Cordilleras. These terraces are renowned for their amphitheater-like shape and are considered one of the most picturesque and well-preserved rice terraces in the Philippines. The terraces are still actively cultivated by the indigenous Ifugao people, showcasing an ancient and sustainable agricultural system. \\r\\n', 'CAR', 'Ifugao', 'Banaue', 'Trekking & Hiking: Embark on a hike to the terraces, including a visit to Tappiya Falls, a scenic waterfall nestled within the rice fields. \\r\\n\\r\\nCultural Immersion: Engage with the local Ifugao community to learn about their traditions, rice farming techniques, and cultural practices.\\r\\n\\r\\nPhotography: Capture the stunning landscapes, especially during sunrise or sunset when the terraces are bathed in golden light.\\r\\n\\r\\nOvernight Stays: Experience traditional Ifugao hospitality by staying in local homestays or guesthouses.', 'General Hours: Accessible year-round; however, the best time to visit is during the dry season (March to May) to ensure safe trekking conditions.\\r\\nNotes: Some trails may be slippery during the rainy season (June to October), so it\\\'s advisable to check weather conditions before planning your visit.', 'Batad Transient House\\r\\nRamon\\\'s Guesthouse\\r\\nBatad Pension and Restaurant\\r\\nNative Village Inn', 'Ramon\\\'s Guesthouse Restaurant\\r\\nBatad Pension Restaurant\\r\\nLocal Carinderias. ', 'https://www.facebook.com/BanaueMunicipalTourismOffice/', 'https://www.facebook.com/BanaueMunicipalTourismOffice/', 'Trains: N/A \\r\\n\\r\\nBuses: Served by intercity buses from Manila (Ohayami Trans, Coda Lines) and other major cities to Banaue. \\r\\n\\r\\nJeepneys: Jeepneys operate from Banaue to Batad. Schedules are limited and may vary; local jeepneys can also reach nearby barangays.\\r\\n\\r\\nTricycles / Pedicabs: Local tricycles are available for short distances near the Batad Saddle Point, helping carry luggage or supplies to the start of hiking trails.\\r\\n\\r\\nTaxis /Ride-Hailing: Limited or unavailable within Batad, private transfers are recommended from Banaue or nearby towns.\\r\\n\\r\\nPrivate Vehicle: Access by private car or van is possible to the Banaue Saddle Point. The last section to Batad village requires trekking.\\r\\n\\r\\nOn Foot: Batad is best explored on foot. Trails are steep and uneven, so good hiking shoes and physical preparedness are advised.\\r\\n\\r\\nNotes: Hiking with a local guide is recommended for safety and cultural guidance, Weather and trail conditions can affect accessibility.', '25.33', '45.69', 'safe', 42793, 1),
(128, 'Nagacadan Rice Terraces', 'UNESCO Sites', NULL, 'The Nagacadan Rice Terraces are a UNESCO World Heritage Site and one of the five clusters that make up the Rice Terraces of the Philippine Cordilleras. Located in Kiangan, Ifugao, these terraces are renowned for their amphitheater-like formation, carved into a scenic valley and flanking a picturesque river. The terraces are a testament to the Ifugao people\\\'s ingenuity, showcasing a harmonious blend of agricultural practices and cultural traditions that have been passed down through generations.', 'CAR', 'Ifugao', 'Kiangan', 'Cultural Immersion: Engage with the local Ifugao community to learn about their traditional farming practices, rituals, and way of life.\\nPhotography: Capture the breathtaking views of the terraces, especially during the golden hours of sunrise and sunset.\\nTrekking: Embark on guided hikes through the terraces to appreciate their intricate design and the surrounding natural beauty.\\nVisit the Kiangan War Memorial Shrine: Explore the historical significance of Kiangan during World War II, located near the terraces.', 'General Access: Open year-round; best visited during the dry season (November to May) for optimal trekking conditions.\\nNote: It\\\'s recommended to arrange tours in advance through local tourism offices or accredited guides.', 'Nagacadan Homestays\\nKiangan Viewpoint Homestay\\nEl Kikasa Homestay\\nBanaue Hotel and Youth Hostel', 'Banaue Viewpoint Restaurant\\nMillion Dollar Hill CafÃƒÂ© & Restaurant', 'visitkiangan@outlook.com\\n0920 467 1020', 'https://visitkiangan.wordpress.com', 'Trains: N/A.\\nBuses: Daily buses from Manila to Banaue (Ohayami Trans, Coda Lines) are available.\\nJeepneys: From Banaue, jeepneys to Kiangan are available.\\nTricycles: Local tricycles can be hired for short distances within Kiangan.\\nTaxis Ride-Hailing: Limited availability; best to arrange private transfers.\\nPrivate Vehicle: Accessible via private car or van; roads may be narrow and winding.\\nOn Foot: Exploring the terraces is best done on foot; trails can be steep and uneven.', '26.36', '45.33', 'safe', 42793, 0),
(129, 'Hungduan Rice Terraces', 'UNESCO Sites', NULL, 'The Hungduan Rice Terraces, part of the UNESCO World Heritage-listed Rice Terraces of the Philippine Cordilleras, are located in Hungduan, Ifugao Province. These terraces are renowned for their scenic beauty and traditional Ifugao agricultural practices. The area offers a more tranquil and less commercialized experience compared to other terraces in the region. \\r\\n', 'CAR', 'Ifugao', 'Hungduan', 'Trekking & Hiking: Explore terraces via designated trails; moderate to challenging hikes.\\r\\nCultural Visits: Engage with local Ifugao communities to learn about rice cultivation and traditions.\\r\\nPhotography: Capture sunrise, sunset, and the panoramic amphitheater-like terraces.\\r\\nNature & Waterfalls: Visit nearby streams and minor waterfalls along the trails.', 'Accessible year-round, best during dry season (November–May) for safer trekking.', 'Australian Hotel Hungduan\\r\\nNative Village Inn\\r\\nBatad View Inn and Restaurant', 'Terrace View Restaurant\\r\\nLocal Carinderias', 'lguhungduanifugao@rocketmail.com\\r\\nhttps://www.facebook.com/localgovernmentunitofhungduan', 'https://hungduan.gov.ph', 'Trains: N/A.\\r\\n\\r\\nBuses: Daily buses from Manila to Banaue (Ohayami Trans, Coda Lines).\\r\\n\\r\\nJeepneys: From Banaue to Hungduan.\\r\\n\\r\\nTricycles / Pedicabs: Available locally for short distances.\\r\\n\\r\\nTaxis: Limited; private transfers recommended.\\r\\n\\r\\nPrivate Vehicle: Accessible via private car or van; roads can be narrow and winding.\\r\\n\\r\\nOn Foot: Best explored on foot; trails are uneven and steep.', '25.47', '45.38', 'safe', 42793, 0);

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
(14, 'test', '$2y$10$x0xf9OBLkMWEqXV3yUV7tuMjNew2sRdL7.QeTIm7cNVUlwkqJl1FC', 'test@gmail.com', '2025-09-18 07:25:20'),
(15, 'pedro', '$2y$10$3UInR47pgJ/Uwjwg0jDxHuwt2xtV1eztluZOs3HC.3pZTqmjj4W8W', 'marcopauloramos03@gmail.com', '2025-09-22 12:54:07'),
(16, 'FortniteLover', '$2y$10$sXChlrrYM0tyRh9brfUsWe4jvykKXWEraEcE30uAoozjlcYu3BmpC', 'austinjan12@gmail.com', '2025-09-22 12:55:50'),
(18, 'toms', '$2y$10$tKCERj1sjl0f4IQKNUSIuuS1lR4h4Yb0ue2KRLtvRjXrA9/RQnLWu', 'tolentinotoms@gmail.com', '2025-09-22 15:40:06');

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
(56, 18, 129, '2025-09-29 13:10:07');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=403;

--
-- AUTO_INCREMENT for table `spot_info`
--
ALTER TABLE `spot_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_bookmarks`
--
ALTER TABLE `user_bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

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
