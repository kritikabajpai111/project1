DELIMITER $$

USE `hwc_mobile`$$

DROP PROCEDURE IF EXISTS `SP_GET_USER_COUNT`$$

CREATE DEFINER=`root`@`%` PROCEDURE `SP_GET_USER_COUNT`(IN reference NVARCHAR(200))
BEGIN
/* *****************************************************************************************
-- Name SP_CHECK_USERNUMBER
-- Description  The following procedure is used to check the number of user in one contact.
-- Maintainence History
--  Developer                  		Date                       Modification Made
--  Kritika Bajpai                	19/12/16                   Create Procedure
-- ******************************************************************************************
*/
    DECLARE id INT;
    DECLARE total INT;
    SELECT COUNT(*) INTO total FROM contact WHERE `contact_content` = reference AND active = 1;
    SELECT IF(total >1, 1, 0) AS `result`;    
    COMMIT;
END$$

DELIMITER ;