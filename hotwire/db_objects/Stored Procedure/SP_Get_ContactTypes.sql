DELIMITER $$
DROP PROCEDURE IF EXISTS SP_Get_ContactTypes$$
CREATE PROCEDURE SP_Get_ContactTypes()
BEGIN
/* *****************************************************************************************
-- Name SP_Get_ContactTypes
-- Description       The following procedure is design to return a list of contact types 
					 that can be used with the SP_UPDATE_CONTACT Procedure.
-- Maintainence History
--  Developer                  		Date                       Modification Made
--  Harley Fischel                 	12/12/16                   Create Procedure
-- ******************************************************************************************
*/

	SELECT vlist_item.`name` AS contact_type, SUBSTRING(vlist_item.`code`,12) AS contact_code FROM vlist_item 
    WHERE vlist_item.`code` LIKE 'CONTACTTYPE%' ORDER BY vlist_item.`name`;

	COMMIT;

END$$

DELIMITER ; 
