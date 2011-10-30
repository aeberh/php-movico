<?php
class BeanUtil {
	
	const DELIM = ".";
	const POST_DELIM = "_";
	
	public static function getBeanString($valueExpression) {
		return str_replace("}", "", str_replace("#{", "", $valueExpression));
	}
	
	public static function getBeanAndProperties($valueExpression, $fromPost=false) {
		$beanString = String::create($valueExpression)->remove("#{")->remove("}");
		$result = $beanString->split($fromPost ? self::POST_DELIM : self::DELIM, 2);
		$props = $result->size() == 1 ? String::BLANK() : $result->get(1)->replace(self::POST_DELIM, self::DELIM);
		$result = array($result->get(0)->__toString(), $props->__toString());
		return $result;
	}
	
	public static function isBeanReference($beanString) {
		return StringUtil::contains($beanString, self::DELIM);
	}
	
}
?>