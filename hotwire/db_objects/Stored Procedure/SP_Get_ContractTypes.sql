DELIMITER $$
DROP PROCEDURE IF EXISTS SP_Get_ContractTypes$$
CREATE PROCEDURE SP_Get_ContractTypes()
BEGIN
/* *****************************************************************************************
-- Name SP_Get_ContractTypes
-- Description       The following procedure is design to return a list of contract types 
					 that can be used with the SP_GET_CONTRACT Procedure.
-- Maintainence History
--  Developer                  		Date                       Modification Made
--  Harley Fischel                 	12/09/16                   Create Procedure
-- ******************************************************************************************
*/

	SELECT vlist_item.`name` AS contract_name, SUBSTRING(vlist_item.`code`,13) AS contract_code FROM vlist_item 
    WHERE vlist_item.`code` LIKE 'CONTRACTTYPE%' ORDER BY vlist_item.`name`;

	COMMIT;

END$$

DELIMITER ; 
