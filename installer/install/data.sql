INSERT INTO `gameNews` (`GN_id`, `GN_author`, `GN_title`, `GN_text`, `GN_date`) VALUES
(1, 1, 'Instalation Complete', 'Framework successfully installed', UNIX_TIMESTAMP());


INSERT INTO `notifications` (`N_time`, `N_id`, `N_uid`, `N_text`, `N_read`) VALUES
(UNIX_TIMESTAMP(), 1, 1, 'Framework installed successfully', 0);


INSERT INTO `userRoles` (`UR_id`, `UR_desc`, `UR_color`) VALUES
(1, 'User', '#777777'),
(2, 'Admin', '#FFFFFF'),
(3, 'Banned', '#FF0000');

INSERT INTO `roleAccess` (`RA_role`, `RA_module`) VALUES (2, '*');