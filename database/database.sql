-- >> Este archivo se genera automáticamente desde tables.sql y constraints.sql. No modifique directamente << ----
-- Estructura de tabla para la tabla `dgn_app_config`
--

CREATE TABLE `dgn_app_config` (
  `key` varchar(50) NOT NULL,
  `value` varchar(500) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dgn_app_config`
--

INSERT INTO `dgn_app_config` (`key`, `value`) VALUES
('address', '123 Nowhere street'),
('company', 'digyna'),
('company_logo', ''),
('email', 'changeme@example.com'),
('fax', ''),
('language', 'spanish'),
('language_code', 'es'),
('lines_per_page', '25'),
('phone', '555-555-5555'),
('timezone', 'America/Mexico_City'),
('website', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_contacts`
--

CREATE TABLE `dgn_contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` int(1) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `comments` text NOT NULL,
  `read` int(1) DEFAULT '0',
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dgn_contacts`
--

INSERT INTO `dgn_contacts` (`contact_id`, `first_name`, `last_name`, `gender`, `phone_number`, `email`, `title`, `comments`, `read`, `deleted`) VALUES
(1, 'digyna', 'cms', 1, '555-555-55-55', 'mail@example.com', 'Hola!, Esto es un correo desde contacto', 'Para poder administrar, todos los correos, por favor visita la pantalla de contacto en el escritorio.', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_customers`
--

CREATE TABLE `dgn_customers` (
  `person_id` int(10) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `taxable` int(1) NOT NULL DEFAULT '1',
  `discount_percent` decimal(15,2) NOT NULL DEFAULT '0.00',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash_version` int(1) NOT NULL DEFAULT '1',
  `deleted` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `rfc` (`rfc`),
  UNIQUE KEY `username` (`username`),
  KEY `person_id` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_grants`
--

CREATE TABLE `dgn_grants` (
  `permission_id` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL,
  PRIMARY KEY (`permission_id`,`person_id`),
  KEY `dgn_grants_ibfk_2` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dgn_grants`
--

INSERT INTO `dgn_grants` (`permission_id`, `person_id`) VALUES
('adverts', 1),
('adverts_banners', 1),
('adverts_marks', 1),
('adverts_ourcustomers', 1),
('adverts_sliders', 1),
('config', 1),
('contacts', 1),
('customers', 1),
('customers_add', 1),
('customers_read', 1),
('customers_delete', 1),
('customers_edit', 1),
('customers_export', 1),
('home', 1),
('products', 1),
('profile', 1),
('sales', 1),
('themes', 1),
('users', 1),
('users_add', 1),
('users_read', 1),
('users_delete', 1),
('users_edit', 1),
('users_export', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_modules`
--

CREATE TABLE `dgn_modules` (
  `name_lang_key` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `module_id` varchar(255) NOT NULL,
  `module_parent` varchar(255) NOT NULL DEFAULT '0',
  `module_icon` varchar(255) NOT NULL DEFAULT '',
  `status` int(10) DEFAULT '0',
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `name_lang_key` (`name_lang_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dgn_modules`
--

INSERT INTO `dgn_modules` (`name_lang_key`, `sort`, `module_id`, `module_parent`, `module_icon`, `status`) VALUES
('module_adverts', 2, 'adverts', '0', 'fa fa-bullhorn', 0),
('module_banners', 3, 'adverts_banners', 'adverts', '', 0),
('module_marks', 4, 'adverts_marks', 'adverts', '', 0),
('module_ourcustomers', 5, 'adverts_ourcustomers', 'adverts', '', 0),
('module_sliders', 6, 'adverts_sliders', 'adverts', '', 0),
('module_config', 14, 'config', '0', 'icon ion-ios-gear', 0),
('module_contacts', 12, 'contacts', '0', 'icon ion-ios-email-outline', 0),
('module_customers', 9, 'customers', '0', 'icon ion-ios-people', 0),
('module_customers_add', 18, 'customers_add', 'customers', '', 0),
('module_customers_read', 17, 'customers_read', 'customers', '', 0),
('module_home', 1, 'home', '0', 'fa fa-desktop', 0),
('module_products', 7, 'products', '0', 'icon ion-bag', 0),
('module_profile', 10, 'profile', '0', 'fa fa-user', 0),
('module_sales', 8, 'sales', '0', 'icon ion-ios-cart', 0),
('module_themes', 13, 'themes', '0', 'icon ion-paintbrush', 0),
('module_users', 11, 'users', '0', 'icon ion-person-stalker', 0),
('module_users_add', 16, 'users_add', 'users', '', 0),
('module_users_read', 15, 'users_read', 'users', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_people`
--

CREATE TABLE `dgn_people` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` int(1) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dgn_people`
--

INSERT INTO `dgn_people` (`first_name`, `last_name`, `phone_number`, `email`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `person_id`) VALUES
('admin', '.', '555-555-5555', 'demo@demo.com', 'Address 1', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_permissions`
--

CREATE TABLE `dgn_permissions` (
  `permission_id` varchar(255) NOT NULL,
  `module_id` varchar(255) NOT NULL,
  `module_parent` varchar(255) NOT NULL DEFAULT '0',
  `name_lang_key` varchar(255) NOT NULL,
  `desc_lang_key` varchar(255) NOT NULL,
  `location_id` int(10) DEFAULT NULL,
  `sort` int(10) NOT NULL,
  `status` int(10) DEFAULT '0',
  PRIMARY KEY (`permission_id`),
  UNIQUE KEY `desc_lang_key` (`desc_lang_key`),
  UNIQUE KEY `name_lang_key` (`name_lang_key`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dgn_permissions`
--

INSERT INTO `dgn_permissions` (`permission_id`, `module_id`, `module_parent`, `name_lang_key`, `desc_lang_key`, `sort`, `status`) VALUES
('adverts', 'adverts', '0', 'module_adverts', 'module_adverts_desc', 2, 0),
('adverts_banners', 'adverts_banners', 'adverts', 'module_banners', 'module_banners_desc', 3, 0),
('adverts_marks', 'adverts_marks', 'adverts', 'module_marks', 'module_marks_desc', 4, 0),
('adverts_ourcustomers', 'adverts_ourcustomers', 'adverts', 'module_ourcustomers', 'module_ourcustomers_desc', 5, 0),
('adverts_sliders', 'adverts_sliders', 'adverts', 'module_sliders', 'module_sliders_desc', 6, 0),
('config', 'config', '0', 'module_config', 'module_config_desc', 24, 0),
('contacts', 'contacts', '0', 'module_contacts', 'module_contacts_desc', 22, 0),
('customers', 'customers', '0', 'module_customers', 'module_customers_desc', 9, 0),
('customers_add', 'customers', 'customers', 'module_customers_add', 'module_customers_add_desc', 11, 0),
('customers_delete', 'customers', 'customers', 'module_customers_delete', 'module_customers_delete_desc', 13, 0),
('customers_edit', 'customers', 'customers', 'module_customers_edit', 'module_customers_edit_desc', 12, 0),
('customers_export', 'customers', 'customers', 'module_customers_export', 'module_customers_export_desc', 14, 0),
('customers_read', 'customers', 'customers', 'module_customers_read', 'module_customers_read_desc', 10, 0),
('home', 'home', '0', 'module_home', 'module_home_desc', 1, 0),
('products', 'products', '0', 'module_products', 'module_products_desc', 7, 0),
('profile', 'profile', '0', 'module_profile', 'module_profile_desc', 15, 0),
('sales', 'sales', '0', 'module_sales', 'module_sales_desc', 8, 0),
('themes', 'themes', '0', 'module_themes', 'module_themes_desc', 23, 0),
('users', 'users', '0', 'module_users', 'module_users_desc', 16, 0),
('users_add', 'users', 'users', 'module_users_add', 'module_users_add_desc', 18, 0),
('users_delete', 'users', 'users', 'module_users_delete', 'module_users_delete_desc', 20, 0),
('users_edit', 'users', 'users', 'module_users_edit', 'module_users_edit_desc', 19, 0),
('users_export', 'users', 'users', 'module_users_export', 'module_users_export_desc', 21, 0),
('users_read', 'users', 'users', 'module_users_read', 'module_users_read_desc', 17, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_sessions`
--

CREATE TABLE `dgn_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_users`
--

CREATE TABLE `dgn_users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `hash_version` int(1) NOT NULL DEFAULT '2',
  UNIQUE KEY `username` (`username`),
  KEY `person_id` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dgn_users`
--

INSERT INTO `dgn_users` (`username`, `password`, `person_id`, `deleted`, `hash_version`) VALUES
('admin', '$2y$10$dqrXH5ERqHNSs9KAxW8Cu.aiFLPEstw4tBER08L71NOCURWgiBoq.', 1, 0, 2);


--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dgn_customers`
--
ALTER TABLE `dgn_customers`
  ADD CONSTRAINT `dgn_customers_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `dgn_people` (`person_id`);

--
-- Filtros para la tabla `dgn_grants`
--
ALTER TABLE `dgn_grants`
  ADD CONSTRAINT `dgn_grants_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `dgn_permissions` (`permission_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dgn_grants_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `dgn_users` (`person_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `dgn_permissions`
--
ALTER TABLE `dgn_permissions`
  ADD CONSTRAINT `dgn_permissions_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `dgn_modules` (`module_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `dgn_users`
--
ALTER TABLE `dgn_users`
  ADD CONSTRAINT `dgn_users_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `dgn_people` (`person_id`);

