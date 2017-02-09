DELIMITER $$

USE `hwc_mobile`$$

DROP PROCEDURE IF EXISTS `SP_GET_USER_BY_PHONE`$$

CREATE DEFINER=`root`@`%` PROCEDURE `SP_GET_USER_BY_PHONE`(IN reference NVARCHAR(200))
BEGIN
/* *****************************************************************************************
-- Name SP_GET_USER_BY_PHONE
-- Description  The following procedure is used to get the user object by phone.
-- Maintainence History
--  Developer                  		Date                       Modification Made
--  Kritika Bajpai                	19/12/16                   Create Procedure
-- ******************************************************************************************
*/
    DECLARE id INT;
    SELECT user_id INTO id FROM contact WHERE `contact_content` = reference AND active = 1 LIMIT 1;     
    CALL SP_Get_User(id);
    COMMIT;
END$$

DELIMITER ;