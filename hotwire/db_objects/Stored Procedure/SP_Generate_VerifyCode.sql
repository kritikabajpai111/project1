DELIMITER $$

USE `hwc_mobile`$$

DROP PROCEDURE IF EXISTS `SP_Generate_VerifyCode`$$

CREATE DEFINER=`root`@`%` PROCEDURE `SP_Generate_VerifyCode`(IN reference NVARCHAR(200))
BEGIN

/* *****************************************************************************************
-- Name SP_Generate_VerifyCode - V2
-- Description  The following procedure is used to generate and store a verify code.
-- Maintainence History
--  Developer                  		Date                       Modification Made
--  Harley Fischel                 	11/22/16                   Create Procedure
-- ******************************************************************************************
*/

	DECLARE vcode INT;
	DECLARE contact_id INT;
/*    DECLARE vveri INT; */
    DECLARE verify_type INT;

	SELECT id INTO verify_type FROM vlist_item WHERE `code` = IF(CEIL(reference),'VERIFICATIONTYPEMOBPHONE','VERIFICATIONTYPEEMAIL') LIMIT 1;

/*	START TRANSACTION;*/ 
							/* SAFE UPDATE MODE FIX */
/*	WHILE (SELECT id FROM verify_code WHERE `active` = 1 AND `expire_date` < NOW()) DO
		UPDATE verify_code SET `active` = 0 WHERE `id` = id;
	END WHILE;*/
    UPDATE verify_code SET `active` = 0 WHERE `active` = 1 AND `expire_date` < NOW();
/*	COMMIT;*/
/*	UPDATE verify_code SET `active` = 0 WHERE `active` = 1 AND `expire_date` < NOW();
  */      
/*	SELECT `id` INTO contact_id FROM contact WHERE `information` = reference; */
/*	SELECT `verified` INTO vveri FROM contact WHERE `id` = contact_id; */

/*	IF vveri = 1 THEN 
		SELECT vveri AS `verified`;
    ELSE */ /*  AND `verified` = 0 */
/*
		UPDATE verify_code SET `active` = 0 WHERE `active` = 1 AND `expire_date` > NOW();
*/
		SELECT FLOOR((RAND() * (999999-100000+1))+100000) AS v_code FROM verify_code 
		WHERE "v_code" NOT IN (SELECT `verification_code` FROM verify_code WHERE `active` = 1) LIMIT 1 INTO vcode; 
/*SET vcode = '123456';*/
		INSERT INTO verify_code (`verification_code`,
								`content`,
                                `verify_type_li`,
								`expire_date`,
                                `mod_person_id`,
                                `active`)
							VALUES
								(vcode,
								reference,
                                verify_type,
								NOW() + INTERVAL 20 MINUTE,
                                1,
                                1);

		SELECT vcode AS `code` LIMIT 1;
        COMMIT;
/*	END IF;
*/
END$$

DELIMITER ;