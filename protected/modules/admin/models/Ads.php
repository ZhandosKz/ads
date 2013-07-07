<?php

/**
 * This is the model class for table "ads".
 *
 * The followings are the available columns in table 'ads':
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property integer $is_published
 * @property string $created_at
 * @property integer $created_by
 * @property string $modified_at
 * @property integer $modified_by
 * @property array $categories
 */
class Ads extends CActiveRecord
{
	const GET_CATEGORIES_AS_LINKS_LIST = 0;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ads the static model class
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
		return 'ads';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('is_published', 'boolean'),
			array('title, description', 'required'),
			array('categories', 'required', 'message' => 'Выберите как минимум одну категорию'),
			array('title', 'length', 'max'=>255),
			array('description, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, title, description, is_published, created_at, created_by, modified_at, modified_by', 'safe', 'on'=>'search'),
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
			'categories' => array(self::MANY_MANY, 'Category', 'ads_category(ads_id, category_id)')
		);
	}

	public function behaviors()
	{
		return array(
			'CreatedModified' => array(
				'class' => 'CreatedModifiedBehavior'
			),
			'Alias' => array(
				'class' => 'AliasBehavior',
				'toAliasAttribute' => 'title'
			),
			'CAdvancedArBehavior' => array(
				'class' => 'CAdvancedArBehavior'
			)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'title' => 'Заголовок',
			'description' => 'Описание',
			'is_published' => 'Is Published',
			'categories' => 'Категории',
			'created_at' => 'Created At',
			'created_by' => 'Created By',
			'modified_at' => 'Modified At',
			'modified_by' => 'Modified By',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified_at',$this->modified_at,true);
		$criteria->compare('modified_by',$this->modified_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getCategories($as = self::GET_CATEGORIES_AS_LINKS_LIST)
	{
		if ($as === self::GET_CATEGORIES_AS_LINKS_LIST)
		{
			$links = array_map(function($category){
				return CHtml::link($category->name, array('/ads/category/view', 'alias' => $category->alias));
			}, $this->categories);

			return trim(implode(', ', $links));
		}
		// Может в будущем понадобится получать категории в другом формате
		return null;
	}

	/**
	 * Получение DataProvider для отображения объявлений на странице категории или на странице всех категорий
	 * @param null $category_id
	 * @return CActiveDataProvider
	 */
	public static function getCListDataProvider($category_id = NULL)
	{
		$criteria = new CDbCriteria();

		if ($category_id !== NULL)
		{
			$criteria->join = 'LEFT JOIN ads_category AS ac ON ac.ads_id = t.id';
			$criteria->condition = 'ac.category_id = :category_id';
			$criteria->params = array(':category_id' => $category_id);
		}

		$sort = new CSort();
		$sort->sortVar = 'sort';
		$sort->defaultOrder = 't.created_at ASC';
		$sort->multiSort = true;
		$sort->attributes = array(
			'title'=>array(
				'label'=>'названию',
				'asc'=>'t.title ASC',
				'desc'=>'t.title DESC',
				'default'=>'desc',
			),
		);

		return new CActiveDataProvider(Ads::model(),
			array(
				'criteria'=>$criteria,
				'sort'=>$sort,
				'pagination'=>array(
					'pageSize'=>10,
				),
			)
		);
	}
}