<?php

namespace app\models;
use Yii;
use app\models\Usuario as DbUsuario;


class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $idUsuario;
    public $token;
    public $authKey;
    public $usuario;
    public $id_registro;
    public $mail;
    public $password;
    public $userName;
    public $baja;
    public $ultimaActualizacion;
    public $nacionalidad;
    public $direccion;
    public $id_localidad;
    public $fecha_nac;
    public $foto;
    public $nombre;
    public  $id_rol;
    public  $idSector;
    
    
    const ROLE_GESTOR = 1;
    const ROLE_POSTULANTE = 2;
    const ROLE_ADMIN = 3;
    const ROLE_SELECTOR = 4;

 /*   private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
        ];*/ 

    public static function findIdentity($id) {

        
        $dbUser = DbUsuario::find()->where([ "idUsuario" => $id])->one();
        
        if ($dbUser == null) {
            return null;
        }
        return new static($dbUser);
    }
    
    public static function findIdentityByAccessToken($token, $userType = null) {
        
        $dbUser = DbUsuario::find()
        ->where(["token" => $toke])
        ->one();
        if (!count($dbUser)) {
            return null;
        }
        return new static($dbUser);
    }

    public static function findByUsername($username) {
        
        $dbUser = Usuario::find()->where(["usuario" => $username])->one();
        
        if ($dbUser == null) {
            return null;
        }
        return new static($dbUser);
    }

    /**
     * {@inheritdoc}
     *
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     *
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     *
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['userName'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->idUsuario;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->userName;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->userName = $nombre;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->nombre = $apellido;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        $dbUser = Usuario::find()
        ->select("password")
        ->where([
            "idUsuario" => $this->idUsuario
        ])
        ->one();
        $passMd5 =md5($password);
        //if( Yii::$app->getSecurity()->validatePassword($password, $dbUser->password))
        if($passMd5 = $dbUser->password)
        {
            return true;
        }else {
            return false;
        }
    }
}
