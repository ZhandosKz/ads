<?php

/**
 * This is the model class for table "content_view".
 *
 * The followings are the available columns in table 'content_view':
 * @property integer $id
 * @property string $object_alias
 * @property integer $object_id
 * @property string $user_cookie
 */
class ContentView extends CActiveRecord
{
	private static $_countableContents = array(
		'Ads'
	);

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContentView the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'content_view';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('object_id', 'numerical', 'integerOnly'=>true),
			array('object_alias, user_cookie', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, object_alias, object_id, user_cookie', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'object_alias' => 'Object Alias',
			'object_id' => 'Object',
			'user_cookie' => 'Session',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('object_alias',$this->object_alias,true);
		$criteria->compare('object_id',$this->object_id);
		$criteria->compare('user_cookie',$this->user_cookie,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function setView(CActiveRecord $object)
	{
		if (!in_array(get_class($object), self::$_countableContents))
		{
			throw new CException('Такой тип контента не допустим для подсчёта просмотров', E_USER_ERROR);
		}

		$event = self::model()->find('object_alias = :object_alias AND object_id = :object_id AND user_cookie = :user_cookie', array(
			':object_alias' => get_class($object),
			':object_id' => $object->getPrimaryKey(),
			':user_cookie' => User::getUserCookie()
		));

		if (!$event instanceof ContentView)
		{
			$event = new ContentView();
			$event->object_alias = get_class($object);
			$event->object_id = $object->getPrimaryKey();
			$event->user_cookie = User::getUserCookie();
			if (!$event->save())
			{
				throw new CException('Ошибка сохранения просмотра контента', E_USER_ERROR);
			}
			return TRUE;
		}

		return FALSE;
	}
}