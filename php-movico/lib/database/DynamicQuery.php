<?php
class DynamicQuery {

    private $className;
	private $dbManager;

    public function __construct($className, $dbManager) {
        $this->className = $className;
		$this->dbManager = $dbManager;
    }

    private $criterions;

	public function addCriterion(DQCriterion $criterion) {
		$this->criterions[] = $criterion;
		return $this;


		$dq = DQFactoryUtil::forClass("User")
			->addCriterion(DQPropertyFactoryUtil::forName("firstName")->like("%P"))
			->setProjection(DQProjectionFactoryUtil::count())
			->setLimit(5, 10);
	}

	private $projection;

	public function setProjection(DQProjection $projection) {
		$this->projection = $projection;
		return $this;
	}

	private $limitFrom;
	private $limitCount;

	public function setLimit($limitFrom, $limitCount) {
		$this->limitFrom = $limitFrom;
		$this->limitCount = $limitCount;
		return $this;
	}

}
?>
