<?php 
	namespace App\Helpers;

	class Categories
	{
		public static function buildTreeCategory($category = [])
		{
			$data = [];
			$arrCheck = [];
			//lay ra tat ca cate cha lon nhat id_parent = 0 ;
			//xu ly cap menu
			foreach ($category as $key => $val) {
				if($val['parent_id'] == 0){
					$arrCheck[]= $val['id']; //check khong trung sau nay
					$val['subCate'] = [];	//tao ra 1 mang con subcate
					$data[$val['id']] =$val;
				}
			}
			//xu ly cho menu ben trong
			foreach ($category as $k => $v) {
				// lay ra nhun itemt khong ton tai trong mang
				if(!in_array($v['id'], $arrCheck)){
					if($v['parent_id']> 0 ){
						$arrCheck[] = $v['id']; //check trung cho nhung lan tiep theo
						$v['subCate'] = [];
						$data[$v['parent_id']]['subCate'][$v['id']] =$v;
					}
				}
			}
			return $data;

		}
		
	}
