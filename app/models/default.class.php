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

        $this->closeTimers();

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


                return $this->prepareStatement($select, true, true);

    }

    public function closeTimers()
    {

        $update = "UPDATE `Entries` SET `Timestamp_out` = NOW() WHERE `Timestamp_out` IS NULL";

        $results = $this->prepareStatement($update, true, false);

        if ($results !== "No Results")
        {
            return $results;
        }

        return $results; //"No Results"

    }


    public function confirmKeyword($keyword)
    {

        $select = "SELECT `keyword_id` FROM `Keywords` WHERE `keyword_str` LIKE ? LIMIT 1;";

        $prepared = $this->prepareStatement($select, false);

        $prepared->bindParam(1, $keyword, PDO::PARAM_STR, 50);

        $result = $this->executeStatement($prepared, true);


        if (is_array($result) && count($result) > 0)
        {
            $keyword_id = $result[0]['keyword_id'];
            return $keyword_id;
        }

        return "Error confirming Keyword";

    }


    public function startTimer($keyword, $project_id)
    {

        $this->closeTimers();

        $keyword_id = $this->confirmKeyword($keyword);

        $update = "INSERT INTO `Entries` SET `Keywords_keyword_id` = ?, `Projects_project_id` = ?, `Timestamp_in` = NOW();";

        $project_id = $project_id;
        $keyword_id = $keyword_id;

        $prepared = $this->prepareStatement($update, false);

        $prepared->bindParam(1, $keyword_id, PDO::PARAM_INT);
        $prepared->bindParam(2, $project_id, PDO::PARAM_INT);

        $results = $this->executeStatement($prepared, false);
        //var_dump($results);

        if ($results !== "No Results")
        {
            return $results;
        }

        return $results; //"No Results"
    }


    public function prepareStatement($stmt, $execute = false, $fetch = false)
    {
        $prepare = $this->DBH->prepare($stmt);

        if (!empty($execute))
        {
            return $this->executeStatement($prepare, $fetch);
        }

        return $prepare;

    }

    public function executeStatement($prepared, $fetch = false)
    {

        $prepared->execute();

        try {

            if (false !== $fetch)
            {
                $results = $prepared->fetchAll();
                return $results;
            }

            return true;

        } catch (PDOException $e) {
        echo"something went wrong! " . var_dump($e);
    }
   //     {
   //         return $results;
   //     }

   //     return "No Results";

   }



}

