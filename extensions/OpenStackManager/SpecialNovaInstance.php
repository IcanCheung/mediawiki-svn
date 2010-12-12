<?php
class SpecialNovaInstance extends SpecialPage {

	var $adminNova, $userNova;

	function __construct() {
		parent::__construct( 'NovaInstance' );
	}
 
	function execute( $par ) {
		global $wgRequest;
		global $wgOpenStackManagerNovaAdminKeys;

		wfLoadExtensionMessages('OpenStackManager');
		$user = new OpenStackNovaUser();
		if ( ! $user->exists() ) {
			$this->noCredentials();
			return true;
		}
		$project = $wgRequest->getVal('project');
		$userCredentials = $user->getCredentials( $project );
		$this->userNova = new OpenStackNovaController( $userCredentials );
		$adminCredentials = $wgOpenStackManagerNovaAdminKeys;
		$this->adminNova = new OpenStackNovaController( $adminCredentials );

		$action = $wgRequest->getVal('action');

		if ( $action == "create" ) {
			if ( ! $user->inProject( $project ) ) {
				$this->notInProject();
				return true;
			}
			$this->createInstance();
		} else if ( $action == "modify" ) {
			if ( ! $user->inProject( $project ) ) {
				$this->notInProject();
				return true;
			}
			$this->modifyInstance();
		} else {
			$this->listInstances();
		}
	}

	function noCredentials() {
		global $wgOut;

		$this->setHeaders();
		$wgOut->setPagetitle("No Nova credentials found for your account");
		$wgOut->addHTML('<p>There were no Nova credentials found for your user account. Please ask a Nova administrator to create credentials for you.</p>');
	}

	function notInProject() {
		global $wgOut;

		$this->setHeaders();
		$wgOut->setPagetitle("Your account is not in the project requested");
		$wgOut->addHTML('<p>You can not complete the action requested as your user account is not in the project requested.</p>');
	}

	function createInstance() { 
		global $wgRequest, $wgOut;

		$this->setHeaders();
		$wgOut->setPagetitle("Create Instance");
 
		$project = $wgRequest->getVal('project');

		# TODO: Add project name field

		$instanceInfo = Array(); 
		$instanceInfo['instanceName'] = array(
			'type' => 'text',
			'label-message' => 'instancename',
			'default' => '',
			'section' => 'instance/info',
		);

		$instanceTypes = $this->adminNova->getInstanceTypes();
		$instanceType_keys = Array();
		foreach ( $instanceTypes as $instanceType ) {
			$instanceType_keys["$instanceType"] = $instanceType;
		}
		$instanceInfo['instanceType'] = array(
			'type' => 'select',
			'section' => 'instance/info',
			'options' => $instanceType_keys,
			'label-message' => 'instancetype',
		);

		# Availability zone names can't be translated. Get the keys, and make an array
		# where the name points to itself as a value
		$availabilityZones = $this->adminNova->getAvailabilityZones();
		$availabilityZone_keys = Array();
		foreach ( array_keys( $availabilityZones ) as $availabilityZone_key ) {
			$availabilityZone_keys["$availabilityZone_key"] = $availabilityZone_key;
		}
		$instanceInfo['availabilityZone'] = array(
			'type' => 'select',
			'section' => 'instance/info',
			'options' => $availabilityZone_keys,
			'label-message' => 'availabilityzone',
		);

		# Image names can't be translated. Get the image, and make an array
		# where the name points to itself as a value
		$images = $this->adminNova->getImages();
		$image_keys = Array();
		foreach ( array_keys($images) as $image_key ) {
			$image_keys["$image_key"] = $image_key;
		}
		$instanceInfo['imageType'] = array(
			'type' => 'select',
			'section' => 'instance/info',
			'options' => $image_keys,
			'label-message' => 'imagetype',
		);

		# Keypair names can't be translated. Get the keys, and make an array
		# where the name points to itself as a value
		# TODO: get keypairs as the user, not the admin
		$keypairs = $this->userNova->getKeypairs();
		$keypair_keys = Array();
		foreach ( array_keys( $keypairs ) as $keypair_key ) {
			$keypair_keys["$keypair_key"] = $keypair_key;
		}
		$instanceInfo['keypair'] = array(
			'type' => 'select',
			'section' => 'instance/info',
			'options' => $keypair_keys,
			'label-message' => 'keypair',
		);

		$instanceInfo['action'] = array(
			'type' => 'hidden',
			'default' => 'create',
		);

		$instanceInfo['project'] = array(
			'type' => 'hidden',
			'default' => htmlentities( $project ),
		);

		#TODO: Add availablity zone field

		$instanceForm = new OpenStackCreateInstanceForm( $instanceInfo, 'novainstance-form' );
		$instanceForm->setTitle( SpecialPage::getTitleFor( 'NovaInstance' ));
		$instanceForm->setSubmitID( 'novainstance-form-createinstancesubmit' );
		$instanceForm->setSubmitCallback( array( $this, 'tryCreateSubmit' ) );
		$instanceForm->show();

	}

	function modifyInstance() {
		return true;
	}

	function listInstances() {
		global $wgOut;

		$this->setHeaders();
		$wgOut->setPagetitle("Instance list");

		$out = '';
		$instances = $this->adminNova->getInstances();
		$out .= Html::element( 'th', array(), 'ID' );
		$out .= Html::element( 'th', array(), 'State' );
		$out .= Html::element( 'th', array(), 'Type' );
		$out .= Html::element( 'th', array(), 'Image ID' );
		$out .= Html::element( 'th', array(), 'Project' );
		foreach ( $instances as $instance ) {
			$instanceOut = Html::element( 'td', array(), $instance->getInstanceId() );
			$instanceOut .= Html::element( 'td', array(), $instance->getInstanceState() );
			$instanceOut .= Html::element( 'td', array(), $instance->getInstanceType() );
			$instanceOut .= Html::element( 'td', array(), $instance->getImageId() );
			$instanceOut .= Html::element( 'td', array(), $instance->getOwner() );
			$out .= Html::rawElement( 'tr', array(), $instanceOut );
		}
		$out = Html::rawElement( 'table', array( 'id' => 'novainstancelist', 'class' => 'wikitable' ), $out );

		$wgOut->addHTML( $out );
	}

	function tryCreateSubmit( $formData, $entryPoint = 'internal' ) {
		global $wgOut;

		$instance = $this->userNova->createInstance( $formData['imageType'], $formData['keypair'],
						  $formData['instanceType'], $formData['availabilityZone'] );

		$out = Html::element( 'p', array(), 'Created instance ' . $instance->getInstanceID() . ' with image ' . $instance->getImageId() );

		$wgOut->addHTML( $out );
		return true;
	}
}

class OpenStackCreateInstanceForm extends HTMLForm {
}
