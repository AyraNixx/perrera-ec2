<?php
// Damos un apodo al directorio
namespace model;

use utils\Utils;
use utils\Constants;
use \model\Model;
use Stripe\Util\Util;

require_once "../utils/Utils.php";
require_once "../utils/Constants.php";
require_once "../models/Model.php";

class Img
{
    private $img;
    private $table_name;

    function __construct(String $table_name)
    {
        $this->img = new Model();
        $this->table_name = $table_name;
    }

    public function getImgs(String $id)
    {
        $query = ($this->table_name == Constants::ANIMAL_TABLE) ? Constants::GET_IMGS_ANIMAL_QUERY : Constants::GET_IMGS_EMPLOYEE_QUERY;
        return $this->img->queryParam($query, ['id' => $id]);
    }

    public function getImg(String $id)
    {
        return $this->img->queryParam(Constants::GET_IMG_QUERY, ['id' => $id]);
    }

    public function addImgs(String $id, array $params)
    {
        $query = ($this->table_name == Constants::ANIMAL_TABLE) ? Constants::INSERT_ANIMALES_PHOTOS : Constants::INSERT_EMPLEADOS_PHOTOS;
        return $this->img->save_multiple_imgs($id, $params, $query);
    }

    public function updtImg(array $params)
    {
        return $this->img->queryParam(Constants::UPDT_IMG, $params);
    }

    public function deleteImg(String $id) {
        $url_img = $this->getImg($id);
        Utils::delete_img($url_img['ruta']);
        return $this->img->queryParam(Constants::DELETE_IMG_QUERY, ['id' => $id]);
    }

    public function deleteImgs(String $id)
    {
        $url_imgs = $this->getImgs($id);
        foreach ($url_imgs as $key) {
            Utils::delete_img($key['ruta']);
        }
        return $this->img->queryParam(Constants::DELETE_IMGS_ANIMAL_QUERY, ['id' => $id]);
    }
}

// $img = new Img('animales'); 
// var_dump($img->deleteImgs('001100867981340311676'));
