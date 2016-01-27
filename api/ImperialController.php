<?php

use \Jacwright\RestServer\RestException;

class ImperialController
{
    /**
     * Returns a JSON string object to the browser when hitting the root of the domain
     *
     *
     * @url GET standings/$year
     * @url GET standings/$month/$year
     * @url GET standings/$year/$region
     * @url GET standings/$month/$year/$region
     */
    public function region($region = null, $month = null, $year)
    {
        $conn = new mysqli('localhost', 'impbnsco_admin', '1992Thgink', 'impbnsco_admin');
        $results = "";
        $myArray = array();
        if ($conn) {
            if (($month) && ($year) && ($region)) {
                $results = mysqli_query($conn, "SELECT * FROM ".$month.$year."_standings s WHERE s.region = '$region' ORDER BY s.points DESC ");
            }
            if ((!$month) && ($year) && ($region)) {
                $results = mysqli_query($conn, "SELECT * FROM ".$year."_standings s WHERE s.region = '$region' ORDER BY s.points DESC ");

            }
            if (($month) && ($year) && (!$region)) {
                $results = mysqli_query($conn, "SELECT * FROM ".$month.$year."_standings s ORDER BY s.points DESC ");
            }
            if ((!$month) && ($year) && (!$region)) {
                $results = mysqli_query($conn, "SELECT * FROM ".$year."_standings s ORDER BY s.points DESC ");
            }
        }
        if ($results) {
            while($row = $results->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
        }
        $results->close();
        $conn->close();
        return $myArray;
    }

    /**
     * Logs in a user with the given username and password POSTed. Though true
     * REST doesn't believe in sessions, it is often desirable for an AJAX server.
     *
     * @url POST /login
     */
    public function login($data)
    {
        $email = $data->email;
        $password = md5($data->password);
        $conn = new mysqli('localhost', 'impbnsco_admin' , '1992Thgink', 'impbnsco_admin');
        $result = "";
        if ($conn) {
            $result = mysqli_query($conn, "SELECT * FROM users u WHERE u.email = '$email' and u.password = '$password'");
        }
        if ($result) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
        }
        $result->close();
        $conn->close();
        return $row;
    }

    /**
     * Add in a new standing
     *
     * @url POST /standings/add
     */
    public function addStanding($data)
    {
        $conn = new mysqli('localhost', 'impbnsco_admin' , '1992Thgink', 'impbnsco_admin');
        $month = $data->month;
        $region = $data->region;
        $name = $data->name;
        $class = $data->class;
        $profile = $data->profile;
        $points = $data->points;

        if ($conn) {
            $conn->query("INSERT INTO ".$month."2016_standings(id, name, class, points, profile, region)
            VALUES ('','$name','$class','$points','$profile','$region')");
        }
        $conn->close();
    }

    /**
     * Add in a new standing
     *
     * @url POST /standings/edit
     */
    public function editStanding($data)
    {
        $conn = new mysqli('localhost', 'impbnsco_admin' , '1992Thgink', 'impbnsco_admin');
        $month = $data->month;
        $region = $data->region;
        $name = $data->name;
        $class = $data->class;
        $profile = $data->profile;
        $points = $data->points;
        $id = $data->id;

        if ($conn) {
            $conn->query("UPDATE ".$month."2016_standings SET name='$name',
                          class='$class',points='$points',profile='$profile',
                          region='$region' WHERE id = '$id'");
        }
        $conn->close();
    }


    /**
     * Throws an error
     *
     * @url GET /error
     */
    public function throwError() {
        throw new RestException(401, "Empty password not allowed");
    }
}