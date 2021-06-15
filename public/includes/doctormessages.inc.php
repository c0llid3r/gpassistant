<div class="messages">
            <div class='message-header'>
            <h3>Hi <?php echo ucfirst($_SESSION['username']) ?>, here are your messages:</h3>
            <div><a class='message-button' href=''>Refresh</a></div>
            </div>
            <div class=results-header><span>From</span><span>Date</span><span>Message</span></div>
            <div class='msg-area'>
            <ul>
            <?php 
            if (empty($msgs)) {
                echo 'No messages';
            } else {
                $simpleList = [];

                foreach($msgs as $i) {
                    $in = false;
                    if (!empty($simpleList)) {
                        for($c = 0; $c < sizeof($simpleList); $c++) {
                            if ($simpleList[$c]['patientid'] == $i['patientid']) {
                                $simpleList[$c] = $i;
                                $in = true;
                                break;
                            }
                        }
                        if (!$in) {
                            $simpleList[] = $i;
                        }
                    } else {
                        $simpleList[] = $i;
                    }
                }

                foreach($simpleList as $msg) {
                    $datetime = explode(' ', $msg['date']);
                    $date = $datetime[0];
                    $time = $datetime[1];
                    $sender = $msg['sender'] == 'D' ? 'doctor' : '';
                    $acceptAppt = $_SESSION['admin'] == true ? "<input type='checkbox'/>" : "<span>Accept Appointment: <input type='checkbox'/></span>";
                    echo "<li class='".$sender."'><span>$msg[patientid]</span><span>$date <br> ($time)</span><span>$msg[msg]</span><form action='' method='GET'><button type='submit' name='msgid' value='$msg[msgid]'>Open</button></form></li>";
                }
            };
            
            echo "</ul>";
            ?>
            <?php if (!$_SESSION['showall']) : ?>
                <a class='message-button' href='?showAll=true'>View All</a>
            <?php else : ?>
                <a class='message-button' href='?showAll=false'>Show Less</a>
            <?php endif ?>
            </div>
        </div>