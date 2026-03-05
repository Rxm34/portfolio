<?php 
    function temps_ecoule($datetime) {
        $now = new DateTime();
        $date = new DateTime($datetime);
        $interval = $now->diff($date);
    
        if ($interval->y >= 1) {
            return 'il y a ' . $interval->y . ' an' . ($interval->y > 1 ? 's' : '');
        } elseif ($interval->m >= 1) {
            return 'il y a ' . $interval->m . ' mois';
        } elseif ($interval->d >= 7) {
            $semaines = floor($interval->d / 7);
            return 'il y a ' . $semaines . ' semaine' . ($semaines > 1 ? 's' : '');
        } elseif ($interval->d >= 1) {
            return 'il y a ' . $interval->d . ' jour' . ($interval->d > 1 ? 's' : '');
        } elseif ($interval->h >= 1) {
            return 'il y a ' . $interval->h . ' heure' . ($interval->h > 1 ? 's' : '');
        } elseif ($interval->i >= 1) {
            return 'il y a ' . $interval->i . ' minute' . ($interval->i > 1 ? 's' : '');
        } else {
            return 'à l’instant';
        }
    }
?>