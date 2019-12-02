<?php

require_once "config.php";

function get_stu_availability()
{
    global $link;
    $items = array();

    $sql = "SELECT
    sr.eid, sr.mo_times, sr.tu_times, sr.we_times, sr.th_times, sr.fr_times, sr.sa_times, sr.su_times
    FROM
        (SELECT
            eid, MAX(request_date) AS request_date
        FROM
            scheduler_requests as sr
        GROUP BY eid) AS sr_join
    INNER JOIN
        scheduler_requests as sr
    ON
        sr.eid = sr_join.eid AND
        sr.request_date = sr_join.request_date
    ORDER BY
        eid";

    if ($link->connect_errno) {
        printf("Connect failed: %s\n", $link->connect_error);
        exit();
    }
    if ($result = $link->query($sql)) {
        // printf("Select returned %d rows.\n", $result->num_rows);
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        /* free result set */
        $result->close();
    }

    return $items;
}
