<?php defined('SYSPATH') or die('No direct script access.');


class Multiroom extends Dobby_Module {


    const CAPTION = 'Мультирум';
    const NAME = 'multiroom';

    public $id = null;
    public $name = null;
    public $engname = null;
    public $channels = null;

    /**
     * @var Kohana_Config_Group
     */
    private static $config;
    /**
     * @var resource
     */
    private static $socket;


    public $syncParams = array('name', 'engname', 'channels');

    public static $ouputs = array(Multiroom::FRONT => 'Перейдний правый и левый', Multiroom::REAR => 'Задний правый и левый', Multiroom::CENTERBASS => 'Центр и басс', Multiroom::SIDE => 'Боковой правый и левый',);


    const FRONT = 0;
    const REAR = 1;
    const CENTERBASS = 2;
    const SIDE = 3;


    /**
     * @param $data
     */
    public function init($data) {

        if (!self::$config) {
            self::loadConfig();
        }

        $data = is_array($data) ? $data : array();
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->name = isset($data['name']) ? $data['name'] : null;
        $this->engname = isset($data['engname']) ? $data['engname'] : null;
        $this->channels = isset($data['channels']) ? $data['channels'] : null;
    }

    private static function loadConfig() {
        self::$config = Kohana::$config->load('multiroom');
    }

    /**
     * @param $values
     * @return $this|bool
     */
    public function save($values) {

        $valid = Validation::factory($values);
        $valid->rules('name', Rules::instance()->not_empty)->rules('engname', Rules::instance()->engname)->rules('channels', Rules::instance()->not_empty)->check();
        Message::instance($valid->errors());

        if (!Message::instance()->isempty()) return false;

        $this->name = $values['name'];
        $this->engname = $values['engname'];
        $this->channels = $values['channels'];
        Module::instance(self::NAME)->saveRecord($this);
        return $this;
    }

    public function test() {
        Multiroom::send('command=test&channel=' . $this->channels);
    }


    /**
     * @param null $data
     * @return Multiroom
     */
    public static function factory($data = null) {

        if (is_numeric($data)) {
            return new Multiroom(self::readById($data));
        }
        return new Multiroom($data);
    }

    /**
     * @param $id
     * @return null
     */
    public static function readById($id) {
        return Module::instance(self::NAME)->getRecord($id);
    }

    private static function connect() {
        self::$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if (self::$socket === false) {
            Dobby::$log->add("Не удалось выполнить socket_create(): причина: " . socket_strerror(socket_last_error()) . "\n");
        }
        $result = socket_connect(self::$socket, self::$config->get('host'), self::$config->get('port'));
        if ($result === false) {
            echo "Не удалось выполнить socket_connect().\nПричина: (" . $result . ") " . socket_strerror(socket_last_error(self::$connection)) . "\n";
        }
    }

    public static function send($message) {
        if (!self::$config) {
            self::loadConfig();
        }
        self::connect();
        $result = '';
        if (self::$socket) {
            $message .= '&eof=<EOF>';
            socket_write(self::$socket, $message, strlen($message));
            $result = "";
            while ($out = socket_read(self::$socket, 2048)) {
                $result .= $out;
            }

        }
        socket_close(self::$socket);
        return $result;
    }


    public static function getItems() {

        return Database::instance()->prepare("SELECT * FROM files ORDER BY clevel, name")->execute()->fetchAll();
    }


}