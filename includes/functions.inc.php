<?php
    function timing($upload_time) {
        $date = strtotime($upload_time);
        $difference = time() - $date; //Aantal seconden geleden

        if($difference < 60){
             return $difference . " seconden geleden";
        } else {
            //1 minuut
            if (($difference / 60) < 1.5) {
                return round($difference / 60) . " minuut geleden";
            } else {
                if (($difference / 60) < 60) {
                    return round($difference / 60) . " minuten geleden";
                } else {
                    if (($difference / (60 * 60)) < 24) {
                        return round($difference / (60 * 60)) . " uur geleden";
                    } else {
                        if (($difference / (60 * 60 * 24)) < 1.5) {
                            return round($difference / (60 * 60 * 24)) . " dag geleden";
                        } else {
                            if (($difference / (60 * 60 * 24)) < 7) {
                                return round($difference / (60 * 60 * 24)) . " dagen geleden";
                            } else {
                                if ((($difference / (60 * 60 * 24 * 7)) < 1.5)) {
                                    return round($difference / (60 * 60 * 24 * 7)) . " week geleden";
                                } else {
                                    if ((($difference / (60 * 60 * 24 * 7)) < 52)) {
                                        return round($difference / (60 * 60 * 24 * 7)) . " weken geleden";
                                    } else {
                                        return round($difference / (60 * 60 * 24 * 7 * 52)) . " jaar geleden";
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>