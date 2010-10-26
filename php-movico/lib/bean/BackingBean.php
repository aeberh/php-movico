<?
abstract class BackingBean {
	
	private $selectedRowIndex;
	
	protected function getSelectedRowIndex() {
		return $this->selectedRowIndex;
	}
	
	public function setSelectedRowIndex($selectedRowIndex) {
		$this->selectedRowIndex = $selectedRowIndex;
	}
	
}
?>