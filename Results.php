<?php
	class Results {
    private $product_name;
    private $product_price;
    private $product_link;
    private $product_image;
	private $source_website;
	
		public function getProduct_name() {
			return $this->product_name;
		}

		public function setProduct_name($product_name) {
			$this->product_name = $product_name;
			return $this;
		}

		public function getProduct_price() {
			return $this->product_price;
		}

		public function setProduct_price($product_price) {
			$this->product_price = $product_price;
			return $this;
		}

		public function getProduct_link() {
			return $this->product_link;
		}

		public function setProduct_link($product_link) {
			$this->product_link = $product_link;
			return $this;
		}

		public function getProduct_image() {
			return $this->product_image;
		}

		public function setProduct_image($product_image) {
			$this->product_image = $product_image;
			return $this;
		}	

		public function getSource_website() {
			return $this->source_website;
		}
		
		public function setSource_website($source_website) {
			$this->source_website = $source_website;
			return $this;
		}
	}
?>