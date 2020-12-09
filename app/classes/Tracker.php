<?php


namespace App;

use Core\FileDB;

class Tracker
{
    /**
     * Get session email
     * @return bool|string
     */
    public function getSessionEmail()
    {
        if ($_SESSION) {
            $user = App::$session->getUser();

            return $user['email'];
        }

        return false;
    }

    /**
     * Get user visit time
     * @return string
     */
    public function getVisitTime(): string
    {
        date_default_timezone_set('Europe/Vilnius');

        return date("Y-m-d H:i:s");
    }

    /**
     * Return visited page path
     * @param $page
     * @return string
     */
    public function getVisitedPage(string $page): string
    {
        return $page;
    }

    /**
     * Combine user activity data to an array
     * @return array
     */
    public function createPageVisitArray(): array
    {
        $history = [
            'user' => self::getSessionEmail(),
            'time' => self::getVisitTime(),
            'page' => self::getVisitedPage(self::getVisitedPage(basename($_SERVER['PHP_SELF']))),
        ];

        return $history;
    }

    /**
     * Check if session is active and save or update users history.
     * @return bool
     */
    public function savePageVisit(): bool
    {
        if ($_SESSION) {
            App::$db->insertRow('history', self::createPageVisitArray());

            return true;
        }

        return false;
    }

    /**
     * Return array with given user activity.
     * @param $user
     * @return array
     */
    public function getUserHistory($user): array
    {
        return App::$db->getRowsWhere('history', $conditions = ['user' => $user]) ?? [];
    }

    /**
     * Return history table from db.
     * @return array
     */
    public function getHistory(): array
    {
        return App::$db->getData()['history'] ?? [];
    }
}