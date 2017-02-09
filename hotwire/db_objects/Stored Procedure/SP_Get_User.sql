DELIMITER $$

USE `hwc_mobile`$$

DROP PROCEDURE IF EXISTS `SP_Get_User`$$

CREATE DEFINER=`root`@`%` PROCEDURE `SP_Get_User`(IN user_id INTEGER)
BEGIN
/* *****************************************************************************************
-- Name SP_GET_USER
-- Description       The following procedure is used to return user information.
-- Maintainence History
--  Developer                  		Date                       Modification Made
--  Geoff Baker                   	11/14/16                   Create Procedure
-- ******************************************************************************************
*/

	SELECT id, first_name, last_name, emailaddress_login 
    FROM USER WHERE id = user_id LIMIT 1;
	COMMIT;

END$$

DELIMITER ;