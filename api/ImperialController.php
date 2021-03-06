<?php

use \Jacwright\RestServer\RestException;

class ImperialController
{
    const HOST = "localhost";
    const USER = "impbnsco_admin";
    const PWD = "3egR0HTB0QCvaqE";
    const DB = "impbnsco_admin";
    private static $conn;

    public function __construct()
    {
        self::$conn = new mysqli(self::HOST, self::USER, self::PWD, self::DB);
    }

    public function __destruct() {
        self::$conn = null;
    }

    /**
     * Logs in a user with the given username and password POSTed. Though true
     * REST doesn't believe in sessions, it is often desirable for an AJAX server.
     *
     * @url POST /login
     */
    public function login($data)
    {
        $stmt = "";
        $password = md5($data->password);
        if (self::$conn) {
            $stmt = self::$conn->prepare("SELECT id, username, email, status FROM users u WHERE u.email = ? and u.password = ?");
            $stmt->bind_param("ss", $data->email, $password);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                return http_response_code(401);
            }
            $stmt->bind_result($id, $username, $email, $status);
            while($stmt->fetch()) {
                $row = array('id'=> $id, 'username' => $username, 'email' => $email, 'status' => $status);
            }

        }
        $stmt->close();
        self::$conn->close();
        return $row;
    }


    /**
     * Get all standings with month or/and region
     *
     * @url GET standings/$month
     * @url GET standings/$month/$region
     */
    public function region($month, $region = null)
    {
        $myArray = array();
        $stmt = "";
        if (self::$conn) {
            if (($month) && (!$region)) {
                $stmt = self::$conn->prepare("SELECT * FROM ".$month."2016_standings s ORDER BY s.points DESC");
            }
            if (($month) && ($region)) {
                $stmt = self::$conn->prepare("SELECT * FROM ".$month."2016_standings s WHERE s.region = ? ORDER BY s.points DESC");
                $stmt->bind_param("s", $region);
            }
        }
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 0) {
            return http_response_code(404);
        }
        $stmt->bind_result($id, $name, $class, $points, $profile, $region);
        while($stmt->fetch()) {
            $myArray[] = array('id'=> $id, 'name' => $name, 'class' => $class, 'points' => $points, 'profile' => $profile, 'region' => $region);
        }
        $stmt->close();
        self::$conn->close();
        return $myArray;
    }


    /**
     * Get a single standing with the month and its id
     *
     * @url GET /standing/$month/$id
     */
    public function getStanding($month, $id)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("SELECT * FROM ".$month."2016_standings s WHERE s.id = ?");
            $stmt->bind_param("d", $id);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                return http_response_code(404);
            }
            $stmt->bind_result($id, $name, $class, $points, $profile, $region);
            while($stmt->fetch()) {
                $result = array('id'=> $id, 'name' => $name, 'class' => $class, 'points' => $points, 'profile' => $profile, 'region' => $region);
            }
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }


    /**
     * Add a new standing
     *
     * @url POST /standing/add
     */
    public function addStanding($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("INSERT INTO ".$data->month."2016_standings(name, class, points, profile, region)
                                            VALUES (?,?,?,?,?)");
            $stmt->bind_param("ssdss", $data->name, $data->class, $data->points, $data->profile, $data->region);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Delete a standing
     *
     * @url POST /standing/delete
     */
    public function deleteStanding($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("DELETE FROM ".$data->month."2016_standings WHERE id = ? AND name = ?");
            $stmt->bind_param("ds", $data->id, $data->name);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Edit a standing
     *
     * @url POST /standing/edit
     */
    public function editStanding($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE ".$data->month."2016_standings SET name=?,class=?,points=?,profile=?,region=? WHERE id =?");
            $stmt->bind_param("ssdssd", $data->name, $data->class, $data->points, $data->profile, $data->region, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Edit a standing name
     *
     * @url POST /standing/editName
     */
    public function editStandingName($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE ".$data->month."2016_standings SET name=? WHERE id =?");
            $stmt->bind_param("sd", $data->name, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Edit a standing class
     *
     * @url POST /standing/editClass
     */
    public function editStandingClass($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE ".$data->month."2016_standings SET class=? WHERE id =?");
            $stmt->bind_param("sd", $data->class, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Edit a standing points
     *
     * @url POST /standing/editPoints
     */
    public function editStandingPoints($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE ".$data->month."2016_standings SET points=? WHERE id =?");
            $stmt->bind_param("dd", $data->points, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Edit a standing profile
     *
     * @url POST /standing/editProfile
     */
    public function editStandingProfile($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE ".$data->month."2016_standings SET profile=? WHERE id =?");
            $stmt->bind_param("sd", $data->profile, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Edit a standing region
     *
     * @url POST /standing/editRegion
     */
    public function editStandingRegion($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE ".$data->month."2016_standings SET region=? WHERE id =?");
            $stmt->bind_param("sd", $data->region, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Get all user infos
     *
     * @url GET /userInfo/$id
     */
    public function getUserInfos($id)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("SELECT u.username, u.mention, u.introvid, u.description, u.facebook, u.twitter,
                                          u.youtube, u.googleplus FROM users u WHERE u.id = ?");
            $stmt->bind_param("d", $id);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                return http_response_code(404);
            }
            $stmt->bind_result($username, $mention, $introvid, $description, $facebook, $twitter, $youtube, $googleplus);
            while($stmt->fetch()) {
                $myArray = array('username' => $username, 'mention'=> $mention, 'introvid' => $introvid, 'description' => $description,
                    'facebook' => $facebook, 'twitter' => $twitter, 'youtube' => $youtube, 'googleplus' => $googleplus);
            }
        }
        $stmt->close();
        self::$conn->close();
        return $myArray;
    }

    /**
     * Edit all user infos
     *
     * @url POST /user/edit
     */
    public function editUserInfos($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE users SET introvid=?, description=?, facebook=?,
                                          twitter=?, youtube=?, googleplus=? WHERE id =?");
            $stmt->bind_param("ssssssd", $data->introvid, $data->description, $data->facebook, $data->twitter,
                $data->youtube, $data->googleplus, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit user mention
     *
     * @url POST /user/editMention
     */
    public function editUserMention($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE users SET mention=? WHERE id =?");
            $stmt->bind_param("sd", $data->mention, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit user introvid
     *
     * @url POST /user/editIntrovid
     */
    public function editUserIntrovid($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE users SET introvid=? WHERE id =?");
            $stmt->bind_param("sd", $data->introvid, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit user description
     *
     * @url POST /user/editDescription
     */
    public function editUserDescription($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE users SET description=? WHERE id =?");
            $stmt->bind_param("sd", $data->description, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit user facebook
     *
     * @url POST /user/editFacebook
     */
    public function editUserFacebook($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE users SET facebook=? WHERE id =?");
            $stmt->bind_param("sd", $data->facebook, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit user twitter
     *
     * @url POST /user/editTwitter
     */
    public function editUserTwitter($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE users SET twitter=? WHERE id =?");
            $stmt->bind_param("sd", $data->twitter, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit user youtube
     *
     * @url POST /user/editYoutube
     */
    public function editUserYoutube($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE users SET youtube=? WHERE id =?");
            $stmt->bind_param("sd", $data->youtube, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit user googleplus
     *
     * @url POST /user/editGoogleplus
     */
    public function editUserGooglePlus($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE users SET googleplus=? WHERE id =?");
            $stmt->bind_param("sd", $data->googleplus, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Get all the guides
     *
     * @url GET /guides
     */
    public function getGuides()
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("SELECT g.id, u.username, g.class, g.title, g.description, g.video, g.iframe
                                          FROM guides g INNER JOIN users u ON g.user_id = u.id");
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                return http_response_code(404);
            }
            $stmt->bind_result($id, $username, $class, $title, $description, $video, $iframe);
            while($stmt->fetch()) {
                $myArray[] = array('id'=> $id, 'username' => $username, 'class' => $class, 'title' => $title,
                    'description' => $description, 'video' => $video, 'iframe' => $iframe);
            }
        }
        $stmt->close();
        self::$conn->close();
        return $myArray;
    }

    /**
     * Get all users having a guide
     *
     * @url GET /guides/user
     */
    public function getGuidesUser()
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("SELECT u.id, u.username
                                          FROM users u INNER JOIN guides g ON g.user_id = u.id GROUP BY u.id");
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                return http_response_code(404);
            }
            $stmt->bind_result($id, $username);
            while($stmt->fetch()) {
                $myArray[] = array('id'=> $id, 'username' => $username);
            }
        }
        $stmt->close();
        self::$conn->close();
        return $myArray;
    }

    /**
     * Get all users having a guide of a class
     *
     * @url GET /guides/user/class/$class
     */
    public function getClassGuidesUser($class)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("SELECT u.id, u.username, g.class
                                          FROM users u INNER JOIN guides g ON g.user_id = u.id
                                          WHERE g.class = ?
                                          GROUP BY u.id");
            $stmt->bind_param("s", $class);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                return http_response_code(404);
            }
            $stmt->bind_result($id, $username, $class);
            while($stmt->fetch()) {
                $myArray[] = array('id'=> $id, 'username' => $username, 'class' => $class);
            }
        }
        $stmt->close();
        self::$conn->close();
        return $myArray;
    }

    /**
     * Get a single guide based on guide id
     *
     * @url GET /user/guide/$id
     */
    public function getUserGuide($id)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("SELECT g.id, u.username, g.class, g.title, g.description, g.video, g.iframe
                                          FROM guides g INNER JOIN users u ON g.user_id = u.id WHERE g.id = ?");
            $stmt->bind_param("d", $id);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                return http_response_code(404);
            }
            $stmt->bind_result($id, $username, $class, $title, $description, $video, $iframe);
            while($stmt->fetch()) {
                $myArray = array('id'=> $id, 'username' => $username, 'class' => $class, 'title' => $title,
                    'description' => $description, 'video' => $video, 'iframe' => $iframe);
            }
        }
        $stmt->close();
        self::$conn->close();
        return $myArray;
    }

    /**
     * Get a all guide from an user based on user id
     *
     * @url GET /user/guides/$id
     */
    public function getUserGuides($id)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("SELECT g.id, u.username, g.class, g.title, g.description, g.video, g.iframe
                                          FROM guides g INNER JOIN users u ON g.user_id = u.id WHERE g.user_id = ?");
            $stmt->bind_param("d", $id);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                return http_response_code(404);
            }
            $stmt->bind_result($id, $userId, $class, $title, $description, $video, $iframe);
            while($stmt->fetch()) {
                $myArray[] = array('id'=> $id, 'userId' => $userId, 'class' => $class, 'title' => $title,
                    'description' => $description, 'video' => $video, 'iframe' => $iframe);
            }
        }
        $stmt->close();
        self::$conn->close();
        return $myArray;
    }

    /**
     * Get a all guides titles from an user based on user id and the class
     *
     * @url POST /user/guides/titles
     */
    public function getUserGuidesTitles()
    {
        $class = $_POST['class'];
        $id = $_POST['id'];
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("SELECT g.id, g.title FROM guides g
                                          INNER JOIN users u ON g.user_id = u.id
                                          WHERE g.class = ? AND g.user_id = ?");
            $stmt->bind_param("sd", $class, $id);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                return http_response_code(404);
            }
            $stmt->bind_result($id, $title);
            while($stmt->fetch()) {
                $myArray[] = array('guideID' => $id, 'title' => $title);
            }
        }
        $stmt->close();
        self::$conn->close();
        return $myArray;
    }

    /**
     * Add a new guide
     *
     * @url POST /user/guide/add
     */
    public function addGuide($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("INSERT INTO guides (id, user_id, class, title, description, video, iframe) VALUES ('',?,?,?,?,?,?)");
            $stmt->bind_param("dsssss", $data->userId, $data->class, $data->title, $data->description, $data->video, $data->iframe);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Delete a guide
     *
     * @url GET /user/guide/delete/$id
     */
    public function deleteGuide($id)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("DELETE FROM guides WHERE id = ?");
            $stmt->bind_param("d", $id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Edit all guide info
     *
     * @url POST /user/guide/edit
     */
    public function editUserGuide($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE guides SET class=?, title=?, description=?, video=?, iframe=? WHERE id =?");
            $stmt->bind_param("sssssd", $data->class, $data->title, $data->description, $data->video, $data->iframe, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit a user guide class
     *
     * @url POST /user/guide/editClass
     */
    public function editUserGuideClass($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE guides SET class=? WHERE id =?");
            $stmt->bind_param("sd", $data->class, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit a user guide title
     *
     * @url POST /user/guide/editTitle
     */
    public function editUserGuideTitle($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE guides SET title=? WHERE id =?");
            $stmt->bind_param("sd", $data->title, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit a user guide description
     *
     * @url POST /user/guide/editDescription
     */
    public function editUserGuideDescription($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE guides SET description=? WHERE id =?");
            $stmt->bind_param("sd", $data->description, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit a user guide video
     *
     * @url POST /user/guide/editVideo
     */
    public function editUserGuideVideo($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE guides SET video=? WHERE id =?");
            $stmt->bind_param("sd", $data->video, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit a user guide iframe
     *
     * @url POST /user/guide/editIframe
     */
    public function editUserGuideIframe($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE guides SET iframe=? WHERE id =?");
            $stmt->bind_param("sd", $data->iframe, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Get all tournaments
     *
     * @url GET /tournaments
     */
    public function getTournaments()
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("SELECT id, t.name, startDate, description, brackets, players, region, finished
                                          FROM tournaments t");
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                return http_response_code(404);
            }
            $stmt->bind_result($id, $name, $startDate, $description, $brackets, $players, $region, $finished);
            while($stmt->fetch()) {
                $myArray[] = array('id' => $id, 'name' => $name, 'startDate' => $startDate, 'description' => $description,
                    'brackets' => $brackets, 'region' => $region, 'players' => $players, 'finished' => $finished);
            }
        }
        $stmt->close();
        self::$conn->close();
        return $myArray;
    }

    /**
     * Get all ongoing tournaments
     *
     * @url GET /tournaments/ongoing
     */
    public function getOngoingTournaments()
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("SELECT id, t.name, startDate, description, brackets, players, region, finished
                                          FROM tournaments t WHERE t.finished = 0");
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                return http_response_code(404);
            }
            $stmt->bind_result($id, $name, $startDate, $description, $brackets, $players, $region, $finished);
            while($stmt->fetch()) {
                $myArray[] = array('id' => $id, 'name' => $name, 'startDate' => $startDate, 'description' => $description,
                    'brackets' => $brackets, 'region' => $region, 'players' => $players, 'finished' => $finished);
            }
        }
        $stmt->close();
        self::$conn->close();
        return $myArray;
    }

    /**
     * Get all finished tournaments
     *
     * @url GET /tournaments/finished
     */
    public function getFinishedTournaments()
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("SELECT id, t.name, t.startDate, t.description, t.brackets, t.players, t.region, t.finished
                                          FROM tournaments t WHERE t.finished = 1");
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                return http_response_code(404);
            }
            $stmt->bind_result($id, $name, $startDate, $description, $brackets, $players, $region, $finished);
            while($stmt->fetch()) {
                $myArray[] = array('id' => $id, 'name' =>$name, 'startDate' => $startDate, 'description' => $description,
                    'brackets' => $brackets, 'region' => $region, 'players' => $players, 'finished' => $finished);
            }
        }
        $stmt->close();
        self::$conn->close();
        return $myArray;
    }

    /**
     * Add a new tournament
     *
     * @url POST /tournament/add
     */
    public function addTournament($data)
    {
        $stmt = "";
        if (self::$conn) {
            if (self::$conn) {
                $stmt = self::$conn->prepare("INSERT INTO tournaments (id, name, startDate, description, brackets, players, region, finished)
                                              VALUES ('',?,?,?,?,?,?,0)");
                $stmt->bind_param("ssssss", $data->name, $data->starDate, $data->description, $data->brackets, $data->players, $data->region);
                $stmt->execute();
            }
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Delete a tournament
     *
     * @url POST /tournaments/delete
     */
    public function deleteTournament($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("DELETE FROM tournaments t WHERE t.id = ?");
            $stmt->bind_param("d", $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit all tournament info
     *
     * @url POST /tournament/edit
     */
    public function editTournament($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE tournaments t
                                          SET t.name=?, startDate=?, description=?, brackets=?, players=?, region=?, finished=?
                                          WHERE id =?");
            $stmt->bind_param("ssssssdd", $data->name, $data->startDate, $data->description,
                $data->brackets, $data->players, $data->region, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit a tournament name
     *
     * @url POST /tournament/edit/name
     */
    public function editTournamentName($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE tournaments t SET t.name=? WHERE id =?");
            $stmt->bind_param("sd", $data->name, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit a tournament date
     *
     * @url POST /tournament/edit/date
     */
    public function editTournamentDate($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE tournaments SET startDate=? WHERE id =?");
            $stmt->bind_param("sd", $data->startDate, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit a tournament description
     *
     * @url POST /tournament/edit/description
     */
    public function editTournamentDescription($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE tournaments SET description=? WHERE id =?");
            $stmt->bind_param("sd", $data->description, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit a tournament brackets iframe
     *
     * @url POST /tournament/edit/brackets
     */
    public function editTournamentBrackets($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE tournaments SET brackets=? WHERE id =?");
            $stmt->bind_param("sd", $data->brackets, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit a tournament players iframe
     *
     * @url POST /tournament/edit/players
     */
    public function editTournamentPlayers($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE tournaments SET players=? WHERE id =?");
            $stmt->bind_param("sd", $data->players, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit a tournament region
     *
     * @url POST /tournament/edit/region
     */
    public function editTournamentRegion($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE tournaments SET region=? WHERE id =?");
            $stmt->bind_param("sd", $data->region, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
    }

    /**
     * Edit a tournament status
     *
     * @url POST /tournament/edit/status
     */
    public function editTournamentStatus($data)
    {
        $stmt = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE tournaments SET finished=? WHERE id =?");
            $stmt->bind_param("dd", $data->finished, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return true;
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