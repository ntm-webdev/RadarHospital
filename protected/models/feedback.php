
<?php

/**
 * This is the model class for table "feedback".
 *
 * The followings are the available columns in table 'feedback':
 * @property integer $id
 * @property string $descricao
 * @property integer $atendimento
 * @property integer $atendimento_medico
 * @property integer $higiene
 * @property integer $infraestrutura
 * @property integer $id_hospital
 * @property string $datahora
 *
 * The followings are the available model relations:
 * @property Hospital $idHospital
 * @property Usuario[] $usuarios
 */
class Feedback extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'feedback';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('descricao, atendimento, atendimento_medico, higiene, infraestrutura, id_hospital', 'required'),
            array('id_hospital, id_usuario', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, descricao, atendimento, atendimento_medico, higiene, infraestrutura, id_usuario, id_hospital, datahora', 'safe', 'on'=>'search'),
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
            'fkhospital' => array(self::BELONGS_TO, 'hospital', 'id_hospital'),
            'fkusuario' => array(self::BELONGS_TO, 'usuario', 'id_usuario'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'descricao' => 'Comentario',
            'atendimento' => 'Atendimento',
            'atendimento_medico' => 'Atendimento Médico',
            'higiene' => 'Higiene',
            'infraestrutura' => 'Infraestrutura',
            'id_hospital' => 'Id Hospital',
            'datahora' => 'Datahora',
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

        $criteria->compare('id',$this->id);
        $criteria->compare('descricao',$this->descricao,true);
        $criteria->compare('atendimento',$this->atendimento);
        $criteria->compare('atendimento_medico',$this->atendimento_medico);
        $criteria->compare('higiene',$this->higiene);
        $criteria->compare('infraestrutura',$this->infraestrutura);
        $criteria->compare('id_hospital',$this->id_hospital);
        $criteria->compare('datahora',$this->datahora,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Feedback the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function beforeSave() {
        $this->datahora = new CDbExpression('NOW()');
        return parent::beforeSave();
    }

    public function getStarts($qtd) {
        $star = "";

        switch($qtd) 
        {
            case 1:
                $star = "<i class='fa fa-star'></i> 
                 <i class='fa fa-star-o'></i> 
                 <i class='fa fa-star-o'></i> 
                 <i class='fa fa-star-o'></i>";
            break;
            case 2:
                $star = "<i class='fa fa-star'></i> 
                 <i class='fa fa-star'></i> 
                 <i class='fa fa-star-o'></i> 
                 <i class='fa fa-star-o'></i>";
            break;
            case 3:
                $star = "<i class='fa fa-star'></i> 
                 <i class='fa fa-star'></i> 
                 <i class='fa fa-star'></i> 
                 <i class='fa fa-star-o'></i>";
            break;
            case 4:
                $star = "<i class='fa fa-star'></i> 
                 <i class='fa fa-star'></i> 
                 <i class='fa fa-star'></i> 
                 <i class='fa fa-star'></i>";
            break;
        }

        return $star;
    }

    public function ParseDate($date)
    {
        return date('d/m/Y', strtotime($date));
    }
}