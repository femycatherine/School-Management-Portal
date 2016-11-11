<?php
$sql = '
CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `homework_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `upload_link` text NOT NULL,
  `last_update_time` date NOT NULL,
  `grade` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;
CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `year` text NOT NULL,
  `grade` text NOT NULL,
  `create_time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;
CREATE TABLE IF NOT EXISTS `class_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `create_time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

CREATE TABLE IF NOT EXISTS `class_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;
CREATE TABLE IF NOT EXISTS `configuration` (
  `id` int(11) NOT NULL,
  `site_name` text NOT NULL,
  `site_logo_url` text NOT NULL,
  `email` text NOT NULL,
  `theme` text NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_name` text NOT NULL,
  `file_location` text NOT NULL,
  `who_uploaded` text NOT NULL,
  `create_time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

CREATE TABLE IF NOT EXISTS `functions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `function_name` text NOT NULL,
  `function_variable` text NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

CREATE TABLE IF NOT EXISTS `help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `created_by` text NOT NULL,
  `create_time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `home_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `home_work_heading` text NOT NULL,
  `topics_text` text NOT NULL,
  `upload_link` text NOT NULL,
  `create_time` date NOT NULL,
  `respond_time` date NOT NULL,
  `teacher` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

CREATE TABLE IF NOT EXISTS `liturgy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `day` date NOT NULL,
  `activity` text NOT NULL,
  `category` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=223 ;

CREATE TABLE IF NOT EXISTS `liturgy_dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dates` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

CREATE TABLE IF NOT EXISTS `liturgy_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `liturgy_member_id` int(11) NOT NULL,
  `category` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

CREATE TABLE IF NOT EXISTS `login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `url` text NOT NULL,
  `action_time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7785 ;
CREATE TABLE IF NOT EXISTS `reading` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `heading` text NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` text NOT NULL,
  `role_description` text NOT NULL,
  `template` text NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;
CREATE TABLE IF NOT EXISTS `role_function` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `function_id` mediumint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=222 ;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` text NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone_home` text NOT NULL,
  `phone_cell` text NOT NULL,
  `email` text NOT NULL,
  `contact_name1` text NOT NULL,
  `contact_phone1` text NOT NULL,
  `contact_relation1` text NOT NULL,
  `contact_name2` text NOT NULL,
  `contact_phone2` text NOT NULL,
  `contact_relation2` text NOT NULL,
  `new_student` int(1) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_baptism` date NOT NULL,
  `parish_where_baptized` text NOT NULL,
  `name_of_previous_school` text NOT NULL,
  `father_family_name` text NOT NULL,
  `father_name` text NOT NULL,
  `father_religion_rite` text NOT NULL,
  `father_place_of_birth` text NOT NULL,
  `father_parish_diocess` text NOT NULL,
  `mother_family_name` text NOT NULL,
  `mother_name` text NOT NULL,
  `mother_religion_rite` text NOT NULL,
  `mother_place_of_birth` text NOT NULL,
  `mother_parish_diocess` text NOT NULL,
  `date` date NOT NULL,
  `sign` int(1) NOT NULL,
  `message_info` text NOT NULL,
  `baptism_doc_location` text NOT NULL,
  `other_data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

CREATE TABLE IF NOT EXISTS `student_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=688 ;

CREATE TABLE IF NOT EXISTS `student_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `name` text NOT NULL,
  `username` text NOT NULL,
  `pass` text NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;INSERT INTO `functions` (`id`, `function_name`, `function_variable`, `create_time`) VALUES
(1, "Manage Roles", "Manage_Roles", "2016-02-11 00:00:00"),
(2, "Manage Users", "Manage_Users", "2016-02-11 00:00:00"),
(3, "Faith Formation Registration", "Faith_Formation_Registration", "0000-00-00 00:00:00"),
(4, "View CCD Attendence", "View_CCD_Attendence", "0000-00-00 00:00:00"),
(5, "View Grades", "View_Grades", "0000-00-00 00:00:00"),
(6, "View Students", "View_Students", "0000-00-00 00:00:00"),
(7, "View Teachers List", "View_Teachers_List", "0000-00-00 00:00:00"),
(8, "Manage Members", "Manage_Members", "0000-00-00 00:00:00"),
(9, "View CCD Classes", "View_CCD_Classes", "0000-00-00 00:00:00"),
(10, "Documents", "Documents", "0000-00-00 00:00:00"),
(11, "Manage Operations", "Manage_Operations", "0000-00-00 00:00:00"),
(12, "Manage Liturgy", "Manage_Liturgy", "0000-00-00 00:00:00"),
(13, "Settings", "Settings", "0000-00-00 00:00:00"),
(14, "Grades and Attendance", "Grades_and_Attendance", "0000-00-00 00:00:00"),
(15, "Mark Attendance", "Mark_Attendance", "0000-00-00 00:00:00"),
(16, "Home Work information", "Home_Work_information", "0000-00-00 00:00:00"),
(17, "Grades and Attendance parent view", "Grades_and_Attendance_parent_view", "0000-00-00 00:00:00");
		INSERT INTO `users` (`id`, `email`, `name`, `username`, `pass`)
		VALUES (1, "root@root.com", "admin", "admin", "admin");INSERT INTO `roles` (`id`, `role_name`, `role_description`, `template`, `create_time`) VALUES
(1, "Admin", "Administrator", "index", "0000-00-00 00:00:01"),
(2, "Parent", "Parent", "dashboard_guardian", "0000-00-00 00:00:00"),
(3, "Teacher", "Teacher", "dashboard_mentor", "2016-02-14 00:00:00"),
(20, "Any Staff", "Any Staff", "index", "0000-00-00 00:00:00"),
(30, "Manager", "Manager", "index", "2016-03-07 17:33:50"),
(31, "Decon", "Decon", "index", "2016-03-07 21:34:02");

INSERT INTO `role_function` (`id`, `role_id`, `function_id`) VALUES
(217, 1, 16),
(216, 1, 15),
(215, 1, 14),
(214, 1, 13),
(213, 1, 12),
(212, 1, 11),
(211, 1, 10),
(210, 1, 9),
(209, 1, 8),
(208, 1, 7),
(207, 1, 6),
(206, 1, 5),(205, 1, 4),(204, 1, 3),(203, 1, 2),(202, 1, 1);
INSERT INTO `user_role` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1);';

?>