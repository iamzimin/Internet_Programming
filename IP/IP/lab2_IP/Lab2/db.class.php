<?php

class DB {

    protected static $_instance;

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    private  function __construct() {
        $this->connect = mysqli_connect("localhost", "root", "") or die("Невозможно установить соединение".mysqli_error($this->connect));
        mysqli_select_db( $this->connect, "bd_ulstu") or die ("Невозможно выбрать указанную базу".mysqli_error($this->connect));
        $this->query('SET names "utf8"');
    }

    private function __clone() { //запрещаем клонирование объекта модификатором private
    }

    private function __wakeup() {//запрещаем клонирование объекта модификатором private
    }

    public static function query($sql) {

        $obj=self::$_instance;

        if(isset($obj->connect)){
            $obj->count_sql++;
            $start_time_sql = microtime(true);
            $result=mysqli_query($obj->connect,$sql)or die("<br/><span style='color:red'>Ошибка в SQL запросе:</span> ".$obj->connect->error);
            $time_sql = microtime(true) - $start_time_sql;
            //echo "<br/><br/><span style='color:red'> <span style='color:orange'># Запрос номер ".$obj->count_sql.": </span>".$sql."</span> <span style='color:orange'>(".round($time_sql,4)." msec )</span>";

            return $result;
        }
        return false;
    }

    //возвращает запись в виде объекта
    public static function fetch_object($object)
    {
        return @mysqli_fetch_object($object);
    }

    //возвращает запись в виде массива
    public static function fetch_array($object)
    {
        return @mysqli_fetch_array($object);
    }

    //mysql_insert_id() возвращает ID,
    //сгенерированный колонкой с AUTO_INCREMENT последним запросом INSERT к серверу
    public static function insert_id()
    {
        return @mysqli_insert_id();
    }


}