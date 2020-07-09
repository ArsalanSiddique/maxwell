<?php

    class alert {

        function success($message) {
            $raw = '<div class="alert alert-success alert-dismissible col-lg-4 pull-right fade in" style="position:absolute;opacity:0.9;right:20px;top:80px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Successfully!</strong> '.$message.'
                    </div>';
            return $raw;
        }

        function danger($message = "Something went wrong.") {
            $raw = '<div class="alert alert-danger alert-dismissible col-lg-4 pull-right fade in" style="position:absolute;opacity:0.9;right:20px;top:80px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong> '.$message.'
                    </div>';
            return $raw;
        }

        function info($message) {
            $raw = '<div class="alert alert-info alert-dismissible col-lg-4 pull-right fade in" style="position:absolute;opacity:0.9;right:20px;top:80px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Info!</strong> '.$message.'
                    </div>';
            return $raw;
        }

        function warning($message) {
            $raw = '<div class="alert alert-warning alert-dismissible col-lg-4 pull-right fade in" style="position:absolute;opacity:0.9;right:20px;top:80px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Warning!</strong> '.$message.'
                    </div>';
            return $raw;
        }


    }

    $alert_obj = new alert();
?>