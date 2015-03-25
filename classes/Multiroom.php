<?php defined('SYSPATH') or die('No direct script access.');


class Multiroom extends Dobby_Module {


    const CAPTION = 'Мультирум';
    const NAME = 'multiroom';

    public $id = null;
    public $name = null;
    public $engname = null;
    public $channels = null;


    public $syncParams = array('name', 'engname', 'channels');

    public static $ouputs = array(
        Multiroom::FRONT => 'Перейдний правый и левый',
        Multiroom::REAR => 'Задний правый и левый',
        Multiroom::CENTERBASS => 'Центр и басс',
        Multiroom::SIDE => 'Боковой правый и левый',
    );


    const FRONT = 0;
    const REAR = 1;
    const CENTERBASS = 2;
    const SIDE = 3;


    /**
     * @param $data
     */
    public function init($data) {

        $data = is_array($data) ? $data : array();
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->name = isset($data['name']) ? $data['name'] : null;
        $this->engname = isset($data['engname']) ? $data['engname'] : null;
        $this->channels = isset($data['channels']) ? $data['channels'] : null;
    }


    /**
     * @param $values
     * @return $this|bool
     */
    public function save($values) {

        $valid = Validation::factory($values);
        $valid->rules('name', Rules::instance()->not_empty)
            ->rules('engname', Rules::instance()->engname)
            ->rules('channels', Rules::instance()->not_empty)
            ->check();
        Message::instance($valid->errors());

        if (!Message::instance()->isempty()) return false;

        $this->name = $values['name'];
        $this->engname = $values['engname'];
        $this->channels = $values['channels'];
        Module::instance(self::NAME)->saveRecord($this);
        return $this;
    }

    public function test() {

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

}