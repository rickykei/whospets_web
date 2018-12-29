<?php
class SearchProductsForm extends CFormModel
{
	public $minPrice;
	public $maxPrice;
	public $category;
	public $sub_category;
	public $country_id;
	public $sub_country_id;
	public $condition;
	public $size;
	public $store_id;
	public $sorting;
	public $keywords;
	public $pet_status;
	
	public $age;
	public $country;
	public $gender;
	
	//private $keywordSearchColumnArray = array('title', 'keywords', 'style_code'); //Columns to search 
	private $keywordSearchColumnArray = array('title', 'pet_id', 'name_of_pet'); //Columns to search 

    // Add a public property for each search form element here

	public function rules()
	{
		return array(
			// You should validate your search parameters here
			array('category,country_id,sub_country_id,store_id,age', 'numerical', 'integerOnly'=>true),
			array('minPrice,maxPrice,category,condition,size,store_id,sorting,keywords,age,country,gender,sub_category,pet_status', 'safe'),
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;
		$criteria->order='created DESC';
		if(!empty($this->category)){
			//$criteria->compare('category_id',$this->category);
			$criteria->together = true;
			$criteria->with = array('category');
			//$criteria->addCondition('t.category_id:=category_id or category');
			$criteria->compare('t.category_id',$this->category);
			$criteria->compare('category.parent_id',$this->category,false,'OR');
		}elseif(!empty($this->sub_category)){
			//$criteria->compare('category_id',$this->category);
			$criteria->together = true;
			$criteria->with = array('category');
			//$criteria->addCondition('t.category_id:=category_id or category');
			$criteria->compare('t.category_id',$this->sub_category);
			$criteria->compare('category.parent_id',$this->sub_category,false,'OR');
		}
		
		if(!empty($this->minPrice))
			$criteria->addCondition('price >= '.(int)$this->minPrice);
			//$criteria->addCondition('cast(price as decimal(10,6)) > '.(int)$this->minPrice);

		if(!empty($this->maxPrice))
			$criteria->addCondition('price <= '.(int)$this->maxPrice);
			//$criteria->addCondition('cast(price as decimal(10,6)) < '.(int)$this->maxPrice);
			
	//	if(!empty($this->condition))
	//	    $criteria->addCondition('`condition`="'.$this->condition.'"');
			
	//	if(!empty($this->store_id))
		//    $criteria->compare('store_id',$this->store_id);
		
		if(isset($this->age) && $this->age!=null){
			//$criteria->compare('age',$this->age);
			$dateTo = new DateTime('today');
			$dateTo->modify('-'.floor($this->age).' year');
			
			$dateFrom = new DateTime('today');
			$dateFrom->modify('-'.floor($this->age+1).' year');
			
			$criteria->addCondition('date_born >= \''.date_format($dateFrom,'Y-m-d'). '\' and date_born < \''.date_format($dateTo,'Y-m-d').'\'');
		}
			
		//if(!empty($this->country))
		  //  $criteria->compare('country',$this->country);
		
		
		//20160830 add country id
		if(!empty($this->country_id))
		    $criteria->compare('country_id',$this->country_id);
			
		if(!empty($this->sub_country_id))
		    $criteria->compare('sub_country_id',$this->sub_country_id);
						
		if(!empty($this->gender))
		    $criteria->compare('gender',$this->gender);
			
		if(!empty($this->pet_status) || $this->pet_status == '0')
		    $criteria->compare('pet_status',$this->pet_status);
			
		//New code for the keyword search
		if(!empty($this->keywords))
		{
			$additionalCriteria = $this->makeKeywordSearchCondition($this->keywords);
			$criteria->addCondition($additionalCriteria);
		}
		
		if(!empty($this->size)){
			/*
			$criteria->together = true;
			$criteria->with = array('variations');
			$criteria->addCondition('variations.product_id=t.product_id');
			//$criteria->compare( 'variations.product_id', $this->owner, true );
			$criteria->compare('variations.title',$this->size);
			*/
			$criteria2 = new CDbCriteria;
			$criteria->together = true;
			$criteria2->with = array('variations');
			$criteria2->addCondition('variations.product_id=t.product_id');
			//$criteria->compare( 'variations.product_id', $this->owner, true );
			$criteria2->compare('variations.title',$this->size);
			$criteria->mergeWith($criteria2);
		}
		
		//show active
		$criteria->compare('status',1);
		
		if(!empty($this->sorting)){
			switch ($this->sorting) {
				case 'price':
					//$criteria->order = 'CAST(price AS FLOAT)';
					$criteria->order = 'price*1';
					break;
				case 'price_desc':
					//$criteria->order = 'CAST(price AS FLOAT)';
					$criteria->order = 'price*1 DESC';
					break;
				case 'newest':
					$criteria->order = 'created DESC';
					break;
				case 'sales':
					$criteria->order = 'price*1';
					break;
				default:
					$criteria->order = 'price*1';
					break;
			}
		}
		
		// Add more conditions for each property here

		return new CActiveDataProvider('Products', array(
			'criteria' => $criteria,
			// more options here, e.g. sorting, pagination, ...
			'pagination' => array('pageSize' => Shop::module()->noOfShoes,'pageVar'=>'page',),
		));
	}
	
	/**
	 * Make the keyword search SQL. 
	 * @param       String  Search string input by user
	 * @return      String  SQL condition 
	 */     
	private function makeKeywordSearchCondition($keywordStr){
			$criteriaSql='';           //Search condition      
			
			//Split the string into an array of words and phrases
			//The string: Android "Web Apps" 
			//will produce a two element array containing 'Android' and 'Web Apps' 
			$elementArray = array();
			$regX = "/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|[\s,]+/"; 
			$tempArray = preg_split  ($regX, trim($keywordStr),  0, PREG_SPLIT_DELIM_CAPTURE);
			foreach($tempArray as $ind => $str){
					if(trim($str)){
							array_push($elementArray, $str);
					}                       
			}
			
			//Construct the search sql  
			/*
			foreach($this->keywordSearchColumnArray as $column)
			{       
					foreach($elementArray as $value){
							$value =  addSlashes($value);
							$value = '"%'.$value.'%"';      
							if($criteriaSql){

									$criteriaSql .= ' OR';
							}
							$criteriaSql .= " t.$column LIKE $value";
					}

			}     
			*/			
			
			foreach($this->keywordSearchColumnArray as $column)
			{       
					$tmpCriteriaSql='';
					foreach($elementArray as $value){
							$value =  addSlashes($value);
							$value = '"%'.$value.'%"';      
							if($tmpCriteriaSql){

									$tmpCriteriaSql .= ' AND';
							}
							$tmpCriteriaSql .= " t.$column LIKE $value";
					}
					if($tmpCriteriaSql){
						$tmpCriteriaSql='('.$tmpCriteriaSql.')';
					}
					if($criteriaSql){
						$criteriaSql = $criteriaSql.' OR '.$tmpCriteriaSql;
					}else{
						$criteriaSql = $tmpCriteriaSql;
					}
			}     
			return $criteriaSql;
	}             
	
		 
}


?>