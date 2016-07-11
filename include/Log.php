<?php //Put together based on information from the PHP manual
class Log {
    private $logTitle = null;   //The title of the Log instance
    private $logContent = null; //The contents of the Log instance
    private $logID = 0;

    /*Construct a new Log instance with $title as it's title.*/
    function __construct($title) {
        if (is_string($title)) {
            $this->name = $title;
            $output = "<!--Constructing new instance of Log with title ".$this->name.".-->\n";
            print $output;
            $this->logTitle = $title;
            $this->logContent = array();
            $this->logID = rand();
        } else {
            $output = "<!--Log(\$title) constructor expects type string for its argument.-->\n";
            print $output;
        }
    }

    function addToLog($type, $msgSource, $msg) {
        if (is_numeric($type) && is_string($msgSource) && is_string($msg)) {
            $entry = ['type' => $type, 'source' => $msgSource, 'msg' => $msg];
            $this->logContent[] = $entry;
        } else {
            $entry = ['type' => -1, 'source' => "addToLog(type,source,message)", 'msg' => "Method expects arguments of type int, string and string."];
            $this->logContent[] = $entry;
        }
    }

    function generateLogHtml() {
        $output =   "<div class=\"LogObject\">\n";
        $output .=  "   <div class=\"Log\" id=\"Log".$this->logID."\">\n";
        $output .=  "   <div class=\"LogHeader\">\n";
        $output .=  "       <h4 class=\"LogTitle\">".$this->logTitle."</h4>\n";
        $output .=  "       <div class=\"LogButton\" id=\"refreshButton\" onclick=\"refreshLog(".$this->logID.");\">\n";
        $output .=  "           <h4 class=\"LogButtonText\" id=\"logRefresh".$this->logID."\">Refresh</h4>\n";
        $output .=  "       </div>\n";
        $output .=  "       <div class=\"LogButton\" id=\"saveButton\" onclick=\"saveLog(".$this->logID.");\">\n";
        $output .=  "           <h4 class=\"LogButtonText\" id=\"logSave".$this->logID."\">Save</h4>\n";
        $output .=  "       </div>\n";
        $output .=  "   </div>\n";
        $output .=  "   <div class=\"LogContent\" id=\"logContentDiv".$this->logID."\">\n";
        $output .=  $this->generateLogContentHtml();
        $output .=  "   </div>\n";
        $output .=  "   </div>\n";
        $output .=  "   <div class=\"LogToggle\" onclick=\"toggleLogDisplay(".$this->logID.");\">\n";
        $output .=  "       <h4 class=\"LogToggleText\" id=\"LogToggleText".$this->logID."\">+</h4>\n";
        $output .=  "   </div>\n";
        $output .=  "</div>\n";
        return $output;
    }

    function generateLogContentHtml() {
        $contentBody = "";
        foreach ($this->logContent as $logEntry) {
            $type = $logEntry['type'];
            $source = $logEntry['source'];
            $msg = $logEntry['msg'];
            $contentBody .= "       <h6 class=\"LogEntrySource\">".$source.":</h6>\n";
            switch ($type) {
                case -1:
                    $contentBody .= "       <p class=\"LogEntryError\">";
                    break;
                default:
                    $contentBody .= "       <p class=\"LogEntryDefault\">";
            }
            $contentBody .= $msg."</p>\n";
        }
        return $contentBody;
    }

    function saveToFile() {
        if (!empty($this->logContent)) {
            $fileOutput = $this->logTitle." ".$this->logID."\n";
            foreach ($this->logContent as $logEntry) {
                $fileOutput .= sprintf("%3d %-40s\n\t%s \n", $logEntry['type'], $logEntry['source'], $logEntry['msg']);
            }
            $written = false;
            if (file_exists("logs/server.log")) {
                $written = file_put_contents("logs/server.log", $fileOutput, FILE_APPEND | LOCK_EX) != false;
            } elseif (file_exists("../logs/server.log")) {
                $written = file_put_contents("../logs/server.log", $fileOutput, FILE_APPEND | LOCK_EX) != false;
            }
            if ($written) {
                $this->logContent = array();
            }
        }
    }
}
?>
