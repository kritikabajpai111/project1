DELIMITER $$

USE `hwc_mobile`$$

DROP PROCEDURE IF EXISTS `SP_GET_USER_BYPHONE`$$

CREATE DEFINER=`root`@`%` PROCEDURE `SP_GET_USER_BYPHONE`(IN reference NVARCHAR(200))
BEGIN
/* *****************************************************************************************
-- Name SP_GET_USER_BYPHONE
-- Description  The following procedure is used to get the user object by phone.
-- Maintainence History
--  Developer                  		Date                       Modification Made
--  Kritika Bajpai                	19/12/16                   Create Procedure
-- ******************************************************************************************
*/
    DECLARE contact_id INT;
    SELECT id INTO contact_id FROM contact WHERE `contact_content` = reference AND active = 1 LIMIT 1;    
    COMMIT;
    CALL SP_GET_CONTACT(contact_id);
END$$

DELIMITER ;