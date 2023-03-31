<?php

function bubbleSort(...$numbers)
{
	$tmpBox = 0;
	$arrLen = count($numbers);
	$sortLen = count($numbers)-1; // 只需要对比到倒数第二位
	$lastExchangeIndex = 0; // 最后一次变化位置（表示后续位置已经排序完成无需再次判断）
	for ($i=0; $i < $arrLen; $i++) { 
		$isSorted = true; // 是否结束（表明所有数据已经排序完成）
		for ($j=0; $j < $sortLen; $j++) { 
			if($numbers[$j] > $numbers[$j+1]){
				 $tmpBox = $numbers[$j+1];
				 $numbers[$j+1] = $numbers[$j];
				 $numbers[$j] = $tmpBox;
				 $isSorted = false; // 有变化标识没有结束
				 $lastExchangeIndex = $j;
			}
		}
		$sortLen = $lastExchangeIndex;// 确定还需比较的位置
		if($isSorted){
			break;
		}
	}
	return $numbers;
}

echo implode(',', bubbleSort(3,6,2,0,5,9,1,4,7,8));

?>
