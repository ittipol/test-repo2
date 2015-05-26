<?php

	function logoSwitcher($route = ''){

		switch ($route) {
			case 'main':
				return 'assets/img/eportal_logo.png';
				break;
			
			case 'paid_list':
				return 'assets/img/payportal_logo.png';
				break;

			case 'invoiceinfo':
				return 'assets/img/payportal_logo.png';
				break;

			case 'billing':
				return 'assets/img/payportal_logo.png';
				break;

			case 'paid_completed':
				return 'assets/img/payportal_logo.png';
				break;

			default:
				return 'assets/img/eportal_logo.png';
		}

	}

	function titleSwitcher($route = ''){

		switch ($route) {
			case 'main':
				return 'ePortal';
				break;
			
			case 'paid_list':
				return 'PayPortal';
				break;

			case 'invoiceinfo':
				return 'PayPortal';
				break;

			case 'billing':
				return 'PayPortal';
				break;

			case 'paid_completed':
				return 'PayPortal';
				break;

			default:
				return 'ePortal';
		}

	}

?>