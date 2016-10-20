<?php	
	class CoursesController extends BaseController {
		public function getAssessment(){
			return View::make('services.assessment');
		}

		public function getCompliance(){
			return View::make('services.compliance');
		}

		public function getDataProtection(){
			return View::make('services.data_protection');
		}

		public function getSocCert(){
			return View::make('services.soc_cert');
		}

		public function getAdmin(){
			return View::make('services.resources_management');
		}
		
	}
?>

