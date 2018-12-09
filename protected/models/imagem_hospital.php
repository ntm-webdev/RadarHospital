
<?php

/**
 * This is the model class for table "imagem_hospital".
 *
 * The followings are the available columns in table 'imagem_hospital':
 * @property integer $codhospital
 * @property integer $codimagem
 *
 * The followings are the available model relations:
 * @property Hospital $codhospital0
 * @property Imagens $codimagem0
 */
class imagem_hospital extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'imagem_hospital';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('codhospital, codimagem', 'required'),
            array('codhospital, codimagem', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('codhospital, codimagem', 'safe', 'on'=>'search'),
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
            'fkcodhospital' => array(self::BELONGS_TO, 'hospital', 'codhospital'),
            'fkimg' => array(self::BELONGS_TO, 'imagens', 'codimagem'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'codhospital' => 'Codhospital',
            'codimagem' => 'Codimagem',
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

        $criteria->compare('codhospital',$this->codhospital);
        $criteria->compare('codimagem',$this->codimagem);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ImagemHospital the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function deleteImagem($idHospital, $fotos)
    {
        for ($i=0; $i<4; $i++) {
            $j = $i+1;

            if (!empty(imagem_hospital::model()->findByAttributes(['codimagem'=>$j,'codhospital'=>$idHospital])) || !empty($fotos[$i])) {
                Yii::app()->db->createCommand('DELETE from imagem_hospital where codhospital=:codhospital and codimagem=:codimagem')->execute([':codhospital'=>$idHospital, ':codimagem'=>$fotos[$i]]);
            } 
        }
    }
}