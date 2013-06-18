<?php

class defaultDB Extends DB
{

    public $DBH;

    public function __construct()
    {
        parent::__construct();
        //$this->DBH = parent::DBH;
    }

    public function getDefaultListings()
    {

        $select = "SELECT DISTINCT
            `Projects`.`project_id` AS `project_id_1`,
            `Projects`.`project_name` AS `project_name`,
            (SELECT GROUP_CONCAT(`Keywords`.`keyword_str` SEPARATOR ', ')
                FROM `Projects`
                LEFT JOIN `Projects_has_Keywords` ON `Projects`.`project_id` = `Projects_has_Keywords`.`Projects_project_id`
                RIGHT JOIN `Keywords` ON `Keywords`.`keyword_id` = `Projects_has_Keywords`.`Keywords_keyword_id`
                WHERE `Projects`.`project_id` = `project_id_1`) AS `keywords`,

            DATE_FORMAT(`Projects`.`project_created`, '%D %b, %Y') AS `created`,
            (SELECT DATE_FORMAT(`Entries`.`Timestamp_out`, '%D %b, %Y') FROM `Entries` WHERE
            `Projects_project_id` = `project_id_1` ORDER BY `Entries`.`entry_id` DESC LIMIT 1) AS `last_active`,
            `Projects`.`project_active` AS `active`,
            `Projects`.`project_remarks` AS `remarks`

            FROM `Projects`
                LEFT JOIN `Projects_has_Keywords` ON `Projects`.`project_id` = `Projects_has_Keywords`.`Projects_project_id`
                RIGHT JOIN `Keywords` ON `Keywords`.`keyword_id` = `Projects_has_Keywords`.`Keywords_keyword_id`

            WHERE `Projects`.`project_active` = 1

                ORDER BY `Projects`.`project_id` ASC";



        // assign the statement handler
        $stmt = $this->DBH->prepare($select);

        // Execute the query
        $stmt->execute();

        if ($results = $stmt->fetchAll(PDO::FETCH_NUM))
        {
            return $results;
        } else {
            return "No results";
        }
    }

}

