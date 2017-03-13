<?php

/**
 * @since 2.0
 * @version 2.0
 */
class DateConverter
{

    /**
     * The initial date
     * @var string
     */
    protected $date;

    /**
     * The formated date
     * @var string
     */
    protected $newDate;

    /**
     * The desired format
     * @var string
     */
    protected $format;

    /**
     * class constructor
     * @param string $oldFormat    old format
     * @param object $date_element the date
     */
    function __construct($oldFormat, $date_element)
    {
        $this->date = DateTime::createFromFormat($oldFormat, $date_element);
    }

    /**
     * $new date format
     * @param  string $date_format the desired new date format
     * @return string              the date
     */
    protected function formatDate( $date_format )
    {
        $this->format         = $date_format;
        return $this->newDate = $this->date->format($this->format);
    }

    /**
     * Check if contains letter or no
     * @param  string $date_format format
     * @return string              DateConverter
     */
    public function getDate ($date_format)
    {
        $letters = array('D', 'l', 'S', 'F', 'M', 'a', 'A');
        foreach ($letters as $letter) {
            if (strpos($date_format, $letter) !== false) {
                   return $this->getDate_letter($date_format);
            }
        }
        return $this->getDate_noLetter($date_format);
    }

    /**
     * get new date without letter
     * @param  string $date_format the desired new date format
     * @return string              the date
     */
    public function getDate_noLetter( $date_format )
    {
        return $this->formatDate( $date_format );
    }

    /**
     * get new date with letter
     * @param  string $date_format the desired new date format
     * @return string              the date
     */
    public function getDate_letter( $date_format )
    {
        $this->formatDate( $date_format );
        $unixtimestamp = strtotime($this->newDate);
        return $FinalDate = date_i18n($this->format, $unixtimestamp);
    }

}
