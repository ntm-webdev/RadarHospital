<?php

/**
 * This is the model class for table "hospital".
 *
 * The followings are the available columns in table 'hospital':
 * @property integer $id
 * @property string $nome
 * @property string $endereco
 * @property double $latitude
 * @property double $longitude
 * @property integer $id_regiao
 * @property integer $id_bairro
 * @property string $telefone
 *
 */
class hospital extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'hospital';
        rfrefve;vsds;dswes
    }

    protected $_regiao;
    protected $_bairro;
    protected $_plano_saude;
    protected $_especialidade;
    protected $_distancia;
    protected $distancia;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nome, endereco, latitude, longitude, id_regiao, id_bairro, telefone, site, url_mapa', 'required'),
            array('id_regiao, id_bairro', 'numerical', 'integerOnly'=>true),
            array('latitude, longitude', 'numerical'),
            array('nome', 'length', 'max'=>60),
            array('endereco', 'length', 'max'=>80),
            array('telefone', 'length', 'max'=>15),
            array('id,_regiao,_bairro,_plano_saude,_especialidade,_distancia', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nome, endereco, latitude, longitude, id_regiao, id_bairro, telefone', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'fkespecialidade' => array(self::MANY_MANY, 'especialidades', 'especialidade_hospital(codhospital, codespecialidade)'),
            'fkimagens' => array(self::MANY_MANY, 'imagens', 'imagem_hospital(codhospital, codimagem)'),
            'fkregiao' => array(self::BELONGS_TO, 'regiao', 'id_regiao'),
            'fkbairro' => array(self::BELONGS_TO, 'bairro', 'id_bairro'),
            'fkplanosaude' => array(self::MANY_MANY, 'plano_saude', 'plano_hospital(codhospital, codplano)'),
            //'fkdias' => array(self::MANY_MANY, 'dia_da_semana', 'dia_hospital(id_hospital, id_dia_da_semana)'),
            'fkfavorites' => array(self::MANY_MANY, 'usuarios', 'favorites(id_hospital, id_usuario)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'nome' => 'Hospital',
            'endereco' => 'Endereco',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'id_regiao' => 'Região',
            'id_bairro' => 'Bairro',
            '_plano_saude' => 'Plano de Saude',
            '_regiao' => 'Região',
            '_bairro' => 'Bairro',
            '_especialidade' => 'Especialidade',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        
        if (!empty($this->_distancia)) {
            $distancia = $this->_distancia / 1.609;
        } else {
            $distancia = 1.24274;
        }

        if (!empty($this->latitude) && !empty($this->longitude)) {
            $criteria->select = '
                *,
                ( 
                    3959 
                        * 
                        acos( cos( radians(:latitude) ) 
                        * 
                        cos( radians( latitude ) ) 
                        * 
                        cos( radians( longitude ) - radians(:longitude) ) 
                        + 
                        sin( radians(:latitude) ) 
                        * 
                        sin( radians( latitude ) ) ) 
                ) AS distance 
            ';
            $criteria->params = [
                ':latitude' => $this->latitude,
                ':longitude' => $this->longitude,
            ];
            
            $criteria->having = 'distance <'.$distancia;
            $criteria->order = 'distance';
        }
       
        $criteria->compare('t.id',$this->id);
        $criteria->compare('t.nome',$this->nome,true);
        $criteria->compare('t.endereco',$this->endereco,true);
        $criteria->compare('t.id_regiao',$this->id_regiao);
        $criteria->compare('t.id_bairro',$this->id_bairro);
        $criteria->compare('t.telefone',$this->telefone,true);
        $criteria->compare('fkplanosaude.nome', $this->_plano_saude);
        $criteria->compare('fkregiao.nome', $this->_regiao);
        $criteria->compare('fkbairro.nome', $this->_bairro);
        $criteria->compare('fkespecialidade.nome', $this->_especialidade);

        $criteria->together = true;
        $criteria->with = ['fkregiao','fkbairro','fkespecialidade', 'fkplanosaude'];
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => false,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Hospital the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getHospitais()
    {
        $hospitais = hospital::model()->findAll();

        return $hospitais;
    }

    public function get_Regiao()
    {
        return $this->_regiao;
    }

    public function set_Regiao($val)
    {
        $this->_regiao = $val;
    }

    public function get_Bairro()
    {
        return $this->_bairro;
    }

    public function set_Bairro($val)
    {
        $this->_bairro = $val;
    }

    public function get_plano_saude()
    {
        return $this->_plano_saude;
    }

    public function set_plano_saude($val)
    {
        $this->_plano_saude = $val;
    }

    public function get_Especialidade()
    {
        return $this->_especialidade;
    }

    public function set_Especialidade($val)
    {
        $this->_especialidade = $val;
    }

    public function get_Distancia()
    {
        return $this->_distancia;
    }

    public function set_Distancia($val)
    {
        $this->_distancia = $val;
    }
}
